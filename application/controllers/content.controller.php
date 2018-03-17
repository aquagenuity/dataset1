<?php

class ContentController extends BaseController
{
	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->registry->template->scripts = array('/js/jquery.validate.js');
	}
	public function index()
	{
	}
	public function offline()
	{
		$this->registry->template->show('content.offline.php');
	}
	public function info()
	{
		$this->registry->template->show('content.info.php');
	}
	public function env()
	{
		$this->registry->template->show('content.env.php');
	}
	public function test()
	{
		$this->registry->template->show('content.test.php');
	}
}