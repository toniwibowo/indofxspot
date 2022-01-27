<?php include "include/header.php"; ?>

<content>
	<?php include "include/slider.php"; ?>

<section class="introducing">
	<div class="container">
	<div class="clearer">
	<div class="clearer">
	<div class="clearer">

		<div class="row">
			<div class="col-md-12 col-xs-12">
			<h2 class="secTitle"><span>BEST AGENT IN TOWN</span></h2>
			<p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
			</div>
		</div>

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
			<h1><i class="fa fa-bank"></i></h1>
			<h3>Residential</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
			</div>

			<div class="col-md-6 col-xs-12">
			<h1><i class="fa fa-building"></i></h1>
			<h3>Commercial</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
			</div>

			<div class="col-md-6 col-xs-12">
			<h1><i class="fa fa-user-circle-o"></i></h1>
			<h3>Our Best Staff</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
			</div>

			<div class="col-md-6 col-xs-12">
			<h1><i class="fa fa-clock-o"></i></h1>
			<h3>24 Hours Service</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
			</div>
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
		<h2 class="propertyTitle">PROPERTY<span>LISTING</span></h2>
		<p class="section-tagline">We have properties in these areas, view a list of Featured Properties</p>

		<div class="clearer">
		<h3 class="secTitle" style="text-align:center"><span>PRIMARY</span></h3>
		</div>

		<div class="row">

		<?php
		$this->db->where('category_id',2);
		$this->db->order_by('product_id','DESC');
		$this->db->from('product');
		$this->db->join('provinces','provinces.id = product.city');
		$queryPrimary = $this->db->get('');

		if($queryPrimary->num_rows() > 0):
		foreach($queryPrimary->result_array() as $row):
		?>

		<div class="col-md-4 col-xs-12">
			<div class="thumbnail">
			<p class="status"><?php echo $row['service'] ?></p>
			<a href="<?php echo site_url('primary').'/'.$row['product_id'].'/'.url_title($row['product_name'],'-',true) ?>"><img src="<?php echo base_url().'assets/uploads/files/'.$row['image_small'] ?>"  /></a>
			<div class="caption">
			<div class="entry-spect">
			<span><i class="fa fa-object-group"></i> 530 sq ft</span>
			<span><i class="fa fa-bed"></i> 3</span>
			<span><i class="fa fa-bath"></i> 1 Bathroom</span>
			</div>

			<div class="entry-body">
			<h3 class="media-heading"><a href="<?php echo site_url('primary').'/'.$row['product_id'].'/'.url_title($row['product_name'],'-',true) ?>"><?php echo $row['product_name'] ?></a></h3>
			<p class="addr"><?php echo $row['area'].', '.$row['name'] ?></p>
			<p><?php echo $row['resume'] ?></p>
			</div>

			<div class="entry-footer">
			<p class="price">IDR. 5.000.000.000,-</p>

			<div class="nav-button">
			<a class="text-right" href="#"><i class="fa fa-video-camera"></i></a>
			<a href="<?php echo site_url('primary').'/'.$row['product_id'].'/'.url_title($row['product_name'],'-',true) ?>"><i class="fa fa-link"></i></a>
			</div>

			</div>

			</div>
			</div>
		</div>

		<?php endforeach ?>
		<?php else : ?>
		<div class="col-md-12 col-xs-12">
		<p class="bg-success text-center" style="padding:15px 0;">NO DATA FOUND ! </p>
		</div>
		<?php endif ?>

		</div>

		<div class="clearer">
		<h3 class="secTitle" style="text-align:center"><span>SECONDARY</span></h3>
		</div>

		<div class="row">

		<?php
		$this->db->where('category_id',3);
		$this->db->order_by('product_id','DESC');
		$queryPrimary = $this->db->get('product');

		if($queryPrimary->num_rows() > 0):
		foreach($queryPrimary->result_array() as $row):
		?>

		<div class="col-md-4 col-xs-12">
			<div class="thumbnail">
			<p class="status"><?php echo $row['service'] ?></p>
			<img src="<?php echo base_url().'assets/uploads/files/'.$row['image_small'] ?>"  />
			<div class="caption">
			<div class="entry-spect">
			<span><i class="fa fa-object-group"></i> 530 sq ft</span>
			<span><i class="fa fa-bed"></i> 3</span>
			<span><i class="fa fa-bath"></i> 1 Bathroom</span>
			</div>

			<div class="entry-body">
			<h3 class="media-heading"><a href="#"><?php echo $row['product_name'] ?></a></h3>
			<p class="addr"><?php echo $row['city'].','.$row['area'] ?></p>
			<p><?php echo $resume ?></p>
			</div>

			<div class="entry-footer">
			<p class="price">IDR. 5.000.000.000,-</p>

			<div class="nav-button">
			<a class="text-right" href="#"><i class="fa fa-video-camera"></i></a>
			<a href="#"><i class="fa fa-heart"></i></a>
			</div>

			</div>

			</div>
			</div>
		</div>

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

<section class="parallax parallax-agent agent">
		<div class="overlay"></div>
		<div class="middle">
		<div class="middle-frame">
		<div class="inner">

		<div class="container">
		<div class="row">
		<div class="col-md-12 col-xs-12">
		<?php
		$this->db->where('agent_id',3);
		$query = $this->db->get('agent');

		$ag = $query->row_array();
		?>
		<div class="media">
			<div class="media-left"><img src="<?php echo base_url().'assets/uploads/files/'.$ag['photo'] ?>"  /></div>
			<div class="media-body media-middle">
			<h1 class="media-heading">Meet Mr. <?php echo $ag['agent_name'] ?></h1>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
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
	<div class="clearer">

	<div class="row grid">

	<div class="col-md-12 col-xs-12 grid-item">
	<div class="thumbnail">
	<img src="<?php echo base_url().'images/logos.jpg' ?>"  />
	</div>
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

	<div class="col-md-4 col-xs-12 grid-item">
	<div class="thumbnail text-center">
	<img class="img-responsive" src="<?php echo base_url().'images/sprite/phone-light.png' ?>"  />
	<div class="caption">
	<h3 class="media-heading"><strong>Phone Number</strong></h3>
	<p style="margin:0;">+62 81 1109 633</p>
	</div>
	</div>
	</div>

	<div class="col-md-4 col-xs-12 grid-item">
	<div class="thumbnail text-center">
	<img class="img-responsive" src="<?php echo base_url().'images/sprite/mark-location-light.png' ?>"  />
	<div class="caption">
	<h3 class="media-heading"><strong>Location</strong></h3>
	<p style="margin:0;">Jl. Jend. Sudirman No. 86. Jakarta Pusat</p>
	</div>
	</div>
	</div>

	<div class="col-md-4 col-xs-12 grid-item">
	<div class="thumbnail text-center">
	<img class="img-responsive" src="<?php echo base_url().'images/sprite/envelope-light.png' ?>"  />
	<div class="caption">
	<h3 class="media-heading"><strong>E-mail</strong></h3>
	<p style="margin:0;"><a class="home-info" href="mailto:info@iloveapartment.com">info@iloveapartment.com</a></p>
	</div>
	</div>
	</div>

	</div>
	</div>
	</div>
	</div>
</section>


</content>
<?php include "include/footer.php"; ?>
