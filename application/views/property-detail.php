<?php include "template/include/header.php"; ?>
<content>
	
	<?php $row = $query->row_array(); ?>
	<?php $kota = $this->db->where('id',$row['city'])->get('provinces')->row_array(); ?>


	<?php

	//echo $string_query;

	//print_r($row);

	 ?>
	<section class="property-detail">
		<div class="container">
			<div class="clearer">
				<ol class="breadcrumb">
					<li><a href="<?php echo site_url() ?>">Home</a></li>
					<li><a href="<?php echo site_url('property') ?>">Property</a></li>
					<?php if($site_lang=='en'): ?>
					<li class="active"><?php echo $row['product_name_en'] ?></li>
				<?php else: ?>
					<li class="active"><?php echo $row['product_name_jp'] ?></li>
				<?php endif; ?>
				</ol>
				
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="title">
						<?php if($site_lang=='en'): ?>
							<h1><?php echo $row['product_name_en'] ?></h1>
						<?php else: ?>
							<h1><?php echo $row['product_name_jp'] ?></h1>
						<?php endif; ?>	
							<p><?php echo $row['area'].' - '.$kota['name'] ?> </p>
						</div>
						
						<div class="entry-content">
							<h4>Spesification</h4>
							<table class="table table-striped">
								<tr align="left" valign="top">
									<th>Size</th>
									<th>Bedroom</th>
									<!--<th>Bathroom</th>-->
									<th>Price</th>
								</tr>
								
								<?php
								$typeQuery = $this->db->query("select * from type where product_id = ".$row['product_id']);
								 ?>
								 <?php if($typeQuery->num_rows()>0): ?>

								 	<?php foreach($typeQuery->result_array() as $t): ?>
								 		<tr align="left" valign="top">
									<td><?php echo $t['size'] ?></td>
									<td><?php echo $t['bedroom'] ?> </td>
									
									<td><?php echo '$ '.$t['harga'];//echo 'IDR '.number_format($row['harga'],0,',','.') ?></td>
									</tr>
								<?php endforeach; ?>
								<?php endif; ?>
								
							</table>
							
							<h4>Apartment Preview</h4>
							<ul class="gallery_slider">
								<?php if(unserialize($row['facility']) > 0): ?>
								<?php foreach(unserialize($row['facility']) as $pict): ?>
									<li>
										<img src="<?php echo base_url('assets/uploads/files').'/'.$pict ?>"  />
									</li>
								<?php endforeach ?>
								<?php endif ?>
							</ul>
							
							<div class="clearer">
							<h4>Facilities</h4>
							<div class="row">
								<?php if(unserialize($row['facility']) > 0): ?>
								<?php foreach(unserialize($row['facility']) as $pict): ?>
									<div class="col-md-4 col-xs-12">
										<div class="thumbnail">
											<img src="<?php echo base_url('assets/uploads/files').'/'.$pict ?>"  />
										</div>
									</div>
								<?php endforeach ?>
								<?php endif ?>
							</div>
							</div>

							<div class="row">
							<?php echo $row['resume']; ?>
							</div>
							
							<div class="row">
							<?php echo $row['caption_facility_'.$site_lang]; ?>
							</div>

							<div class="clearer">
							<!-- <h4>Floor Plan</h4> -->
							<div class="row">
							<div class="col-md-4 hidden">
							<div class="panel panel-warning">
							<div class="panel-heading"><h3 style="margin:10px 0;">EXPLORE OUR FLOOR PLAN</h3></div>
							
							<ul class="list-group">
							<li class="list-group-item"><i class="fa fa-chevron-circle-down"></i> Suite Allee</li>
							</ul>
							
							<div class="list-group" id="bx-pager">
							<a data-slide-index="0" href="" class="list-group-item active">Type B &amp F </a>
							<a data-slide-index="1" href="" class="list-group-item">Type A &amp G </a>
							<a data-slide-index="2" href="" class="list-group-item">Type D &amp E </a>
							<a data-slide-index="3" href="" class="list-group-item">Type AB &amp GF </a>
							<p class="list-group-item list-name"><i class="fa fa-chevron-circle-down"></i> Suite Porte</p>
							<a data-slide-index="4" href="" class="list-group-item">Type D &amp E </a>
							<a data-slide-index="5" href="" class="list-group-item">Type A, B &amp F </a>
							</div>
							
							</div>
							</div>
							<div class="col-md-6 col-md-offset-3 col-xs-12">
							
							<ul class="slider">
								<?php if(unserialize($row['floor_plan']) > 0): ?>
								<?php foreach(unserialize($row['floor_plan']) as $pict): ?>
									<li><img src="<?php echo base_url('assets/uploads/files').'/'.$pict ?>"  /></li>
								<?php endforeach ?>
								<?php endif ?>
							</ul>

							</div>
							</div>
							</div>
							
							<?php if($row['lat']!= '' && $row['lang']!=''): ?>

							<style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>

							<div id="map"></div>

							<script>
      function initMap() {
        var uluru = {lat: <?php echo $row['lat']; ?>, lng: <?php echo $row['lang']; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUvU_X1zv-TuamZoGXFlP4d2h31izLBDg&callback=initMap">
    </script>

<?php endif; ?>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script>
		function myMap() {
			var mapProp= {
				center:new google.maps.LatLng(<?php echo $row['maps'] ?>),
				zoom:18,
			};
			var map=new google.maps.Map(document.getElementById("mapsGoogle"),mapProp);
			
			var marker = new google.maps.Marker({
			  position: new google.maps.LatLng(<?php echo $row['maps'] ?>),
			  map: map,
			  label: {
						color: 'black',
						fontWeight: 'bold',
						text: '<?php echo $row['product_name'] ?>',
					  }
			});
			
			
		}
	</script>
	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzyJme49igmiWDsWsbzwH1-2r3SyesHMo&callback=myMap"></script>	
	
</content>
<?php include "template/include/footer.php"; ?>