<?php
class ZipLocation{
  public $zip_location_id;
  public $zip;
  public $lat;
  public $lon;

  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->zip_location_id = 0;
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
    $sql = "call sp_zip_location_get";
    $results = MySQL::Execute($sql);
    if($results) foreach($results as $result) $values[] = new ZipLocation($result);
    return $values;
  }

  static function GetById($zip_location_id){
    $value = null;
    $sql = "call sp_zip_location_get_by_id(?)";
    $params = array('i', $zip_location_id);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new ZipLocation($results[0]);
    return $value;
  }

  static function GetByZip($zip){
    $value = null;
    $sql = "call sp_zip_location_get_by_zip(?)";
    $params = array('s', $zip);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new ZipLocation($results[0]);
    return $value;
  }

  function Create(){
    $value = null;
    $sql = "call sp_zip_location_ins(?, ?, ?)";
    $params = array('sdd', $this->zip, $this->lat, $this->lon);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->zip_location_id = $results[0]->zip_location_id;
    }
  }

  function Update(){
    $value = null;
    $sql = "call sp_zip_location_upd(?, ?, ?, ?)";
    $params = array('isdd', $this->zip_location_id, $this->zip, $this->lat, $this->lon);
    $results = MySQL::Execute($sql, $params);
  }

  function Save(){
    if(empty($this->zip_location_id)){
      $this->Create();
    }else{
      $this->Update();
    }
  }

  function Delete(){
    $sql = "call sp_zip_location_del(?)";
    $params = array('i', $this->zip_location_id);
    MySQL::Execute($sql, $params);
  }

  static function Truncate(){
    $sql = "call sp_zip_location_trn()";
    MySQL::Execute($sql);
  }

}
?>