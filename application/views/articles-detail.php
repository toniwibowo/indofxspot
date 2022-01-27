 <?php $row = $query->row_array(); ?>
<!DOCTYPE html>


<html>
  <head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $row['title']; ?></title>

    <meta name="keywords" content="indosan" />
    <meta name="description" content="Indosan">
    <meta name="author" content="sketsa.net">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/animate/animate.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>css/theme.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/theme-elements.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/theme-blog.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/theme-shop.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/rs-plugin/css/navigation.css">

    <!-- Demo CSS -->


    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>css/skins/skin-corporate-6.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>css/custom.css">

    <!-- Head Libs -->
    <script src="<?= base_url() ?>vendor/modernizr/modernizr.min.js"></script>

    <?php if ($this->uri->segment(1) != '' && $this->uri->segment(1) != 'home'): ?>
      <style media="screen">
        #header .header-body{
          background: #214a78;
        }

        #header .header-nav.header-nav-links:not(.header-nav-light-text) nav > ul > li > a, #header .header-nav.header-nav-line:not(.header-nav-light-text) nav > ul > li > a{
          color:#fff;
        }
      </style>
    <?php endif; ?>

    <!-- Global site tag (gtag.js) - Google Analytics --> <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153693685-1"> </script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-153693685-1'); </script>

  </head>
  <body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 500}">
    <div class="loading-overlay">
      <div class="bounce-loader">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>

    <?php

$site_lang = !empty($this->session->userdata('site_lang'))?$this->session->userdata('site_lang'):'en';

 ?>

    <div class="body">
      <header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 120, 'stickyHeaderContainerHeight': 70}">
        <div class="header-body">
          <div class="header-container container">
            <div class="header-row">
              <div class="header-column">
                <div class="header-row">
                  <div class="header-logo">
                    <a href="<?= site_url() ?>">
                      <img alt="Indosan" width="100" height="48" data-sticky-width="82" data-sticky-height="40" src="<?= $this->uri->segment(1) != '' && $this->uri->segment(1) != 'home' ? base_url().'public/images/logo-light.png' : base_url().'public/images/logo.png' ?>">
                    </a>
                  </div>
                </div>
              </div>
              <div class="header-column justify-content-end">
                <div class="header-row">
                  <div class="header-nav header-nav-links order-2 order-lg-1">


                    <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                      <nav class="collapse">

                         <?php if($this->session->userdata('site_lang')=='id'): ?>
                        <ul class="nav nav-pills" id="mainNav">
                          <li>
                            <a class="dropdown-item active" href="<?= site_url() ?>">
                              Beranda
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="<?php echo site_url('pages/view/1/about-us'); ?>">
                              Tentang Kami
                            </a>
                          </li>

                          <li class="dropdown">
                            <a class="dropdown-item dropdown-toggle" href="<?php echo site_url('product') ?>">
                              Produk
                            </a>
                            <ul class="dropdown-menu">

                              <?php

        $categoryProduct = $this->db->query("select * from category_product order by category_product_id asc");

        ?>
        <?php if($categoryProduct->num_rows()>0): ?>
          <?php foreach($categoryProduct->result_array() as $row): ?>

                              <li class="dropdown-submenu">
                                <a class="dropdown-item" href="<?php echo site_url('product/category/'.$row['category_product_id'].'/'.url_title($row['category_product_name_id'])) ?>"><?php echo $row['category_product_name_id']; ?></a>

                                          <?php

        $subCategoryProduct = $this->db->query("select * from subcategory_product where category_product_id = ".$row['category_product_id']);
         ?>
          <?php if($subCategoryProduct->num_rows()>0): ?>


                                <ul class="dropdown-menu">

                                  <?php foreach($subCategoryProduct->result_array() as $r): ?>
                                  
                                  <li><a href="<?php echo site_url('product/subcategory/'.$row['category_product_id'].'/'.$r['subcategory_product_id'].'/'.url_title($r['name'])) ?>"><?php echo $r['name']; ?></a></li>
            <?php endforeach; ?>
                                  
                                </ul>

         <?php endif; ?>                       

                              </li>

         <?php endforeach; ?>
        <?php endif; ?>

                            </ul>
                          </li>


                        
                           <?php $uri = $this->uri->segment(1) ?>
              <!--<li><a href="<?php echo site_url('blog/view') ?>">Blog</a></li>-->
              <li><a href="<?php echo site_url('promo/view') ?>">Promo</a></li>
              <li><a href="<?php echo site_url('berita/view') ?>">Berita</a></li>
              <li><a href="<?php echo site_url('artikel/view') ?>">Artikel</a></li>

              <li><a href="<?php echo site_url('rekanan/view') ?>">Rekanan</a></li>
              <li><a href="<?php echo site_url('gallery/view'); ?>">Galeri</a></li>
              <?php if($uri == '' || $uri == 'home'): ?>
              <li><a href="<?php echo site_url('kontak') ?>">Kontak</a></li>
              <?php else: ?>
              <li><a href="<?php echo site_url('kontak') ?>">Kontak</a></li>
              <?php endif ?>


                        </ul>


                          <?php else: ?>



          <!--=========================BAHASA INGGRIS==================================================-->

           <ul class="nav nav-pills" id="mainNav">
                          <li>
                            <a class="dropdown-item active" href="<?= site_url() ?>">
                              Home
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="<?php echo site_url('pages/view/1/about-us'); ?>">
                              About Us
                            </a>
                          </li>

                          <li class="dropdown">
                            <a class="dropdown-item dropdown-toggle" href="<?php echo site_url('product') ?>">
                              Product
                            </a>
                            <ul class="dropdown-menu">

                              <?php

                              $lang =  $this->session->userdata('site_lang');
                            if($lang=='en')
                            {
                              $category_product_name = 'category_product_name';
                            }else
                            {
                              $category_product_name = 'category_product_name_id';
                            }

        $categoryProduct = $this->db->query("select * from category_product order by category_product_id asc");

        ?>
        <?php if($categoryProduct->num_rows()>0): ?>
          <?php foreach($categoryProduct->result_array() as $row): ?>

                              <li class="dropdown-submenu">
                                <a class="dropdown-item" href="<?php echo site_url('product/category/'.$row['category_product_id'].'/'.url_title($row[$category_product_name])) ?>"><?php echo $row[$category_product_name]; ?></a>

                                          <?php

        $subCategoryProduct = $this->db->query("select * from subcategory_product where category_product_id = ".$row['category_product_id']);
         ?>
          <?php if($subCategoryProduct->num_rows()>0): ?>


                                <ul class="dropdown-menu">

                                  <?php foreach($subCategoryProduct->result_array() as $r): ?>
                                  
                                  <li><a href="<?php echo site_url('product/subcategory/'.$row['category_product_id'].'/'.$r['subcategory_product_id'].'/'.url_title($r['name'])) ?>"><?php echo $r['name']; ?></a></li>
            <?php endforeach; ?>
                                  
                                </ul>

         <?php endif; ?>                       

                              </li>

         <?php endforeach; ?>
        <?php endif; ?>

                            </ul>
                          </li>


                        
                           <?php $uri = $this->uri->segment(1) ?>
              <!--<li><a href="<?php echo site_url('blog/view') ?>">Blog</a></li>-->
              <li><a href="<?php echo site_url('promo/view') ?>">Promo</a></li>
              <li><a href="<?php echo site_url('berita/view') ?>">News</a></li>
              <li><a href="<?php echo site_url('artikel/view') ?>">Articles</a></li>

              <li><a href="<?php echo site_url('rekanan/view') ?>">Partners</a></li>
              <li><a href="<?php echo site_url('gallery/view'); ?>">Galery</a></li>
              <?php if($uri == '' || $uri == 'home'): ?>
              <li><a href="<?php echo site_url('kontak') ?>">Contact Us</a></li>
              <?php else: ?>
              <li><a href="<?php echo site_url('kontak') ?>">Contact Us</a></li>
              <?php endif ?>


                        </ul>

          <!--============================END==========================================================-->




                      <?php endif; ?>
                      </nav>
                    </div>



                    <div class="btn-search mx-3">
                      <form role="search" action="<?php echo site_url("search/view"); ?>" method="POST">
                        <div class="simple-search input-group">
                          <input class="form-control text-1" id="headerSearch" name="key" type="search" placeholder="Search...">
                          <input name="param" type="hidden" />
                          <span class="input-group-append">
                            <button class="btn" type="submit">
                              <i class="fa fa-search header-nav-top-icon"></i>
                            </button>
                          </span>
                        </div>
                      </form>
                    </div>
                    <div class="language-switcher mx-2 d-none d-lg-block">
                      <ul>

                        <?php if($this->session->userdata('site_lang')=='id'): ?>
                        <li>
                          <a class="btn btn-outline btn-primary btn-xs p-0" href="<?php echo site_url('langswitch/switchlanguage/en') ?>"><img width="34" src="<?= base_url() ?>images/eng.png" alt=""> </a>
                        </li>
                        <?php else: ?>
                        <li>
                          <a class="btn btn-outline btn-primary btn-xs p-0" href="<?php echo site_url('langswitch/switchlanguage/id') ?>"><img width="34" src="<?= base_url() ?>images/ind.png" alt=""></a>
                        </li>

                      <?php endif; ?>
                      </ul>
                    </div>
                    <div class="btn-menu d-block d-lg-none">
                      <button class="btn btn-primary btn-sm" type="button" name="button"><i class="fa fa-list"></i></button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </header>


<?php

        		$row = $query->row_array();

        		?>

<div class="main" role="main">
  <section class="page-header page-header-classic page-header-sm mb-0">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
          <h1 data-title-border>Articles</h1>
        </div>
        <div class="col-md-4 order-1 order-md-2 align-self-center">
          <ul class="breadcrumb d-block text-md-right">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo site_url('articles/view'); ?>">Articles</a></li>
            <li class="active"><?php echo $row['title']; ?></li>
          </ul>
        </div>
      </div>
    </div>
  </section>


	<content class="news">
	<section class="news my-5">
    	<div class="container">
        	<div class="clearer cellpadding">





          <div class="row">
  				<div class="col-md-8 col-sm-8 col-xs-12">

					<div class="detail-title">
					<h3><?php echo $row['title'] ?></h3>
					<p class="date"><i class="fa fa-calendar"></i> <?php
              $date = date('d M Y',strtotime($row['posting_date']));
              echo $date;
               ?></p>
					</div>

			<div class="detail-content">

			<!--<img src="<?php echo base_url('assets/uploads/files/'.$row['image_small']); ?>" alt="" />-->
			 <?php if(count(unserialize($row['images'])) > 0): ?>
            <?php foreach(unserialize($row['images']) as $pict): ?>
            <img class="img-fluid bigImage" src="<?php echo base_url().'assets/uploads/files/'.$pict; ?>"/>
            <?php endforeach ?>
            <?php endif ?>

			<p><?php echo $row['description']; ?></p>


			</div>

			</div>

		<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="news-widget">
		<?php include_once "include/right-column.php"; ?>
  	</div>
		</div>






				</div>
			</div>
        </div>
	</section>
    </content>

</div>
<?php include_once "include/footer.php"; ?>
