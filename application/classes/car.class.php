<?php
class Car{
  public $car_id;
  public $year;
  public $make;
  public $model;
  public $color;
  public $price;
  
  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->car_id = 0;
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
    $sql = "call sp_car_get";
    $results = MySQL::Execute($sql);
    if($results) foreach($results as $result) $values[] = new Car($result);
    return $values;
  }
  
  static function GetById($car_id){
    $value = null;
    $sql = "call sp_car_get_by_id(?)";
    $params = array('i', $car_id);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new Car($results[0]);
    return $value;
  }
  
  function Create(){
    $value = null;
    $sql = "call sp_car_ins(?, ?, ?, ?, ?)";
    $params = array('isssd', $this->year, $this->make, $this->model, $this->color, $this->price);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->car_id = $results[0]->car_id;
    }
  }
  
  function Update(){
    $value = null;
    $sql = "call sp_car_upd(?, ?, ?, ?, ?, ?)";
    $params = array('iisssd', $this->car_id, $this->year, $this->make, $this->model, $this->color, $this->price);
    $results = MySQL::Execute($sql, $params);
  }
  
  function Save(){
    if(empty($this->car_id)){
      $this->Create();
    }else{
      $this->Update();
    }
  }
  
  function Delete(){
    $sql = "call sp_car_del(?)";
    $params = array('i', $this->car_id);
    MySQL::Execute($sql, $params);
  }
  
  static function Truncate(){
    $sql = "call sp_car_trn()";
    MySQL::Execute($sql);
  }
  
}
?>