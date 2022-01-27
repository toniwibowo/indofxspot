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

 <style type="text/css">
#map {
  width: 100%;
  height: 300px;
}
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}
#searchInput {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 50%;
}
#searchInput:focus {
  border-color: #4d90fe;
}
ul#geoData {
    text-align: left;
    font-weight: bold;
    margin-top: 10px;
}
ul#geoData span {
    font-weight: normal;
}
</style>

</head>
<body class="hold-transition skin-red fixed">

<!--===============TAMBAHAN===================================================================-->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

<script type="text/javascript">
    
    // A $( document ).ready() block.
$( document ).ready(function() {

    
    initMap();
    
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
                
                <?php

                $ur =  $this->uri->segment(4);

                 ?>
                 

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



<!--==================== maps -->




<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUvU_X1zv-TuamZoGXFlP4d2h31izLBDg&libraries=places&callback=initMap" async defer></script>



<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13
    });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
        //Location details
        for (var i = 0; i < place.address_components.length; i++) {
            if(place.address_components[i].types[0] == 'postal_code'){
                document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'country'){
                document.getElementById('country').innerHTML = place.address_components[i].long_name;
            }
        }
        document.getElementById('location').innerHTML = place.formatted_address;
        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lang').value = place.geometry.location.lng();
    });
}
</script>


<!---END MAPS-->








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