<?php

class FileUpload{
	public $name;
	public $filepath;

	function __construct(){
	}
	function __toString(){
		return get_class($this);
	}
	static function GetHtml($name){
		$num_args = func_num_args();
		if($num_args > 1)	$params = json_decode(func_get_arg(1));
		if($num_args > 2)	$styles = json_decode(func_get_arg(2));

		$html = sprintf("<input type=\"file\" id=\"%s\" name=\"%s\"", $name, $name);
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
		$html .= " />";
		return $html;
	}
}
?>
