<?php
	$s= $_SERVER['PHP_SELF'];
	$filename = substr($s,strrpos($s,'/')+1);
	$app_path = substr($s,0,strrpos($s,'/')+1);

	$html = "<h2>Environment</h2>";

  $html .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"command\">";
  $html .= "<col width=\"300\" />";
  $html .= "<col width=\"600\" />";
  $html .= sprintf("<tr><td>app_path</td><td>%s</td></tr>", $app_path);
  $values = array('error_reporting', 'display_errors', 'display_startup_errors', 'log_errors', 'error_log');
  foreach($values as $value){
    $html .= sprintf("<tr><td>%s</td><td>%s</td></tr>", $value, ini_get($value));
  }

  $html .= "</table>";
  $html .= "<hr/>";

	$items = array($_SERVER);
	foreach($items as $item){
		$html .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"command\">";
		$html .= "<col width=\"300\" />";
		$html .= "<col width=\"600\" />";
		foreach($item as $key=>$value){
			$html .= sprintf("<tr><td>%s</td><td>%s</td></tr>", $key, $value);
		}
		$html .= "</table>";
		$html .= "<hr />";
	}


	echo $html;
?>
