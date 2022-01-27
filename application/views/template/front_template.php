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
    ];
    ?>
    <?php $this->output_view->set_assets($path, true, 'styles') ?>
    <?php 
        if (isset($css_plugins)) {
            $this->output_view->set_assets($css_plugins, false, 'styles');
        }
    ?>
    <?php $this->output_view->set_assets('assets/css/front.css', true, 'styles') ?>
    <?php echo $this->output_view->get_assets('styles') ?>


    <!--VIDEO PLAYER HTML5 -->
    <script src="https://cdn.plyr.io/2.0.7/plyr.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/2.0.7/plyr.css">

    <!--END VIDEO PLAYER HTML5 -->


</head>
<body class="hold-transition skin-red layout-top-nav">
    <!-- Site wrapper -->
    <div class="wrapper"> 
        <header class="main-header">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <a href="<?php echo site_url() ?>" class="navbar-brand">Sketsa CMS</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                      <?php $menus = $this->output_view->get_menu('top menu'); ?>
                      <ul class="nav navbar-nav">
                        <?php foreach ($menus as $menu): ?>
                            <?php if (is_array($menu['children'])): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $menu['label'] ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                    <?php foreach ($menu['children'] as $menu2): ?>
                                        <li><a href="<?php echo base_url($menu2['link']) ?>"><?php echo $menu2['label'] ?></a></li>
                                    <?php endforeach ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li><a href="<?php echo base_url($menu['link']) ?>"><?php echo $menu['label'] ?></a></li>
                            <?php endif ?>
                        <?php endforeach ?>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                        <?php if (!$this->ion_auth->logged_in()): ?>
                            <li><a href="<?php echo site_url('login') ?>" title="Login"><i class="fa fa-sign-in fa-fw"></i> Login</a></li>
                            <li><a href="<?php echo site_url('register') ?>" title="Sign Up">Sign Up</a></li>
                        <?php else: ?>
                            <li class="dropdown user user-menu">
                                <?php $user = $this->ion_auth->user()->row() ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo $user->photo == '' ? base_url('assets/img/logo/kotaxdev.png') : base_url('assets/uploads/image/'.$user->photo) ?>" class="user-image" alt="User Image"/>
                                    <span class="hidden-xs"><?php echo $user->username ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo $user->photo == '' ? base_url('assets/img/logo/kotaxdev.png') : base_url('assets/uploads/image/'.$user->photo) ?>" class="img-circle" alt="User Image" />
                                        <p>
                                          <?php echo $user->full_name ?>
                                          <small>Last login <?php echo ' '.date('d/m/Y H:i', $user->last_login); ?></small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo  site_url('myigniter/profile')?>" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo  site_url('logout')?>" class="btn btn-default btn-flat">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <?php endif ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content exspan-bottom">
                <?php echo $this->output_view->get_wrapper('page') ?>

               

            </section><!-- /.content -->
        </div><!-- ./wrapper -->
        <footer class="main-footer">
            <div class="container">            
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2014-2016 <a href="http://www.sketsa.net">Sketsa.net</a>.</strong> All rights reserved.
            </div>
        </footer>
    </div>
    <?php
    $path = [
        'assets/plugins/jquery/dist/jquery.min.js',
        'assets/plugins/bootstrap/dist/js/bootstrap.min.js',
        'assets/plugins/AdminLTE/dist/js/app.min.js',
    ];
    ?>
    <?php $this->output_view->set_assets($path, true, 'scripts') ?>
    <?php 
    if (isset($js_plugins)) {
        $this->output_view->set_assets($js_plugins, false, 'scripts');
    }
    ?>
    <?php $this->output_view->set_assets('assets/js/a-design.js', true, 'scripts') ?>
    <?php echo $this->output_view->get_assets('scripts') ?>
    <?php echo $this->output_view->get_script() ?>


     <script>
      
     // A $( document ).ready() block.
$( document ).ready(function() {
    console.log( "ready!" );
    plyr.setup();
});
      
    </script>
</body>
</html>