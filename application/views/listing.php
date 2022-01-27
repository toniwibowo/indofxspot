<?php include_once "template/include/header.php"; ?>

<?php

$row = $query->row_array();

//print_r($row);
?>

<content class="pages">

    <div class="container">
    	<?php
		$getUrl = $this->uri->segment(2);
		if($getUrl=='kebijakan'){
			echo "<h2 class='title' style='margin:20px 0'>&raquo; Kebijakan</h2>";
		}elseif($getUrl=='laporan'){
			echo "<h2 class='title' style='margin:20px 0'>&raquo; Laporan Kegiatan</h2>";
		}elseif($getUrl=='sinergi'){
			echo "<h2 class='title' style='margin:20px 0'>&raquo; Ayo Sinergi</h2>";	
		}elseif($getUrl=='komunitasDologin'){
			echo "	<ol class='breadcrumb' style='margin:50px 0;'>
					<li><a href='".site_url()."'>Home</a></li>
					<li><a href=''>Profile</a></li>
					<li><a href=''>Video</a></li>
					<li><a href=''>Posting</a></li>
					</ol>";
			echo "<h1 class='text-center' style='margin:20px 0'> WELCOME KOMUNITAS </h1>";	
		}elseif($getUrl=='komunitas'){
			echo "	<ol class='breadcrumb' style='margin:50px 0;'>
					<li><a href='".site_url()."'>Home</a></li>
					<li><a href=''>Profile</a></li>
					<li><a href=''>Video</a></li>
					<li><a href=''>Posting</a></li>
					</ol>";
			
			echo "
			<div class='clearer' style='margin-top:0'>
			<form>
				<div class='row'>
					
					<div class='col-md-3'>
					<select class='form-control'>
					<option>==PILIH KATEGORI==</option>
					</select>
					</div>
					
					<div class='col-md-3'>
					<select class='form-control'>
					<option>==PILIH KOTA==</option>
					</select>
					</div>
					
				</div>
			</form>
			</div>
			";
		}else{
			echo"<h2 class='title' style='margin:20px 0'>".stripslashes($row['title']) ."</h2>";
		}
		?>
        
        <?php
		if($getUrl=='komunitas'){
		?>
		
        <div class="clearer komunitas" style="margin-top:0">
        
        <div class="row">
        	
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news1.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news2.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news1.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news2.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news1.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news2.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news1.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news2.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news1.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news2.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news1.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news2.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news1.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news2.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news1.jpg"></a>
            </div>
            
            <div class="col-md-3 col-xs-12">
            <a href="#"><img src="<?php echo base_url(); ?>images/news/news2.jpg"></a>
            </div>
            
        </div>
        
        </div>
		
		<?php
		}else{
		?>
        <div class="contentLeft">
        <div class="row">
        <div class="col-md-12 col-xs-12">
		<div class="clearer" style="margin-top:0">
<!--        	<h3><?php echo stripslashes($row['title']); ?></h2></h3>-->
            
            <?php echo stripslashes($row['description']); ?>
        </div>
        </div>
        </div>
        </div>
        
        <div class="sideBar">

<!--    <img style="width:100%; height:300px; margin-bottom:20px" src="<?php echo base_url(); ?>images/banner/banner1.jpg" />-->
        <?php $bann=$this->db->query("select * from banner where position=1 and start_date <= now( ) and end_date >=now()");
        foreach($bann->result_array()as $banner){ ?>
    <?php  $url = str_replace("http://", "", $banner['url']); ?>

        <?php if($banner['url']!=''): ?>
        <a target="_blank" href="<?php echo $banner['url'];//echo site_url('home/banner/'.$banner['banner_id'].'/'.$url) ;?><?php //echo $banner['url'];?>" class="banneriklan">
            <img style="width:100%; margin-bottom:20px" src="<?php echo base_url().'assets/uploads/files/'. $banner['file_banner'];?>" /></a>
        <?php else: ?>
        <img style="width:100%; margin-bottom:20px" src="<?php echo base_url().'assets/uploads/files/'. $banner['file_banner'];?>" />
    <?php endif; ?>
        <?php } ?>

    </div>
        <?php } ?>
            
    </div>
</content>
<?php include_once "template/include/footer.php"; ?>