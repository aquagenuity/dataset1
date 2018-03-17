<?php

	$class_name = "User";
	$item_id = "user_id";

	$table_fields = array('username', 'email', 'approved_flag',  'active_flag', 'creation_dtm');
	$view_fields = array('username', 'email', 'approved_flag'=>'checkbox', 'active_flag'=>'checkbox','creation_dtm');
	$edit_fields = array('username', 'email',  'approved_flag'=>'checkbox', 'active_flag'=>'checkbox', 'password');
	$profile_edit_fields = array('first_name','last_name','age');

	$ctl_lnk = '<a href=\"javascript:__postback(\'Export\', \'\', \'/admin/user\', \'_blank\')\">Export</a> &nbsp;';

	$page_no = 1;
	$resultcount  = 12;
	$key_types = array('text', 'select', 'textarea', 'checkbox', 'file', 'richtextbox');

	$cmd = $_REQUEST["cmd"];
	if(empty($cmd)) $cmd = CMD_LIST;

	$cmd_arg = $_REQUEST["cmd_arg"];

	if($cmd == CMD_EXPORT){
		$html = "\"Role\",\"Last Name\",\"First Name\",\"Email Address\",\"Creation DateTime\"\n";
		$users = User::GetAll();
		foreach($users as $user){
			$profile = Profile::GetByUser($user->user_id);
			if($profile) $html .= sprintf("\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"\n", 'User', $profile->last_name, $profile->first_name, $user->email, $user->username, $user->creation_dtm);
		}
		header("Cache-Control: private");
		header("Content-Type: text/plain");
		echo $html;
		die;
	}
	if($cmd == CMD_DELETE){
		if(!$double_post_back) {
			$rmethod = new ReflectionMethod($class_name, 'GetById');
			$item = $rmethod->invoke($class_name, $cmd_arg);

			$profile = Profile::GetByUser($item->user_id);
			if($profile) $profile->Delete();

			$item->Delete();
		}
		$cmd = CMD_LIST;
	}
	if($cmd == CMD_BACK){
		$cmd = CMD_LIST;
	}
	if($cmd == CMD_CANCEL){
		$cmd = CMD_LIST;
	}
	if($cmd == CMD_SAVE){


		if(!$double_post_back){
			$send_account = 0;
			$rclass = new ReflectionClass($class_name);
			if(empty($cmd_arg)){
				$item = $rclass->newInstance();
			}else{
				$rmethod = new ReflectionMethod($class_name, 'GetById');
				$item = $rmethod->invoke($class_name, $cmd_arg);
			}
			foreach($edit_fields as $key => $key_type){
				if(array_search($key_type, $key_types) === false)	$key = $key_type;
				$value = $_REQUEST[$key];
				if($key == 'password'){
					if(!empty($value) && $value != PASSWORD_MASK){
						$value = Blowfish::Encrypt($value);
						$item->$key = $value;
					}
				}else{
					$item->$key = $value;
				}
			}

			$item->application_id = APP_ID;
			$item->Save();

			$profile = Profile::GetByUser($item->user_id);
			foreach($profile_edit_fields as $key => $key_type){
				if(array_search($key_type, $key_types) === false)	$key = $key_type;
				$value = $_REQUEST[$key];
				if($value != "NoSelect" && !is_masked($value)) $profile->$key = $value;
			}
			$profile->Save();

			if($send_account) $item->SendAccount();
    }
		$cmd = CMD_LIST;
	}
	if($cmd == CMD_NEW){
		$rclass = new ReflectionClass($class_name);
		$item = $rclass->newInstance();
		$profile = new Profile();
	}
	if($cmd == CMD_EDIT){
		$rmethod = new ReflectionMethod($class_name, 'GetById');
		$item = $rmethod->invoke($class_name, $cmd_arg);
		$profile = Profile::GetByUser($item->user_id);
	}
	if($cmd == CMD_VIEW){
		$rmethod = new ReflectionMethod($class_name, 'GetById');
		$item = $rmethod->invoke($class_name, $cmd_arg);
		$profile = Profile::GetByUser($item->user_id);
	}
	if($cmd == CMD_SORT){
		$page_no = 1;
		$cmd_arg_values = explode(':', $cmd_arg);
		$sort_id = $cmd_arg_values[0];
		$sort_order = $cmd_arg_values[1];
		$items = $_SESSION["items"];
		$enclosure = new StdClassEnclosure($sort_id, $sort_order);
		usort($items, array($enclosure, 'cmp'));
	}
	if($cmd == CMD_PAGE){
		$page_no = $cmd_arg;
		$items = $_SESSION["items"];
	}
	if($cmd == CMD_SEARCH){
		$page_no = 1;
		$search_username = $_REQUEST["search_username"];
		$search_email = $_REQUEST["search_email"];
		$search_last_name = $_REQUEST["search_last_name"];
		$rmethod = new ReflectionMethod($class_name, 'GetAll');
		$items = $rmethod->invoke($class_name);
		if($search_username){
			$items = array_filter($items,
				function($item) use ($search_username) {
				return (strpos($item->username, $search_username) === 0);
			});
		}
		if($search_email){
			$items = array_filter($items,
				function($item) use ($search_email) {
				return (strpos($item->email, $search_email) === 0);
			});
		}
		if($search_last_name){
			$profiles = Profile::GetByProperty('last_name', $search_last_name);
			$items = array_filter($items,
				function($item) use ($profiles) {
					$b = false;
					foreach($profiles as $profile){
						if($item->user_id == $profile->user_id){
							$b = true;
							break;
						}
					}
					return $b;
			});
		}
		$items = array_values($items);
	}
	if($cmd == CMD_LIST){
		$rmethod = new ReflectionMethod($class_name, 'GetAll');
		$items = $rmethod->invoke($class_name);
	}

	$_SESSION["page_no"] = $page_no;
	$_SESSION["items"] = $items;

	include $layout->header;

				switch($cmd){
					case CMD_LIST:
					case CMD_PAGE:
					case CMD_SORT:
					case CMD_SEARCH:

						$pagedResults = new Paginated($items, $resultcount, $page_no);
						$pagedResults->setLayout(new MbLayout());
						$page_html = $pagedResults->fetchPagedNavigationHtml();

						$start_rec = (($page_no-1) * $resultcount) + 1;
						$end_rec = $start_rec + $resultcount - 1;
						$item_count = count($items);
						if($end_rec > $item_count) $end_rec = $item_count;


						$html = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
						eval("\$ctl_lnk_value = \"$ctl_lnk\";");
						$html .= sprintf("<tr><td><h2>%ss</h2></td><td style=\"text-align:right;\">%s%s</td></tr>", label($class_name), $ctl_lnk_value, LinkButton::GetHtml('New', CMD_NEW));
						$html .= "</table>";
						$html .= "<div style=\"border:1px solid silver; padding:5px; margin-bottom:10px\">";
						$html .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"filter-table\">";
						$html .= "<col width=\"130\" />";
						$html .= "<col width=\"130\" />";
						$html .= "<col width=\"130\" />";
						$html .= "<col width=\"50\" />";
						$html .= "<tr>";
						$html .= "<td>";
						$html .= "<div class=\"label\">Username</div>";
						$html .= sprintf("<input name=\"search_username\" type=\"text\" id=\"search_username\" value=\"%s\" style=\"width:130px;\" /></td>", $search_username);
						$html .= "<td>";
						$html .= "<div class=\"label\">Email Address</div>";
						$html .= sprintf("<input name=\"search_email\" type=\"text\" id=\"search_email\" value=\"%s\" style=\"width:130px;\" /></td>", $search_email);
						$html .= "<td>";
						$html .= "<div class=\"label\">Last Name</div>";
						$html .= sprintf("<input name=\"search_last_name\" type=\"text\" id=\"search_last_name\" value=\"%s\" style=\"width:130px;\" /></td>", $search_last_name);
						$html .= "<td>";
						$html .= "<div class=\"label\">&nbsp;</div>";
						$html .= Button::GetHtml('Search', CMD_SEARCH);
						$html .= "</tr>";
						$html .= "</table>";
						$html .= "</div>";
						if($item_count == 0){
							$html .= "<div>No records found.</div>";
						}else{
							$html .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"items\">";
							$html .= "<col width=\"310\" /><col width=\"310\" /><col width=\"100\" /><col width=\"90\" /><col width=\"80\" /><col width=\"90\" />";
							$html .= "<tr class=\"item-header\">";
							foreach($table_fields as $key){
								$key_sort_order = 0;
								$sort_arrow = '';
								if($key == $sort_id){
									if($sort_order == 0){
										$sort_arrow = '<img class="sort-arrow" src="/img/sort_asc.png" />';
										$key_sort_order = 1;
									}else{
										$sort_arrow = '<img class="sort-arrow" src="/img/sort_desc.png" />';
										$key_sort_order = 0;
									}
								}
								$cmd_arg_value = sprintf("%s:%s", $key, $key_sort_order);
								$html .= sprintf("<td>%s%s</td>", $sort_arrow, LinkButton::GetHtml(label($key), CMD_SORT, $cmd_arg_value, '', 'sort-link') );
							}
							$html .= "<td></td>";
							$html .= "</tr>";

							$n = 0;
							while($item = $pagedResults->fetchPagedRow()){
								$class = ($n%2 == 0)? "item":"alt-item";
								$html .= sprintf("<tr class=\"%s\">", $class);
								foreach($table_fields as $key){
									$value = $item->$key;
									if(ends_with($key, '_id')){
										$values = ${'g_'.$key.'_values'};
										if($values) $value = $values[$value];
									}else if(ends_with($key, '_flag') || starts_with($key, 'is_')){
			 							$value = yes_no($value);
			 						}else if(ends_with($key, '_dtm') || ends_with($key, '_date')){
			 							$value = to_date($value);
			 						}
		 						  $html .= sprintf("<td>%s</td>", $value);
								}
								eval("\$cmd_lnk_value = \"$cmd_lnk\";");
								$html .= sprintf("<td style=\"text-align:right;\">%s%s &nbsp; %s</td>", $cmd_lnk_value, LinkButton::GetHtml('Edit', CMD_EDIT, $item->$item_id), LinkButton::GetHtml('Delete', CMD_DELETE, $item->$item_id, '', '', true));
								$html .= "</tr>";
								$n++;
							}
							$html .= "</table>";
							$html .= $page_html;
						}
						echo $html;
					break;
					case CMD_VIEW:
						$html = sprintf("<h2>View %s</h2>", label($class_name));
						$html .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"items\">";
						$n = 0;
						foreach($view_fields as $key){
							$class = ($n%2 == 0)? "item":"alt-item";
							$value = $item->$key;
							if(ends_with($key, '_id')){
								$values = ${'g_'.$key.'_values'};
								if($values) $value = $values[$value];
	 						}else if(ends_with($key, '_dtm') || ends_with($key, '_date')){
	 							$value = to_date($value);
	 						}
							$html .= sprintf("<tr class=\"%s\">", $class);
							$html .= sprintf("<td><span class=\"label\">%s</span></td><td>%s</td>", label($key), $value);
							$html .= "</tr>";
							$n++;
						}
						$html .= "</table>";

						$html .= "<div style=\"text-align:right;\" class=\"command\">";
						$html .= LinkButton::GetHtml('Back', CMD_LIST);
						$html .= " ";
						$html .= LinkButton::GetHtml('Edit', CMD_EDIT, $item->$item_id);
						$html .= "</div>";
						echo $html;
					break;
					case CMD_EDIT:
					case CMD_NEW:
						$html = sprintf("<h2>%s %s</h2>", $cmd, label($class_name));
						$html .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"items\">";
						$n = 0;

						foreach($edit_fields as $key => $key_type){
							if(array_search($key_type, $key_types) === false){
								$key = $key_type;
								$key_type = "text";
							}
							if(ends_with($key, '_id')) $key_type = "select";

							$class = ($n%2 == 0)? "item":"alt-item";
							$html .= sprintf("<tr class=\"%s\">", $class);

							$value = $item->$key;

							if($key == 'password' && $cmd == CMD_EDIT) $value = PASSWORD_MASK;


							if($key_type == "select"){
								$values = ${'g_'.$key.'_values'};
								$element = Select::GetHtml($key, $values, $value, '{"class":"element"}');
							}else if($key_type == "file"){
								$element = FileUpload::GetHtml($key, '{"class":"element"}', '{"width":"500px"}');
							}else if($key_type == "checkbox"){
								$element = Checkbox::GetHtml($key, $value);
							}else{
								//if(ends_with($key, '_dtm') || ends_with($key, '_date'))	$value = to_date($value);
							 	if($key_type == "richtextbox"){
									$element = sprintf("<textarea id=\"%s\" name=\"%s\" class=\"ckeditor\">%s</textarea>", $key, $key, $value);
							 	}else if($key_type == "textarea"){
									$element = sprintf("<textarea id=\"%s\" name=\"%s\" class=\"element\">%s</textarea>", $key, $key, $value);
								}else{
									if(ends_with($key, '_dtm') || ends_with($key, '_date'))	$value = to_date($value);
									$element = sprintf("<input type=\"text\" id=\"%s\" name=\"%s\" value=\"%s\" class=\"element\" />", $key, $key, $value);
									//if($key == 'account_no'){
									//	$element .= sprintf("&nbsp;&nbsp;<div class=\"notify-container\" style=\"margin-top:5px\">%s Send Notification</div>", Checkbox::GetHtml('notify', false));
									//}
								}
							}
							$html .= sprintf("<td><span class=\"label\">%s</span></td><td>%s</td>", label($key), $element);
							$html .= "</tr>";

							$n++;
						}

						foreach($profile_edit_fields as $key => $key_type){
							if(array_search($key_type, $key_types) === false){
								$key = $key_type;
								$key_type = "text";
							}
							if(ends_with($key, '_id')) $key_type = "select";
							if($key == 'facebook_id') $key_type = "text";

							$class = ($n%2 == 0)? "item":"alt-item";
							$html .= sprintf("<tr class=\"%s\">", $class);
							$value = $profile->$key;

							if($key_type == "select"){
								$values = ${'g_'.$key.'_values'};
								$element = Select::GetHtml($key, $values, $value, '{"class":"element"}');
							}else if($key_type == "file"){
								$element = FileUpload::GetHtml($key, '{"class":"element"}', '{"width":"500px"}');
							}else if($key_type == "checkbox"){
								$element = Checkbox::GetHtml($key, $value);
							}else{
								//if(ends_with($key, '_dtm') || ends_with($key, '_date'))	$value = to_date($value);
							 	if($key_type == "richtextbox"){
									$element = sprintf("<textarea id=\"%s\" name=\"%s\" class=\"ckeditor\">%s</textarea>", $key, $key, $value);
							 	}else if($key_type == "textarea"){
									$element = sprintf("<textarea id=\"%s\" name=\"%s\" class=\"element\">%s</textarea>", $key, $key, $value);
								}else{
									if(ends_with($key, '_dtm') || ends_with($key, '_date'))	$value = to_date($value);
									if($key == 'card_no') $value = mask($value, 4);
									$element = sprintf("<input type=\"text\" id=\"%s\" name=\"%s\" value=\"%s\" class=\"element\" />", $key, $key, $value);
									if(is_masked($value)) $element .= sprintf(" <a href=\"javascript:void(0)\" class=\"unmask\" pid=\"%s\">unmask</a>", $profile->profile_id);
								}
							}
							$html .= sprintf("<td><span class=\"label\">%s</span></td><td>%s</td>", label($key), $element);
							$html .= "</tr>";

							$n++;
						}


						$html .= "</table>";
						$html .= "<div id=\"valsum\" class=\"error\">$valsum</div>";

						$html .= "<div style=\"text-align:right;\" class=\"command-float\">";
						$html .= "<div class=\"xpan-canvas\"></div>";
						$html .= "<div class=\"xpan-content\">";
						$html .= LinkButton::GetHtml('Cancel', CMD_CANCEL);
						$html .= " ";
						$html .= LinkButton::GetHtml('Save', CMD_SAVE, $item->$item_id);
						$html .= "</div>";
						$html .= "</div>";
						$html .= "</div>";
						echo $html;
					break;
				}
	include $layout->footer;
?>

