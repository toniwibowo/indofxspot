<div class="register-box">
  <div class="register-logo">
    <img src="http://www.sketsa.net/images/logo.png" height="100px">
    <br>
    <a href="<?php echo site_url() ?>">Sketsa.net</a>
  </div><!-- /.login-logo -->
  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>
    <?php echo $message;?>
    <?php echo form_open('register'); ?>
      <div class="form-group has-feedback">
        <input name="fullname" type="text" class="form-control" placeholder="Full Name" required="required">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="Email" required="required">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" id="password" data-toggle="password" type="password" class="form-control" placeholder="Password" required="required">
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the terms
            </label>
          </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div><!-- /.col -->
      </div>
    <?php echo form_close(); ?>
    <a href="<?php echo site_url('login') ?>" class="text-center">I already have a membership</a><br>
  </div><!-- /.form-box -->
</div><!-- /.register-box -->
<script>
$(function(){
  $('input').iCheck({ checkboxClass: 'icheckbox_square-blue' });
});
</script>