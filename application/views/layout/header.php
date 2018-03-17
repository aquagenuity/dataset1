<!DOCTYPE html>
<html>
<head>
<title></title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
<!--[if (gt IE 8) | (IEMobile)]><!-->
  <link rel="stylesheet" href="/css/unsemantic-grid-responsive.css" />
<!--<![endif]-->
<!--[if (lt IE 9) & (!IEMobile)]>
  <link rel="stylesheet" href="/css/ie.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="/css/default.css?v=1.0" />
<?php

  $user_id = $_SESSION['user_id'];
  if($user_id) $user = Membership::GetUser($user_id);

  $html = null;
  if(isset($styles)) {
    foreach($styles as $style) {
      $html .= sprintf("<link rel=\"stylesheet\" type=\"text/css\" href=\"%s\" />\n", $style);
    }
  }
  $html .= "</head>";
  $html .= empty($user_id)? '<body>':'<body class="auth">';
  echo $html;
?>
<div class="loader"><div class="green"></div><div class="red"></div><div class="blue"></div><div class="yellow"></div></div>
<div class="grid-container">
<div class="fb-root"></div>
<div class="grid-100 hdr"><a href="/"><img class="logo" src="/img/qeala.png" width="225" /></a></div>
<?php
  $user_id = $_SESSION['user_id'];
  $html = null;
  $html .= "<div class=\"grid-100 nav\">";
  $html .= "<ul>";
  $html .= sprintf("<li><a href=\"/\"%s>Home</a></li>", ($routeinfo->action == "index")?" class=\"home selected\"":" class=\"home\"");
  if($user_id){
    $html .= sprintf("<li><a href=\"%s/user/profile\"%s>Profile</a></li>", $secure_url, ($routeinfo->action == "profile")?" class=\"selected\"":"");
    if(is_admin()) $html .= sprintf("<li><a href=\"%s/test\"%s>Test</a></li>", $secure_url, ($routeinfo->action == "test")?" class=\"selected\"":"");
    if(is_admin()) $html .= sprintf("<li><a href=\"%s/admin\"%s>Admin</a></li>", $secure_url, ($routeinfo->action == "admin")?" class=\"selected\"":"");
    $html .= sprintf("<li><a href=\"%s/user/signout\"%s>Sign Out</a></li>", $site_url, ($routeinfo->action == "signout")?" class=\"selected\"":"");
  }else{
    $html .= sprintf("<li><a href=\"%s/user/signin\"%s>Sign In</a></li>", $site_url, ($routeinfo->action == "signin")?" class=\"selected\"":"");
  }
  $html .= "</ul>";
  $html .= "</div>\n";
  print $html;
?>
