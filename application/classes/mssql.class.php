<?php

class MsSQL{
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

    trace('MSSQL_DSN:'.MSSQL_DSN);
    trace('MSSQL_USERNAME:'.MSSQL_USERNAME);
    trace('MSSQL_PASSWORD:'.MSSQL_PASSWORD);

    $conn = odbc_connect(MSSQL_DSN, MSSQL_USERNAME, MSSQL_PASSWORD);

    trace('32');

    if(!$conn) trace('mssql connect failed');

    if(!empty($params) && count($params) > 1){

      $sql = str_replace('(', ' ', $sql);
      $sql = str_replace(')', ' ', $sql);
      $sql = trim($sql);

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

          //$param_value = $mysqli->real_escape_string($param_value);

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
    }else{
      trace('nothing 68');
    }

    if(strpos($sql, 'sp_user_get') === 0){
      //trace($sql);
    }

    if(starts_with($sql, 'call ')){
      $sql = substr($sql, 5);
    }

    trace($sql);

    $rs = odbc_exec($conn, $sql);
    if (!$rs) exit("Error in SQL: $sql");

    while($row = odbc_fetch_array($rs)){
      $item = (object)$row;
      $items[] = $item;
    }

    odbc_close($conn);
    return $items;
  }

}
