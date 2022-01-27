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
        'assets/plugins/alertify-js/build/css/alertify.min.css',
        'assets/plugins/alertify-js/build/css/themes/default.min.css',
    ];
    ?>
    <?php $this->output_view->set_assets($path, true, 'styles') ?>
    <?php 
        if (isset($grocery_css)) {
            foreach ($grocery_css as $key => $value) {
                $crud_css[] = $value;
            }
            if (isset($crud_css)) {
                $this->output_view->set_assets($crud_css, false, 'styles');
            }
        }
        if (isset($css_plugins)) {
            $this->output_view->set_assets($css_plugins, false, 'styles');
        }
    ?>
    <?php $this->output_view->set_assets('assets/css/a-design.css', true, 'styles') ?>
    <?php echo $this->output_view->get_assets('styles') ?>



    <!--VIDEO PLAYER HTML5 -->
    <script src="https://cdn.plyr.io/2.0.7/plyr.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/2.0.7/plyr.css">

    <!--END VIDEO PLAYER HTML5 -->

</head>
<body class="hold-transition skin-red fixed">
    <!-- Site wrapper -->
    <div class="wrapper">  
        <header class="main-header">
            <a href="<?php echo site_url(); ?>" class="logo">
               <span class="logo-mini"><b>Hiburananak.com</b></span>
               <span class="logo-lg">Hiburananak.com</span>
            </a>

            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <!--<ul class="nav navbar-nav">
                        <li class="dropdown user user-menu" >
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
                    </ul>-->
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar" id="menuSidebar">
               
                <ul class="sidebar-menu list" id="menuList">
                </ul>
               

                <ul class="sidebar-menu list" id="menuSub">
                                                                <li class="header">MAIN NAVIGATION 2</li>
                                                                                   
                                                           
                                                            <li class="treeview">
                                                                        <a href="#" class="name">
                                        <i class="fa fa-user"></i> <span>Channel                                        </span><i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                            
                                            <?php
                                            $channelQuery = $this->db->query("select * from channel");
                                             ?>          
                                             <?php if($channelQuery->num_rows()>0): ?>       

                                             <?php foreach($channelQuery->result_array() as $row): ?>                       
                                            <li id="#">
                                                <a href="<?php echo site_url('video/channel/'.$row['channel_id'].'/'.url_title($row['name'])); ?>" class="name">
                                                    <i class="fa fa-circle-o"></i> <span> <?php echo $row['name']; ?></span>
                                                </a>
                                            </li>

                                        <?php endforeach; ?>

                                        <?php endif; ?>

                                                                            </ul>
                                                                    </li>
                                                            
                                                                                        </ul>



            </section>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $judul ?>
                </h1>
                <?php $this->output_view->breadcrumb($crumb) ?>
            </section>
            <!-- Main content -->
            <section class="content exspan-bottom">
                <?php echo $this->output_view->get_wrapper('page') ?>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 3.8.2
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="http://www.sketsa.net">Sketsa.net</a>.</strong> All rights reserved.
        </footer>
    </div><!-- ./wrapper -->
    <?php 
        $this->output_view->set_assets('assets/plugins/jquery/dist/jquery.min.js', true, 'scripts');
        if (isset($grocery_js)) {
            foreach ($grocery_js as $key => $value) {
                $crud_js[] = $value;
            }
            if (isset($crud_js)) {
                $this->output_view->set_assets($crud_js, false, 'scripts');
            }
        }
    ?>
    <?php
        $path = [
            'assets/plugins/bootstrap/dist/js/bootstrap.min.js',
            'assets/plugins/AdminLTE/dist/js/app.min.js',
            'assets/plugins/alertify-js/build/alertify.min.js',
            'assets/plugins/slimScroll/jquery.slimscroll.min.js',
            'assets/plugins/list.js/dist/list.min.js',
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
    <?php echo $this->output_view->get_script(); ?>


    <script>
      
     // A $( document ).ready() block.
$( document ).ready(function() {
    console.log( "ready!" );
    plyr.setup();
});
      
    </script>
</body>
</html>