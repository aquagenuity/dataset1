<?php

class LinkButton{

	function __construct(){
	}
	function __toString(){
		return get_class($this);
	}
	static function GetHtml(){
		global $g_pagename;

		$num_args = func_num_args();

		if($num_args > 0)	$text = func_get_arg(0);
		if($num_args > 1)	$cmd = func_get_arg(1);
		if($num_args > 2)	$cmd_arg = func_get_arg(2);
		if($num_args > 3)	$cmd_action = func_get_arg(3);
		if($num_args > 4)	$class_name = func_get_arg(4);
		if($num_args > 5)	$confirm_delete = func_get_arg(5);
		if($num_args > 6) $target = func_get_arg(6);

		if(empty($cmd_action)) $cmd_action = $g_pagename;

		if($text){
			$html .= "<a href=\"javascript:__postback('$cmd','$cmd_arg','$cmd_action','$target')\" class=\"$class_name\"";
			if($confirm_delete) $html .= " onclick=\"return jConfirmDelete(this)\"";
			$html .= ">$text</a>";
		}
		return $html;
	}
}

?>