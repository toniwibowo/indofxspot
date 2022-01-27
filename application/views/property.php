<?php include_once "template/include/header.php"; ?>
	<content class="education">
    
	<section class="property">
	<div class="container">
	<div class="clearer">
		<ol class="breadcrumb">
			<li><a href="">Home</a></li>
			<li class="active">Property Listing</li>
		</ol>
	<div class="clearer">
		<h2 class="propertyTitle">PROPERTY<span>FOR RENT</span></h2>
		<!--<p class="section-tagline">We have properties in these areas, view a list of Featured Properties</p>-->
		
		<!--<div class="clearer">
		<h3 class="secTitle" style="text-align:center"><span><?php echo $category_name; ?></span></h3>
		</div>-->
		
		<div class="row">
		<?php

		 //echo $sql;
		
		if($query->num_rows() > 0):
		foreach($query->result_array() as $row):
		?>

	<?php if($site_lang=='en'): ?>

		<div class="col-md-4 col-xs-12">
			<div class="thumbnail">
			<p class="status"><?php echo $row['service'] ?></p>
			<a href="<?php echo site_url('property/detail/'.$row['product_id'].'/'.url_title($row['product_name_en'])); ?>"><img src="<?php echo base_url().'assets/uploads/files/'.$row['image_small'] ?>"  /></a>
			<div class="caption">
			<div class="entry-spect">
			
				<span><i class="fa fa-object-group"></i> <?php echo $row['luas']; ?> sq ft</span>
			<span><i class="fa fa-bed"></i> <?php echo $row['bedroom'] ?></span>
			<span><i class="fa fa-bath"></i> <?php echo $row['bathroom']; ?> Bathroom</span>
			
			</div>

			<div class="entry-body">
			<h3 class="media-heading"><a href="<?php echo site_url('property/detail/'.$row['product_id'].'/'.url_title($row['product_name_en'])); ?>"><?php echo $row['product_name_en'] ?></a></h3>
			<p class="addr"><?php echo $row['city'].','.$row['area'] ?></p>
			<!--<p><?php echo $row['resume'] ?></p>-->
			</div>

			<div class="entry-footer">
			<!--<p class="price">$. <?php echo $row['harga']; //number_format($row['harga'], 0, '.', '');  ?>,-</p>-->


			<div class="nav-button">
			<a class="text-right" href="#"><i class="fa fa-video-camera"></i></a>
			<a href="#"><i class="fa fa-heart"></i></a>
			</div>

			</div>

			</div>
			</div>
		</div>

	<?php else: ?>	

		<div class="col-md-4 col-xs-12">
			<div class="thumbnail">
			<p class="status"><?php echo $row['service'] ?></p>
			<a href="<?php echo site_url('property/detail/'.$row['product_id'].'/'.url_title($row['product_name_jp'])); ?>"><img src="<?php echo base_url().'assets/uploads/files/'.$row['image_small'] ?>"  /></a>
			<div class="caption">
			<div class="entry-spect">
			
				<span><i class="fa fa-object-group"></i> <?php echo $row['luas']; ?> sq ft</span>
			<span><i class="fa fa-bed"></i> <?php echo $row['bedroom'] ?></span>
			<span><i class="fa fa-bath"></i> <?php echo $row['bathroom']; ?> Bathroom</span>
			
			</div>

			<div class="entry-body">
			<h3 class="media-heading"><a href="<?php echo site_url('property/detail/'.$row['product_id'].'/'.url_title($row['product_name_jp'])); ?>"><?php echo $row['product_name_jp'] ?></a></h3>
			<p class="addr"><?php echo $row['city'].','.$row['area'] ?></p>
			<!--<p><?php echo $row['resume'] ?></p>-->
			</div>

			<div class="entry-footer">
			<!--<p class="price">$. <?php echo $row['harga']; //number_format($row['harga'], 0, '.', '');  ?>,-</p>-->


			<div class="nav-button">
			<a class="text-right" href="#"><i class="fa fa-video-camera"></i></a>
			<a href="#"><i class="fa fa-heart"></i></a>
			</div>

			</div>

			</div>
			</div>
		</div>

	<?php endif; ?>

		<?php endforeach ?>
		<?php else : ?>
		<div class="col-md-12 col-xs-12">
		<p class="bg-success text-center" style="padding:15px 0;">NO DATA FOUND ! </p>
		</div>
		<?php endif ?>
		
		</div>
		
	
		
		
		
	</div>
	</div>
	</div>
	</section>
	</content>
<?php include_once "template/include/footer.php"; ?>