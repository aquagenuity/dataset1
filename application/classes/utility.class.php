<?php
class Utility{
  public $utility_id;
  public $name;
  public $description;
  public $state_type_cd;
  public $creation_user_id;
  public $creation_dtm;
  public $last_update_user_id;
  public $last_update_dtm;

  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->utility_id = 0;
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
    $key = "Utility:GetValues";
    $apc_enabled = ini_get('apc.enabled');
    if(!$apc_enabled || !apc_exists($key)){
      $items = Utility::GetAll();
      foreach($items as $item) $values[$item->utility_id] = $item->name;
      if($apc_enabled && !empty($values)) apc_store($key, $values, 0);
    }
    if($apc_enabled) $values = apc_fetch($key);
    return $values;
  }

  static function GetAll(){
    $values = array();
    $key = "Utility:GetAll";
    $apc_enabled = ini_get('apc.enabled');
    if(!$apc_enabled || !apc_exists($key)){
      $sql = "call sp_utility_get";
      $results = MySQL::Execute($sql);
      if($results) foreach($results as $result) $values[] = new Utility($result);
      if($apc_enabled && !empty($values)) apc_store($key, $values, 0);
    }
    if($apc_enabled) $values = apc_fetch($key);
    return $values;
  }

  static function GetByName($name){
    $values = array();
    $key = "Utility:GetByName:$name";
    $apc_enabled = ini_get('apc.enabled');
    if(!$apc_enabled || !apc_exists($key)){
      $sql = "call sp_utility_get_by_name(?)";
      $params = array('s', $name);
      $results = MySQL::Execute($sql, $params);
      if($results) foreach($results as $result) $values[] = new Utility($result);
      if($apc_enabled && !empty($values)) apc_store($key, $values, 0);
    }
    if($apc_enabled) $values = apc_fetch($key);
    return $values;
  }

  static function GetById($utility_id){
    $value = null;
    $key = "Utility:GetById:$utility_id";
    $apc_enabled = ini_get('apc.enabled');
    if(!$apc_enabled || !apc_exists($key)){
      $sql = "call sp_utility_get_by_id(?)";
      $params = array('i', $utility_id);
      $results = MySQL::Execute($sql, $params);
      if($results) $value = new Utility($results[0]);
      if($apc_enabled && !empty($value)) apc_store($key, $value, 0);
    }
    if($apc_enabled) $value = apc_fetch($key);
    return $value;
  }

  function Create(){
    $value = null;
    $sql = "call sp_utility_ins(?, ?, ?, ?)";
    $params = array('ssss', $this->name, $this->description, $this->state_type_cd, $this->creation_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->utility_id = $results[0]->utility_id;
      $this->creation_dtm = $results[0]->creation_dtm;
    }
  }

  function Update(){
    $value = null;
    $sql = "call sp_utility_upd(?, ?, ?, ?, ?)";
    $params = array('issss', $this->utility_id, $this->name, $this->description, $this->state_type_cd, $this->last_update_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->last_update_dtm = $results[0]->last_update_dtm;
    }
  }

  function Save(){
    if(empty($this->utility_id)){
      $this->Create();
    }else{
      $this->Update();
    }
  }

  function Delete(){
    $sql = "call sp_utility_del(?)";
    $params = array('i', $this->utility_id);
    MySQL::Execute($sql, $params);
  }

  static function Truncate(){
    $sql = "call sp_utility_trn()";
    MySQL::Execute($sql);
  }

}
?>