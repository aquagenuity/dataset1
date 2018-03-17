<?php

class HandlerController extends BaseController
{
	public function index()
	{
		print 'Handler';
	}
  public function test(){
    $root = new stdClass();
    $root->status = 'success';
    header('Content-Type: application/json');
    print $result;
  }
}