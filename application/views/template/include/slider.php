<div class="mainSlider">
	
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
		
		<?php
		$where = "start_date <= NOW() AND end_date >= NOW()";
		$this->db->where($where);
		$this->db->order_by('slider_id','DESC');
		$data_slider = $this->db->get('slider');
		
		if($data_slider->num_rows() > 0):
		foreach($data_slider->result_array() as $row):
		?>
	
		<div class="item parallax parallax-slider" data-speed="4" style="background-image:url(<?php echo base_url('assets/uploads/files/').$row['file_image'] ?>)">
		  <!-- <img src="..." alt="..."> -->
		  <div class="carousel-caption">
			
		  </div>
		</div>
		
		<?php endforeach ?>
		<?php endif ?>
	  </div>

	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
	</div>

</div>

