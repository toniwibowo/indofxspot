<?php include_once "template/include/header.php"; ?>

<script language="javascript">
function cekContact(){
  var username = document.form_contact.username.value;
  
  
  var password = document.form_contact.password.value;
  
  
  
  
  if(username == ""){
    alert("Email harus diisi");
    return false;
  }if(password == ""){
    alert("Password harus diisi");
    return false;
  }else{
    document.form_contact.submit();
  }
}
</script> 

<content>
	<div class="container">
    	<div class="clearer about">
        <h3 class="titleContent text-center">Login</span></h3>
        
        <div class="row">
        	<div class="col-md-8 col-xs-12">
            

  <form class="form-horizontal" action="<?php echo site_url('guru/doLogin') ?>" method="post" enctype="multipart/form-data" id="formku" 
  name="form_contact">
     
     <div class="form-group">
    <label style="text-align:left" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Your Email">
    </div>
  </div>

  <div class="form-group">
    <label style="text-align:left" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputEmail3" >
    </div>
  </div>

 
  
 
  <div class="form-group">
     <label class="col-sm-2 control-label" for="inputEmail3"></label>
    <div class="col-sm-6">
 <input type="button" onclick="cekContact()" class="btn btn-primary" name="Submit" value="Send" id="button1">
    </div>
  </div>     
</form>

<p><a href="<?php echo site_url('guru/forgot') ?>">Forgot Password</a></p>


            </div>
            
            <div class="col-md-4 col-xs-12">
                	<address>
  					<strong>PT. Federal International Finance (FIFGROUP)</strong><br>
  					Menara FIF<br />
					Jl Letjen TB Simatupang Kav 15<br />
					Cilandak Barat, Cilandak<br />
					Jakarta Selatan, Kode Pos 12430<br />
					DKI Jakarta, Indonesia<br />
  					<abbr title="Phone">P:</abbr> (021) 7698899<br />
					<abbr title="Website">W:</abbr> www.fifgroup.co.id
					</address>
           </div>
        </div>
        
        </div>
    </div>
</content>
<?php include_once "template/include/footer.php"; ?>