<?php
class User{
	public $user_id;
	public $application_id;
	public $username;
	public $email;
	public $password;
	public $approved_flag;
	public $active_flag;
	public $last_login_dtm;
	public $creation_dtm;
	public $last_update_dtm;

	function __construct(){
		$num_args = func_num_args();
		switch($num_args){
			case 0:
				$this->user_id = 0;
				$this->active_flag = 0;
				$this->approved_flag = 0;
			break;
			case 1:
				$result = func_get_arg(0);
				foreach($result as $key => $value) $this->$key = $value;
			break;
		}
	}

	function __toString(){
		return get_class($this);
	}
	static function GetAll(){
		$values = array();
		$sql = "call sp_user_get";
		$results = MySQL::Execute($sql);
		if($results) foreach($results as $result) $values[] = new User($result);
		return $values;
	}

	static function GetById($user_id){
		$value = null;
		$sql = "call sp_user_get_by_id(?)";
		$params = array('s', $user_id);
		$results = MySQL::Execute($sql, $params);
		if($results) $value = new User($results[0]);
		return $value;
	}

	function Create(){
		$value = null;
		$sql = "call sp_user_ins(?, ?, ?, ?, ?, ?, ?)";
		$params = array('ssssiis', $this->application_id, $this->username, $this->email, $this->password, $this->approved_flag, $this->active_flag, $this->last_login_dtm);
		$results = MySQL::Execute($sql, $params);
		if($results){
			$this->user_id = $results[0]->user_id;
			$this->creation_dtm = $results[0]->creation_dtm;
		}
	}

	function Save(){
		if(empty($this->user_id)){
			$this->Create();
		}else{
			$value = null;
			$sql = "call sp_user_upd(?, ?, ?, ?, ?, ?, ?, ?)";
			$params = array('sssssiis', $this->user_id, $this->application_id, $this->username, $this->email, $this->password, $this->approved_flag, $this->active_flag, $this->last_login_dtm);
			$results = MySQL::Execute($sql, $params);
			if($results){
				$this->last_update_dtm = $results[0]->last_update_dtm;
			}
		}
	}

	function Delete(){
		$sql = "call sp_user_del(?)";
		$params = array('s', $this->user_id);
		MySQL::Execute($sql, $params);
	}

	static function GetByUserName($username){
		$value = null;
		$sql = "call sp_user_get_by_username(?)";
		$params = array('s', $username);
		$results = MySQL::Execute($sql, $params);
		if($results) $value = new User($results[0]);
		return $value;
	}

	static function GetByEmail($email){
		$value = null;
		$sql = "call sp_user_get_by_email(?)";
		$params = array('s', $email);
		$results = MySQL::Execute($sql, $params);
		if($results) $value = new User($results[0]);
		return $value;
	}

	static function GetByRole($rolename){
		$value = null;
		$sql = "call sp_user_get_by_role(?)";
		$params = array('s', $rolename);
		$results = MySQL::Execute($sql, $params);
		if($results) $value = new User($results[0]);
		return $value;
	}

	static function Validate($username, $password){
		$password = Blowfish::Encrypt($password);
		$value = null;
		$sql = "call sp_user_validate(?, ?)";
		$params = array('ss', $username, $password);
		$results = MySQL::Execute($sql, $params);
		if($results) $value = new User($results[0]);
		return $value;
	}

	function SendWelcome(){
		$prof = Profile::GetByUser($this->user_id);
		$html = "<style type=\"text/css\">";
		$html .= "div{font:normal 9pt verdana; margin-bottom:10px;}";
		$html .= ".thanks{margin-top:10px;}";
		$html .= "</style>";
		$html .= sprintf("<div>Hi %s,</div>", $prof->first_name);
		$html .= "<div>Your membership has been created. Now it will be easier than ever to access our products and services.</div>";
		$html .= sprintf("<div>Username: %s</div>", $this->username);
		$html .= sprintf("<div>Email: %s</div>", $this->email);
		$html .= sprintf("<div>Password: %s</div>", $this->password);
		$html .= "<div class=\"thanks\">Thanks,</div>";
		$html .= sprintf("<div>The %s Team</div>", APP_NAME);

		$to = $this->email;
		$subj = sprintf("Welcome to %s", APP_NAME);
		$msg = $html;
		send_mail($to, $subj, $msg);
	}

	function SendActivation(){
		$prof = Profile::GetByUser($this->user_id);
		$site_url = sprintf("http://%s%s", $_SERVER['HTTP_HOST'], APP_PATH);
		$activate_url = sprintf("%s/user/activate/%s", $site_url, urlencode(base64_encode(Blowfish::Encrypt($this->user_id))));
		$html = "<style type=\"text/css\">";
		$html .= "div{font:normal 9pt verdana; margin-bottom:10px;}";
		$html .= ".thanks{margin-top:10px;}";
		$html .= "</style>";
		$html .= sprintf("<div>Hi %s,</div>", $prof->first_name);
		$html .= sprintf("<div>You recently registered at %s.  Please confirm your membership by clicking this link:</div>", APP_NAME);
		$html .= sprintf("<div><a href=\"%s\">%s</a></div>", $activate_url, $activate_url);
		$html .= "<div class=\"thanks\">Thanks,</div>";
		$html .= sprintf("<div>The %s Team</div>", APP_NAME);

		$to = $this->email;
		$subj = 'Membership Information';
		$msg = $html;
		send_mail($to, $subj, $msg);
	}

	function SendNotification(){
		$prof = Profile::GetByUser($this->user_id);
		$site_url = sprintf("http://%s%s", $_SERVER['HTTP_HOST'], APP_PATH);
		$view_url = sprintf("%s/user/view/%s", $site_url, urlencode(base64_encode(Blowfish::Encrypt($this->user_id))));
		$html = "<style type=\"text/css\">";
		$html .= "div{font:normal 9pt verdana; margin-bottom:10px;}";
		$html .= ".thanks{margin-top:10px;}";
		$html .= "</style>";
		$html .= "<div>Hello,</div>";
		$html .= sprintf("<div>A user recently registered at %s.  You may view the user information by clicking this link:</div>", APP_NAME);
		$html .= sprintf("<div><a href=\"%s\">%s</a></div>", $view_url, $view_url);
		$html .= "<div class=\"thanks\">Thanks,</div>";
		$html .= sprintf("<div>The %s Team</div>", APP_NAME);

		$to = EMAIL_SIGNUP;
		$subj = 'Membership Notification';
		$msg = $html;
		send_mail($to, $subj, $msg);
	}

	function SendPassword(){
		$prof = Profile::GetByUser($this->user_id);
		$site_url = sprintf("http://%s%s", $_SERVER['HTTP_HOST'], APP_PATH);
		$activate_url = sprintf("%s/user/activate/%s", $site_url, urlencode(base64_encode(Blowfish::Encrypt($this->user_id))));
		$reset_url = sprintf("%s/user/reset/%s", $site_url, urlencode(base64_encode(Blowfish::Encrypt($this->user_id))));

		$html = "<style type=\"text/css\">";
		$html .= "div{font:normal 9pt verdana; margin-bottom:10px;}";
		$html .= ".thanks{margin-top:10px;}";
		$html .= "</style>";
		$html .= sprintf("<div>Hi %s,</div>", $prof->first_name);
		$html .= sprintf("<div>You recently requested your membership credentials for %s.</div>", APP_NAME);

		if(empty($this->approved_flag)){
			$html .= "<div>Your membership is currently inactive.  You must first activate your membership by clicking the link below:</div>";
			$html .= sprintf("<div><a href=\"%s\">%s</a></div>", $activate_url, $activate_url);
		}else{
			$html .= sprintf("<div><a href=\"%s\">Click here to reset your password.</a></div>", $reset_url);
		}

		$html .= "<div class=\"thanks\">Thanks,</div>";
		$html .= sprintf("<div>The %s Team</div>", APP_NAME);

		$to = $this->email;
		$subj = 'Membership Information';
		$msg = $html;
		send_mail($to, $subj, $msg);
	}

	function SendAccount(){
		$prof = Profile::GetByUser($this->user_id);
		$site_url = sprintf("http://%s%s", $_SERVER['HTTP_HOST'], APP_PATH);
		$signin_url = sprintf("%s/user/signin", $site_url);
		$html = "<style type=\"text/css\">";
		$html .= "div{font:normal 9pt verdana; margin-bottom:10px;}";
		$html .= ".thanks{margin-top:10px;}";
		$html .= "</style>";
		$html .= sprintf("<div>Hi %s,</div>", $prof->first_name);
		$html .= sprintf("<div>%s account has been updated. Please sign in to review your account.</div>", APP_NAME);
		$html .= sprintf("<div><a href=\"%s\">%s</a></div>", $signin_url, $signin_url);
		$html .= "<div class=\"thanks\">Thanks,</div>";
		$html .= sprintf("<div>The %s Team</div>", APP_NAME);

		$to = $this->email;
		$subj = 'Account Information';
		$msg = $html;
		send_mail($to, $subj, $msg);
	}
}
?>