<style media="screen" type="text/css">
  #about::before{
    content: '';
    background: none;
  }
</style>


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
            <li class="active"><?php //echo $row['product_name'] ?></li>
          </ul>
        </div>
      </div>
    </div>
  </section>


    <section id="about" class="mb-4" style="background:none">
      <div class="container">

        <div class="clearer">



          <div class="row">
        <div class="col">
          <?php if($image_header!=''): ?>

             <?php if($this->session->userdata('site_lang')=='id'): ?>
          <img src="<?php echo base_url().'assets/uploads/files/'.$image_header; ?>" class="img-fluid w-100" alt="">
            <?php else: ?>
              <img src="<?php echo base_url().'assets/uploads/files/'.$image_header_en; ?>" class="img-fluid w-100" alt="">

            <?php endif; ?>
          <?php else: ?>
            <!--<img src="http://www.indosan.com/demo/images/banner-breadcrumb.jpg" class="img-fluid w-100" alt="">-->
           <?php endif; ?>
        </div>
      </div>

          <div class="row about-cols">

            <div class="col-12 mb-4">
              <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                  <?php if($subcategory !=''): ?>

                    <?php if($subcategory->num_rows()>0): ?>



                      <?php foreach($subcategory->result_array() as $key=> $row): ?>
                        <?php
                      $images = $row['image_small'];
                      if($images !='') :

                        ?>

                  <div class="carousel-item <?php if($key==0){ echo 'active ';} ?> ">
                    <img class="d-block w-100" src="<?php echo base_url('assets/uploads/files/'.$row['image_small']); ?>" alt="First slide" border="0">
                  </div>

                  <?php endif; ?>
                    <?php endforeach; ?>

                  <?php endif; ?>
                  <?php endif; ?>

                </div>
                <!-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a> -->




              </div>
            </div>

            <?php
            //echo $sql;
            //echo $query->num_rows();

            //$where = "start_date <= NOW() AND end_date >= NOW()";
            //$this->db->where($where);
            //$this->db->order_by('product_id','DESC');
            //$data_product = $this->db->get('product');

            if($jlh > 0):
            foreach($query->result_array() as $key=>$row):
              //print_r($row);
            ?>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 column wow fadeInUp mb-4" key={fitur.id}>

              <!-- <h1 class="text-center" style="color:#fff"><?php echo $row['product_name'] ?></h1> -->
              <div class="card">
                <a href="<?php echo site_url('product/detail/'.$row['product_id'].'/'.url_title($row['product_name'])); ?>">
                  <img src="<?php echo base_url().'assets/uploads/files/'.$row['image_small']; ?>" alt="<?php echo $row['product_name'] ?>" class="img-fluid" />
                </a>
                <p><!--<?php echo $row['description']; ?>--></p>
              </div>
              <div class="card p-2" style="background:#ededed; border:0; border-radius:0">

                <h4 class="title mb-0 text-center">
                  <a href="<?php echo site_url('product/detail/'.$row['product_id'].'/'.url_title($row['product_name'])); ?>">
                    <?php echo $row['product_name'] ?>
                  </a>
                </h4>

                <!--<div class="icon">-->
                  <!-- <i class="ion-ios-speedometer-outline"></i> -->
                  <!--<img style="margin-top:5px" width="30" height="30" src="<?php echo base_url() ?>public/images/logo-A-SAN.png" alt="">
                </div>-->
              </div>
            </div>


              <?php endforeach ?>

              <div class="col-12">
                <nav >
                  <?php  echo $this->pagination->create_links(); ?>
                </nav>
              </div>



              <?php else : ?>

              <h4 class="text-center bg-primary">No Data Found !</h4>
            <?php endif ?>

          </div>
        </div>

      </div>
    </section>


</div>
