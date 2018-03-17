<?php	include $layout->header; ?>
<form id="signin" action="/admin/signin" method="post">
<input type="hidden" name="post_id" value="<?php echo md5(date('Hms').session_id()); ?>" />
<div id="signin_header">
<div class="logo"><img src="/img/qeala-web-design-logo.png" /></div>
<div class="title"><?php APP_NAME ?><br/>Content<br>Management<br>System</div>
<div class="error"><?php echo $error ?></div>
<label>Email Address</label>
<input type="text" id="email" name="email" tabindex="1" maxlength="100" />
<label>Password</label>
<input type="password" id="password" name="password" tabindex="2" maxlength="10" />
<div class="command"><input type="submit" id="cmd" name="cmd" value="<?php echo CMD_LOGIN ?>" class="button submit" /></div>
</form>
<?php	include $layout->footer; ?>


