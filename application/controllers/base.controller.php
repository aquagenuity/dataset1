<?php

abstract class BaseController
{
	protected $registry;

	function __construct($registry)
	{
		$this->registry = $registry;
	}

	abstract function index();

	function noaction($action)
	{
		$s = sprintf("%s does not implement %s action", get_class($this), $action);
		trace($s);
		print($s);
	}
	function redirect($url){
		header("location:" . $_SERVER['SERVER_URL'] . $url);
	}
}