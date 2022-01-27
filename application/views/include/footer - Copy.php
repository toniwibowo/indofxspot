<?php

$site_lang = !empty($this->session->userdata('site_lang'))?$this->session->userdata('site_lang'):'en';

 ?>

<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 footer-info">
            <a href="#intro">
              <img style={logStyle} src="<?php echo base_url() ?>public/images/logo-light.png" alt="" title="" height="80" />
            </a><br /><br />
            <?php if($site_lang=='en'): ?>
            <p>PT Indosan Berkat Bersama was established on 12 January 2018 in Jakarta, Indonesia. On April 14, 2018 we are proud to present Security and Safety Protection Products under SAN brand for commercial, industrial and residential markets</p>
            <?php else: ?>
              PT. Indosan Berkat Bersama baru-baru ini didirikan di Jakarta, Indonesia. Kami menyediakan perlindungan untuk keamanan dan keselamatan bagi pasar komersial, industrial maupun perumahan.
          <?php endif; ?>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Links</h4>

             <?php if($site_lang=='en'): ?>

              <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url() ?>">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('pages/view/1/about-us'); ?>">About Us</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Product</a></li>
              <!--<li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('blog/view') ?>">Blog</a></li>-->
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('news/view') ?>">News</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('articles/view') ?>">Articles</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('partners/view') ?>">Partners</a></li>

              <?php if($site_lang=='id'): ?>
              <li><a href="<?php echo site_url('langswitch/switchlanguage/en') ?>">English</a></li>
              <?php else: ?>

                <li><i class="ion-ios-arrow-right"></i><a href="<?php echo site_url('langswitch/switchlanguage/id') ?>">Indonesia</a></li>
              <?php endif; ?>

            </ul>

              <?php else: ?>

                <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url() ?>">Beranda</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('pages/view/1/about-us'); ?>">Tentang Kami</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Produk</a></li>
              <!--<li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('blog/view') ?>">Blog</a></li>-->
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('news/view') ?>">Berita</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('articles/view') ?>">Artikel</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo site_url('partners/view') ?>">Rekanan</a></li>

              <?php if($site_lang=='id'): ?>
              <li><a href="<?php echo site_url('langswitch/switchlanguage/en') ?>">English</a></li>
              <?php else: ?>

                <li><i class="ion-ios-arrow-right"></i><a href="<?php echo site_url('langswitch/switchlanguage/id') ?>">Indonesia</a></li>
              <?php endif; ?>

            </ul>

               <?php endif; ?> 

            
          </div>
          <div class="col-lg-3 col-md-6 footer-contact">
             <?php if($site_lang=='en'): ?>
              <h4>Contact</h4>
              
              <?php else: ?>
                <h4>Kontak</h4>
             <?php endif; ?>
            
            <div>
            <p>
              PT Indosan Berkat Bersama<br />
              Jl. Prof. Dr. Latumenten Kav. 19<br />
              Kompleks Grogol Permai Blok B/5-6<br />
              Jakarta Barat 11460<br />
              <strong>Phone:</strong> 021-5668436, 021-5649440<br />
              <strong>Email:</strong> <a href="mailto:info@indosan.com">info@indosan.com</a></a><br />
            </p>
            </div>

            <div class="social-links">
              <a target="_blank" href="https://www.facebook.com/myindosan" class="facebook"><i class="fa fa-facebook"></i></a>
              <a target="_blank" href="https://www.instagram.com/sansafes/" class="instagram"><i class="fa fa-instagram"></i></a>
              <a target="_blank" href="https://www.youtube.com/channel/UCTnxVeMekMWTKAVEIWVfGbw" class="instagram"><i class="fa fa-youtube"></i></a>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="container d-none">
      <div class="copyright">

      </div>
    </div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- Load React. -->
<!-- Note: when deploying, replace "development.js" with "production.min.js". -->
<!-- <script src="https://unpkg.com/react@16/umd/react.production.min.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js" crossorigin></script>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script> -->

<!-- JavaScript Libraries -->
<script src="<?php echo base_url() ?>js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.bxslider.js"></script>
<script src="<?php echo base_url() ?>js/jquery.bxslider.min.js"></script>
<script src="<?php echo base_url() ?>public/js/indosan.js"></script>
<script src="<?php echo base_url() ?>public/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>public/lib/easing/easing.min.js"></script>
<script src="<?php echo base_url() ?>public/lib/superfish/hoverIntent.js"></script>
<script src="<?php echo base_url() ?>public/lib/superfish/superfish.min.js"></script>
<script src="<?php echo base_url() ?>public/lib/wow/wow.min.js"></script>
<script src="<?php echo base_url() ?>public/lib/waypoints/waypoints.min.js"></script>
<script src="<?php echo base_url() ?>public/lib/counterup/counterup.min.js"></script>
<script src="<?php echo base_url() ?>public/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>public/lib/isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url() ?>public/lib/lightbox/js/lightbox.min.js"></script>
<script src="<?php echo base_url() ?>public/lib/touchSwipe/jquery.touchSwipe.min.js"></script>
<script src="<?php echo base_url() ?>js/owl.carousel.js"></script>


<!-- Contact Form JavaScript File -->
<script src="<?php echo base_url() ?>public/contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="<?php echo base_url() ?>public/js/main.js"></script>

<!-- Load React. -->
<!-- <script type="text/babel" src="<?php echo base_url() ?>src/Header.js"></script>
<script type="text/babel" src="<?php echo base_url() ?>src/IntroSlider.js"></script>
<script type="text/babel" src="<?php echo base_url() ?>src/Section.js"></script>
<script type="text/babel" src="<?php echo base_url() ?>src/content/PartnerSection.js"></script>
<script type="text/babel" src="<?php echo base_url() ?>src/content/ContactSection.js"></script>
<script type="text/babel" src="<?php echo base_url() ?>src/include/Footer.js"></script> -->


</body>
</html>
