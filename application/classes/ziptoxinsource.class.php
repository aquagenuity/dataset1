<?php
class ZipToxinSource{
  public $zip_toxin_source_id;
  public $zip_cd;
  public $toxin_type_cd;
  public $source_type_cd;
  public $creation_user_id;
  public $creation_dtm;
  public $last_update_user_id;
  public $last_update_dtm;
  
  function __construct(){
    $num_args = func_num_args();
    switch($num_args){
      case 0:
        $this->zip_toxin_source_id = 0;
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
    $sql = "call sp_zip_toxin_source_get";
    $results = MySQL::Execute($sql);
    if($results) foreach($results as $result) $values[] = new ZipToxinSource($result);
    return $values;
  }
  
  static function GetById($zip_toxin_source_id){
    $value = null;
    $sql = "call sp_zip_toxin_source_get_by_id(?)";
    $params = array('i', $zip_toxin_source_id);
    $results = MySQL::Execute($sql, $params);
    if($results) $value = new ZipToxinSource($results[0]);
    return $value;
  }
  
  function Create(){
    $value = null;
    $sql = "call sp_zip_toxin_source_ins(?, ?, ?, ?)";
    $params = array('ssss', $this->zip_cd, $this->toxin_type_cd, $this->source_type_cd, $this->creation_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->zip_toxin_source_id = $results[0]->zip_toxin_source_id;
      $this->creation_dtm = $results[0]->creation_dtm;
    }
  }
  
  function Update(){
    $value = null;
    $sql = "call sp_zip_toxin_source_upd(?, ?, ?, ?, ?)";
    $params = array('issss', $this->zip_toxin_source_id, $this->zip_cd, $this->toxin_type_cd, $this->source_type_cd, $this->last_update_user_id);
    $results = MySQL::Execute($sql, $params);
    if($results){
      $this->last_update_dtm = $results[0]->last_update_dtm;
    }
  }
  
  function Save(){
    if(empty($this->zip_toxin_source_id)){
      $this->Create();
    }else{
      $this->Update();
    }
  }
  
  function Delete(){
    $sql = "call sp_zip_toxin_source_del(?)";
    $params = array('i', $this->zip_toxin_source_id);
    MySQL::Execute($sql, $params);
  }
  
  static function Truncate(){
    $sql = "call sp_zip_toxin_source_trn()";
    MySQL::Execute($sql);
  }
  
}
?>