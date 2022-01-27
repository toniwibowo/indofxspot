<footer>
	<div class="container">

	<div class="clearer" style="margin-bottom:0">
    	<div class="row">

            <?php if($site_lang=='en'): ?>

			<div class="col-md-3 col-xs-12">
			<a href=""><img style="margin-bottom:20px;" src="<?php echo base_url() ?>images/logo.png" /></a>
				<p>Sahid Sudirman Residences<br>LG Floor / 11 / Office<br>
		Jl. Jend. Sudirman No. 86.<br />
        Jakarta Pusat 10250</p>
			<ul class="office">
            <!-- <li><i class="fa fa-phone"></i> <a href="tel:+62811109633">+62 81 1109 633</a></li>
            <li><i class="fa fa-envelope"></i> <a href="mailto:info@apatojakarta.com">info@apatojakarta.com</a></li> -->
            </ul>
			</div>

			<div class="col-md-3 col-xs-12">
            <h4 class="title" style="color:#ccc;"><strong>SITEMAP</strong></h4>
			<ul>
            <li><a href="<?php echo site_url(); ?>"><i class="fa fa-angle-double-right"></i> Home</a></li>
<!--            <li><a href="<?php echo activate_menu('about') ?>"><i class="fa fa-angle-double-right"></i> About Us</a></li>-->
            <!--<li><a href="<?php echo base_url().'property/category/2'; ?>"><i class="fa fa-angle-double-right"></i> Primary</a></li>-->
             <li><a href="<?php echo base_url().'property/category/3'; ?>"><i class="fa fa-angle-double-right"></i> Rent</a></li>
            <li><a href="<?php echo site_url('blog/view'); ?>"><i class="fa fa-angle-double-right"></i> Blog</a></li>
           <!-- <li><a href="<?php echo site_url('contact'); ?>"><i class="fa fa-angle-double-right"></i> Contact Us</a></li>-->
            </ul>
            </div>

			<div class="col-md-3 col-xs-12">
            <h4 class="title" style="color:#ccc;"><strong>INFORMATIONS</strong></h4>
			<ul>
                        <li><a href="<?php echo site_url('about'); ?>"><i class="fa fa-angle-double-right"></i> About Us</a></li> 
                        <li><a href="http://www.apatojakarta.com/japanese-community-info"><i class="fa fa-angle-double-right"></i> Japanese Community Info</a>
            <!--<li><a href="#"><i class="fa fa-angle-double-right"></i> Terms &amp Conditions</a></li>
            <li><a href="#"><i class="fa fa-angle-double-right"></i> How to Booking</a></li>-->
            </ul>
            </div>

			<div class="col-md-3 col-xs-12">
            <h4 class="title" style="color:#ccc;"><strong>CONTACT US</strong></h4>
			<ul>
            <li><a href="<?php echo site_url('contact'); ?>"><i class="fa fa-angle-double-right"></i> Contact Us</a></li>
            </ul>
            </div>

            <div class="col-md-12 col-xs-12"><hr style="margin-bottom:20px" /></div>

            <?php else: ?>

                <div class="col-md-3 col-xs-12">
            <a href=""><img style="margin-bottom:20px;" src="<?php echo base_url() ?>images/logo.png" /></a>
                <p>Sahid Sudirman Residences<br>LG Floor / 11 / Office<br>
        Jl. Jend. Sudirman No. 86.<br />
        Jakarta Pusat 10250</p>
            <ul class="office">
            <!-- <li><i class="fa fa-phone"></i> <a href="tel:+62811109633">+62 81 1109 633</a></li>
            <li><i class="fa fa-envelope"></i> <a href="mailto:info@apatojakarta.com">info@apatojakarta.com</a></li> -->
            </ul>
            </div>

            <div class="col-md-3 col-xs-12">
            <h4 class="title" style="color:#ccc;"><strong>サイトマップ</strong></h4>
            <ul>
            <li><a href="<?php echo site_url(); ?>"><i class="fa fa-angle-double-right"></i> ホーム</a></li>
<!--            <li><a href="<?php echo activate_menu('about') ?>"><i class="fa fa-angle-double-right"></i> About Us</a></li>-->
            <!--<li><a href="<?php echo base_url().'property/category/2'; ?>"><i class="fa fa-angle-double-right"></i> Primary</a></li>-->
             <li><a href="<?php echo base_url().'property/category/3'; ?>"><i class="fa fa-angle-double-right"></i> 物件紹介</a></li>
            <li><a href="<?php echo site_url('blog/view'); ?>"><i class="fa fa-angle-double-right"></i> ブログ</a></li>
           <!-- <li><a href="<?php echo site_url('contact'); ?>"><i class="fa fa-angle-double-right"></i> Contact Us</a></li>-->
            </ul>
            </div>

            <div class="col-md-3 col-xs-12">
            <h4 class="title" style="color:#ccc;"><strong> 弊社・追加情報</strong></h4>
            <ul>
                        <li><a href="<?php echo site_url('about'); ?>"><i class="fa fa-angle-double-right"></i>弊社情報</a></li> 
                        <li><a href="http://www.apatojakarta.com/japanese-community-info"><i class="fa fa-angle-double-right"></i> ジャパニーズコミュニティ情報</a>
            <!--<li><a href="#"><i class="fa fa-angle-double-right"></i> Terms &amp Conditions</a></li>
            <li><a href="#"><i class="fa fa-angle-double-right"></i> How to Booking</a></li>-->
            </ul>
            </div>

            <div class="col-md-3 col-xs-12">
            <h4 class="title" style="color:#ccc;"><strong>お問い合わせ</strong></h4>
            <ul>
            <li><a href="<?php echo site_url('contact'); ?>"><i class="fa fa-angle-double-right"></i> お問い合わせ</a></li>
            </ul>
            </div>

            <div class="col-md-12 col-xs-12"><hr style="margin-bottom:20px" /></div>

                <?php endif; ?>


        </div>
    </div>
    <div class="clearer" style="margin-top:0">
    	<div class="row">
        	<div class="col-md-12 col-xs-12 text-center">
            <p style="font-size:12px; margin-top:10px;">Copyright &copy; 2018 APATO JAKARTA, All Rights Reserved</p>
            </div>

            <div class="col-md-3 col-md-offset-5 follow hidden">
            <h4>FOLLOW US</h4>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
    </div>
    </div>
</footer>

</body>
</html>
