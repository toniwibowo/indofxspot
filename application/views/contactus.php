<?php include_once "include/header.php"; ?>

<script language="javascript">
function cekContact(){
  var name = document.form_contact.name.value;


  var email = document.form_contact.email.value;


  var message = document.form_contact.message.value;
  var captcha = document.form_contact.captcha.value;
  if(name == ""){
    alert("Nama harus diisi");
    return false;
  }if(email == ""){
    alert("Email harus diisi");
    return false;
  }if(message == ""){
    alert("Message harus diisi");
    return false;
  }if(captcha == ""){
    alert("Captcha harus diisi");
    return false;
  }else{
    document.form_contact.submit();
  }
}
</script>


<div class="main" role="main">
  <section class="page-header page-header-classic page-header-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
        <?php if($site_lang=='en'): ?>

        <h1 data-title-border>Contact Us</h1>

<?php else: ?>

<h1 data-title-border>Hubungi Kami</h1>

<?php endif; ?>
          
        </div>
        <div class="col-md-4 order-1 order-md-2 align-self-center">
          <ul class="breadcrumb d-block text-md-right">
          <?php if($site_lang=='en'): ?>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">Contact Us</li>
<?php else: ?>

<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li class="active">Hubungi Kami</li>

<?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </section>



	<div class="container">
    	<div class="clearer cellpadding">

        
        <div class="row">
        	<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">


  <form action="<?php echo site_url('contactus/send') ?>" method="post" enctype="multipart/form-data" id="formku" name="addroom">

    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input type="text" name="nama" class="form-control" id="inputEmail3">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
      <div class="col-sm-10">
        <input type="tel" class="form-control" name="phone" id="inputEmail3">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" id="inputEmail3">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputName" class="col-sm-2 control-label">Subject</label>
      <div class="col-sm-10">
        <select class="form-control" name="subject" id="inputName">
          <option value="">==Pilih Subjek==</option>
                  <option value="Permintaan Produk">Permintaan Produk</option>
                  <option value="Pengiriman">Pengiriman</option>
                  <option value="Layanan Purna Jual">Layanan Purna Jual</option>
                  <option value="Keluhan">Keluhan</option>
                  <option value="Biaya-biaya">Biaya-biaya</option>
                  <option value="Lain-lain">Lain-lain</option>
        </select>
      </div>
    </div>


    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 control-label">Message</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="message" rows="3"></textarea>
      </div>
    </div>

    <div class="form-group row">
      <label for="inputName" class="col-sm-2 control-label"></label>
      <div class="col-sm-3">
        <?php echo $cap_img; ?>
      </div>
    </div>


    <div class="form-group row">
      <label for="inputName" class="col-sm-2 control-label">Captcha</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="captcha" id="inputEmail3" ><?php echo $cap_msg; ?>
      </div>
    </div>


    <div class="form-group row">
       <label class="col-sm-2 control-label" for="inputEmail3"></label>
      <div class="col-sm-6">
   <input type="submit" class="btn btn-primary" name="Submit" value="Send" id="button1">
      </div>
    </div>
  </form>




            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
            <address>
              <strong>PT Indosan Berkat Bersama</strong><br>
              Kompleks Grogol Permai Blok B/5-6 <br>
              Jl. Prof. Dr. Latumenten Kav. 19 <br>
              
              Jakarta Barat 11460 <br><br>
              Phone: 021-5668436<br>
              WA: +62-8111936108<br>
              Email: <a href="mailto:info@indosan.com">info@indosan.com</a>
					</address>
           </div>
        </div>

        </div>
    </div>
</div>