<?php

class MySQL{
	function __construct(){
	}
	function __toString(){
		return get_class($this);
	}

  static function Execute(){

    $items = array();
		$params = array();

		$num_args = func_num_args();
		switch($num_args){
			case 1:
				$sql = func_get_arg(0);
			break;
			case 2:
				$sql = func_get_arg(0);
				$params = func_get_arg(1);
			break;
		}


    //trace('MYSQL_SERVER:'.MYSQL_SERVER);
    //trace('MYSQL_USERNAME:'.MYSQL_USERNAME);
    //trace('MYSQL_PASSWORD:'.MYSQL_PASSWORD);
    //trace('MYSQL_DATABASE:'.MYSQL_DATABASE);

    $mysqli = new mysqli(MYSQL_SERVER, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
    if($mysqli->connect_errno) {
     die(sprintf("MySQL connect failed: %s", $mysqli->error));
    }

    //trace(sprintf("Initial character set: %s", $mysqli->character_set_name()));
    if (!$mysqli->set_charset("utf8")) {
      die(sprintf("Error loading character set utf8: %s", $mysqli->error));
    // } else {
    //   trace(sprintf("Current character set: %s", $mysqli->character_set_name()));
    }

  	if(!empty($params) && count($params) > 1){

      $param_types = str_split($params[0]);
      $param_types_count = count($param_types);
  	  $param_count = count($params)-1;
  	  $place_count = substr_count($sql, '?');

      if($param_types_count == $param_count && $param_count == $place_count){
        $sqlo = '';
        $i = 0;
        $offset = 0;
        while(($p = strpos($sql, '?', $offset)) !== false){
          $sql_value = substr($sql, $offset, ($p - $offset));
          $param = $params[$i+1];
          $param_type = $param_types[$i];
          $param_value = sprintf("%s", $param);
          $param_value = $mysqli->real_escape_string($param_value);
          if(($param_type == 's' || $param_type == 'b') && strlen($param_value) > 0) $param_value = sprintf("'%s'", $param_value);
					if(strlen($param_value) == 0) $param_value = 'null';
					if($param_value == 'on' && $param_type == 'i') $param_value = 1;
					if($param_value == 'off' && $param_type == 'i') $param_value = 0;
          $sqlo .= sprintf("%s%s", $sql_value, $param_value);
          $offset = $p+1;
          $i++;
        }
        if($offset <= strlen($sql)) $sqlo .= substr($sql, $offset);
        $sql = $sqlo;
      }
  	}

		if(strpos($sql, MYSQL_FILTER) === 0){
			trace($sql);
		}

    $b = $mysqli->multi_query($sql);
    if(!$b){
      $values = $mysqli->error_list;
      die('multi_query failed:'.$mysqli->errno.':'.$mysqli->error.':'.$sql);
    }

		//$b = true;
    do{
      $result = $mysqli->store_result();


      if($result && gettype($result) == 'object'){
        while($item = $result->fetch_object()){
          $items[] = $item;
        }
        $result->free();
      }

      $b = $mysqli->more_results();
      if($b){
				$mysqli->next_result();
      }

    }while($b);

    $mysqli->close();

    //trace(count($items));

    return $items;
  }

}
