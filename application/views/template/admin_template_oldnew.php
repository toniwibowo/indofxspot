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
        'assets/plugins/AdminLTE/dist/css/skins/_all-skins.min.css',
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
</head>
<body class="hold-transition skin-red fixed">

<!--===============TAMBAHAN===================================================================-->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

<script type="text/javascript">
    
    // A $( document ).ready() block.
$( document ).ready(function() {

    console.log( "ready!" );
	
});

</script>

<script type="text/javascript">
	function showArea(str) {
    if (str == ""){
        document.getElementById("dataArea").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dataArea").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","<?php echo base_url().'admin/product/area/'?>"+str,true);
        xmlhttp.send();
    }
	}
</script>

<!--===============TAMBAHAN===================================================================-->
    <!-- Site wrapper -->
    <div class="wrapper">  
        <header class="main-header">
            <a href="<?php echo site_url(); ?>" class="logo">
               <span class="logo-mini"><b>Sketsa.net</b></span>
               <span class="logo-lg">Sketsa.net CMS</span>
            </a>

            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu" >
                            <?php $user = $this->ion_auth->user()->row() ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo $user->photo == '' ? base_url('assets/img/logo/sk.png') : base_url('assets/uploads/image/'.$user->photo) ?>" class="user-image" alt="User Image"/>
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
                                        <a href="<?php echo  site_url('sketsanet/profile')?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo  site_url('logout')?>" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar" id="menuSidebar">
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" class="form-control searchlist" id="searchSidebar" placeholder="Search..." autocomplete="off"/>
                        <span class="input-group-btn">
                            <button type='button' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <ul class="sidebar-menu list" id="menuList">
                </ul>
                <ul class="sidebar-menu list" id="menuSub">
                    <?php $menus = $this->output_view->get_menu() ?>

                    <?php 

                   // print_r($menus);

                    ?>
                    <?php foreach ($menus as $menu): ?>
                        <li class="header"><?php echo $menu['label'] ?></li>
                        <?php if (is_array($menu['children'])): ?>
                            <?php foreach ($menu['children'] as $menu2): ?>
                                <li <?php echo $menu2['attr'] != '' ? ' id="'.$menu2['attr'].'" ' : '' ?> <?php echo is_array($menu2['children']) ? ' class="treeview" ' : '' ?>>
                                    <?php if (is_array($menu2['children'])): ?>
                                    <a href="<?php echo $menu2['link'] != '#' ? base_url($menu2['link']) : '#' ?>" class="name">
                                        <i class="fa fa-<?php echo $menu2['icon'] ?>"></i> <span><?php echo $menu2['label'] ?>
                                        </span><i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <?php foreach ($menu2['children'] as $menu3): ?>
                                            <li class="<?php echo activate_menu(strtolower(preg_replace('/\s+/', '', $menu3['label']))); ?>" <?php echo $menu3['attr'] != '' ? ' id="'.$menu3['attr'].'" ' : '' ?>>
                                                <a href="<?php echo $menu3['link'] != '#' ? base_url($menu3['link']) : '#' ?>" class="name">
                                                    <i class="fa fa-<?php echo $menu3['icon'] ?>"></i> <span>
                                                    <?php echo $menu3['label'] ?>
                                                    <?php //echo preg_replace('/\s+/', '', $menu3['label']); ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                    <?php else: ?>
                                    <a href="<?php echo $menu2['link'] != '#' ? base_url($menu2['link']) : '#' ?>" class="name">
                                        <i class="fa fa-<?php echo $menu2['icon'] ?>"></i> <span><?php echo $menu2['label'] ?>
                                    </a>
                                    <?php endif ?>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endforeach ?>
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
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2011-2016 <a href="http://www.sketsa.net">Sketsa.net</a>.</strong> All rights reserved.
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
</body>
</html>