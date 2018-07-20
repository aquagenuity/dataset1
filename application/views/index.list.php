<?php include $layout->header; ?>
<div class="row">
  <div class="col-md-12">

<?php if(is_auth()){ ?>
    <form action="/" method="post">
      <input type="hidden" name="post_id" value="<?php echo md5(date('Hms').session_id()); ?>" />
      <h1>Home</h1>
      <div class="error"><?php echo $error ?></div>
      <label>Zip Code</label>
      <input type="text" class="zip" name="zip_cd" tabindex="1" maxlength="5" />
<!--
      <label>Utility</label>
      <input type="text" class="utility" name="utility_id" tabindex="2" maxlength="100" />
 -->
      <div class="command"><input type="submit" id="cmd" name="cmd" tabindex="3" value="<?php echo CMD_SEARCH ?>" class="button submit" /></div>
    </form>
<?php } ?>

  </div>
</div>
<?php include $layout->footer; ?>
