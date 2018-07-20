<?php
class SourceType{
  public $source_type_cd;
  public $source_type_name;
  public $source_type_description;

  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->source_type_cd = 0;
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
    $items = SourceType::GetAll();
    foreach($items as $item) $values[$item->source_type_cd] = $item->source_type_name;
    return $values;
  }

  static function GetAll(){
    $values = array();
    $key = "SourceType:GetAll";
    $apc_enabled = ini_get('apc.enabled');
    if(!$apc_enabled || !apc_exists($key)){
      $sql = "call sp_source_type_get";
      $results = MySQL::Execute($sql);
      if($results) foreach($results as $result) $values[] = new SourceType($result);
      if($apc_enabled && !empty($values)) apc_store($key, $values, 0);
    }
    if($apc_enabled) $values = apc_fetch($key);
    return $values;
  }

  static function GetByCd($source_type_cd){
    $value = null;
    $items = SourceType::GetAll();
    foreach($items as $item){
      if($item->source_type_cd == $source_type_cd){
        $value = $item;
        break;
      }
    }
    return $value;
  }

}
?>