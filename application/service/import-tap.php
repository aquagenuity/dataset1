<?php

  error_reporting(E_ALL);

  include_once('../settings.php');
  include_once('../classes/mysql.class.php');

  trace('import.begin');

  trace('truncate');
  $items = array('zip', 'utility', 'toxin_average', 'toxin_limit', 'zip_toxin_source', 'toxin_type');
  foreach($items as $item){
    $sql = "delete from $item;";
    trace($sql);
    MySQL::Execute($sql);
    $sql = "alter table $item auto_increment = 1;";
    MySQL::Execute($sql);
  }

  trace('insert utility');
  $sql = "select a.utility_name, b.state from tap a join zipcode b on a.zip = b.zip where a.toxin not like '%<br>%' group by a.utility_name, b.state";
  $items = MySQL::Execute($sql);
  trace("items:". count($items));
  for($i=0;$i<count($items);$i++){
    $item = $items[$i];
    $name = $item->utility_name;
    $name = str_replace("'", "''", $name);
    $state_type_cd = $item->state;
    $sql = "insert utility (name, state_type_cd) values ('$name', '$state_type_cd')";
    //trace($sql);
    MySQL::Execute($sql);
  }

  trace('insert toxin_type');
  $sql = "select distinct(toxin) as toxin_type_name from tap where toxin not like '%<br>%' order by toxin";
  $items = MySQL::Execute($sql);
  trace("items:". count($items));
  for($i=0;$i<count($items);$i++){
    $item = $items[$i];
    $toxin_type_cd = $i<10?"0$i":"$i";
    $toxin_type_name = $item->toxin_type_name;
    $toxin_type_name = str_replace("'", "''", $toxin_type_name);
    $sql = "insert toxin_type (toxin_type_cd, toxin_type_name) values ('$toxin_type_cd', '$toxin_type_name')";
    //trace($sql);
    MySQL::Execute($sql);
  }

  trace('select taps');
  $sql = "select a.tap_id, a.health_guideline, a.health_guideline_unit, a.legal_limit, a.legal_limit_unit, a.mode, a.national_average, a.national_average_unit, a.pws, a.state_average, a.state_average_unit, a.toxin, a.utility_average, a.utility_average_unit, a.utility_name, a.zip, a.creation_user_id, a.creation_dtm, a.last_update_user_id, a.last_update_dtm, b.toxin_type_cd, b.toxin_type_name, c.utility_id from tap a join toxin_type b on a.toxin = b.toxin_type_name join utility c on a.utility_name = c.name where a.toxin not like '%<br>%' order by a.tap_id";
  $items = MySQL::Execute($sql);
  trace("items:". count($items));

  foreach($items as $item){

    $tap_id = $item->tap_id;
    $health_guideline = $item->health_guideline;
    $health_guideline_unit = $item->health_guideline_unit;
    $legal_limit = $item->legal_limit;
    $legal_limit_unit = $item->legal_limit_unit;
    $mode = $item->mode;
    $national_average = $item->national_average;
    $national_average_unit = $item->national_average_unit;
    $pws = $item->pws;
    $state_average = $item->state_average;
    $state_average_unit = $item->state_average_unit;
    $toxin = $item->toxin;
    $utility_average = $item->utility_average;
    $utility_average_unit = $item->utility_average_unit;
    $utility_name = $item->utility_name;
    $zip = $item->zip;
    $creation_user_id = $item->creation_user_id;
    $creation_dtm = $item->creation_dtm;
    $last_update_user_id = $item->last_update_user_id;
    $last_update_dtm = $item->last_update_dtm;
    $toxin_type_cd = $item->toxin_type_cd;
    $toxin_type_name = $item->toxin_type_name;
    $utility_id = $item->utility_id;

    // if($zip != '30349') continue;

    trace("utility_average:$utility_average");

    if(empty($utility_average)) $utility_average = 0;

    if($utility_average_unit == 'ppm'){
      $utility_average_unit = 'ppb';
      $utility_average = $utility_average / 1000;
    }

    if($state_average_unit == 'ppm'){
      $state_average_unit = 'ppb';
      $state_average = $state_average / 1000;
    }

    if($national_average_unit == 'ppm'){
      $national_average_unit = 'ppb';
      $national_average = $national_average / 1000;
    }

    if($health_guideline_unit == 'ppm'){
      $health_guideline_unit = 'ppb';
      $health_guideline = $health_guideline / 1000;
    }

    if($legal_limit_unit == 'ppm'){
      $legal_limit_unit = 'ppb';
      $legal_limit = $legal_limit / 1000;
    }

    trace("zip:$zip");

    trace('insert toxin_average');
    //$sql = sprintf("insert toxin_average (toxin_type_cd, average_type_cd, value, creation_dtm) values ('%s', '01', %f, utc_timestamp)", $toxin_type_cd, $item->utility_average);
    //MySQL::Execute($sql);

    $sql = sprintf("insert toxin_average (toxin_type_cd, average_type_cd, value, creation_dtm) values ('%s', '02', %f, utc_timestamp)", $toxin_type_cd, $item->state_average);
    MySQL::Execute($sql);

    $sql = sprintf("insert toxin_average (toxin_type_cd, average_type_cd, value, creation_dtm) values ('%s', '03', %f, utc_timestamp)", $toxin_type_cd, $item->national_average);
    MySQL::Execute($sql);

    trace('insert toxin_limit');
    $sql = sprintf("insert toxin_limit (toxin_type_cd, limit_type_cd, value, creation_dtm) values ('%s', '01', %f, utc_timestamp)", $toxin_type_cd, $item->health_guideline);
    MySQL::Execute($sql);

    $sql = sprintf("insert toxin_limit (toxin_type_cd, limit_type_cd, value, creation_dtm) values ('%s', '02', %f, utc_timestamp)", $toxin_type_cd, $item->legal_limit);
    MySQL::Execute($sql);

    $sql = sprintf("insert toxin_limit (toxin_type_cd, limit_type_cd, value, creation_dtm) values ('%s', '03', %f, utc_timestamp)", $toxin_type_cd, $item->legal_limit);
    MySQL::Execute($sql);

    trace('insert zip_toxin_source');
    $sql = sprintf("insert zip_toxin_source (zip_cd, toxin_type_cd, source_type_cd, creation_dtm) values ('%s', '%s', '01', utc_timestamp)", $zip, $toxin_type_cd);
    MySQL::Execute($sql);

    trace('insert zip');
    $sql = sprintf("insert zip (zip_cd, toxin_type_cd, health_risk_type_cd, filter_type_cd, amount, utility_id, sample_dtm, creation_dtm) values ('%s', '%s', '01', '01', %f, '%s', '2015-01-01', utc_timestamp)", $zip, $toxin_type_cd, $utility_average, $utility_id);
    trace($sql);
    MySQL::Execute($sql);

  }

  trace('import.end');

  function trace($s){
    print("$s\n");
  }

?>