<?php

class ApiController extends BaseController
{
  public $page_size = 10;

  public function index()
  {
    print 'Api';
  }

  /*
  CRUD
  (C)reate 	POST
  (R)ead		GET
  (U)pdate	PUT
  (D)elete	DELETE

  api/car  		GET  		- get all cars
  api/car			POST		- create car found in POST param
  api/car 		PUT			- update car found in PUT param
  api/car			DELETE 	-	delete car found in DELETE param
  */
  public function apc_clear_cache(){
    $root = new stdClass();
    $root->status = 'success';
    apc_clear_cache();
    header('Content-Type: application/json');
    print json_encode($root);
  }

  public function results(){
    $root = new stdClass();
    $root->status = 'success';
    $json = request('json');

    $items = json_decode($json);
    $json = json_encode($items, JSON_PRETTY_PRINT);
    trace($json);

    $count = count($items);
    trace("count:$count");

    for($i=0;$i<count($items);$i++){
      trace("item:$i");
      $item = $items[$i];
      $titem = new Tap($item);
      $titem->Save();
    }


    header('Content-Type: application/json');
    print json_encode($root);
  }

  public function utility($id=null){
    $root = new stdClass();
    $root->status = 'success';

    $items = array();

    $name = request('name');
    if($name){
      $items = Utility::GetByName($name);
    }else if($id){
      $item = Utility::GetById($id);
      if($item) $items[] = $item;
    }else{
      $items = Utility::GetAll();
    }

    $root->items = $items;

    header('Content-Type: application/json');
    print json_encode($root);
  }

  public function zip($id=null){
    $root = new stdClass();
    $root->status = 'success';

    $zip_cd = request('zip_cd');
    $utility_id = request('utility_id');

    $items = array();

    if($zip_cd){
      if($utility_id){
        $items = Zip::GetByCdUtility($zip_cd, $utility_id);
      }else{
        $items = Zip::GetByCd($zip_cd);
      }
    }else if($utility_id){
      $items = Zip::GetByUtility($utility_id);
    }else if($id){
      $item = Zip::GetById($id);
      if($item) $items[] = $item;
    }else{
      $items = Zip::GetAll();
    }

    $toxin_rating = 0;

    $titems = ToxinType::GetAll();
    $toxin_total = count($titems);

    $toxin_type_cds = array();
    foreach($items as $item){
      $toxin_type_cd = $item->toxin_type_cd;
      if(!in_array($toxin_type_cd, $toxin_type_cds)){
        $toxin_type_cds[] = $toxin_type_cd;
      }
    }
    $toxin_count = count($toxin_type_cds);

    $toxin_rating = ceil((floatval($toxin_total - $toxin_count)/floatval($toxin_total)) * 10);

    if($toxin_rating < 1) $toxin_rating = 1;

    foreach($items as $item) {
      $item->extend();
      $item->toxin_total = $toxin_total;
      $item->toxin_count = $toxin_count;
      $item->toxin_rating = $toxin_rating;
    }

    $root->items = $items;

    header('Content-Type: application/json');
    print json_encode($root);
  }
  public function test(){
    $value = new stdClass();
    $value->status = 'success';

    trace('test.begin');
    $json = json_encode($_REQUEST, JSON_PRETTY_PRINT);
    trace($json);
    $json = json_encode($_SERVER, JSON_PRETTY_PRINT);
    trace($json);
    trace('test.end');

    header('Content-Type: application/json');
    print json_encode($value);
  }
  private function is_assoc ($arr) {
    return (is_array($arr) && count(array_filter(array_keys($arr),'is_string')) == count($arr));
  }
  private function crud($class_name,$id=null){

    $root = new stdClass();
    $root->result = 'success';
    $root->dtm = 'now';

    $method = $_SERVER['REQUEST_METHOD'];
    $method_override = $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'];
    $user_method_override = $_REQUEST['USER_METHOD_OVERRIDE'];

    $root->request_method = $method;
    $root->x_http_method_override = $method_override;
    $root->user_method_override = $user_method_override;

    if(isset($method_override)) $method = $method_override;
    if(isset($user_method_override)) $method = $user_method_override;

    if($class_name == 'Charity') $method = 'GET';

    $method = strtoupper($method);

    switch($method){
      case 'GET':
      $items = array();
      if(isset($id)){
        $rmethod = new ReflectionMethod($class_name, 'GetById');
        $item = $rmethod->invoke($class_name, $id);
        if($item) $items[] = $item;
      }else{
        $rmethod = new ReflectionMethod($class_name, 'GetAll');
        $items = $rmethod->invoke($class_name);
      }
      $root->items = $items;
      break;
      case 'POST':
      $obj = $_POST['obj'];
      if(isset($obj)){
        $obj = json_decode(json_encode($obj));
        $rclass = new ReflectionClass($class_name);
        $item = $rclass->newInstanceArgs(array($obj));
        $item->Create();
      }
      break;
      case 'PUT':
      $obj = $_POST['obj'];
      if(isset($obj)){
        $obj = json_decode(json_encode($obj));
        $rclass = new ReflectionClass($class_name);
        $item = $rclass->newInstanceArgs($obj);
        $item->Update();
      }
      break;
      case 'DELETE':
      if(isset($id)){
        $rmethod = new ReflectionMethod($class_name, 'GetById');
        $item = $rmethod->invoke($class_name, $id);
        if($item) $item->Delete();
      }
      break;
    }
    return $root;
  }
}