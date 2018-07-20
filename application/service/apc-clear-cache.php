<?php

  error_reporting(E_ALL);

  include_once('../settings.php');
  include_once('../classes/mysql.class.php');

  $url = sprintf("%s/api/apc_clear_cache", SITE_URL);
  trace($url);

  $result = get($url);
  trace($result);

  function get($url){

    $result = null;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
  }

  function trace($s){
    print("$s\n");
  }


?>