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
  public function car($id=null){
    $value = $this->crud('Car',$id);
    header('Content-Type: application/json');
    print json_encode($value);
  }
  public function club($id=null){
    $value = $this->crud('Club',$id);
    header('Content-Type: application/json');
    print json_encode($value);
  }
  public function test(){
    $value = new stdClass();
    $value->status = 'success';
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