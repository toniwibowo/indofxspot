<?php include_once "include/header.php"; ?>

<?php

            $row = $query->row_array();

            ?>
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

  <div class="container py-4">

    <div class="row">
      <div class="col">
        <div class="blog-posts single-post">

          <article class="post post-large blog-single-post border-0 m-0 p-0">
            <div class="post-image ml-0">
              
               <?php if(count(unserialize($row['images'])) > 0): ?>
            <?php foreach(unserialize($row['images']) as $pict): ?>
            <img class="img-fluid bigImage" src="<?php echo base_url().'assets/uploads/files/'.$pict; ?>"/>
            <?php endforeach ?>
            <?php endif ?>
            </div>

            <!--<div class="post-date ml-0">
              <span class="day">10</span>
              <span class="month">Jan</span>
            </div>-->

            <div class="post-content ml-0">

              <h2 class="font-weight-bold"><?php echo $row['title'] ?></h2>

              <!--<div class="post-meta">
                <span><i class="far fa-user"></i> By <a href="#">John Doe</a> </span>
                <span><i class="far fa-folder"></i> <a href="#">Lifestyle</a>, <a href="#">Design</a> </span>
                <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
              </div>-->
<?php echo $row['description']; ?>
              <p>

              <div class="post-block mt-5 post-share">
                <h4 class="mb-3">Share this Post</h4>

                <!-- AddThis Button BEGIN -->
                <!--<div class="addthis_toolbox addthis_default_style ">
                  <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                  <a class="addthis_button_tweet"></a>
                  <a class="addthis_button_pinterest_pinit"></a>
                  <a class="addthis_counter addthis_pill_style"></a>
                </div
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>
                <!-- AddThis Button END -->

              </div>

            </div>
          </article>

        </div>
      </div>
    </div>

  </div>
</div>


<?php include_once "include/footer.php"; ?>