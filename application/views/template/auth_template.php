<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php echo $this->output_view->get_meta_tags() ?>
    <?php echo $this->output_view->get_title() ?>
    <?php echo $this->output_view->get_favicon() ?>
    <?php echo $this->output_view->get_schema() ?>
    <?php
    $path = [
        'assets/plugins/bootstrap/dist/css/bootstrap.min.css',
        'assets/plugins/AdminLTE/dist/css/AdminLTE.min.css',
        'assets/plugins/AdminLTE/dist/css/skins/skin-red.min.css',
        'assets/plugins/font-awesome/css/font-awesome.min.css',
        'assets/plugins/iCheck/skins/square/blue.css'
    ];
    ?>
    <?php $this->output_view->set_assets($path, TRUE, 'styles') ?>
    <?php 
        if (isset($css_plugins))
        {
            $this->output_view->set_assets($css_plugins, FALSE, 'styles');
        }
    ?>
    <?php $this->output_view->set_assets('assets/css/a-design.css', TRUE, 'styles') ?>
    <?php echo $this->output_view->get_assets('styles') ?>
</head>
<body class="login-page">
    <!-- Page Content -->
    <?php echo $this->output_view->get_wrapper('page') ?>
    <!-- /#page-wrapper -->
    <?php
    $path = [
        'assets/plugins/jquery/dist/jquery.min.js',
        'assets/plugins/bootstrap/dist/js/bootstrap.min.js',
        'assets/plugins/iCheck/icheck.min.js',
        'assets/plugins/bootstrap-show-password/bootstrap-show-password.min.js'
    ];
    ?>
    <?php $this->output_view->set_assets($path, TRUE, 'scripts') ?>
    <?php 
    if (isset($js_plugins))
    {
        $this->output_view->set_assets($js_plugins, FALSE, 'scripts');
    }
    ?>
    <?php $this->output_view->set_assets('assets/js/a-design.js', TRUE, 'scripts') ?>
    <?php echo $this->output_view->get_assets('scripts') ?>
    <?php echo $this->output_view->get_script() ?>
</body>
</html>