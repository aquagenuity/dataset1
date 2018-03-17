<?php	include $layout->header; ?>
<div class="row">
  <div class="col-md-12">

<h1>Profile</h1>
<?php

foreach($prof as $key => $value){
	if($key != 'user_id'){
		if($value) {
      printf("<b>%s:</b> %s<br/>", label($key), $value);
    }
	}
}
printf("<b>Email:</b> %s<br/>", $user->email);
printf("<b>Created:</b> %s<br/>", to_date_time($user->creation_dtm));



?>

  </div>
</div>
<?php	include $layout->footer; ?>
