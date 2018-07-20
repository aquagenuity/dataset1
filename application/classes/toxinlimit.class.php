<?php
class ToxinLimit{
  public $toxin_limit_id;
  public $toxin_type_cd;
  public $limit_type_cd;
  public $value;
  public $creation_user_id;
  public $creation_dtm;
  public $last_update_user_id;
  public $last_update_dtm;

  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->toxin_limit_id = 0;
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

  static function GetAll(){
    $values = array();
    $key = "ToxinLimit:GetAll";
    $apc_enabled = ini_get('apc.enabled');
    if(!$apc_enabled || !apc_exists($key)){
      $sql = "call sp_toxin_limit_get";
      $results = MySQL::Execute($sql);
      if($results) foreach($results as $result) $values[] = new ToxinLimit($result);
      if($apc_enabled && !empty($values)) apc_store($key, $values, 0);
    }
    if($apc_enabled) $values = apc_fetch($key);
    return $values;
  }

  static function GetById($toxin_limit_id){
    $value = null;
    $sql = "call sp_toxin_limit_get_by_id(?)";
    $params = array('i', $toxin_limit_id);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new ToxinLimit($results[0]);
    return $value;
  }

  function Create(){
    $value = null;
    $sql = "call sp_toxin_limit_ins(?, ?, ?, ?)";
    $params = array('ssds', $this->toxin_type_cd, $this->limit_type_cd, $this->value, $this->creation_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->toxin_limit_id = $results[0]->toxin_limit_id;
      $this->creation_dtm = $results[0]->creation_dtm;
    }
  }

  function Update(){
    $value = null;
    $sql = "call sp_toxin_limit_upd(?, ?, ?, ?, ?)";
    $params = array('issds', $this->toxin_limit_id, $this->toxin_type_cd, $this->limit_type_cd, $this->value, $this->last_update_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->last_update_dtm = $results[0]->last_update_dtm;
    }
  }

  function Save(){
    if(empty($this->toxin_limit_id)){
      $this->Create();
    }else{
      $this->Update();
    }
  }

  function Delete(){
    $sql = "call sp_toxin_limit_del(?)";
    $params = array('i', $this->toxin_limit_id);
    MySQL::Execute($sql, $params);
  }

  static function Truncate(){
    $sql = "call sp_toxin_limit_trn()";
    MySQL::Execute($sql);
  }

}
?>