<?php

class AdminController extends BaseController
{
	public function __construct($registry)
	{
		parent::__construct($registry);
		$layout = new stdClass();
		$layout->header = 'application/views/layout/header-admin.php';
		$layout->footer = 'application/views/layout/footer-admin.php';
		$this->registry->template->SetLayout($layout);
	}

	public function signin(){
		global $post_back, $double_post_back;
		$cmd = $_POST['cmd'];

		if($post_back && !$double_post_back && $cmd == CMD_LOGIN){
			$email = $_POST['email'];
			$password = $_POST['password'];
			$username = Membership::GetUserNameByEmail($email);
			$b = Membership::ValidateUser($username, $password);
			if($b){
				// set cookie and redirect user
				$user = Membership::GetUserByUserName($username);
				if($user->approved_flag){
					$_SESSION['user_id'] = $user->user_id;
					$_SESSION['username'] = $user->username;
					$this->redirect('/admin');
				}else{
					$this->registry->template->error = 'Account is not active.';
				}
			}else{
				$this->registry->template->error = 'Invalid Credentials';
			}
		}

		$layout = new stdClass();
		$layout->header = 'application/views/layout/header-min.php';
		$layout->footer = 'application/views/layout/footer-min.php';
		$this->registry->template->setLayout($layout);

		$this->registry->template->scripts = array('/js/jquery.validate.js','/js/admin.signin.js');
		$this->registry->template->show('admin.signin.php');
	}
	public function signout(){
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
		session_destroy();
		$this->redirect('/');
	}
	public function index()
	{
		if(!is_admin()) $this->redirect('/user/signout');
		$this->redirect('/admin/user');
	}
	public function cms(){
		if(!is_admin()) $this->redirect('/user/signout');

		$this->registry->template->class_name = "Cms";
		$this->registry->template->item_id = "cms_id";

		$this->registry->template->table_fields = array('cms_id', 'name', 'creation_dtm');
		$this->registry->template->view_fields = array('cms_id', 'name', 'creation_dtm');
		$this->registry->template->edit_fields = array('name', 'html'=>'textarea');

		$this->registry->template->scripts = array('/js/jquery.validate.js', '/js/jquery.alerts.js', '/js/nicEdit.js', '/js/admin.cms.js');
		$this->registry->template->show('admin.manage.php');
	}
	public function user(){
		if(!is_admin()) $this->redirect('/user/signout');

		$this->registry->template->scripts = array('/js/jquery.validate.js', '/js/jquery.alerts.js', '/js/admin.user.js');
		$this->registry->template->show('admin.user.php');
	}
	public function gen(){
		if(!is_admin()) $this->redirect('/user/signout');

		$this->registry->template->scripts = array('/js/jquery.validate.js', '/js/jquery.alerts.js', '/js/admin.gen.js');
		$this->registry->template->show('admin.gen.php');
	}
}
