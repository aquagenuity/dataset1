<?php
class FilterType{
  public $filter_type_cd;
  public $filter_type_name;
  public $filter_type_description;
  
  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->filter_type_cd = 0;
      break;
      case 1:
        $result = func_get_arg(0);
        foreach($result as $key => $value) $this->$key = $value;
      break;
    }
  }
  
  function __toString(){
    return get_class($this);
  }
  
  static function GetValues(){
    $values = array();
    $items = FilterType::GetAll();
    foreach($items as $item) $values[$item->filter_type_cd] = $item->filter_type_name;
    return $values;
  }
  
  static function GetAll(){
    $values = array();
    $sql = "call sp_filter_type_get";
    $results = MySQL::Execute($sql);
    if($results) foreach($results as $result) $values[] = new FilterType($result);
    return $values;
  }
  
  static function GetByCd($filter_type_cd){
    $value = null;
    $sql = "call sp_filter_type_get_by_cd(?)";
    $params = array('s', $filter_type_cd);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new FilterType($results[0]);
    return $value;
  }
  
  
}
?>