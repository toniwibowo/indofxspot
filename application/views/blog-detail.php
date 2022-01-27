<?php include_once "include/header.php"; ?>


<?php

        		$row = $query->row_array();

        		?>

<div class="main" role="main">
  <section class="page-header page-header-classic page-header-sm mb-0">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
          <h1 data-title-border>Blog</h1>
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

	<section class="news mt-5">
    	<div class="container">
        	<div class="clearer cellpadding">



          <div class="row">

					<div class="col-md-8 col-sm-8 col-xs-12">

					<div class="detail-title">
							<h3><?php echo $row['title'] ?></h3>
							<p class="date">
								<i class="fa fa-calendar"></i> <?php
              	$date = date('d M Y',strtotime($row['posting_date']));
              	echo $date;
              ?>
						 	</p>
					</div>

			<div class="detail-content">

			<!--<img src="<?php echo base_url('assets/uploads/files/'.$row['image_small']); ?>" alt="" />-->

			<?php if(count(unserialize($row['images']))>0): ?>
          <?php foreach(unserialize($row['images']) as $pict): ?>
          <img class="img-fluid" style="margin-bottom:20px" src="<?php echo base_url().'assets/uploads/files/'.$pict ?>" />
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



</div>
<?php include_once "include/footer.php"; ?>
