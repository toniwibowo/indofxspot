<?php include_once "include/header.php"; ?>

<div class="main" role="main">
  <section class="page-header page-header-classic page-header-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
          <h1 data-title-border>Promo</h1>
        </div>
        <div class="col-md-4 order-1 order-md-2 align-self-center">
          <ul class="breadcrumb d-block text-md-right">
            <li><a href="#">Home</a></li>
            <li class="active">Pages</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!--<section class="section section-promo border-0 m-0 bg-white">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="owl-promo owl-carousel owl-theme" data-plugin-options="{'items': 3, 'margin': 10, 'loop': false, 'nav': false, 'dots': true}">
            <div>
              <img class="img-fluid border-radius-0" src="<?= base_url('images/promo-1.jpg') ?>" alt="">
            </div>
            <div>
              <img class="img-fluid border-radius-0" src="<?= base_url('images/promo-2.jpg') ?>" alt="">
            </div>
            <div>
              <img class="img-fluid border-radius-0" src="<?= base_url('images/promo-3.jpg') ?>" alt="">
            </div>
            <div>
              <img class="img-fluid border-radius-0" src="<?= base_url('images/promo-3.jpg') ?>" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->

  <div class="container">
    <div class="row">
       <?php if($jlh>0): ?>

<?php foreach($query->result_array() as $r): ?>


      <div class="col-md-4">
        <div class="card2">
          <a href="<?php echo site_url('promo/detail/'.$r['promo_id'].'/'.url_title($r['title'])) ?>">
            <span class="thumb-info thumb-info-no-borders thumb-info-no-borders-rounded thumb-info-lighten thumb-info-centered-info thumb-info-block thumb-info-block-primary">
              <span class="thumb-info-wrapper">
                <img src="<?php echo base_url('assets/uploads/files/'.$r['image_small']); ?>" class="img-fluid" alt="">
                <span class="thumb-info-title">
                  <span class="thumb-info-inner"><?php echo $r['title']; ?></span>
                  <!--<span class="thumb-info-type bg-color-dark">Promo Type</span>-->
                </span>
                <span class="thumb-info-action">
                  <span class="thumb-info-action-icon background-transparent"><i class="fas fa-plus text-light"></i></span>
                </span>
              </span>
            </span>
          </a>
          <div class="card-body p-3">
            <p class="mb-0">
              <?php echo $r['resume']; ?>
            </p>
          </div>
        </div>
      </div>

     
           <?php endforeach; ?>

<?php endif; ?>

    </div>
  </div>
</div><br><br> 



<?php include_once "include/footer.php"; ?>