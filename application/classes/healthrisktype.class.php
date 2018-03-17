<?php
class HealthRiskType{
  public $health_risk_type_cd;
  public $health_risk_type_name;
  public $health_risk_type_description;
  
  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->health_risk_type_cd = 0;
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
    $items = HealthRiskType::GetAll();
    foreach($items as $item) $values[$item->health_risk_type_cd] = $item->health_risk_type_name;
    return $values;
  }
  
  static function GetAll(){
    $values = array();
    $sql = "call sp_health_risk_type_get";
    $results = MySQL::Execute($sql);
    if($results) foreach($results as $result) $values[] = new HealthRiskType($result);
    return $values;
  }
  
  static function GetByCd($health_risk_type_cd){
    $value = null;
    $sql = "call sp_health_risk_type_get_by_cd(?)";
    $params = array('s', $health_risk_type_cd);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new HealthRiskType($results[0]);
    return $value;
  }
  
  
}
?>