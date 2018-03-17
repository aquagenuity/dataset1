<?php
class Club{
  public $club_id;
  public $name;
  public $address;
  public $city;
  public $zip;
  public $price;
  
  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->club_id = 0;
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
    $items = Club::GetAll();
    foreach($items as $item) $values[$item->club_id] = $item->name;
    return $values;
  }
  
  static function GetAll(){
    $values = array();
    $sql = "call sp_club_get";
    $results = MySQL::Execute($sql);
    if($results) foreach($results as $result) $values[] = new Club($result);
    return $values;
  }
  
  static function GetById($club_id){
    $value = null;
    $sql = "call sp_club_get_by_id(?)";
    $params = array('i', $club_id);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new Club($results[0]);
    return $value;
  }
  
  function Create(){
    $value = null;
    $sql = "call sp_club_ins(?, ?, ?, ?, ?)";
    $params = array('ssssd', $this->name, $this->address, $this->city, $this->zip, $this->price);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->club_id = $results[0]->club_id;
    }
  }
  
  function Update(){
    $value = null;
    $sql = "call sp_club_upd(?, ?, ?, ?, ?, ?)";
    $params = array('issssd', $this->club_id, $this->name, $this->address, $this->city, $this->zip, $this->price);
    $results = MySQL::Execute($sql, $params);
  }
  
  function Save(){
    if(empty($this->club_id)){
      $this->Create();
    }else{
      $this->Update();
    }
  }
  
  function Delete(){
    $sql = "call sp_club_del(?)";
    $params = array('i', $this->club_id);
    MySQL::Execute($sql, $params);
  }
  
  function Truncate(){
    $sql = "call sp_club_trn()";
    MySQL::Execute($sql);
  }
  
}
?>