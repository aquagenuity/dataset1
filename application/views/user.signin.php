<?php	include $layout->header; ?>
<div class="row">
  <div class="col-md-12">


<form id="signin" action="/user/signin" method="post">
<input type="hidden" name="post_id" value="<?php echo md5(date('Hms').session_id()); ?>" />
<h1>Sign In</h1>
<div class="error"><?php echo $error ?></div>
<label>Email Address</label>
<input type="text" id="email" name="email" tabindex="1" maxlength="100" />
<label>Password</label>
<input type="password" id="password" name="password" tabindex="2" maxlength="10" />
<div><a href="/user/password">Forgot Password</a></div>
<div class="command"><input type="submit" id="cmd" name="cmd" value="<?php echo CMD_LOGIN ?>" class="button submit" /></div>
</form>

  </div>
</div>
<?php	include $layout->footer; ?>


