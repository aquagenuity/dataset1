<?php
class Application{
	public $application_id;
	public $application_name;
	public $creation_dtm;
	public $last_update_dtm;

	function __construct(){
		$num_args = func_num_args();
		switch($num_args){
			case 0:
				$this->application_id = 0;
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
		$sql = "call sp_application_get";
		$results = MySQL::Execute($sql);
		if($results) foreach($results as $result) $values[] = new Application($result);
		return $values;
	}

	static function GetById($application_id){
		$value = null;
		$sql = "call sp_application_get_by_id(?)";
		$params = array('s', $application_id);
		$results = MySQL::Execute($sql, $params);
		if($results) $value = new Application($results[0]);
		return $value;
	}

	function Create(){
		$value = null;
		$sql = "call sp_application_ins(?)";
		$params = array('s', $this->application_name);
		$results = MySQL::Execute($sql, $params);
		if($results){
			$this->application_id = $results[0]->application_id;
			$this->creation_dtm = $results[0]->creation_dtm;
		}
	}

	function Save(){
		if(empty($this->application_id)){
			$this->Create();
		}else{
			$value = null;
			$sql = "call sp_application_upd(?, ?)";
			$params = array('ss', $this->application_id, $this->application_name);
			$results = MySQL::Execute($sql, $params);
			if($results){
				$this->last_update_dtm = $results[0]->last_update_dtm;
			}
		}
	}

	function Delete(){
		$sql = "call sp_application_del(?)";
		$params = array('s', $this->application_id);
		MySQL::Execute($sql, $params);
	}

}
?>