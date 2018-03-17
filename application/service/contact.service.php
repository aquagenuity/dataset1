<?php

	error_reporting(E_ALL);

	include_once('../settings.php');
	include_once('../classes/contact.class.php');
	include_once('../classes/phpmailer.class.php');
	include_once('../classes/smtp.class.php');
	include_once('../classes/mysql.class.php');

	$mtime = microtime();
	$mtime = explode(' ', $mtime);
	$mtime = $mtime[1] + $mtime[0];
	$starttime = $mtime;

	$contacts = Contact::GetByProcessFlag(1);
	foreach($contacts as $contact){

		$html = "<style type=\"text/css\">";
		$html .= "div{font:normal 9pt verdana; margin-bottom:10px;}";
		$html .= ".thanks{margin-top:10px;}";
		$html .= "</style>";

		$html .= sprintf("<div>Name: %s</div>", $contact->name);
		$html .= sprintf("<div>Email: %s</div>", $contact->email);
		$html .= sprintf("<div>Phone: %s</div>", $contact->phone);
		$html .= sprintf("<div>Message: %s</div>", $contact->message);

		$to = EMAIL_CONTACT;
		$subj = 'Customer Inquiry';
		$msg = $html;
		$rply = $contact->email;

		printf("%s...", $to);

		if(send_mail($to, $subj, $msg, $rply)){
			print("success\n");
			$contact->process_flag = 0;
			$contact->Save();
		}else{
			print("Fail\n");
		}
	}

	function send_mail($to, $subj, $msg, $rply){
		$msg = wordwrap($msg, 70);

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->Host = SMTP_HOST;
		$mail->Port = 587;
		$mail->Username = SMTP_USERNAME;
		$mail->Password = SMTP_PASSWORD;
		$mail->SetFrom(EMAIL_NOTIFY);
		$mail->Subject = $subj;
		$mail->MsgHTML($msg);
		$mail->AddAddress($to);

		$value = $mail->Send();

		if($value != true) trace($mail->ErrorInfo);

		return $value;
	}


	function trace($s, $j=0){
		global $starttime;

		$mtime = microtime();
		$mtime = explode(" ", $mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;
		$totaltime = ($endtime - $starttime);
		$sdtm = $totaltime;

		if(!is_scalar($s)) $s = json_encode($s);
		if(TRACE_ENABLED){
		  error_log(sprintf("%09.6f %s \n", $sdtm, $s), 3, TRACE_FILE_UNC);
		}
	}


?>