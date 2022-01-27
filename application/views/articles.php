<?php include_once "include/header.php"; ?>
<div class="main" role="main">
  <section class="page-header page-header-classic page-header-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
          <h1 data-title-border><?= ucwords($this->uri->segment(1)) ?></h1>
        </div>
        <div class="col-md-4 order-1 order-md-2 align-self-center">
          <ul class="breadcrumb d-block text-md-right">
          	<?php if($site_lang=='en'): ?>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active"><?php echo 'Articles'; 
				    ?></li>

        	<?php else: ?>

        		<li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">Artikel</li>

        	<?php endif; ?>

          </ul>
        </div>
      </div>
    </div>
  </section>

  <div class="container py-4">

    <div class="row">
      <div class="col-lg-3 order-lg-2">
        <aside class="sidebar">
								<!--<form action="page-search-results.html" method="get">
									<div class="input-group mb-3 pb-1">
										<input class="form-control text-1" placeholder="Search..." name="s" id="s" type="text">
										<span class="input-group-append">
											<button type="submit" class="btn btn-info text-1 p-2"><i class="fas fa-search m-2"></i></button>
										</span>
									</div>
								</form>-->
								<!--<h5 class="font-weight-bold pt-4">Categories</h5>
								<ul class="nav nav-list flex-column mb-5">
									<li class="nav-item"><a class="nav-link" href="#">Design (2)</a></li>
									<li class="nav-item">
										<a class="nav-link active" href="#">Photos (4)</a>
										<ul>
											<li class="nav-item"><a class="nav-link" href="#">Animals</a></li>
											<li class="nav-item"><a class="nav-link active" href="#">Business</a></li>
											<li class="nav-item"><a class="nav-link" href="#">Sports</a></li>
											<li class="nav-item"><a class="nav-link" href="#">People</a></li>
										</ul>
									</li>
									<li class="nav-item"><a class="nav-link" href="#">Videos (3)</a></li>
									<li class="nav-item"><a class="nav-link" href="#">Lifestyle (2)</a></li>
									<li class="nav-item"><a class="nav-link" href="#">Technology (1)</a></li>
								</ul>-->
								<div class="tabs tabs-dark mb-4 pb-2">
									<ul class="nav nav-tabs">
										<li class="nav-item active"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#popularPosts" data-toggle="tab">News</a></li>
										<li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">Articles</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="popularPosts">
											<ul class="simple-post-list">

												<?php
  //$where = "start_date <= NOW() AND end_date >= NOW()";
  //$this->db->where($where);
  $this->db->order_by('news_id','DESC');
  $this->db->limit(3);
  $news = $this->db->get('news');

 // if($data_product->num_rows() > 0):
  //foreach($data_product->result_array() as $key=>$row):
  ?>

  <?php

 if($news->num_rows() > 0):
  foreach($news->result_array() as $key=>$r):

 ?>


												<li>
													<div class="post-image">
														<div class="img-thumbnail img-thumbnail-no-borders d-block">
															<a href="<?php echo site_url('news/detail/'.$r['news_id'].'/'.url_title($r['title'])); ?>">
																<img src="<?php echo base_url('assets/uploads/files/'.$r['image_small']); ?>" width="50" height="50" alt="">
															</a>
														</div>
													</div>
													<div class="post-info">
														<a href="<?php echo site_url('news/detail/'.$r['news_id'].'/'.url_title($r['title'])); ?>"><?php echo $r['title']; ?></a>
														<div class="post-meta">
															 <?php
              $date = date('d M Y',strtotime($r['posting_date']));
              echo $date;
               ?>
														</div>
													</div>
												</li>

												<?php endforeach ?>

  <?php else : ?>

    <h4 class="text-center bg-primary">No Data Slider Found !</h4>
  <?php endif ?>

												
											</ul>
										</div>
										<div class="tab-pane" id="recentPosts">
											<ul class="simple-post-list">

												<?php
  //$where = "start_date <= NOW() AND end_date >= NOW()";
   $where = "posting_date <= NOW()";
  $this->db->where($where);
  $this->db->order_by('articles_id','DESC');
  $this->db->limit(3);
  $articles = $this->db->get('articles');

 // if($data_product->num_rows() > 0):
  //foreach($data_product->result_array() as $key=>$row):
  ?>

  

<?php

 if($articles->num_rows() > 0):
  foreach($articles->result_array() as $key=>$r):

 ?>


												<li>
													<div class="post-image">
														<div class="img-thumbnail img-thumbnail-no-borders d-block">
															<a href="<?php echo site_url('artikel/detail/'.$r['articles_id'].'/'.url_title($r['title'])); ?>">
																<img src="<?php echo base_url('assets/uploads/files/'.$r['image_small']); ?>" width="50" height="50" alt="">
															</a>
														</div>
													</div>
													<div class="post-info">
														<a href="<?php echo site_url('artikel/detail/'.$r['articles_id'].'/'.url_title($r['title'])); ?>"><?php echo $r['title']; ?></a>
														<div class="post-meta">
															 <?php
              $date = date('d M Y',strtotime($r['posting_date']));
              echo $date;
               ?>
														</div>
													</div>
												</li>
													
													<?php endforeach ?>
  <?php else : ?>



    <h4 class="text-center bg-primary">No Data Slider Found !</h4>
  <?php endif ?>
												
											</ul>
										</div>
									</div>
								</div>
								<!--<h5 class="font-weight-bold pt-4">About Us</h5>
								<p>Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Nulla nunc dui, tristique in semper vel. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. </p>-->
							</aside>
      </div>
      <div class="col-lg-9 order-lg-1">
        <div class="blog-posts">

          <div class="row px-3">



		    <?php if($jlh>0): ?>

<?php foreach($query->result_array() as $r): ?>


            <div class="col-sm-6">
              <article class="post post-medium border-0 pb-0 mb-5">
                <div class="post-image">
                  <a href="<?php echo site_url('articles/detail/'.$r['articles_id'].'/'.url_title($r['title'])) ?>">
                    <img src="<?php echo base_url('assets/uploads/files/'.$r['image_small']); ?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                  </a>
                </div>

                <div class="post-content">

                  <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="<?php echo site_url('articles/detail/'.$r['articles_id'].'/'.url_title($r['title'])) ?>"><?php echo $r['title']; ?></a></h2>
                  <p><?php echo $r['resume']; ?></p>

                  <div class="post-meta">
                   <!-- <span><i class="far fa-user"></i> By <a href="#">Bob Doe</a> </span>
                    <span><i class="far fa-folder"></i> <a href="#">News</a>, <a href="#">Design</a> </span>
                    <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>-->
                    <span class="d-block mt-2"><a href="<?php echo site_url('articles/detail/'.$r['articles_id'].'/'.url_title($r['title'])); ?>" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
                  </div>

                </div>
              </article>
            </div>          
            

           <?php endforeach; ?>

<?php endif; ?> 

          </div>

          <div class="row">
            <div class="col">
              <ul class="pagination float-left">
               <!--  <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a> -->
                <?php echo $this->pagination->create_links(); ?>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>

</div>




<?php include_once "include/footer.php"; ?>