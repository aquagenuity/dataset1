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
	public function zip(){
		if(!is_admin()) $this->redirect('/user/signout');

    $this->registry->template->class_name = "Zip";
    $this->registry->template->item_id = "zip_id";

    $this->registry->template->g_toxin_type_cd_values = ToxinType::GetValues();
    $this->registry->template->g_health_risk_type_cd_values = HealthRiskType::GetValues();
    $this->registry->template->g_filter_type_cd_values = FilterType::GetValues();
    $this->registry->template->g_utility_id_values = Utility::GetValues();

    $this->registry->template->table_fields = array('zip_cd', 'toxin_type_cd', 'health_risk_type_cd', 'filter_type_cd');
    $this->registry->template->view_fields = array('zip_cd', 'toxin_type_cd', 'health_risk_type_cd', 'filter_type_cd', 'amount', 'utility_id', 'sample_dtm');
    $this->registry->template->edit_fields = array('zip_cd', 'toxin_type_cd', 'health_risk_type_cd', 'filter_type_cd', 'amount', 'utility_id', 'sample_dtm');


		$this->registry->template->scripts = array('/js/jquery.validate.js', '/js/jquery.alerts.js');
		$this->registry->template->show('admin.manage.php');
	}

  public function toxin_average(){
    if(!is_admin()) $this->redirect('/user/signout');

    $this->registry->template->class_name = "ToxinAverage";
    $this->registry->template->item_id = "toxin_average_id";

    $this->registry->template->g_toxin_type_cd_values = ToxinType::GetValues();
    $this->registry->template->g_average_type_cd_values = AverageType::GetValues();

    $this->registry->template->table_fields = array('toxin_type_cd', 'average_type_cd', 'value');
    $this->registry->template->view_fields = array('toxin_type_cd', 'average_type_cd', 'value');
    $this->registry->template->edit_fields = array('toxin_type_cd', 'average_type_cd', 'value');

    $this->registry->template->scripts = array('/js/jquery.validate.js', '/js/jquery.alerts.js');
    $this->registry->template->show('admin.manage.php');
  }

  public function toxin_limit(){
    if(!is_admin()) $this->redirect('/user/signout');

    $this->registry->template->class_name = "ToxinLimit";
    $this->registry->template->item_id = "toxin_limit_id";

    $this->registry->template->g_toxin_type_cd_values = ToxinType::GetValues();
    $this->registry->template->g_limit_type_cd_values = LimitType::GetValues();

    $this->registry->template->table_fields = array('toxin_type_cd', 'limit_type_cd', 'value');
    $this->registry->template->view_fields = array('toxin_type_cd', 'limit_type_cd', 'value');
    $this->registry->template->edit_fields = array('toxin_type_cd', 'limit_type_cd', 'value');

    $this->registry->template->scripts = array('/js/jquery.validate.js', '/js/jquery.alerts.js');
    $this->registry->template->show('admin.manage.php');
  }

  public function zip_toxin_source(){
    if(!is_admin()) $this->redirect('/user/signout');

    $this->registry->template->class_name = "ZipToxinSource";
    $this->registry->template->item_id = "zip_toxin_source_id";

    $this->registry->template->g_toxin_type_cd_values = ToxinType::GetValues();
    $this->registry->template->g_source_type_cd_values = SourceType::GetValues();

    $this->registry->template->table_fields = array('zip_cd', 'toxin_type_cd', 'source_type_cd');
    $this->registry->template->view_fields = array('zip_cd', 'toxin_type_cd', 'source_type_cd');
    $this->registry->template->edit_fields = array('zip_cd', 'toxin_type_cd', 'source_type_cd');

    $this->registry->template->scripts = array('/js/jquery.validate.js', '/js/jquery.alerts.js');
    $this->registry->template->show('admin.manage.php');
  }

}
