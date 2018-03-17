<?php

class Router
{
	private $path, $controller, $action, $id;
	static $instance;

	public function __construct()
	{
		$request = $_GET['request'];
		$split = explode('/',trim($request,'/'));

		$this->controller = !empty($split[0]) ? ucfirst($split[0]) : 'Index';
		$this->action = !empty($split[1]) ? $split[1] : 'index';
		$this->id = !empty($split[2]) ? $split[2] : null;

		if($r = strpos($this->action, '?'))	$this->action = substr($this->action, 0, $r);
		if($r = strpos($this->id, '?'))	$this->id = substr($this->id, 0, $r);
		$this->action = str_replace('-','_', $this->action);
	}

	public function route($registry)
	{

		require_once( __DIR__ . '/../controllers/base.controller.php');

		$routeinfo = new stdClass();
		$routeinfo->controller = $this->controller;
		$routeinfo->action = $this->action;
		$routeinfo->id = $this->id;

		$uri = sprintf("/%s", $this->controller);
		if(strlen($this->action) > 0){
			$uri = sprintf("%s/%s", $uri, $this->action);
			if(strlen($this->id) > 0){
				$uri = sprintf("%s/%s", $uri, $this->id);
			}
		}

		//trace($uri);

		$routeinfo->uri = strtolower($uri);
		$registry->template->routeinfo = $routeinfo;

		$file = __DIR__ . '/../controllers/' . strtolower($this->controller) . '.controller.php';

		$site_offline = SITE_OFFLINE;

		$remote_host  = null;

		if(isset($_SERVER['REMOTE_HOST'])){
			$remote_host = $_SERVER['REMOTE_HOST'];
		}

		if(SITE_OFFLINE){
			$site_offline_ips = explode(',', SITE_OFFLINE_IP);
			foreach($site_offline_ips as $site_offline_ip){
				if($site_offline_ip == $remote_host) $site_offline = false;
			}
		}

		if($site_offline && $routeinfo->action != 'offline'){
			redirect('/offline');
		}else{
			if(is_readable($file))
			{
				include $file;
				$class = $this->controller . 'Controller';

				$controller = new $class($registry);

				if (is_callable(array($controller, $this->action))){
					$action = $this->action;
					$controller->$action($this->id);
				}else{
					//$controller->noaction($this->action);
					include __DIR__ . '/../controllers/error404.controller.php';
					$controller = new Error404Controller($registry);
					$controller->index();
				}
			}
			else
			{
				include __DIR__ . '/../controllers/error404.controller.php';
				$controller = new Error404Controller($registry);
				$controller->index();
			}
		}

	}
}