<?php

class RadioButton{
	public $name;
	public $checked;

	function __construct(){
	}
	function __toString(){
		return get_class($this);
	}
	static function GetHtml($name, $checked){
		$num_args = func_num_args();
		if($num_args > 2)	$params = json_decode(func_get_arg(2));
		if($num_args > 3)	$styles = json_decode(func_get_arg(3));

		if($params->readonly){
			$html = sprintf("<img src=\"/img/%sradio.png\" />", empty($checked)? "un":"");
		}else{
			$html = sprintf("<input type=\"radio\" id=\"%s\" name=\"%s\"", $name, $name);
			if($params){
				foreach($params as $key => $value){
					$html .= sprintf(" %s=\"%s\"", $key, $value);
				}
			}
			if($styles){
				$html .= " style=\"";
				foreach($styles as $key => $value){
					$html .= sprintf("%s:%s;", $key, $value);
				}
				$html .= "\"";
			}
			if(!empty($checked)) $html .= " checked";
			$html .= " />";
		}
		return $html;
	}
}
?>
