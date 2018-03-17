<?php
class Zip{
  public $zip_id;
  public $zip_cd;
  public $toxin_type_cd;
  public $health_risk_type_cd;
  public $filter_type_cd;
  public $amount;
  public $utility_id;
  public $sample_dtm;
  public $creation_user_id;
  public $creation_dtm;
  public $last_update_user_id;
  public $last_update_dtm;

  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->zip_id = 0;
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

  function extend(){
    $item = ToxinType::GetByCd($this->toxin_type_cd);
    if($item) $this->toxin_type_name = $item->toxin_type_name;

    $item = HealthRiskType::GetByCd($this->health_risk_type_cd);
    if($item) $this->health_risk_type_name = $item->health_risk_type_name;

    $item = FilterType::GetByCd($this->filter_type_cd);
    if($item) $this->filter_type_name = $item->filter_type_name;

    $item = Utility::GetById($this->utility_id);
    if($item) $this->utility_name = $item->name;

    $count = 0;
    $sitems = ToxinLimit::GetAll();
    foreach($sitems as $sitem){
      if($sitem->toxin_type_cd == $this->toxin_type_cd){
        switch ($sitem->limit_type_cd) {
          case '01':
            $this->health_limit = $sitem->value;
            $count++;
            break;
          case '02':
            $this->state_limit = $sitem->value;
            $count++;
            break;
          case '03':
            $this->national_limit = $sitem->value;
            $count++;
            break;
        }
      }
      if($count > 2) break;
    }

    $count = 0;
    $sitems = ToxinAverage::GetAll();
    foreach($sitems as $sitem){
      if($sitem->toxin_type_cd == $this->toxin_type_cd){
        switch ($sitem->average_type_cd) {
          case '02':
            $this->state_average = $sitem->value;
            $count++;
            break;
          case '03':
            $this->national_average = $sitem->value;
            $count++;
            break;
        }
      }
      if($count > 2) break;
    }

    $this->above_health_limit = $this->health_limit? ($this->amount > $this->health_limit) : null;
    $this->above_state_limit = $this->state_limit? ($this->amount > $this->state_limit) : null;
    $this->above_national_limit = $this->national_limit? ($this->amount > $this->national_limit) : null;
    $this->above_state_average = $this->state_average? ($this->amount > $this->state_average) : null;
    $this->above_national_average = $this->national_average? ($this->amount > $this->national_average) : null;

  }

  static function GetAll(){
    $values = array();
    $sql = "call sp_zip_get";
    $results = MySQL::Execute($sql);
    if($results) foreach($results as $result) $values[] = new Zip($result);
    return $values;
  }

  static function GetById($zip_id){
    $value = null;
    $sql = "call sp_zip_get_by_id(?)";
    $params = array('i', $zip_id);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new Zip($results[0]);
    return $value;
  }

  function Create(){
    $value = null;
    $sql = "call sp_zip_ins(?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array('ssssdiss', $this->zip_cd, $this->toxin_type_cd, $this->health_risk_type_cd, $this->filter_type_cd, $this->amount, $this->utility_id, date_time_six($this->sample_dtm), $this->creation_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->zip_id = $results[0]->zip_id;
      $this->creation_dtm = $results[0]->creation_dtm;
    }
  }

  function Update(){
    $value = null;
    $sql = "call sp_zip_upd(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array('issssdiss', $this->zip_id, $this->zip_cd, $this->toxin_type_cd, $this->health_risk_type_cd, $this->filter_type_cd, $this->amount, $this->utility_id, date_time_six($this->sample_dtm), $this->last_update_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->last_update_dtm = $results[0]->last_update_dtm;
    }
  }

  function Save(){
    if(empty($this->zip_id)){
      $this->Create();
    }else{
      $this->Update();
    }
  }

  function Delete(){
    $sql = "call sp_zip_del(?)";
    $params = array('i', $this->zip_id);
    MySQL::Execute($sql, $params);
  }

  static function Truncate(){
    $sql = "call sp_zip_trn()";
    MySQL::Execute($sql);
  }

}
?>