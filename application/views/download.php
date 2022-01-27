<?php include_once "template/include/header.php"; ?>
	<content class="video">
    	<div class="container">
        <div class="clearer">
        
        <div class="contentLeft">
        <h2 style="margin-top:0" class="title">&raquo; Laporan Kegiatan</h2>
        	<div class="row">
                	<div class="col-md-12 col-xs-12">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
					<tr><th>No.</th><th>File</th><!-- <th>Bytes</th> --></tr>	
                     <?php
					 $no=0;  
foreach($query->result_array()as $datas){ $no++; ?>
                    
                    
                    
                 
                    <tr><td><?php echo $no; ?></td>
                    <td><a href="<?php echo base_url().'assets/uploads/files/'. $datas['file_image'] ?>"><?php echo $datas['judul']; ?></a></td><!-- <td><?php echo $datas['size'] ?> kb</td> --></tr>
                   
                    
                    <?php } ?>
                    </table>
                    </div>
                    
                    </div>
                  
                    
                </div>
            </div>
            
            <div class="sideBar">

<!--    <img style="width:100%; height:300px; margin-bottom:20px" src="<?php echo base_url(); ?>images/banner/banner1.jpg" />-->
        <?php $bann=$this->db->query("select * from banner where position='1' and start_date <= now( ) and end_date >=now()");
        foreach($bann->result_array()as $banner){ ?>
    <?php  $url = str_replace("http://", "", $banner['url']); ?>

        <?php if($banner['url']!=''): ?>
        <a target="_blank" href="<?php echo $banner['url'];//echo site_url('home/banner/'.$banner['banner_id'].'/'.$url) ;?><?php //echo $banner['url'];?>" class="banneriklan">
            <img style="width:100%; height:300px; margin-bottom:20px" src="<?php echo base_url().'assets/uploads/files/'. $banner['file_banner'];?>" /></a>
        <?php else: ?>
        <img style="width:100%; height:300px; margin-bottom:20px" src="<?php echo base_url().'assets/uploads/files/'. $banner['file_banner'];?>" />
    <?php endif; ?>
        <?php } ?>

    </div>
        
        </div>    
        </div>
    </content>
<?php include_once "template/include/footer.php"; ?>