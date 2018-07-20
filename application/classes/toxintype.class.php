<?php
class ToxinType{
  public $toxin_type_cd;
  public $toxin_type_name;
  public $toxin_type_description;

  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->toxin_type_cd = 0;
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
    $items = ToxinType::GetAll();
    foreach($items as $item) $values[$item->toxin_type_cd] = $item->toxin_type_name;
    return $values;
  }

  static function GetAll(){
    $values = array();
    $key = "ToxinType:GetAll";
    $apc_enabled = ini_get('apc.enabled');
    if(!$apc_enabled || !apc_exists($key)){
      $sql = "call sp_toxin_type_get";
      $results = MySQL::Execute($sql);
      if($results) foreach($results as $result) $values[] = new ToxinType($result);
      if($apc_enabled && !empty($values)) apc_store($key, $values, 0);
    }
    if($apc_enabled) $values = apc_fetch($key);
    return $values;
  }

  static function GetByCd($toxin_type_cd){
    $value = null;
    $items = ToxinType::GetAll();
    foreach($items as $item){
      if($item->toxin_type_cd == $toxin_type_cd){
        $value = $item;
        break;
      }
    }
    return $value;
  }

}
?>


