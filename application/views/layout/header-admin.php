<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Admin</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="X-UA-Compatible" content="IE=IE8" />
<link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
<link rel="icon" href="/img/favicon.png" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/css/default-admin.css?v=1.0" />
</head>
<body>
<form id="form" action="<?php echo $routeinfo->uri ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="post_id" value="<?php echo md5(date('Hms').session_id()); ?>" />
<?php
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$is_ben = $username == 'ben@qeala.com';
if($user_id){
	$html = "<div class=\"header\">";
  $html .= "<a class=\"logo\" href=\"/admin\"><img src=\"/img/aquagenuity-logo.png\" /></a>";
	$html .= "<ul>";
	$html .= "<li><a href=\"/user/signout\">Logout</a></li>";
	$html .= "<li><a href=\"/\" target=\"_blank\">Site</a></li>";
  $html .= "<li><a href=\"/admin/toxin-limit\">ToxinLimit</a></li>";
  $html .= "<li><a href=\"/admin/toxin-average\">ToxinAverage</a></li>";
  $html .= "<li><a href=\"/admin/zip-toxin-source\">ZipToxinSource</a></li>";
  $html .= "<li><a href=\"/admin/zip\">Zip</a></li>";
	$html .= "<li><a href=\"/admin/user\">User</a></li>";
	$html .= "</ul>";
	$html .= "</div>";
	echo $html."\n";
}
?>
<div class="content">
