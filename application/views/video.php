<?php include_once "template/include/header.php"; ?>
	<content class="video">
    	<div class="container">
        <h2 class="title">&raquo; Video</h2>
        	<div class="clearer">
            	<div class="row">
                	<?php //echo $jlh; ?>
                    
                     <?php  
foreach($query->result_array()as $datas){ ?>
                    <div class="col-md-4 col-xs-12 ytube">
                    <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $datas['uri'] ?>"></iframe>
<!--<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $datas['uri'] ?>" frameborder="0" allowfullscreen></iframe>-->
                    
                   
                    </div>
                    <h4><a href="<?php echo site_url('video/detail/'.$datas['video_id'].'/'.url_title($datas['title'])); ?>"><?php echo $datas['title']; ?></a></h4>
                    </div>
                    <?php } ?>
                  
                    
                </div>
            </div>
        </div>
    </content>
<?php include_once "template/include/footer.php"; ?>