<?php include "include/header.php"; ?>

<content>
	<?php include "include/slider.php"; ?>

<section class="introducing cellpadding hidden">
	<div class="container">
	<div class="clearer">
	<div class="clearer">
	<div class="clearer">

		<div class="row">
			<div class="col-md-12 col-xs-12">
			<h2 class="secTitle"><span>PREMIUM PROPERTY AGENT</span></h2>
			<p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
			</div>
		</div>

	</div>
	</div>
	</div>
	</div>
</section>

<section class="property">
	<div class="container">
	<div class="clearer">
	<div class="clearer">
		
		<?php if($site_lang=='en'): ?>

			<h2 class="propertyTitle">APARTMENT<span>FOR RENT</span></h2>
		<p class="section-tagline text-center">We have properties in these areas, view a list of Featured Properties</p>
		
		<?php else: ?>



		<h2 class="propertyTitle"> 賃貸アパート</h2>
		<p class="section-tagline text-center">ジャカルタ　アパート　おススメ物件、
ジャカルタの日本人駐在員の間で今人気の賃貸アパートをピックア ップ致しました。</p>


			<?php endif; ?>

		<div class="clearer hidden">
		<h3 class="secTitle" style="text-align:center"><span>PRIMARY</span></h3>
		</div>

		<div class="row grid">

		<?php



		$this->db->where('category_id',3);
		$this->db->order_by('product_id','DESC');
		$this->db->from('product');
		$this->db->join('provinces','provinces.id = product.city');
		$queryPrimary = $this->db->get('');

		if($queryPrimary->num_rows() > 0):
		foreach($queryPrimary->result_array() as $row):
		?>

		<div class="col-md-4 grid-item col-xs-12">
			<div class="thumbnail">

				<?php if($site_lang=='en'): ?>
			<p class="status"><?php echo $row['service'] ?></p>
		<?php else: ?>
			<p class="status"><?php if($row['service']=='Sewa'){ echo '賃貸';}  ?></p>
				<?php endif; ?>

			<a href="<?php echo site_url('primary').'/'.$row['product_id'].'/'.url_title($row['product_name_en'],'-',true) ?>"><img src="<?php echo base_url().'assets/uploads/files/'.$row['image_small'] ?>"  /></a>
			
			<?php if($site_lang=='en'): ?>
			<div class="caption">
			<div class="entry-spect hidden">
			<span><i class="fa fa-object-group"></i> <?php echo $row['luas']; ?> sq ft</span>
			<span><i class="fa fa-bed"></i> <?php echo $row['bedroom'] ?></span>
			<span><i class="fa fa-bath"></i> <?php echo $row['bathroom']; ?> Bathroom</span>
			</div>

			<div class="entry-body">
			<h3 class="media-heading"><a href="<?php echo site_url('primary').'/'.$row['product_id'].'/'.url_title($row['product_name_en'],'-',true) ?>"><?php echo $row['product_name_en'] ?></a></h3>

			<?php
				$area_array  =  explode('_', $row['area']);

				?>



			
			<?php

					
					//print_r($area_array);
					$area 	= $area_array[0];
					 ?>
			<p class="addr"><?php echo $area.', '.$row['name'] ?></p>
		
			<!-- <p><?php // echo $row['resume'] ?></p> -->
			</div>

			<div class="entry-footer hidden">
			<!--<p class="price">IDR. <?php echo number_format($row['harga'], 0, '.', '');  ?>,-</p>-->

			<div class="nav-button">
			<a class="text-right" href="#"><i class="fa fa-video-camera"></i></a>
			<a href="<?php echo site_url('primary').'/'.$row['product_id'].'/'.url_title($row['product_name_jp'],'-',true) ?>"><i class="fa fa-link"></i></a>
			</div>

			</div>


			<div class="entry-footer hidden">
			<!--<p class="price">$. <?php echo number_format($row['harga'], 0, '.', '');  ?>,-</p>-->


			<div class="nav-button">
			<a class="text-right" href="#"><i class="fa fa-video-camera"></i></a>
			<a href="#"><i class="fa fa-heart"></i></a>
			</div>

			</div>


			</div>
		<?php else:  ?>

			<div class="caption">
			<div class="entry-spect hidden">
			<span><i class="fa fa-object-group"></i> <?php echo $row['luas']; ?> sq ft</span>
			<span><i class="fa fa-bed"></i> <?php echo $row['bedroom'] ?></span>
			<span><i class="fa fa-bath"></i> <?php echo $row['bathroom']; ?> Bathroom</span>
			</div>

			<div class="entry-body">
			<h3 class="media-heading"><a href="<?php echo site_url('primary').'/'.$row['product_id'].'/'.url_title($row['product_name_jp'],'-',true) ?>"><?php echo $row['product_name_jp'] ?></a></h3>

			<?php
				$area_array  =  explode('_', $row['area']);

				?>



			
			<?php

					
					//print_r($area_array);
					$area 	= $area_array[1];
					 ?>
			<p class="addr"><?php echo $area.', '.$row['name_jp'] ?></p>
		
			<!-- <p><?php // echo $row['resume'] ?></p> -->
			</div>

			<div class="entry-footer hidden">
			<!--<p class="price">IDR. <?php echo number_format($row['harga'], 0, '.', '');  ?>,-</p>-->

			<div class="nav-button">
			<a class="text-right" href="#"><i class="fa fa-video-camera"></i></a>
			<a href="<?php echo site_url('primary').'/'.$row['product_id'].'/'.url_title($row['product_name_jp'],'-',true) ?>"><i class="fa fa-link"></i></a>
			</div>

			</div>


			<div class="entry-footer hidden">
			<!--<p class="price">$. <?php echo number_format($row['harga'], 0, '.', '');  ?>,-</p>-->


			<div class="nav-button">
			<a class="text-right" href="#"><i class="fa fa-video-camera"></i></a>
			<a href="#"><i class="fa fa-heart"></i></a>
			</div>

			</div>


			</div>


			<?php endif; ?>

			</div>
		</div>

		<?php endforeach ?>
		<?php else : ?>
		<div class="col-md-12 col-xs-12">
		<p class="bg-success text-center" style="padding:15px 0;">NO DATA FOUND ! </p>
		</div>
		<?php endif ?>

		</div>

		<div class="clearer hidden">
		<h3 class="secTitle" style="text-align:center"><span>SECONDARY</span></h3>
		</div>

		<div class="row hidden">

		<?php
		$this->db->where('category_id',3);
		$this->db->order_by('product_id','DESC');
		$queryPrimary = $this->db->get('product');

		if($queryPrimary->num_rows() > 0):
		foreach($queryPrimary->result_array() as $row):
		?>

	<?php if($site_lang=='en'): ?>
		<div class="col-md-4 col-xs-12">
			<div class="thumbnail">
			<p class="status"><?php echo $row['service'] ?></p>
			<a href="<?php echo site_url('secondary').'/'.$row['product_id'].'/'.url_title($row['product_name_en'],'-',true) ?>">
			<img src="<?php echo base_url().'assets/uploads/files/'.$row['image_small'] ?>"  />
			</a>
			<div class="caption">
			<div class="entry-spect">
			
			<span><i class="fa fa-object-group"></i> <?php echo $row['luas']; ?> sq ft</span>
			<span><i class="fa fa-bed"></i> <?php echo $row['bedroom'] ?></span>
			<span><i class="fa fa-bath"></i> <?php echo $row['bathroom']; ?> Bathroom</span>

			</div>

			<div class="entry-body">
			<h3 class="media-heading"><a href="<?php echo site_url('secondary').'/'.$row['product_id'].'/'.url_title($row['product_name_en'],'-',true) ?>"><?php echo $row['product_name_en'] ?></a></h3>
			<p class="addr"><?php echo $row['city'].','.$row['area'] ?></p>
			<p><?php echo $row['resume']; ?></p>
			</div>

			<div class="entry-footer">
			<!--<p class="price">IDR. <?php echo number_format($row['harga'], 0, '.', '');  ?>,-</p>-->

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
			<a href="<?php echo site_url('secondary').'/'.$row['product_id'].'/'.url_title($row['product_name_jp'],'-',true) ?>">
			<img src="<?php echo base_url().'assets/uploads/files/'.$row['image_small'] ?>"  />
			</a>
			<div class="caption">
			<div class="entry-spect">
			
			<span><i class="fa fa-object-group"></i> <?php echo $row['luas']; ?> sq ft</span>
			<span><i class="fa fa-bed"></i> <?php echo $row['bedroom'] ?></span>
			<span><i class="fa fa-bath"></i> <?php echo $row['bathroom']; ?> Bathroom</span>

			</div>

			<div class="entry-body">
			<h3 class="media-heading"><a href="<?php echo site_url('secondary').'/'.$row['product_id'].'/'.url_title($row['product_name_jp'],'-',true) ?>"><?php echo $row['product_name_jp'] ?></a></h3>
			<p class="addr"><?php echo $row['city'].','.$row['area'] ?></p>
			<p><?php echo $row['resume']; ?></p>
			</div>

			<div class="entry-footer">
			<!--<p class="price">IDR. <?php echo number_format($row['harga'], 0, '.', '');  ?>,-</p>-->

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

<section class="feature">
	<div class="feature-body">

		<div class="middle">
		<div class="middle-frame">
		<div class="inner">
		<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-xs-12">
			<!-- <h1><i class="fa fa-bank"></i></h1> -->
			<?php 

			$pages1 = $this->db->query("select * from pages where pages_id = 8");
			$row1 	= $pages1->row_array();

			?>
			<h3><?php echo $row1['title']; ?></h3>
			<p><?php echo $row1['resume']; ?></p>
			</div>

			<div class="col-md-6 col-xs-12">
			<!-- <h1><i class="fa fa-building"></i></h1> -->
			
			<?php 

			$pages1 = $this->db->query("select * from pages where pages_id = 9");
			$row1 	= $pages1->row_array();

			?>
			<h3><?php echo $row1['title']; ?></h3>
			<p><?php echo $row1['resume']; ?></p>

			</div>

			<div class="col-md-6 col-xs-12">
			<!-- <h1><i class="fa fa-user-circle-o"></i></h1> -->
			
			<?php 

			$pages1 = $this->db->query("select * from pages where pages_id = 10");
			$row1 	= $pages1->row_array();

			?>
			<h3><?php echo $row1['title_'.$site_lang]; ?></h3>
			<p><?php echo $row1['resume_'.$site_lang]; ?></p>

			</div>

			<div class="col-md-6 col-xs-12">
			<!-- <h1><i class="fa fa-clock-o"></i></h1> -->
			<?php 

			$pages1 = $this->db->query("select * from pages where pages_id = 11");
			$row1 	= $pages1->row_array();

			?>
			<h3><?php echo $row1['title_'.$site_lang]; ?></h3>
			<p><?php echo $row1['resume_'.$site_lang]; ?></p>

			</div>
		</div>
		</div>
		</div>
		</div>
		</div>

	</div>
</section>

<section class="parallax parallax-agent agent">
		<div class="overlay"></div>
		<div class="middle">
		<div class="middle-frame">
		<div class="inner">

		<div class="container">
		<div class="row">
		<div class="col-md-12 col-xs-12">
		<?php
		/*
		$this->db->where('agent_id',3);
		$query = $this->db->get('agent');

		$ag = $query->row_array();
		*/

			$pages1 = $this->db->query("select * from pages where pages_id = 15");
			$row1 	= $pages1->row_array();


		?>
		<div class="media">
			<div class="media-left"><!-- <img src="<?php echo base_url().'assets/uploads/files/'.$ag['image_small'] ?>"  /> --></div>
			<div class="media-body media-middle">
			<h1 class="media-heading"><?php echo $row1['title_'.$site_lang]; ?></h1>
			<p><?php echo $row1['resume_'.$site_lang]; ?></p>

			</div>
		</div>

		</div>
		</div>
		</div>

		</div>
		</div>
		</div>
</section>

<section class="logos">
	<div class="container">
	<div class="clearer cellpadding">

	<div class="row grid">

	<div class="col-md-12 col-xs-12 grid-item">
		<ul class="logo-slide">
		<?php

		$customer = $this->db->query("select * from customer ");
		 ?>

		 	<?php foreach($customer->result_array() as $row): ?>
		 			<?php if($row['link']!=''): ?>
			<li><a href="<?php echo $row['link'] ?>"><img src="<?php echo base_url('assets/uploads/files/'.$row['image_small']); ?>" /></a></li>
		<?php else: ?>
			<li><img src="<?php echo base_url('assets/uploads/files/'.$row['image_small']); ?>" /></li>
		<?php endif; ?>

		<?php endforeach; ?>


		</ul>

	</div>

	</div>
	</div>
	</div>
</section>



<section class="contact-stuff">
	<div class="container">
	<div class="clearer">
	<div class="clearer">

	<div class="row grid">

	<?php if($site_lang=='en'): ?>

	<div class="col-md-4 col-xs-12 grid-item">
	<a href="https://api.whatsapp.com/send?phone=62811109633&amp;text=Halo%20.....">
	<div class="thumbnail text-center">
	<!-- <img class="img-responsive" src="<?php echo base_url().'images/sprite/phone-light.png' ?>"  /> -->
	<h1 class="media-heading"></h1>
	<div class="caption">
	<h3 class="media-heading"><strong>Line</strong></h3>
	<p style="margin:0;">+62 811 8951 689</p>
	</div>
	</div>
	</a>
	</div>

	<div class="col-md-4 col-xs-12 grid-item">
	<a href="tel:+628118951689">
	<div class="thumbnail text-center">
	<!-- <img class="img-responsive" src="<?php echo base_url().'images/sprite/mark-location-light.png' ?>"  /> -->
	<h1 class="media-heading"><i class="fa fa-phone"></i></h1>
	<div class="caption">
	<h3 class="media-heading"><strong>Phone Number</strong></h3>
	<p style="margin:0;">+62 811 8951 689</p>
	</div>
	</div>
	</a>
	</div>

	<div class="col-md-4 col-xs-12 grid-item">
	<a class="home-info" href="mailto:info@apatojakarta.com">
	<div class="thumbnail text-center">
	<!-- <img class="img-responsive" src="<?php echo base_url().'images/sprite/envelope-light.png' ?>"  /> -->
	<h1 class="media-heading"><i class="fa fa-envelope"></i></h1>
	<div class="caption">
	<h3 class="media-heading"><strong>E-mail</strong></h3>
	<p style="margin:0;">info@apatojakarta.com</p>
	</div>
	</div>
	</a>
	</div>

	<?php else: ?>


		<div class="col-md-4 col-xs-12 grid-item">
	<a href="https://api.whatsapp.com/send?phone=62811109633&amp;text=Halo%20.....">
	<div class="thumbnail text-center">
	<!-- <img class="img-responsive" src="<?php echo base_url().'images/sprite/phone-light.png' ?>"  /> -->
	<h1 class="media-heading"></h1>
	<div class="caption">
	<h3 class="media-heading"><strong>ライン</strong></h3>
	<p style="margin:0;">+62 811 8951 689</p>
	</div>
	</div>
	</a>
	</div>

	<div class="col-md-4 col-xs-12 grid-item">
	<a href="tel:+628118951689">
	<div class="thumbnail text-center">
	<!-- <img class="img-responsive" src="<?php echo base_url().'images/sprite/mark-location-light.png' ?>"  /> -->
	<h1 class="media-heading"><i class="fa fa-phone"></i></h1>
	<div class="caption">
	<h3 class="media-heading"><strong>お電話でお問い合わせ</strong></h3>
	<p style="margin:0;">+62 811 8951 689 ( 日本語可能)</p>
	</div>
	</div>
	</a>
	</div>

	<div class="col-md-4 col-xs-12 grid-item">
	<a class="home-info" href="mailto:info@apatojakarta.com">
	<div class="thumbnail text-center">
	<!-- <img class="img-responsive" src="<?php echo base_url().'images/sprite/envelope-light.png' ?>"  /> -->
	<h1 class="media-heading"><i class="fa fa-envelope"></i></h1>
	<div class="caption">
	<h3 class="media-heading"><strong>メールでお問い合わせ</strong></h3>
	<p style="margin:0;">info@apatojakarta.com</p>
	</div>
	</div>
	</a>
	</div>


		<?php endif; ?>

	</div>
	</div>
	</div>
	</div>
</section>


</content>
<?php include "include/footer.php"; ?>
