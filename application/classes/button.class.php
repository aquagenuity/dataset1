<?php

class Button{

	function __construct(){
	}
	function __toString(){
		return get_class($this);
	}
	static function GetHtml(){
		global $g_pagename;

		$text = null;
		$cmd = null;
		$cmd_arg = null;
		$style = null;
		$html = null;

		$num_args = func_num_args();
		if($num_args > 0)	$text = func_get_arg(0);
		if($num_args > 1)	$cmd = func_get_arg(1);
		if($num_args > 2)	$cmd_arg = func_get_arg(2);
		if($num_args > 3){
			$style = func_get_arg(3);
			$style = sprintf("style=\"%s\"", $style);
		}
		if($num_args > 4)	$cmd_action = func_get_arg(4);
		if($num_args > 5) $target = func_get_arg(5);

		if(empty($cmd_action)) $cmd_action = $g_pagename;

		if($text) $html = "<input type=\"button\" value=\"$text\" onclick=\"javascript:__postback('$cmd', '$cmd_arg', '$cmd_action', '$target')\" class=\"button\" $style />";

		return $html;
	}
}

?>