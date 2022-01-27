<footer id="footer" class="mt-0">
  <div class="container-fluid">
    <div class="row py-3">
      <div class="col-md-6 mb-5 mb-lg-0 pt-3 bg-primary">
        <div class="row justify-content-center">
          <div class="col-md-8 col-12 align-self-center">
            <img src="<?= base_url() ?>public/images/logo-light.png" width="200" alt="Indosan" class="img-fluid mb-4">


            <?php if ($this->session->userdata('site_lang') == 'id'): ?>
            <h4 class="text-5 mb-2">TENTANG KAMI</h4>
                <p>PT Indosan Berkat Bersama didirikan atas dasar <b>KEPERCAYAAN</b> dan <b>PENGALAMAN</b> selama lebih dari 3 dekade di bidang Keselamatan dan Keamanan terhadap Kebakaran. Kami berfokus pada inovasi untuk menyediakan solusi berkualitas dan tepat guna bagi semua pelanggan.</p>
              <?php else: ?>
              <h4 class="text-5 mb-2">ABOUT US</h4>
                <p>PT Indosan Berkat Bersama was founded on the basis of <b>TRUST</b> and <b>EXPERIENCE</b> of more than 3 decades in the field of Fire Safety and Security. We are focusing on innovation to provide quality and effective solutions for all customers.</p>
            <?php endif; ?>

            <!--<p class="mb-0">Praesent venenatis turpis vitae purus semper, eget sagittis velit venenatis ptent taciti sociosqu ad litora...</p>-->
            <p class="mb-0"><a href="<?php echo site_url('pages/view/1/about-us'); ?>" class="btn-flat btn-xs text-color-light p-relative top-5"><strong class="text-2">VIEW MORE</strong><i class="fas fa-angle-right p-relative top-1 pl-2"></i></a></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-5 mb-lg-0 pt-3 bg-danger text-center">
        <h5 class="text-3 mb-3 pb-1">
          <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i style="color:red" class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
          </span>
        </h5>
        <h4>PT Indosan Berkat Bersama</h4>
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <p class="mb-4">
              Kompleks Grogol Permai Blok B/5-6 <br>
              Jl. Prof. Dr. Latumenten Kav. 19<br>
              Jakarta Barat 11460
            </p>
          </div>
          <div class="col-lg-6">
            <p class="mb-4">
              Komplek Mangga Dua Blok B1 no. 1<br>
              Jl. Jagir Wonokromo<br>
              Surabaya 60244
            </p>
          </div>
        </div>


        <ul class="list list-icons-custom list-icons-lg p-0">
          <li class="mb-1">
            <span class="fa-stack">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-phone fa-stack-1x fa-inverse text-color-primary"></i>
            </span>
            <p class="m-0">021-5668436, 08111936108</p>
          </li>
          <li class="mb-1">
            <span class="fa-stack">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-envelope fa-stack-1x fa-inverse text-color-primary"></i>
            </span>
            <p class="m-0"><a href="mailto:info@indosan.com">info@indosan.com</a></p>
          </li>
        </ul>

        <ul class="social-icons mt-4">
          <li class="social-icons-facebook"><a href="https://www.facebook.com/sansafes" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
          <li class="social-icons-twitter"><a href="https://www.instagram.com/sansafes/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
          <li class="social-icons-linkedin"><a href="https://www.youtube.com/channel/UCTnxVeMekMWTKAVEIWVfGbw" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a></li>
        <li class="social-icons-linkedin"><a href="https://www.linkedin.com/company/indosan/" target="_blank" title="Youtube"><i class="fab fa-linkedin"></i></a></li>

        </ul>
      </div>

    </div>
  </div>

  <div class="wa-chat d-none">
    <a href="#">
      <i class="fab fa-whatsapp"></i>
    </a>
  </div>

</footer>
</div>

<div class="fly-nav">
  <div class="menu-bars">
    <i class="fa fa-bars"></i> 
  </div>
  <ul>
    <li>
      <a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-2x d-block text-center"></i> <span class="d-inline-block">Home</span></a>
    </li>
    <li>
      <a href="<?php echo site_url('promo/view'); ?>"> <img width="50" class="d-block text-center" src="<?= base_url('images/ic_promo.png') ?>" alt=""> <span class="d-inline-block">Promo</span></a>
    </li>

    <li>
      <a href="<?php echo site_url('product'); ?>"><img width="50" class="d-block text-center" src="<?= base_url('images/ic_product.png') ?>" alt=""> <span class="d-inline-block">Product</span></a>
    </li>
    <li>
      <a href="<?php echo site_url('kontak'); ?>"><i class="fa fa-envelope fa-2x d-block text-center"></i> <span class="d-inline-block">Contact Us</span></a>
    </li>
    <li>
      <a target="_blank" href="https://api.whatsapp.com/send?phone=+628111936108&text=Terima kasih telah menghubungi INDOSAN, apa yang dapat kami bantu?"><i class="fab fa-whatsapp fa-2x d-block text-center"></i> <span class="d-inline-block">Whatsapp</span></a>
    </li>
  </ul>
</div>

<!-- Vendor -->
<script src="<?= base_url() ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="<?= base_url() ?>vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= base_url() ?>vendor/jquery.cookie/jquery.cookie.min.js"></script>
<script src="<?= base_url() ?>vendor/popper/umd/popper.min.js"></script>
<script src="<?= base_url() ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>vendor/common/common.min.js"></script>
<script src="<?= base_url() ?>vendor/jquery.validation/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="<?= base_url() ?>vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="<?= base_url() ?>vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="<?= base_url() ?>vendor/isotope/jquery.isotope.min.js"></script>
<script src="<?= base_url() ?>vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url() ?>vendor/vide/jquery.vide.min.js"></script>
<script src="<?= base_url() ?>vendor/vivus/vivus.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?= base_url() ?>js/theme.js"></script>

<!-- Current Page Vendor and Views -->
<script src="<?= base_url() ?>vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?= base_url() ?>vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?= base_url() ?>vendor/circle-flip-slideshow/js/jquery.flipshow.min.js"></script>
<script src="<?= base_url() ?>js/views/view.home.js"></script>

<!-- Current Page Vendor and Views -->
<script src="<?= base_url() ?>js/views/view.contact.js"></script>

<!-- Theme Custom -->
<script src="<?= base_url() ?>js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?= base_url() ?>js/theme.init.js"></script>

<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-12345678-1', 'auto');
ga('send', 'pageview');
</script>
-->

</body>
</html>
