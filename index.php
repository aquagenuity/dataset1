<?php

  set_error_handler(error_handler);

  if(false){

    echo '<div>display_errors</div>';
    $x_display_errors = ini_get('display_errors');
    var_dump($x_display_errors);

    echo '<div>display_startup_errors</div>';
    //$x_display_startup_errors = init_get('display_startup_errors');
    var_dump($x_display_startup_errors);


    echo '<div>log_errors</div>';
    $x_log_errors = ini_get('log_errors');
    var_dump($x_log_errors);

    echo '<div>error_log</div>';
    $x_error_log = ini_get('error_log');
    var_dump($x_error_log);

    echo '<div>error_reporting</div>';
    $x_error_reporting = ini_get('error_reporting');
    var_dump($x_error_reporting);

    die;
  }


  $mtime = microtime();
  $mtime = explode(' ', $mtime);
  $mtime = $mtime[1] + $mtime[0];
  $starttime = $mtime;

  require_once('application/settings.php');

  ini_set('session.name', SESSION_NAME);

  session_init();

  ob_start();

 // var_die($_SERVER);

  //trace('==========================================================');
  trace(sprintf("-------------------- %s", server('REQUEST_URI')));

  $post_back = is_post_back();
  $double_post_back = is_double_post_back();


  //trace($post_back);
  //trace($double_post_back);
  //trace('what up');
  //trace(sprintf("session_id:%s", session_id()));

  $router = new Router();
  $registry = new Registry();
  $registry->template = new Template();

  $router->route($registry);

  function error_handler ($errorNumber, $message, $errfile, $errline) {
    $enabled = false;

    switch ($errorNumber) {
      case E_ERROR :
        $errorLevel = 'Error';
        $enabled = true;
        break;
      case E_WARNING :
        $errorLevel = 'Warning';
        $enabled = false;
        break;
      case E_NOTICE :
        $errorLevel = 'Notice';
        $enabled = false;
        break;
      default :
        $errorLevel = 'Undefined';
        $enabled = false;
    }

    if($enabled){
      $s = $_SERVER['DOCUMENT_ROOT'];
      if(!ends_with($s, '/')) $s = sprintf("%s/", $s); 
      $errfile = str_replace($s, "", $errfile);
      echo sprintf("<div class=\"handler %s\">%s: %s (%s:%d)</div>", strtolower($errorLevel), $errorLevel, $message, $errfile, $errline);
    }        
  }

  /*** auto load model classes ***/
  function __autoload($class_name)
  {
    try
    {
      $filename = strtolower($class_name) . '.class.php';
      $file = 'application/models/' . $filename;
      $file2 = 'application/classes/' . $filename;

      if (file_exists($file))
        include_once($file);
      elseif(file_exists($file2))
        include_once($file2);
      else
        throw new Exception('model ' . $class_name . ' not found:' . $file . ':' . $file2);
    }
    catch(Exception $e)
    {
      echo $e->getMessage();
      exit(0);
    }
  }
  function label($value){
    $values = explode('_', $value);
    for($i=0;$i<count($values);$i++){
      $values[$i] = ucfirst($values[$i]);
    }
    $value = implode(' ', $values);
    $value = str_replace(' Flag', '', $value);
    $value = str_replace(' Id', '', $value);
    $value = str_replace('_Type', 'Type', $value);
    $value = str_replace('Type', ' Type', $value);
    $value = str_replace('Creation Dtm', 'Created', $value);
    $value = str_replace('Last Update Dtm', 'Updated', $value);
    $value = str_replace('Ext', 'Type', $value);
    $value = str_replace(' Type Cd', '', $value);
    $value = str_replace(' Dtm', ' Date', $value);
    $value = str_replace('Full Address', 'Address', $value);
    return $value;
  }
  function to_bit($s){
    return ($s === "on" || $s === "1" || $s === 1) ? 1 : 0;
  }
  function yes_no($i){
    return empty($i)?'No':'Yes';
  }
  function to_date($sdtm){
    //return date("F j, Y", strtotime($sdtm));
    if(empty($sdtm)) $sdtm = 'now';
    return date("Y-m-d", strtotime($sdtm));
  }
  function to_money($n){
    $s = money_format('$%i', $n);
    $s = preg_replace("/USD /", '', $s);
    $s = preg_replace("/\.00/", '.', $s);
    return $s;
  }
  function to_height($n){
    if(is_numeric($n)){
      $n = intval($n);
      $f = floor($n/12);
      $i = $n % 12;
      $s = sprintf("%d' %d\"", $f, $i);
    }
    return $s;
  }
  function to_weight($n){
    $s = $n;
    if(is_numeric($n)){
      $n = intval($n);
      $s = sprintf("%s lbs.", $n);
    }
    return $s;
  }
  function to_date_time($sdtm){
    return date("F j, Y g:i A T", strtotime($sdtm));
  }
  function server($key){
    $result = '';
    if(isset($_SERVER[$key])){
      $result = $_SERVER[$key];
    }
    return $result;
  }
  function session($key){
    $result = '';
    if(isset($_SESSION[$key])){
      $result = $_SESSION[$key];
    }
    return $result;
  }
  function request($key){
    $result = '';
    if(isset($_REQUEST[$key])){
      $result = $_REQUEST[$key];
    }
    return $result;
  }
  function is_post_back(){
    $value = false;
    if(isset($_REQUEST['post_id'])){
      $value = true;
    }
    return $value;
  }
  function is_double_post_back(){
    $value = false;
    if(isset($_REQUEST['post_id'])){
      $post_id = $_REQUEST['post_id'];
      if(isset($_SESSION['last_post_id'])){
        $last_post_id = $_SESSION['last_post_id'];
        $value = ($post_id == $last_post_id);
      }
      $_SESSION['last_post_id'] = $post_id;
    }
    return $value;
  }
  function trace($s, $j=0){
    global $starttime;

    $mtime = microtime();
    $mtime = explode(" ", $mtime);
    $mtime = $mtime[1] + $mtime[0];
    $endtime = $mtime;
    $totaltime = ($endtime - $starttime);
    $sdtm = $totaltime;
    //$dtm = new DateTime('now');
    //$sdtm = $dtm->format("Y-m-d H:i:s");
    //printf("%09.6f %s \n", $sdtm, $s);

    if(!is_scalar($s)) $s = json_encode($s);
    if(TRACE_ENABLED){
      error_log(sprintf("%09.6f %s \n", $sdtm, $s), 3, TRACE_FILE_UNC);
    }
  }
  function session_init(){
    session_start();
    //trace(sprintf("session_id:%s", session_id()));
  }
  function starts_with($h, $n){
    return (strpos($h, $n) === 0);
  }
  function ends_with($h, $n){
    return (strrpos($h, $n) === (strlen($h)-strlen($n)));
  }
  function is_assoc($arr){
    return array_keys($arr) != range(0, count($arr) - 1);
  }
  function cmp($a, $b){
    return $a->cmp($b);
  }
  function is_masked($value){
    return starts_with($value, '*');
  }
  function to_phone($s){
    $result = $s;
    if (preg_match('/^\d{10}$/', $s)){
      $npa = substr($s, 0, 3);
      $nxx = substr($s, 3, 3);
      $xxxx = substr($s, 6);
      $result = sprintf("(%s) %s-%s", $npa, $nxx, $xxxx);
    }
    return $result;
  }
  function to_fb_date($s){
    $sdtm = new DateTime($s);
    $rdtm = new DateTime('now');
    $tdtm = new DateTime(date('Y-m-d'));
    $edtm = new DateTime($s);
    $edtm->setTimezone(new DateTimeZone('EST'));

    $tti = $rdtm->diff($tdtm);
    $tsec = ($tti->format('%a') * 86400) + ($tti->format('%h') * 3600) + ($tti->format('%i') * 60) + $tti->format('%s');

    $dti = $rdtm->diff($sdtm);
    $dsec = ($dti->format('%a') * 86400) + ($dti->format('%h') * 3600) + ($dti->format('%i') * 60) + $dti->format('%s');

    if($dsec < $tsec){
      $seconds = $dti->format('%s');
      $minutes = $dti->format('%i');
      $hours = $dti->format('%h');
      $days = $dti->format('%a');
      $sd = "$days:$hours:$minutes:$seconds";

      if($hours > 1){
        $value = "$hours hours ago";
      }else if($hours > 0){
        $value = "About an hour ago";
      }else if($minutes > 1){
        $value = "$minutes minutes ago";
      }else if($minutes > 0){
        $value = "About a minute ago";
      }else if($seconds > 1){
        $value = "$seconds seconds ago";
      }else{
        $value = "1 second ago";
      }
    }else if($dsec < ($tsec + 86400)){
      $value = sprintf("Yesterday at %s", $edtm->format('g:i a T'));
    }else if($dsec < ($tsec + (7 * 86400))){
      $value = sprintf("%s at %s", $edtm->format('l'), $edtm->format('g:i a T'));
    }else{
      $value = sprintf("%s at %s", $edtm->format('M j'), $edtm->format('g:i a T'));
    }
    return $value;
  }
  function mask($s, $n=0){
    $value = "";
    if($n == 0){
      $left = $s;
      $right = "";
    }else if($n > 0){
      if($n > strlen($s)) $n = strlen($s);
      $left = substr($s, 0, strlen($s)-$n);
      $right = substr($s, -$n, $n);
    }
    $mask = str_pad('', strlen($left), '*', STR_PAD_LEFT);
    $value = sprintf("%s%s", $mask, $right);
    return $value;
  }
  function seo_name($s){
    if($s == null) return '';
    $s = trim($s);
    $s = preg_replace("/<.*?>/", '', $s);
    $strips = array("%", "ô", "Æ", ",", "<sup>", "</sup>", "reg;", "eacute;", "trade;", "copy;", "trad;", "&", "'", "í", ".", "Æ", "©");
    foreach($strips as $strip) $s = str_replace($strip, '', $s);
    $s = preg_replace('/[\s+|\/]+/', '-', $s);
    $s = preg_replace('/[-+]+/', '-', $s);
    $s = preg_replace('/[¿¡¬√ƒ≈‡·‚„‰Â]+/', 'a', $s);
    $s = preg_replace('/[«Á]+/', 'c', $s);
    $s = preg_replace('/[»… ÀËÈÍÎ]+/', 'e', $s);
    $s = preg_replace('/[ÃÕŒœÏÌÓÔ]+/', 'i', $s);
    $s = preg_replace('/[—Ò]+/', 'n', $s);
    $s = preg_replace('/[“”‘’÷ÚÛÙıˆ]+/', 'o', $s);
    $s = preg_replace('/[Ÿ⁄€‹˘˙˚¸]+/', 'u', $s);
    $s = preg_replace('/[›˝ˇ]+/', 'y', $s);
    $s = strtolower($s);
    return $s;
  }
  function array_copy ($aSource) {
    if (!is_array($aSource)) {
      throw new Exception("Input is not an Array");
    }
    $aRetAr = array();
    $aKeys = array_keys($aSource);
    $aVals = array_values($aSource);
    for ($x=0;$x<count($aKeys);$x++) {
      if (is_object($aVals[$x])) {
          $aRetAr[$aKeys[$x]]=clone $aVals[$x];
      } elseif (is_array($aVals[$x])) {
          $aRetAr[$aKeys[$x]]=array_copy ($aVals[$x]);
      } else {
          $aRetAr[$aKeys[$x]]=$aVals[$x];
      }
    }
    return $aRetAr;
  }
  function send_mail($to, $subj, $msg){
    $msg = wordwrap($msg, 70);

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 1;
    $mail->SMTPAuth = true;
    $mail->Host = SMTP_HOST;
    $mail->Port = 587;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SetFrom(EMAIL_NOTIFY);
    $mail->Subject = $subj;
    $mail->MsgHTML($msg);
    $mail->AddAddress($to);

    $value = $mail->Send();

    if($value != true) trace($mail->ErrorInfo);

    return $value;
  }
  function redirect($url){
    header("location:" . $_SERVER['SERVER_URL'] . $url);
  }
  function var_die($o){
    var_dump($o);
    die;
  }
  function compress_page($html){
    if(SINGLE_LINE_OUTPUT){
      $search = array('/\r\n|\n/','/\s+/');
      $replace = array('',' ');
      $html = preg_replace($search, $replace, $html);
    }
    return $html;
  }
  function is_auth(){
    $retval = false;
    $user_id = $_SESSION['user_id'];
    if($user_id) $retval = true;
    return $retval;
  }
  function is_admin(){
    $retval = false;
    $user_id = $_SESSION['user_id'];
    if($user_id){
      $username = $_SESSION['username'];
      if($username){
        $retval = Roles::IsUserInRole($username, 'Administrator');
      }
    }
    return $retval;
  }
  function is_bondsman(){
    $retval = false;
    $user_id = $_SESSION['user_id'];
    if($user_id){
      $username = $_SESSION['username'];
      if($username){
        $retval = Roles::IsUserInRole($username, 'Bondsman');
      }
    }
    return $retval;
  }
  function is_ben(){
    $retval = false;
    $user_id = $_SESSION['user_id'];
    if($user_id){
      $username = $_SESSION['username'];
      if($username){
        $retval = ($username == 'ben' || $username == 'ben@qeala.com');
      }
    }
    return $retval;
  }


  trace(sprintf("apc_exists:%s", function_exists('apc_exists')));
  trace(sprintf("apc_fetch:%s", function_exists('apc_fetch')));
  trace(sprintf("apc_store:%s", function_exists('apc_store')));

  $g_user = null;
  $g_authenticated = false;
  $g_pagename = strtolower(basename($_SERVER['SCRIPT_FILENAME']));
  $g_uri = $_SERVER['REQUEST_URI'];

  //header("Cache-Control: private");
  //header("Content-Type: text/html");


