<div class="login-box">
  <div class="login-logo">
    <img src="http://www.sketsa.net/images/logo.png" height="100px">
    <br>
    <a href="<?php echo site_url() ?>">Sketsa.net</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Reset password</p>
    <?php echo $message;?>
    <?php echo form_open('reset_password/'.$code); ?>
      <div class="form-group has-feedback">
        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <input type="password" id="password" data-toggle="password" name="password" class="form-control" placeholder="Password" required="required" />
      </div>
      <div class="row">
        <div class="col-xs-4 col-xs-offset-8">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnLoading">Change</button>
        </div><!-- /.col -->
      </div>
    <?php echo form_close(); ?>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->