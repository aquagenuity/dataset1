<?php

class Select{
	private $name;
	private $size;
	private $values;
	private $value;
	private $attributes;
	private $assoc;

	function __construct($name, $size, $values, $value, $assoc=true){
		$this->name = $name;
		$this->size = $size;
		$this->values = $values;
		$this->value = $value;
		$this->attributes = array();
		$this->assoc = $assoc;
	}
	function __toString(){
		return get_class($this);
	}
	function AddAttribute($name, $value){
		$this->attributes[$name] = $value;
	}
	function Html(){
		$html = sprintf("<select id=\"%s\" name=\"%s\" ", $this->name, $this->name);
		if($this->size > 1) $html .= sprintf("size=\"%s\" ", $this->size);
		$keys = array_keys($this->attributes);
		foreach($keys as $key) $html .= sprintf("%s=\"%s\" ", $key, $this->attributes[$key]);
		$html .= ">";
		$keys = array_keys($this->values);
		foreach($keys as $key){
			$value = $this->assoc? $key : $this->values[$key];
			$html .= sprintf("<option value=\"%s\"", $value);
			if($key == $this->value) $html .= " selected=\"true\"";
			$html .= sprintf(">%s</option>", $this->values[$key]);
		}
		$html .= "</select>";
		echo $html;
	}
	static function GetHtml($name, $values, $value){

		if(starts_with($name, 'state_type_') && empty($value)) $value = 10; // default all state drop downs to FL

		$num_args = func_num_args();
		if($num_args > 3)	$params = json_decode(func_get_arg(3));
		if($num_args > 4)	$styles = json_decode(func_get_arg(4));

		$id = $name;
		if(!empty($params) && !empty($params->multiple)) $name = sprintf("%s[]", $name);

		$html = sprintf("<select id=\"%s\" name=\"%s\"", $id, $name);
		if($params){
			if($params->size) $html .= sprintf(" size=\"%s\"", $params->size);
			if($params->multiple) $html .= sprintf(" multiple=\"%s\"", $params->multiple);
			if($params->class) $html .= sprintf(" class=\"%s\"", $params->class);
		}
		if($styles){
			$html .= " style=\"";
			foreach($styles as $skey => $svalue){
				if($skey == "width") $svalue = sprintf("%spx", (intval($svalue)+6));
				$html .= sprintf("%s:%s;", $skey, $svalue);
			}
			$html .= "\"";
		}
		$html .= ">";

		if($values){
			$keys = array_keys($values);
			if($params->is_any) $html .= "<option value=\"Any\">Any</option>";
			if($params->noselect) $html .= sprintf("<option value=\"NoSelect\">%s</option>", $params->noselect);
			foreach($keys as $key){
				$tvalue = is_assoc($values)? $key : $values[$key];
				$html .= sprintf("<option value=\"%s\"", $tvalue);
				$is_match = false;
				if(is_array($value)){
					foreach($value as $svalue) if((string)$key == (string)$svalue) $is_match = true;
				}else if($value == SELECT_ALL) $is_match = true;
				else if((string)$key == (string)$value) $is_match = true;

				if($is_match) $html .= " selected=\"selected\"";
				$html .= sprintf(">%s</option>", htmlspecialchars($values[$key]));
			}
		}
		$html .= "</select>";
		return $html;
	}
}
?>
