<?php
class StateType{
  public $state_type_cd;
  public $state_type_name;
  public $state_type_description;

  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->state_type_cd = 0;
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
    $items = StateType::GetAll();
    foreach($items as $item) $values[$item->state_type_cd] = $item->state_type_name;
    return $values;
  }

  static function GetAll(){
    $values = array();
    $key = "StateType:GetAll";
    $apc_enabled = ini_get('apc.enabled');
    if(!$apc_enabled || !apc_exists($key)){
      $sql = "call sp_state_type_get";
      $results = MySQL::Execute($sql);
      if($results) foreach($results as $result) $values[] = new StateType($result);
      if($apc_enabled && !empty($values)) apc_store($key, $values, 0);
    }
    if($apc_enabled) $values = apc_fetch($key);
    return $values;
  }

  static function GetByCd($state_type_cd){
    $value = null;
    $items = StateType::GetAll();
    foreach($items as $item){
      if($item->state_type_cd == $state_type_cd){
        $value = $item;
        break;
      }
    }
    return $value;
  }


}
?>