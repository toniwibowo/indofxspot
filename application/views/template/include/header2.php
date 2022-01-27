<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>CSR-FIFGROUP</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.bxslider.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.slicknav.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		
		
	});
</script>
</head>

<body>

<header class="l">
	<div class="container">
    
    <div class="clearer">
    	<div class="row">
	<div class="logo col-md-6 col-xs-12 text-left">
    	<a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.jpg"/></a>
       <!-- <a href="<?php echo site_url(); ?>"><img style="margin-top:6px" src="<?php echo base_url(); ?>images/csr.jpg"/></a>-->
    </div>
    
    <nav class="col-md-6 text-right callCenter">
	
    	<ul class="topMenu">
        <li><a href="<?php echo site_url(); ?>">Home</a></li>
        <!--<li><a href="<?php echo site_url('pages/view/6/site-map'); ?>">Site Map</a></li>-->
        <li><a href="<?php echo site_url('contactus'); ?>">Hubungi Kami</a></li>
        </ul>
    
	</nav>
    
    
    </div>
</div>
    
</div>
</header>


    <nav class="mainMenu">
    <div class="container">
    <div class="row">
    	<div class="col-md-12">
    	<ul class="menu">
        	<li><a href="">Profile</a>
				<ul>
				<li><a href="<?php echo site_url('pages/view/2/visi-misi-tujuan'); ?>">Visi, Misi, Tujuan</a></li>
				<li><a href="<?php echo site_url('pages/view/3/kebijakan'); ?>">Kebijakan</a></li>
				<li><a href="<?php echo site_url('download'); ?>">Laporan Kegiatan</a></li>
				<li><a href="<?php echo site_url('pages/view/4/apa-kata-mereka'); ?>">Apa Kata Mereka</a></li>
				<li><a href="<?php echo site_url('pages/view/5/ayo-sinergi'); ?>">Ayo Sinergi</a></li>
				</ul>
			</li>
            <li><a href="<?php echo site_url('pages/view/1/program-csr'); ?>">Program CSR</a></li>
            <li><a href="<?php echo site_url('news/view'); ?>">News</a></li>
            <li><a href="">Gallery</a>
            	<ul>
                <li><a href="<?php echo site_url('gallery/view'); ?>">Photo</a>
					<ul>
                    <?php 

                    $menuPhotoQuery = $this->db->query("select * from category_photo");

                    ?>

                    <?php 
                    if($menuPhotoQuery->num_rows()>0):
                     ?>

                 <?php foreach($menuPhotoQuery->result_array() as $r): ?>
					<li><a href="<?php echo site_url('gallery/category/'.$r['category_photo_id'].'/'.url_title($r['category_photo_name'])) ?>"><?php echo $r['category_photo_name']; ?></a></li>

                <?php endforeach; ?>
					<?php endif; ?>
					</ul>
				</li>
                <li><a href="<?php echo site_url('video/view'); ?>">Video</a>
					<ul>
					
                        <?php 

                    $menuPhotoQuery = $this->db->query("select * from category_video");

                    ?>

                    <?php 
                    if($menuPhotoQuery->num_rows()>0):
                     ?>

                 <?php foreach($menuPhotoQuery->result_array() as $r): ?>
                    <li><a href="<?php echo site_url('video/category/'.$r['category_video_id'].'/'.url_title($r['category_video_name'])) ?>"><?php echo $r['category_video_name']; ?></a></li>

                <?php endforeach; ?>
                    <?php endif; ?>

					</ul>
				</li>
                </ul>
            </li>
            <li><a href="#">Pelatihan Guru</a>
            	<ul>
                <!--<li><a href="<?php echo site_url('infoprogramguru/view') ?>">Info Program</a></li>-->
                <li><a href="<?php echo site_url('guru/program') ?>">Info Program</a></li>
                <li><a href="<?php echo site_url('guru/register') ?>">Pendaftaran</a></li>
                <li><a href="<?php echo site_url('guru/events') ?>">Events</a></li>

                <?php if(empty($_SESSION['username'])): ?>

                    <li><a href="<?php echo site_url('guru/login') ?>">Login</a></li>
                <?php else:?>
                    <li><a href="<?php echo site_url('guru/profile') ?>">Profile</a></li>
                    <li><a href="<?php echo site_url('guru/logout') ?>">Logout</a></li>
                <?php endif; ?>
                
                </ul>
            </li>
            <li><a href="#">Bis Sekolah</a>
            	<ul>
                <li><a href="<?php echo site_url('bus-sosial/program') ?>">Info Program</a></li>
                <li><a href="<?php echo site_url('home/bookingBusSosial'); ?>">Booking</a></li>
                </ul>
            </li>
            
             <li><a href="#">IGA</a>
            	<ul>
                <li><a href="<?php echo site_url('iga/program'); ?>">Info Program</a></li>
                

                 <?php if(empty($_SESSION['username_ukm'])): ?>

                    <li><a href="<?php echo site_url('ukm/login') ?>">Login UKM</a></li>
                <?php else:?>
                    <li><a href="<?php echo site_url('ukm/profile') ?>">Profile</a></li>
                    <li><a href="<?php echo site_url('ukm/produk') ?>">Produk</a></li>
                    <li><a href="<?php echo site_url('ukm/laporan') ?>">Laporan</a></li>
                    <li><a href="<?php echo site_url('ukm/logout') ?>">Logout</a></li>
                <?php endif; ?>


                </ul>
            </li>
        </ul>
    	</div>
            
    </div>
    </div>
    </nav>
