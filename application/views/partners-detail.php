<?php include_once "include/header.php"; ?>



	<content class="news">
	<section class="news">
    	<div class="container">
        	<div class="clearer cellpadding">

        		<?php

        		$row = $query->row_array();

        		?>

					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo site_url() ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?php echo site_url('blog/view') ?>">Rekanan</a></li>
						<li class="breadcrumb-item active hidden-xs"><?php echo $row['title'] ?></li>
						</ol>
					</nav>

          <div class="row">
  				<div class="col-md-8 col-sm-8 col-xs-12">

					<div class="detail-title">
					<h3><?php echo $row['title'] ?></h3>
					
					</div>

			<div class="detail-content">

			<img src="<?php echo base_url('assets/uploads/files/'.$row['image_small']); ?>" alt="" />
			 

			<p><?php echo $row['description']; ?></p>

      <p><?php echo $row['city_name']; ?><p>

      <p><?php echo $row['phone']; ?></p>

      <p><?php echo $row['email']; ?></p>

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
<?php include_once "include/footer.php"; ?>
