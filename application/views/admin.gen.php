<?php include $layout->header; ?>

    <?php


      $dbname = MYSQL_DATABASE;
      $is_sdtm  = null;

      $cmd = request("cmd");
      if(!empty($cmd)){
        $columns = request("columns");
        $all_columns = request("all_columns");

        if(!empty($columns)){
          $column_values = explode("|", $columns);
        }else if(!empty($all_columns)){
          $column_values = explode("\n", $all_columns);
        }else{
          die("No column values");
        }

        for($i=0;$i<count($column_values);$i++){
          $column_values[$i] = trim($column_values[$i]);
          if(empty($column_values[$i])) unset($column_values[$i]);
        }

        $column_names = Array();
        $column_types = Array();
        $parameter_names = Array();
        $parameter_inputs = Array();
        $column_settings = Array();
        $dao_params = Array();
        $sp_params = Array();
        $spi_params = Array();

        for($i=0;$i<count($column_values);$i++){
          $column_value = trim($column_values[$i]);
          list($column_name, $column_type) = explode(" ", $column_value);
          if($column_type == 'datetime') $column_type = 'datetime(6)';
          array_push($column_names, $column_name);
          array_push($column_types, $column_type);
          array_push($parameter_names, sprintf("p_$column_name"));
          array_push($parameter_inputs, sprintf("p_$column_name $column_type"));
          array_push($column_settings, sprintf("$column_name = p_$column_name"));
          array_push($dao_params, sprintf("\$$column_name"));

          $is_decimal = !(strpos($column_type, "decimal") === false);
          $is_int = !(strpos($column_type, "int") === false);
          $is_bit = !(strpos($column_type, "bit") === false);
          $is_num = $is_decimal || $is_int || $is_bit;
          array_push($sp_params, $is_num?"\$$column_name":"'\$$column_name'");
          array_push($spi_params, $is_decimal?'d':($is_int?'i':($is_bit?'i':'s')));
        }

        $dbname = request("dbname");
        $tablename = request("tablename");
        $statprefix = substr($tablename, 0, 3);
        $audit = request("audit");
        $sdtm = request("sdtm");
        $is_sdtm = !empty($sdtm);
        $auto = request("auto");
        $dbw = request("dbw");
        $flw = request("flw");

        $id_column_name = $column_names[0];
        $id_column_type = $column_types[0];

        if(empty($tablename)) $tablename = preg_replace('/\_(i|c)d/i', '', $id_column_name);
        if($id_column_type == "int") $id_column_type = "int unsigned auto_increment";
        $id_column_def = "$id_column_name $id_column_type";
        $is_type = ends_with($tablename, '_type');
        if(!$is_type) $id_column_def .= " not null";

        if($is_type){
          $sdtm = null;
          $is_sdtm = false;
          $audit = null;
        }

        //var_die($is_sdtm);

        $column_list = implode(",\n\t", array_slice($column_names, 0));
        $insert_column_list = implode(",\n\t", array_slice($column_names, 1));
        $new_column_list = sprintf("new.%s", implode(",\n\tnew.", array_slice($column_names, 0)));
        $old_column_list = sprintf("old.%s", implode(",\n\told.", array_slice($column_names, 0)));
        $parameter_list = implode(",\n\t", array_slice($parameter_names, 0));
        $insert_parameter_list = implode(",\n\t", array_slice($parameter_names, 1));
        $settings_list = implode(",\n\t", array_slice($column_settings, 1));

        $select_params = "$parameter_inputs[0]";
        $insert_params = implode(",\n\t", array_slice($parameter_inputs, 1));
        $update_params = implode(",\n\t", $parameter_inputs);
        $upsert_params = implode(",\n\t", $parameter_inputs);
        $delete_params = "$parameter_inputs[0]";

        if($is_sdtm){
          $insert_params = sprintf("%s,\n\tp_creation_user_id varchar(36)", $insert_params);
          $update_params = sprintf("%s,\n\tp_last_update_user_id varchar(36)", $update_params);
        }

        $columns_def = implode(",\n\t", array_slice($column_values, 1));

        $audit_sql = ($is_sdtm && !$is_type)? ",\n\tcreation_user_id varchar(36),\n\tcreation_dtm datetime(6),\n\tlast_update_user_id varchar(36),\n\tlast_update_dtm datetime(6)":"";

        $create_sql = sprintf("DROP TABLE IF EXISTS `%s`.`%s`;\nCREATE TABLE `%s`.`%s` (\n\t%s,\n\t%s%s,\n\tprimary key (`%s`)\n)ENGINE=InnoDB DEFAULT CHARSET=latin1;", $dbname, $tablename, $dbname, $tablename, $id_column_def, $columns_def, $audit_sql, $id_column_name);
        $create_audit_sql = sprintf("DROP TABLE IF EXISTS `%s`.`%s_audit`;\nCREATE TABLE `%s`.`%s_audit` (\n\taudit_id varchar(36),\n\taudit_cd varchar(10),\n\taudit_dtm datetime(6),\n\tprocess_flag tinyint,\n\t%s,\n\t%s%s,\n\tprimary key (`audit_id`)\n)ENGINE=InnoDB DEFAULT CHARSET=latin1;", $dbname, $tablename, $dbname, $tablename, $id_column_def, $columns_def, $audit_sql);
        $audit_tr = sprintf("DELIMITER $$\n\nDROP TRIGGER IF EXISTS `%s`.`tr_%s_ains` $$\nCREATE TRIGGER `%s`.`tr_%s_ains` after insert on `%s`.`%s` for each row\nbegin\ninsert into %s_audit\n(\n\taudit_id,\n\taudit_cd,\n\taudit_dtm,\n\tprocess_flag,\n\t%s,\n\tcreation_user_id,\n\tcreation_dtm,\n\tlast_update_user_id,\n\tlast_update_dtm\n)\nvalues\n(\n\truuid(),\n\t'ins',\n\tutc_timestamp,\n\t1,\n\t%s,\n\tnew.creation_user_id,\n\tnew.creation_dtm,\n\tnew.last_update_user_id,\n\tnew.last_update_dtm\n);\nend $$\n\nDELIMITER ;\n\n", $dbname, $tablename, $dbname, $tablename, $dbname, $tablename, $tablename, $column_list, $new_column_list);

        $select = "select\n";
        for($i=0;$i<count($column_names);$i++){
          $column_name = $column_names[$i];
          $select .= "\ta.$column_name,\n";
        }
        if($is_sdtm && !$is_type){
          $select .= "\ta.creation_user_id,\n\ta.creation_dtm,\n\ta.last_update_user_id,\n\ta.last_update_dtm";
        }else{
          $select = rtrim($select, ",\n");
        }
        $select .= sprintf("\nfrom\n\t%s a", $tablename);

        $select_all_sql = sprintf("%s;\n", $select);
        $select_sql = sprintf("%s\nwhere\n\ta.%s;\n", $select, $column_settings[0]);

        if($is_sdtm){
          if(starts_with($id_column_type, "int")){
            $insert_sql = sprintf("insert %s\n(\n\t%s,\n\tcreation_user_id,\n\tcreation_dtm\n)\nvalues\n(\n\t%s,\n\tp_creation_user_id,\n\tutc_timestamp\n);\n\n%s\nwhere\n\ta.%s = last_insert_id();\n", $tablename, $insert_column_list, $insert_parameter_list, $select, $id_column_name);
          }else if($id_column_type == "varchar(36)"){
            $insert_sql = sprintf("declare p_%s %s;\nset p_%s = ruuid();\n\ninsert %s\n(\n\t%s,\n\tcreation_user_id,\n\tcreation_dtm\n)\nvalues\n(\n\t%s,\n\tp_creation_user_id,\n\tutc_timestamp\n);\n\n%s\nwhere\n\ta.%s = p_%s;\n", $id_column_name, $id_column_type, $id_column_name, $tablename, $column_list, $parameter_list, $select, $id_column_name, $id_column_name);
          }else{
            die("Unsupported id_column_type: $id_column_type");
          }
          $update_sql = sprintf("update\n\t%s\nset\n\t%s,\n\tlast_update_user_id = p_last_update_user_id,\n\tlast_update_dtm = utc_timestamp\nwhere\n\t%s;\n\n%s\nwhere\n\ta.%s;\n", $tablename, $settings_list, $column_settings[0], $select, $column_settings[0] );
        }else{
          if(starts_with($id_column_type, "int")){
            $insert_sql = sprintf("insert %s\n(\n\t%s\n)\nvalues\n(\n\t%s\n);\n\n%s\nwhere\n\ta.%s = last_insert_id();\n", $tablename, $insert_column_list, $insert_parameter_list, $select, $id_column_name);
          }else if($id_column_type == "varchar(36)"){
            $insert_sql = sprintf("declare p_%s %s;\nset p_%s = ruuid();\n\ninsert %s\n(\n\t%s\n)\nvalues\n(\n\t%s\n);\n\n%s\nwhere\n\ta.%s = p_%s;\n", $id_column_name, $id_column_type, $id_column_name, $tablename, $column_list, $parameter_list, $select, $id_column_name, $id_column_name);
          }else if($id_column_type == "varchar(10)"){
            $insert_sql = sprintf("insert %s\n(\n\t%s\n)\nvalues\n(\n\t%s\n);\n\n%s\nwhere\n\ta.%s = p_%s;\n", $tablename, $column_list, $parameter_list, $select, $id_column_name, $id_column_name);
          }else{
            die("Unsupported id_column_type: $id_column_type");
          }
          $update_sql = sprintf("update\n\t%s\nset\n\t%s\nwhere\n\t%s;\n\n%s\nwhere\n\ta.%s;\n", $tablename, $settings_list, $column_settings[0], $select, $column_settings[0] );
        }

        $upsert_insert_sql = sprintf("insert %s\n(\n\t%s\n)\nvalues\n(\n\t%s\n)", $tablename, $column_list, $parameter_list);
        $upsert_update_sql .= sprintf("update\n\t%s", $settings_list);
        $upsert_sql = sprintf("%s\non duplicate key %s;\n\n%s\nwhere\n\ta.%s;\n", $upsert_insert_sql, $upsert_update_sql, $select, $column_settings[0]);

        // insert table (col) values (val) on duplicate key update col = value;
        $n = $is_type? 'cd' : 'id';

        $delete_sql = sprintf("delete from\n\t%s\nwhere\n\t%s;\n", $tablename, $column_settings[0]);
        $truncate_sql = sprintf("truncate table %s;\n", $tablename);

        $select_all_sp = get_sp($dbname, "sp_".$tablename."_get", $select_all_params, $select_all_sql);
        $select_sp = get_sp($dbname, "sp_".$tablename."_get_by_".$n, $select_params, $select_sql);
        $upsert_sp = get_sp($dbname, "sp_".$tablename."_ups", $upsert_params, $upsert_sql);
        $insert_sp = get_sp($dbname, "sp_".$tablename."_ins", $insert_params, $insert_sql);
        $update_sp = get_sp($dbname, "sp_".$tablename."_upd", $update_params, $update_sql);
        $delete_sp = get_sp($dbname, "sp_".$tablename."_del", $delete_params, $delete_sql);
        $truncate_sp  = get_sp($dbname, "sp_".$tablename."_trn", $truncate_params, $truncate_sql);


        $create_db = sprintf("CREATE DATABASE IF NOT EXISTS `%s`;\nUSE `%s`;\n", $dbname, $dbname);
        if($is_type){
          $all_sql = sprintf("%s\n\n%s\n\n%s\n\n%s", $create_db, $create_sql, $select_all_sp, $select_sp);
        }else{
          if(!empty($audit)){
           $all_sql = sprintf("%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s", $create_db, $create_sql, $create_audit_sql, $audit_tr, $select_all_sp, $select_sp, $insert_sp, $update_sp, $delete_sp, $truncate_sp);
          }else{
            $all_sql = sprintf("%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s\n\n%s", $create_db, $create_sql, $select_all_sp, $select_sp, $insert_sp, $update_sp, $delete_sp, $truncate_sp);
          }
        }

        //printpre($upsert_sp);
        //printpre($create_sql);
        //printpre($insert_sp);
        //printpre($update_sp);
        //printpre($delete_sp);
        //printpre($select_sp);

        //printpre($delete_dao);
        //printpre($upsert_dao);

        $class_object = get_class_object($tablename, $column_names, $id_column_name, $spi_params, $is_sdtm);
        $class_php = sprintf("<?php\n%s\n?>", $class_object);
        //printpre($class_object);

        $all_sql = preg_replace('/\t/', '  ', $all_sql);
        $class_php = preg_replace('/\t/', '  ', $class_php);

        $document_root = $_SERVER['DOCUMENT_ROOT'];

        if($dbw){

          $file_path = tempnam(sys_get_temp_dir(), 'admin.gen');
          $myfile = fopen($file_path, "w") or die("Unable to open file $file_path");
          fwrite($myfile, $all_sql);
          fclose($myfile);

          $shell_cmd = sprintf("mysql -u%s -p%s -h %s -D %s < %s", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_SERVER, MYSQL_DATABASE, $file_path);
          $output = shell_exec($shell_cmd);

          if(!empty($output)) var_dump($output);
        }

        if($flw){
          $file_name = strtolower($tablename);
          $file_name = preg_replace('/[^a-z]/','',$file_name);
          $file_name = sprintf("%s.class.php", $file_name);
          $file_path = sprintf("%s/application/classes/%s", $document_root, $file_name);
          file_put_contents($file_path, $class_php);
        }

      }else{
        $sdtm = 'on';
        $auto = 'on';
        $dbw = 'on';
        $flw = 'on';
      }

function get_sp($dbname, $sp_name, $sp_params, $sp_sql){
  $sp = "DELIMITER $$\n";
  $sp .= "\n";
  $sp .= "DROP PROCEDURE IF EXISTS `$dbname`.`$sp_name` $$\n";
  $sp .= "CREATE PROCEDURE `$dbname`.`$sp_name`(";
  if(strlen($sp_params) > 0) $sp .= "\n\t$sp_params\n";
  $sp .= ")\n";
  $sp .= "BEGIN\n";
  $sp .= "\n";
  $sp .= "$sp_sql\n";
  $sp .= "\n";
  $sp .= "END $$\n";
  $sp .= "\n";
  $sp .= "DELIMITER ; \n";
  return $sp;
}

function printpre($s){
  print("<pre>$s</pre>");
}

function print4($s){
  print("<h4>$s</h4>");
}


function get_class_object($tablename, $column_names, $id_column_name, $spi_params, $is_sdtm){

  $is_type = ends_with($tablename, '_type');

  $parts = explode('_', $tablename);
  for($i=0;$i<count($parts);$i++){
    $parts[$i] = ucfirst(strtolower($parts[$i]));
  }
  $classname = implode('', $parts);

  $sp = sprintf("class %s{\n", $classname);
  for($i=0;$i<count($column_names);$i++){
    $column_name = $column_names[$i];
    $property_name = $column_name;
    $sp .= sprintf("\tpublic \$%s;\n", $property_name);
  }
  $tablename = strtolower($tablename);

  if($is_sdtm && !$is_type){
    $sp .= "\tpublic \$creation_user_id;\n";
    $sp .= "\tpublic \$creation_dtm;\n";
    $sp .= "\tpublic \$last_update_user_id;\n";
    $sp .= "\tpublic \$last_update_dtm;\n";
  }
  $sp .= "\t\n";

  $sp .= "\tfunction __construct(){\n";
  $sp .= "\t\t\$num_args = func_num_args();\n";
  $sp .= "\t\tswitch(\$num_args){\n";
  $sp .= "\t\t\tcase 0:\n";
  $sp .= "\t\t\t\t\$this->$id_column_name = 0;\n";
  $sp .= "\t\t\tbreak;\n";
  $sp .= "\t\t\tcase 1:\n";
  $sp .= "\t\t\t\t\$result = func_get_arg(0);\n";
  $sp .= "\t\t\t\tforeach(\$result as \$key => \$value) \$this->\$key = \$value;\n";
  $sp .= "\t\t\tbreak;\n";
  $sp .= "\t\t}\n";
  $sp .= "\t}\n";
  $sp .= "\t\n";

  $sp .= "\tfunction __toString(){\n";
  $sp .= "\t\treturn get_class(\$this);\n";
  $sp .= "\t}\n";
  $sp .= "\t\n";


  if(ends_with($id_column_name, '_type_cd') || !(array_search('name', $column_names) === false)){
    $sp .= "\tstatic function GetValues(){\n";
    $sp .= "\t\t\$values = array();\n";
    $sp .= "\t\t\$items = $classname::GetAll();\n";
    if(!(array_search('name', $column_names) === false)){
      $sp .= "\t\tforeach(\$items as \$item) \$values[\$item->".$tablename."_id] = \$item->name;\n";
    }else{
      $sp .= "\t\tforeach(\$items as \$item) \$values[\$item->".$tablename."_cd] = \$item->".$tablename."_name;\n";
    }
    $sp .= "\t\treturn \$values;\n";
    $sp .= "\t}\n";
    $sp .= "\t\n";
  }

  $sp .= "\tstatic function GetAll(){\n";
  $sp .= "\t\t\$values = array();\n";
  $sp .= "\t\t\$sql = \"call sp_".$tablename."_get\";\n";
  $sp .= "\t\t\$results = MySQL::Execute(\$sql);\n";
  $sp .= "\t\tif(\$results) foreach(\$results as \$result) \$values[] = new $classname(\$result);\n";
  $sp .= "\t\treturn \$values;\n";
  $sp .= "\t}\n";
  $sp .= "\t\n";


  $spv_params = Array();
  $spn_params = Array();
  for($i=0;$i<1;$i++){
    $spv_params[$i] = '?';
    $spn_param = "\$this->".$column_names[$i];
    if(ends_with($column_names[$i], '_flag')) $spn_param = "to_bit(\$this->".$column_names[$i].")";
    else if(ends_with($column_names[$i], '_date')) $spn_param = "date_time_six(\$this->".$column_names[$i].")";
    else if(ends_with($column_names[$i], '_dtm')) $spn_param = "date_time_six(\$this->".$column_names[$i].")";
    $spn_params[$i] =  $spn_param;
  }
  $spi = implode('', array_slice($spi_params, 0, 1));
  $spv = implode(', ', $spv_params);
  $spn = implode(', ', $spn_params);

  $n = $is_type? 'Cd' : 'Id';

  $sp .= "\tstatic function GetBy$n(\$$id_column_name){\n";
  $sp .= "\t\t\$value = null;\n";
  $sp .= "\t\t\$sql = \"call sp_".$tablename."_get_by_".strtolower($n)."($spv)\";\n";
  $sp .= "\t\t\$params = array('$spi', \$$id_column_name);\n";
  $sp .= "\t\t\$results = MySQL::Execute(\$sql, \$params);\n";
  $sp .= "\t\tif(\$results) \$value = new $classname(\$results[0]);\n";
  $sp .= "\t\treturn \$value;\n";
  $sp .= "\t}\n";
  $sp .= "\t\n";

  $n = $is_type? 0 : 1;

  $spv_params = Array();
  $spn_params = Array();
  for($i=$n;$i<count($spi_params);$i++){
    $spv_params[$i] = '?';
    $spn_param = "\$this->".$column_names[$i];
    if(ends_with($column_names[$i], '_flag')) $spn_param = "to_bit(\$this->".$column_names[$i].")";
    else if(ends_with($column_names[$i], '_date')) $spn_param = "date_time_six(\$this->".$column_names[$i].")";
    else if(ends_with($column_names[$i], '_dtm')) $spn_param = "date_time_six(\$this->".$column_names[$i].")";
    $spn_params[$i] =  $spn_param;
  }
  $spi = implode('', array_slice($spi_params, $n));
  $spv = implode(', ', $spv_params);
  $spn = implode(', ', $spn_params);


  if(!$is_type) {

    if($is_sdtm) {
      $spi = sprintf("%ss", $spi);
      $spv = sprintf("%s, ?", $spv);
      $spn = sprintf("%s, %s", $spn, '$this->creation_user_id');
    }

    $sp .= "\tfunction Create(){\n";
    $sp .= "\t\t\$value = null;\n";
    $sp .= "\t\t\$sql = \"call sp_".$tablename."_ins($spv)\";\n";
    $sp .= "\t\t\$params = array('$spi', $spn);\n";
    $sp .= "\t\t\$results = MySQL::Execute(\$sql, \$params);\n";
    $sp .= "\t\tif(\$results){\n";
    $sp .= "\t\t\t\$this->$id_column_name = \$results[0]->$id_column_name;\n";
    if($is_sdtm) $sp .= "\t\t\t\$this->creation_dtm = \$results[0]->creation_dtm;\n";
    $sp .= "\t\t}\n";
    $sp .= "\t}\n";
    $sp .= "\t\n";


    $spv_params = Array();
    $spn_params = Array();
    for($i=0;$i<count($spi_params);$i++){
      $spv_params[$i] = '?';
      $spn_param = "\$this->".$column_names[$i];
      if(ends_with($column_names[$i], '_flag')) $spn_param = "to_bit(\$this->".$column_names[$i].")";
      else if(ends_with($column_names[$i], '_date')) $spn_param = "date_time_six(\$this->".$column_names[$i].")";
      else if(ends_with($column_names[$i], '_dtm')) $spn_param = "date_time_six(\$this->".$column_names[$i].")";
      $spn_params[$i] =  $spn_param;
    }
    $spi = implode('', $spi_params);
    $spv = implode(', ', $spv_params);
    $spn = implode(', ', $spn_params);

    if($is_sdtm){
      $spi = sprintf("%ss", $spi);
      $spv = sprintf("%s, ?", $spv);
      $spn = sprintf("%s, %s", $spn, '$this->last_update_user_id');
    }

    $sp .= "\tfunction Update(){\n";
    $sp .= "\t\t\$value = null;\n";
    $sp .= "\t\t\$sql = \"call sp_".$tablename."_upd($spv)\";\n";
    $sp .= "\t\t\$params = array('$spi', $spn);\n";
    $sp .= "\t\t\$results = MySQL::Execute(\$sql, \$params);\n";
    if($is_sdtm){
      $sp .= "\t\tif(\$results){\n";
      $sp .= "\t\t\t\$this->last_update_dtm = \$results[0]->last_update_dtm;\n";
      $sp .= "\t\t}\n";
    }
    $sp .= "\t}\n";
    $sp .= "\t\n";

    $sp .= "\tfunction Save(){\n";
    $sp .= "\t\tif(empty(\$this->$id_column_name)){\n";
    $sp .= "\t\t\t\$this->Create();\n";
    $sp .= "\t\t}else{\n";
    $sp .= "\t\t\t\$this->Update();\n";
    $sp .= "\t\t}\n";
    $sp .= "\t}\n";
    $sp .= "\t\n";
  }

  $spv_params = Array();
  $spn_params = Array();
  for($i=0;$i<1;$i++){
    $spv_params[$i] = '?';
    $spn_param = "\$this->".$column_names[$i];
    if(ends_with($column_names[$i], '_flag')) $spn_param = "to_bit(\$this->".$column_names[$i].")";
    else if(ends_with($column_names[$i], '_date')) $spn_param = "date_time_six(\$this->".$column_names[$i].")";
    else if(ends_with($column_names[$i], '_dtm')) $spn_param = "date_time_six(\$this->".$column_names[$i].")";
    $spn_params[$i] =  $spn_param;
  }
  $spi = implode('', array_slice($spi_params, 0, 1));
  $spv = implode(', ', $spv_params);
  $spn = implode(', ', $spn_params);

  if(!$is_type) {

    $sp .= "\tfunction Delete(){\n";
    $sp .= "\t\t\$sql = \"call sp_".$tablename."_del($spv)\";\n";
    $sp .= "\t\t\$params = array('$spi', $spn);\n";
    $sp .= "\t\tMySQL::Execute(\$sql, \$params);\n";
    $sp .= "\t}\n";
    $sp .= "\t\n";

    $sp .= "\tfunction Truncate(){\n";
    $sp .= "\t\t\$sql = \"call sp_".$tablename."_trn()\";\n";
    $sp .= "\t\tMySQL::Execute(\$sql);\n";
    $sp .= "\t}\n";
  }

  $sp .= "\t\n";
  $sp .= "}";

  return $sp;
}

?>

<div class="r cnt">
<div class="c12">


      <h1>Gen</h1>
        <input type="hidden" name="cmd" value="createstat" />
        <table border="0" cellpadding="0" cellspacing="0" class="gen-header">
          <tr>
            <td>
              <div class="label">db name</div>
              <input type="text" name="dbname" value="<?php print $dbname ?>" />
            </td>
            <td>
              <div class="label">table name</div>
              <input type="text" name="tablename" value="<?php print $tablename ?>" />
            </td>
            <td align="center">
              <div class="label">aud</div>
              <input type="checkbox" name="audit" <?php if(!empty($audit)) echo "checked=checked" ?> />
            </td>
            <td align="center">
              <div class="label">sdtm</div>
              <input type="checkbox" name="sdtm" <?php if(!empty($sdtm)) echo "checked=checked" ?> />
            </td>
            <td align="center">
              <div class="label">dbw</div>
              <input type="checkbox" name="dbw" <?php if(!empty($dbw)) echo "checked=checked" ?> />
            </td>
            <td align="center">
              <div class="label">flw</div>
              <input type="checkbox" name="flw" <?php if(!empty($flw)) echo "checked=checked" ?> />
            </td>
            <td align="center">
              <div class="label">auto</div>
              <input type="checkbox" name="auto" <?php if(!empty($auto)) echo "checked=checked" ?> />
            </td>
            <td>
              <div class="label">&nbsp;</div>
              <input class="submit" type="submit" value="Submit" class="button" />
            </td>
          </tr>
        </table>

      <hr class="gen"/>

      <table border="0" cellpadding="0" cellspacing="0" class="gen">
        <tr>
          <td>
            <h4>Columns</h4>
            <textarea name="all_columns" class="half" wrap='off'><?php print "$all_columns" ?></textarea>
          </td>
        </tr>
        <tr>
          <td>
            <h4>Sql</h4>
            <textarea wrap='off'><?php print "$all_sql" ?></textarea>
          </td>
        </tr>
        <tr>
          <td>
            <h4>Class</h4>
            <textarea wrap='off'><?php print "$class_php" ?></textarea>
          </td>
        </tr>
      </table>


</div>
<div class="re"></div>
</div>

<?php include $layout->footer; ?>


