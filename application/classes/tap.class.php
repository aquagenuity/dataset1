<?php
class Tap{
  public $tap_id;
  public $health_guideline;
  public $health_guideline_unit;
  public $legal_limit;
  public $legal_limit_unit;
  public $mode;
  public $national_average;
  public $national_average_unit;
  public $pws;
  public $state_average;
  public $state_average_unit;
  public $toxin;
  public $utility_average;
  public $utility_average_unit;
  public $utility_name;
  public $zip;
  public $creation_user_id;
  public $creation_dtm;
  public $last_update_user_id;
  public $last_update_dtm;
  
  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->tap_id = 0;
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
    $sql = "call sp_tap_get";
    $results = MySQL::Execute($sql);
    if($results) foreach($results as $result) $values[] = new Tap($result);
    return $values;
  }
  
  static function GetById($tap_id){
    $value = null;
    $sql = "call sp_tap_get_by_id(?)";
    $params = array('i', $tap_id);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new Tap($results[0]);
    return $value;
  }
  
  function Create(){
    $value = null;
    $sql = "call sp_tap_ins(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array('dsdssdssdssdssss', $this->health_guideline, $this->health_guideline_unit, $this->legal_limit, $this->legal_limit_unit, $this->mode, $this->national_average, $this->national_average_unit, $this->pws, $this->state_average, $this->state_average_unit, $this->toxin, $this->utility_average, $this->utility_average_unit, $this->utility_name, $this->zip, $this->creation_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->tap_id = $results[0]->tap_id;
      $this->creation_dtm = $results[0]->creation_dtm;
    }
  }
  
  function Update(){
    $value = null;
    $sql = "call sp_tap_upd(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array('idsdssdssdssdssss', $this->tap_id, $this->health_guideline, $this->health_guideline_unit, $this->legal_limit, $this->legal_limit_unit, $this->mode, $this->national_average, $this->national_average_unit, $this->pws, $this->state_average, $this->state_average_unit, $this->toxin, $this->utility_average, $this->utility_average_unit, $this->utility_name, $this->zip, $this->last_update_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->last_update_dtm = $results[0]->last_update_dtm;
    }
  }
  
  function Save(){
    if(empty($this->tap_id)){
      $this->Create();
    }else{
      $this->Update();
    }
  }
  
  function Delete(){
    $sql = "call sp_tap_del(?)";
    $params = array('i', $this->tap_id);
    MySQL::Execute($sql, $params);
  }
  
  static function Truncate(){
    $sql = "call sp_tap_trn()";
    MySQL::Execute($sql);
  }
  
}
?>