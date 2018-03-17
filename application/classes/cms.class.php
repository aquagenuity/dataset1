<?php
class Cms{
	public $cms_id;
	public $name;
	public $html;
	public $spanish_html;
	public $creation_dtm;
	public $last_update_dtm;

	function __construct(){
		$num_args = func_num_args();
		switch($num_args){
			case 0:
				$this->cms_id = 0;
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
		$items = Cms::GetAll();
		foreach($items as $item) $values[$item->cms_id] = $item->name;
		return $values;
	}
	static function GetAll(){
		$values = array();
		$sql = "call sp_cms_get";
		$results = MySQL::Execute($sql);
		if($results) foreach($results as $result) $values[] = new Cms($result);
		return $values;
	}

	static function GetById($cms_id){
		$value = null;
		$sql = "call sp_cms_get_by_id(?)";
		$params = array('s', $cms_id);
		$results = MySQL::Execute($sql, $params);
		if($results) $value = new Cms($results[0]);
		return $value;
	}

	function Create(){
		$value = null;
		$sql = "call sp_cms_ins(?, ?, ?)";
		$params = array('sss', $this->name, $this->html, $this->spanish_html);
		$results = MySQL::Execute($sql, $params);
		if($results){
			$this->cms_id = $results[0]->cms_id;
			$this->creation_dtm = $results[0]->creation_dtm;
		}
	}

	function Save(){
		if(empty($this->cms_id)){
			$this->Create();
		}else{
			$value = null;
			$sql = "call sp_cms_upd(?, ?, ?, ?)";
			$params = array('ssss', $this->cms_id, $this->name, $this->html, $this->spanish_html);
			$results = MySQL::Execute($sql, $params);
			if($results){
				$this->last_update_dtm = $results[0]->last_update_dtm;
			}
		}
	}

	function Delete(){
		$sql = "call sp_cms_del(?)";
		$params = array('s', $this->cms_id);
		MySQL::Execute($sql, $params);
	}

	static function GetHtml($cms_id, $language_cd="en"){
		$value = "Cms content for $cms_id not found";
		$cms = Cms::GetById($cms_id);
		if($cms) $value = ($language_cd == "es")? $cms->spanish_html:$cms->html;
		return $value;
	}


}
?>