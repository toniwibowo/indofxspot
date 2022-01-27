

<?php

        		$row = $query->row_array();
        		

header('Cache-Control: no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0',false);
header('Pragma: no-cache');

        		?>

<div class="main" role="main">
  <section class="page-header page-header-classic page-header-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
          <h1 data-title-border>Product</h1>
        </div>
        <div class="col-md-4 order-1 order-md-2 align-self-center">
          <ul class="breadcrumb d-block text-md-right">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active"><?php echo $row['product_name'] ?></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <div class="container">

    <div class="row">
      <div class="col-lg-3">
        <aside class="sidebar">
								<!--<form action="page-search-results.html" method="get">
									<div class="input-group mb-3 pb-1">
										<input class="form-control text-1" placeholder="Search..." name="s" id="s" type="text">
										<span class="input-group-append">
											<button type="submit" class="btn btn-info text-1 p-2"><i class="fas fa-search m-2"></i></button>
										</span>
									</div>
								</form>-->
								
								
								<h5 class="font-weight-bold pt-3">Categories</h5>
								<ul class="nav nav-list flex-column">
	

      <?php $categoryProduct = $this->db->query("select * from category_product order by category_product_id asc"); ?>

        <?php if($categoryProduct->num_rows()>0): ?>
          <?php foreach($categoryProduct->result_array() as $r): ?>
          
                                
                                
            <?php if ($this->session->userdata('site_lang')=='id'): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('product/category/'.$r['category_product_id'].'/'.url_title($r['category_product_name_id'])) ?>">
                  <?php echo $r['category_product_name_id']; ?>
                </a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('product/category/'.$r['category_product_id'].'/'.url_title($r['category_product_name'])) ?>">
                  <?php echo $r['category_product_name']; ?>
                </a>
              </li>
            <?php endif ?>



			 <?php endforeach; ?>
        <?php endif; ?>


								</ul>
								<!--<h5 class="font-weight-bold pt-5">Tags</h5>
								<div class="mb-3 pb-1">
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Nike</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Travel</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Sport</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">TV</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Books</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Tech</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Adidas</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Promo</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Reading</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Social</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Books</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">Tech</span></a>
									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">New</span></a>
								</div>-->
								<!--<div class="row mb-5">
									<div class="col">
										<h5 class="font-weight-bold pt-5">Top Rated Products</h5>
										<ul class="simple-post-list">
											<li>
												<div class="post-image">
													<div class="d-block">
														<a href="shop-product-sidebar-left.html">
															<img alt="" width="60" height="60" class="img-fluid" src="img/products/product-grey-1.jpg">
														</a>
													</div>
												</div>
												<div class="post-info">
													<a href="shop-product-sidebar-left.html">Photo Camera</a>
													<div class="post-meta text-dark font-weight-semibold">
														$299
													</div>
												</div>
											</li>
											<li>
												<div class="post-image">
													<div class="d-block">
														<a href="shop-product-sidebar-left.html">
															<img alt="" width="60" height="60" class="img-fluid" src="img/products/product-grey-4.jpg">
														</a>
													</div>
												</div>
												<div class="post-info">
													<a href="shop-product-sidebar-left.html">Luxury bag</a>
													<div class="post-meta text-dark font-weight-semibold">
														$199
													</div>
												</div>
											</li>
											<li>
												<div class="post-image">
													<div class="d-block">
														<a href="shop-product-sidebar-left.html">
															<img alt="" width="60" height="60" class="img-fluid" src="img/products/product-grey-8.jpg">
														</a>
													</div>
												</div>
												<div class="post-info">
													<a href="shop-product-sidebar-left.html">Military Rucksack</a>
													<div class="post-meta text-dark font-weight-semibold">
														$49
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>-->
							</aside>
      </div>
      <div class="col-lg-9">

        <div class="row">
          <div class="col-lg-6">

            <div class="owl-carousel owl-theme" data-plugin-options="{'items': 1, 'margin': 10}">


            				<?php if(count(unserialize($row['image']))>0): ?>
          <?php foreach(unserialize($row['image']) as $pict): ?>
           <div>
                <img alt="" height="300" class="img-fluid" src="<?php echo base_url().'assets/uploads/files/'.$pict ?>">
              </div>
          <?php endforeach ?>
          <?php endif ?>




            </div>

          </div>

          <div class="col-lg-6">

            <div class="summary entry-summary">

              <h1 class="mb-0 font-weight-bold text-7"><?php echo $row['product_name'] ?></h1>

              <div class="pb-0 clearfix">
                <div title="Rated 3 out of 5" class="float-left">
                  <input type="text" class="d-none" value="3" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'primary', 'size':'xs'}">
                </div>

                <div class="review-num">
                  <!--<span class="count" itemprop="ratingCount">2</span> reviews-->
                </div>
              </div>

              <!-- <p class="price">
                <span class="amount">$22</span>
              </p> -->

              <p class="mb-5"><?php echo $row['resume']; ?> </p>

              <form enctype="multipart/form-data" method="post" class="cart d-none">
                <div class="quantity quantity-lg">
                  <input type="button" class="minus" value="-">
                  <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                  <input type="button" class="plus" value="+">
                </div>
                <button href="#" class="btn btn-primary btn-modern text-uppercase">Add to cart</button>
              </form>

              <!--<div class="product-meta">
                <span class="posted-in">Categories: <a rel="tag" href="#">Accessories</a>, <a rel="tag" href="#">Bags</a>.</span>
              </div>-->

            </div>


          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="tabs tabs-product mb-2">
              <ul class="nav nav-tabs">
                <?php if($this->session->userdata('site_lang')=='id'): ?>

                  <li class="nav-item active"><a class="nav-link py-3 px-4" href="#productDescription" data-toggle="tab">Deskripsi</a></li>
                <li class="nav-item"><a class="nav-link py-3 px-4" href="#productInfo" data-toggle="tab">Unduh Brosur</a></li>

                  <?php else: ?>

                    <li class="nav-item active"><a class="nav-link py-3 px-4" href="#productDescription" data-toggle="tab">Description</a></li>
                <li class="nav-item"><a class="nav-link py-3 px-4" href="#productInfo" data-toggle="tab">Download Brosur</a></li>
                  <?php endif; ?>

                <!--<li class="nav-item"><a class="nav-link py-3 px-4" href="#productReviews" data-toggle="tab">Reviews (2)</a></li>-->
              </ul>
              <div class="tab-content p-0">
                <div class="tab-pane p-4 active" id="productDescription">
                  <p><?php echo $row['description']; ?></p>
                </div>
                <div class="tab-pane p-4" id="productInfo">
                  <?php if ($this->session->userdata('site_lang') == 'id'): ?>
                      <?php if($row['PDF'] != ''): ?>
                        <a href="<?php echo base_url().'assets/uploads/files/'.$row['PDF']; ?>" target ="_blank">Click Here To Download (Id)</a>
                      <?php endif ?>
                    <?php else: ?>
                      <?php if($row['pdf_en'] != ''): ?>
                        <a href="<?php echo base_url().'assets/uploads/files/'.$row['pdf_en']; ?>" target ="_blank">Click Here To Download (En)</a>
                      <?php endif ?>
                  <?php endif; ?>

                </div>
                <div class="tab-pane p-4" id="productReviews">
                  <ul class="comments">
                    <li>
                      <div class="comment">
                        <div class="img-thumbnail border-0 p-0 d-none d-md-block">
                          <img class="avatar" alt="" src="img/avatars/avatar-2.jpg">
                        </div>
                        <div class="comment-block">
                          <div class="comment-arrow"></div>
                          <span class="comment-by">
                            <strong>Jack Doe</strong>
                            <span class="float-right">
                              <div class="pb-0 clearfix">
                                <div title="Rated 3 out of 5" class="float-left">
                                  <input type="text" class="d-none" value="3" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'primary', 'size':'xs'}">
                                </div>

                                <div class="review-num">
                                  <span class="count" itemprop="ratingCount">2</span> reviews
                                </div>
                              </div>
                            </span>
                          </span>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae.</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="comment">
                        <div class="img-thumbnail border-0 p-0 d-none d-md-block">
                          <img class="avatar" alt="" src="img/avatars/avatar.jpg">
                        </div>
                        <div class="comment-block">
                          <div class="comment-arrow"></div>
                          <span class="comment-by">
                            <strong>John Doe</strong>
                            <span class="float-right">
                              <div class="pb-0 clearfix">
                                <div title="Rated 3 out of 5" class="float-left">
                                  <input type="text" class="d-none" value="3" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'primary', 'size':'xs'}">
                                </div>

                                <div class="review-num">
                                  <span class="count" itemprop="ratingCount">2</span> reviews
                                </div>
                              </div>
                            </span>
                          </span>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra odio, gravida urna varius vitae, gravida pellentesque urna varius vitae.</p>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <hr class="solid my-5">
                  <h4>Add a review</h4>
                  <div class="row">
                    <div class="col">

                      <form action="" id="submitReview" method="post">
                        <div class="form-row">
                          <div class="form-group col pb-2">
                            <label class="required font-weight-bold text-dark">Rating</label>
                            <input type="text" class="rating-loading" value="0" title="" data-plugin-star-rating data-plugin-options="{'color': 'primary', 'size':'xs'}">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-lg-6">
                            <label class="required font-weight-bold text-dark">Name</label>
                            <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
                          </div>
                          <div class="form-group col-lg-6">
                            <label class="required font-weight-bold text-dark">Email Address</label>
                            <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col">
                            <label class="required font-weight-bold text-dark">Review</label>
                            <textarea maxlength="5000" data-msg-required="Please enter your review." rows="8" class="form-control" name="review" id="review" required></textarea>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col mb-0">
                            <input type="submit" value="Post Review" class="btn btn-primary btn-modern" data-loading-text="Loading...">
                          </div>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr class="solid my-5">



         <h4 class="mb-3">Marketplace <strong>Partners</strong></h4>

        <div class="row my-5">
          <div class="col-12 col-sm-6 col-lg-3 product">
            <div class="card p-3 mb-4">
              <a href="https://www.tokopedia.com/sansafe" target="_blank"><img src="<?= base_url() ?>images/marketplace/tokopedia.png" class="img-fluid" alt="Tokopedia"></a>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 product">
            <div class="card p-3 mb-4">
              <a href="https://www.bukalapak.com/u/sarana_abadi_nusantara" target="_blank"><img src="<?= base_url() ?>images/marketplace/bukalapak.png" class="img-fluid" alt="Bukalapak"></a>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 product">
            <div class="card p-3">
              <a href="https://www.blibli.com/merchant/san-safes/SAS-60059?page=1&start=0&pickupPointCode=&cnc=&multiCategory=true&sort=7" target="_blank"><img src="<?= base_url() ?>images/marketplace/blibli.png" class="img-fluid" alt="Blibli"></a>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 product">
            <div class="card p-3 mb-4">
              <a href="https://shopee.co.id/sansafes" target="_blank"><img src="<?= base_url() ?>images/marketplace/shopee.png" class="img-fluid" alt="Shopee"></a>
            </div>
          </div>


           <div class="col-12 col-sm-6 col-lg-3 product">
            <div class="card p-3 mb-4">
              <a href="https://www.lazada.co.id/shop/saranaabadinusantara/?spm=a2o4j.pdp.seller.1.d30066bdkDx0Ut&itemId=693748562&channelSource=pdp" target="_blank"><img src="<?= base_url() ?>images/marketplace/lazada.png" class="img-fluid" alt="Lazada"></a>
            </div>
          </div>

           <div class="col-12 col-sm-6 col-lg-3 product">
            <div class="card p-3 mb-4">
              <a href="https://www.olx.co.id/profile/101071442" target="_blank"><img src="<?= base_url() ?>images/marketplace/olx.png" class="img-fluid" alt="olx"></a>
            </div>
          </div>

        </div>





<!--
        <h4 class="mb-3"> <strong>B2B</strong></h4>

        <div class="row my-5">
          <div class="col-12 col-sm-6 col-lg-3 product">
            <div class="card p-3">
              <a href="https://sellercenter.mbizmarket.co.id/katalog/kelola" target="_blank"><img src="<?= base_url() ?>images/marketplace/mbiz-market.jpg" class="img-fluid" alt="" border="0"></a>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3 product">
            <div class="card p-3">
              <a href="https://bizzymarketplace.co.id/seller/product?c0=0" target="_blank"><img src="<?= base_url() ?>images/marketplace/bizzy.jpg" class="img-fluid" alt="" border="0"></a>
            </div>
          </div>

-->

        </div>

      </div>
    </div>
  </div>

</div>
