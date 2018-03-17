<?php

class ImageButton{

	function __construct(){
	}
	function __toString(){
		return get_class($this);
	}
	static function GetHtml(){
		$num_args = func_num_args();
		if($num_args > 0)	$img_url = func_get_arg(0);
		if($num_args > 1)	$img_width = func_get_arg(1);
		if($num_args > 2)	$img_height = func_get_arg(2);
		if($num_args > 3)	$img_caption = func_get_arg(3);
		if($num_args > 4)	$cmd = func_get_arg(4);
		if($num_args > 5)	$cmd_arg = func_get_arg(5);
		if($num_args > 6)	$cmd_action = func_get_arg(6);
		if($num_args > 7)	$confirm_delete = func_get_arg(7);
		if($num_args > 8) $target = func_get_arg(8);

		if($img_url){
			$html .= "<a href=\"javascript:__postback('$cmd', '$cmd_arg', '$cmd_action', '$target')\"";
			if($confirm_delete) $html .= " onclick=\"return jConfirmDelete(this)\"";
			$html .= "><img src=\"$img_url\" width=\"$img_width\" height=\"$img_height\" alt=\"$img_caption\" align=\"middle\" /></a>";
		}
		return $html;
	}
}

?>