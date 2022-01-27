<?php include "include/header.php"; ?>

<content>
    <section class="homeSlider">
        <?php include "include/slider.php"; ?>
    </section>
    
    <section class="csrProgram">
    <div class="clearer">
        <div class="container">
        <h3 class="titleContent text-center">PROGRAM <span>CSR</span></h3>
        <div class="clearer">
            <div class="row">

            <?php

            $iconQuery = $this->db->query("select * from icon ");
             ?>
            
            <?php if($iconQuery->num_rows()>0): ?>

               <?php foreach($iconQuery->result_array() as $row): ?> 

            <div class="col-ex-3 col-xs-12 text-center">
            <?php if($row['url']!=''): ?>

            	<a href="<?php echo $row['url']; ?>"><img src="<?php echo base_url().'assets/uploads/files/'.$row['file_banner']; ?>"/></a>
            <h4><a href="<?php echo $row['url']; ?>"><?php echo $row['title'] ?></a></h4>

            <?php else: ?>	

            	<img src="<?php echo base_url().'assets/uploads/files/'.$row['file_banner']; ?>"/>
            <h4><?php echo $row['title'] ?></h4>

            <?php endif; ?>	
            
            </div>
            
        <?php endforeach; ?>

            <?php endif; ?>
            
            
            
            </div>
        </div>
        </div>
    </div>
    </section>
    
<section class="brand" style="border-bottom:solid thin #a1a1a1;">
    <div class="container">
    <h3 style="margin:50px 0;" class="titleContent text-center">OUR <span>BRAND</span></h3> 
        <div class="clearer" style="margin:0 0 50px;">
            <div class="row">
            
            <div class="col-md-3 col-xs-12 text-center">
            <img src="<?php echo base_url(); ?>images/brand/brand1.png"/>
            <p>FIFASTRA untuk pembiayaan motor baru</p>
            </div>
            
            <div class="col-md-3 col-xs-12 text-center">
            <img src="<?php echo base_url(); ?>images/brand/brand2.png"/>
            <p>SPEKTRA untuk pembiayaan multi guna </p>
            </div>
            
            <div class="col-md-3 col-xs-12 text-center">
            <img src="<?php echo base_url(); ?>images/brand/brand3.png"/>
            <p>AFTRA untuk pembiayaan mobil baru dan bekas berkualitas</p>
            </div>
            
            <div class="col-md-3 col-xs-12 text-center">
            <img src="<?php echo base_url(); ?>images/brand/brand4.png"/>
            <p>AMITRA untuk skema pembiayaan secara syariah</p>
            </div>
            
            
                 
            </div>
        </div>
    </div>
</section>

<section class="video">
    <div class="container">
    <h3 class="titleContent BigTitle text-center">Latest <span>Video</span>
    <span class="more text-right"><a href="#">More Video</a></span>
    </h3>
    
    <div class="clearer">
        <div class="row">
        
        

            <?php 

            $video = $this->db->query("select * from video order by video_id desc limit 3");

             ?>
             <?php if($video->num_rows()>0): ?>
             <?php foreach($video->result_array() as $r): ?>
             <div class="col-md-4 col-xs-6">
            <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $r['uri']; ?>"></iframe>
        <!--<iframe src="//www.youtube.com/embed/<?php echo $r['uri']; ?>" frameborder="0" allowfullscreen></iframe>-->
            
            <!--<div class="link">
            <a href="#"> &nbsp; </a>
            </div>-->
            </div>
        </div>

    <?php endforeach; ?>
        <?php endif; ?>
        <!--<div class="col-md-6 col-xs-6">
            <div class="videoImage">
            <img src="<?php echo base_url(); ?>images/video/video2.jpg"/>
            
            <div class="link">
            <a href="#"> &nbsp; </a>
            </div>
            </div>
        </div>-->
        </div>
    </div>
    
    </div>
</section>

<section class="news">
    <div class="container">
    <h3 style="margin:20px 0" class="titleContent BigTitle">Latest <span>CSR News</span>
    <span class="more text-right"><a href="#">More News</a></span>
    </h3>
        <div class="clearer" style="margin-top:0">
            <div class="row">
            

                 <?php

        $string_query       = "SELECT * 
FROM news
WHERE posting_date <= now( )
ORDER BY posting_date DESC limit 6 ";
        $query                = $this->db->query($string_query);    

         ?>


         <?php 
    if($query->num_rows() >0):
    ?>

    <?php foreach($query->result_array() as $n): ?>

            <div class="col-md-6 col-xs-12 listNews">
            <div class="media">
                <div class="media-left media-top">
                    <a href="#"><img width="200" class="media-object" src="<?php echo base_url() .'assets/uploads/files/'. $n['image_small'];?>" alt="Title"></a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><a text-align:left; font-weight:bold; " href="<?php echo site_url("news/detail")."/".$n['news_id']."/".url_title($n['title']); ?>" ><?php echo stripslashes($n['title']);?></a></h4>
                    
    <p><?php echo stripslashes($n['resume']);?></p>
                </div>
                </div>
            </div>
            
            
             <?php endforeach; ?>
        
        <?php endif; ?>
           
            
                
            </div>
        
        </div>
    </div>
</section>

<section class="gallery">
    <div class="container">
    <h3 style="margin:20px 0" class="titleContent bigTitle">Latest <span>Gallery Photo</span>
    <span class="more text-right"><a href="#">More Photos</a></span>
    </h3>
        <div class="clearer" style="margin-top:0">
            <div class="row">
            
            <?php 

            $string_query       = "select * from gallery order by posting_date desc";
        $query                = $this->db->query($string_query);         

            ?>

            <?php if($query->num_rows() >0): ?>

            <?php foreach($query->result_array() as $r): ?>
            <div class="col-ex-3 photo">
                <p><a href="<?php echo site_url('gallery/detail/'.$r['gallery_id'].'/'.$r['title']) ?>"><img src="<?php echo base_url().'assets/uploads/files/'.$r['image_small']; ?>"/></a></p>
                <a href="<?php echo site_url('gallery/detail/'.$r['gallery_id'].'/'.$r['title']) ?>"><?php echo $r['title']; ?></a>

            </div>
            <?php endforeach; ?>
            <?php endif; ?>
                
            </div>
        
        </div>
    </div>
</section>


</content>
<?php include "include/footer.php"; ?>