<?php include_once "include/header.php"; ?>


<div class="main" role="main">
  <section class="page-header page-header-classic page-header-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
          <h1 data-title-border>Rekanan</h1>
        </div>
        <div class="col-md-4 order-1 order-md-2 align-self-center">
          <ul class="breadcrumb d-block text-md-right">
          <?php if($site_lang=='en'): ?>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">Partners</li>
<?php else: ?>

<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li class="active">Rekanan</li>

<?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </section>


  <section id="team">
    <div class="container">
    <div class="clearer">

        

      <div class="section-header wow fadeInUp">
          <?php if($site_lang=='en'): ?>
       <h3>Partners</h3>
       <p>Following are the partners of PT Indosan Berkat Bersama</p>
       <?php else: ?>   <h3>Rekanan</h3>
       <p>Berikut ini adalah daftar rekanan dari PT Indosan Berkat Bersama</p>
        <?php endif; ?>
        
      </div>

      <div class="row">

        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">

              <thead>
                  <?php if($site_lang=='en'): ?>

                    <tr>
                  <th scope="col">NO</th>
                  <th scope="col">COMPANY NAME</th>
                  <th scope="col">CITY</th>
                  <th scope="col">PHONE NO.</th>
                 <!-- <th scope="col">WEBSITE</th>-->
                  <th scope="col">EMAIL</th>
                </tr>
                    <?php else: ?>
                      <tr>
                  <th scope="col">NO</th>
                  <th scope="col">NAMA PERUSAHAAN</th>
                  <th scope="col">KOTA</th>
                  <th scope="col">TELP</th>
                  <!--<th scope="col">WEBSITE</th>-->
                  <th scope="col">EMAIL</th>
                </tr>
                  <?php endif; ?>
                
              </thead>

              <tbody>

              <?php
              //$where = "start_date <= NOW() AND end_date >= NOW()";
              //$this->db->where($where);
              //$this->db->order_by('customer_id','DESC');
              $data_customer = $this->db->query("select * from customer a left join city c on a.city_id = c.city_id   ORDER BY a.customer_id");;

              $no = 0;

              if($data_customer->num_rows() > 0):
              foreach($data_customer->result_array() as $key=>$row):
                $no++;
              ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><h5><?php echo $row['title']; ?></h5></td>
                  <td><?php echo $row['city_name'] ?></td>
                  <td><?php echo $row['phone'] ?></td>
                  <td><?php echo $row['email'] ?></td>
                  
                </tr>
              <?php endforeach ?>
              <?php else : ?>
                <tr>
                  <td><h4 class="text-center bg-primary mb-0">No Data Slider Found !</h4></td>
                </tr>
              <?php endif ?>
              </tbody>
            </table>
          </div>
        </div>



          <!-- <div class="col-lg-3 col-md-6 col-xs-12 wow fadeInUp">
            <div class="member">
              <img src="<?php echo base_url().'assets/uploads/files/'.$row['image_small']; ?>" alt="Partner One" class="img-fluid" />
                <div class="member-info">
                  <div class="member-info-content">
                    <h4><?php echo $row['title']; ?></h4>
                    <span><?php echo $row['description']; ?></span>
                  </div>
                </div>
            </div>
          </div> -->



         <!-- <div class="col-lg-3 col-md-6 col-xs-12 wow fadeInUp" >
            <div class="member">
              <img src="<?php base_url() ?>public/images/partners/logo-1.png" alt="Partner One" class="img-fluid" />
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>Partner One</h4>
                    <span>Lorem Ipsum Dolor</span>
                  </div>
                </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-xs-12 wow fadeInUp" key={partner.id}>
            <div class="member">
              <img src="<?php base_url() ?>public/images/partners/logo-1.png" alt="Partner One" class="img-fluid" />
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>Partner One</h4>
                    <span>Lorem Ipsum Dolor</span>
                  </div>
                </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-xs-12 wow fadeInUp" key={partner.id}>
            <div class="member">
              <img src="<?php base_url() ?>public/images/partners/logo-1.png" alt="Partner One" class="img-fluid" />
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>Partner One</h4>
                    <span>Lorem Ipsum Dolor</span>
                  </div>
                </div>
            </div>
          </div>-->

      </div>
      </div>

    </div>
  </section>


</div>