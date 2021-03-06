<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <link rel="manifest" href="<?php echo base_url() ?>public/manifest.json">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/style.css">

    <!-- Bootstrap CSS File -->
    <link href="<?php echo base_url() ?>public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="<?php echo base_url() ?>public/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url() ?>/css/jquery.bxslider.css" rel="stylesheet">


    <link rel="shortcut icon" href="<?php echo base_url() ?>favicon.png">
    <title>Indosan | Lemari Besi Tahan Api | Lemari Besi Tahan Bongkar | Brangkas Jakarta</title>

    <meta name="Keywords" content="Lemari kaca, Lemari buku, Lemari besi, Lemari arsip, safe deposit box, Furniture murah, Rak serbaguna, Rak Ikea, Lemari boneka, Furniture rumah, Brankas Krisbow, Brankas mini, Rak portable, Lemari kantor, Furniture kantor, Kotak uang, Lemari dokumen, Loker sekolah, Loker kantor, Brankas Murah, Rak Murah, Lemari Locker, Gun Safe, Lemari rumah, Brankas Portable">

<meta name="Description" content="PT. Indosan Berkat Bersama menyediakan perlindungan untuk keamanan dan keselamatan bagi pasar komersial, industrial maupun perumahan, produk kami Lemari Besi Tahan Api, Lemari Besi Tahan Bongkar, Brangkas Jakarta">


  </head>
  <body>

    <?php

$site_lang = !empty($this->session->userdata('site_lang'))?$this->session->userdata('site_lang'):'en';

 ?>

    <header id="header">
      <div class="container-fluid">
          <div class="row">
          <div id="logo" class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-left">
            <a href="#intro"><img src="<?php echo base_url() ?>public/images/logo.png" alt="" title="" height="50" /></a>
          </div>
          <div class="col-xl-7 col-lg-7 col-md-6 col-sm-6 col-xs-12">
          <nav id="nav-menu-container">

            <?php if($this->session->userdata('site_lang')=='id'): ?>
            <ul class="nav-menu">
              <li class="menu-active"><a href="<?php echo site_url() ?>">Beranda</a></li>
              <li><a href="<?php echo site_url('pages/view/1/about-us'); ?>">Tentang Kami</a></li>
              <li class="menu-has-children"><a href="<?php echo site_url('product') ?>">Produk</a>
                <ul>

                	<?php

				$categoryProduct = $this->db->query("select * from category_product order by category_product_id asc");

				?>
				<?php if($categoryProduct->num_rows()>0): ?>
					<?php foreach($categoryProduct->result_array() as $row): ?>
				<li><a class="" href="<?php echo site_url('product/category/'.$row['category_product_id'].'/'.url_title($row['category_product_name_id'])) ?>"><?php echo $row['category_product_name_id']; ?></a>
				<?php

				$subCategoryProduct = $this->db->query("select * from subcategory_product where category_product_id = ".$row['category_product_id']);
				 ?>
				 <?php if($subCategoryProduct->num_rows()>0): ?>
					<ul>
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

              <li><a href="<?php echo site_url('berita/view') ?>">Berita</a></li>
              <li><a href="<?php echo site_url('artikel/view') ?>">Artikel</a></li>

              <li><a href="<?php echo site_url('rekanan/view') ?>">Rekanan</a></li>
              <li><a href="<?php echo site_url('gallery/view'); ?>">Galeri</a></li>
              <?php if($uri == '' || $uri == 'home'): ?>
              <li><a href="<?php echo site_url('kontak') ?>">Kontak</a></li>
              <?php else: ?>
              <li><a href="<?php echo site_url('kontak') ?>">Kontak</a></li>
              <?php endif ?>

              <li>
                <a href="<?php echo site_url('langswitch/switchlanguage/en') ?>">
                  <img class="img-fluid flag" src="<?php echo base_url('images/eng.png') ?>" alt="">
                </a>
              </li>
            </ul>

            <?php else: ?>




               <ul class="nav-menu">
              <li class="menu-active"><a href="<?php echo site_url() ?>">Home</a></li>
              <li><a href="<?php echo site_url('pages/view/1/about-us'); ?>">About Us</a></li>
              <li class="menu-has-children"><a href="<?php echo site_url('product') ?>">Products</a>
                <ul>

                  <?php

        $categoryProduct = $this->db->query("select * from category_product order by category_product_id asc");

        ?>
        <?php if($categoryProduct->num_rows()>0): ?>
          <?php foreach($categoryProduct->result_array() as $row): ?>
        <li><a class="" href="<?php echo site_url('product/category/'.$row['category_product_id'].'/'.url_title($row['category_product_name'])) ?>"><?php echo $row['category_product_name']; ?></a>
        <?php

        $subCategoryProduct = $this->db->query("select * from subcategory_product where category_product_id = ".$row['category_product_id']);
         ?>
         <?php if($subCategoryProduct->num_rows()>0): ?>
          <ul>
            <?php foreach($subCategoryProduct->result_array() as $r): ?>
            <li><a href="<?php echo site_url('product/subcategory/'.$row['category_product_id'].'/'.$r['subcategory_product_id'].'/'.url_title($r['name_en'])) ?>"><?php echo $r['name_en']; ?></a></li>
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

              <li><a href="<?php echo site_url('news/view') ?>">News</a></li>
              <li><a href="<?php echo site_url('articles/view') ?>">Articles</a></li>

              <li><a href="<?php echo site_url('partners/view') ?>">Partners</a></li>
              <li><a href="<?php echo site_url('gallery/view'); ?>">Gallery</a></li>
              <?php if($uri == '' || $uri == 'home'): ?>
              <li><a href="<?php echo site_url('contactus') ?>">Contact</a></li>
              <?php else: ?>
              <li><a href="<?php echo site_url('contactus') ?>">Contact</a></li>
              <?php endif ?>
              <li>
                <a href="<?php echo site_url('langswitch/switchlanguage/id') ?>">
                  <img class="img-fluid flag" src="<?php echo base_url('images/ind.png') ?>" alt="">
                </a>
              </li>
            </ul>



          <?php endif //Lang  ?>

          </nav>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <form class="rd-search" action="<?php echo site_url("search/view"); ?>"  method="POST">
            <div class="input-group mb-3">

              <input type="text"  name="key" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2" />
              <input name="param" type="hidden" />
              <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary rd-search-form-submit" type="button"><i class="fa fa-search"></i></button>
              </div>

               </form>
            </div>
          </div>
        </div>
      </div>
    </header>
