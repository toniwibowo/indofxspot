<div class="login-box">
  <div class="login-logo">
    <img src="<?php echo base_url(); ?>images/logo-admin.png" height="100px">
    <br>
    <a href="<?php echo site_url() ?>">Sketsa.net</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php echo $message;?>
    <?php echo form_open('login'); ?>
      <div class="form-group has-feedback">
        <input type="email" name="identity" class="form-control" placeholder="Email" required="required" autofocus />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" data-toggle="password" name="password" class="form-control" placeholder="Password" required="required" />
      </div>
      <div class="row">
        <div class="col-xs-8">    
          <div class="checkbox icheck">
            <label>
              <input name="remember" type="checkbox" value="1"> Remember
            </label>
          </div>                        
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnLoading">Login</button>
        </div><!-- /.col -->
      </div>
    <?php echo form_close(); ?>
    <!--<a href="<?php echo site_url('forgot-password') ?>" title="Sign Up">I forgot my password</a><br>
    <a href="<?php echo site_url('register') ?>" title="Sign Up">Register a new membership</a>-->
  </div><!-- /.login-box-body -->
  <br>
 <!-- <div class="callout callout-info">
    <h4>Demo Login</h4>
    <p>Email : <strong>admin@admin.com</strong><br>Password : <strong>password</strong></p>
  </div>-->
</div><!-- /.login-box -->
<script>
$(function(){
  $('input').iCheck({ checkboxClass: 'icheckbox_square-blue' });
});
</script>