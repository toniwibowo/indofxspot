<div class="login-box">
  <div class="login-logo">
    <img src="http://www.sketsa.net/images/logo.png" height="100px">
    <br>
    <a href="<?php echo site_url() ?>">Sketsa.net</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Forgot password</p>
    <?php echo $message;?>
    <?php echo form_open('forgot_password'); ?>
      <div class="form-group has-feedback">
        <input type="email" name="identity" class="form-control" placeholder="Email" required="required" autofocus />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 col-xs-offset-8">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnLoading">Send</button>
        </div><!-- /.col -->
      </div>
    <?php echo form_close(); ?>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->