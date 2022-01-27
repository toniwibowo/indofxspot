<?php include_once "include/header.php"; ?>
<content>
    <div class="container">
        <div class="clearer about cellpadding mt-4">



        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <!--<li class="breadcrumb-item active"><?php echo $row['title_en']; ?></li>-->
          </ol>
        </nav>

        <div class="row">

        <?php  if($cekJlh > 0):?>
                    <?php foreach($query->result_array() as $row):   ?>
                    <?php
                        if($row['TypeSearch'] == 'Articles'){
                            $site= 'articles/detail';
                        }

                        if($row['TypeSearch'] == 'News'){
                            $site= 'news/detail';
                        }


                        if($row['TypeSearch'] == 'Product'){
                            $site= 'product/detail';
                        }

                     ?>

        <div class="col-md-4 col-xs-12 col-xl-4 col-xxl-4 mb-4">
        <article class="post-blog-large">
          <figure class="card">
            <a class="title-post-lg" href="<?php echo site_url($site)."/".$row['ID']."/".url_title($row['Title']); ?>"><img class="img-fluid" src="<?php echo base_url('assets/uploads/files/'.$row['Image']); ?>" alt="" width="868" height="640"/></a>
          </figure>
          <ul class="post-blog-meta">
            <!--<li><span>by</span>&nbsp;<a href="about-me.html">Author</a></li>-->
            <!-- <li> -->
            <!-- <time datetime="2018">
            <?php
              //$date = date('d M Y',strtotime($row['posting_date']));
             // echo $date;
            ?></time>
            </li> -->
          </ul>
          <div class="post-blog-large-caption">
            <a class="title-post-lg" href="<?php echo site_url($site)."/".$row['ID']."/".url_title($row['Title']); ?>"><?php echo $row['Title']; ?></a>
            <p class="post-blog-large-text"><?php echo strip_tags(substr($row['Resume'],0,80)); ?></p>
            <br>
          <div class="text-center btn btn-primary" id="btn-bubu" onclick="location.href='<?php echo site_url($site)."/".$row['ID']."/".url_title($row['Title']); ?>'">
            <a class="text-white" href="<?php echo site_url($site)."/".$row['ID']."/".url_title($row['Title']); ?>">read more</a>
          </div>
          </div>
        </article>
      </div>

  <?php endforeach; ?>

<?php endif; ?>

  <div class="col-md-12 col-xs-12">
     <?php echo $this->pagination->create_links(); ?>
  </div>
  </div>
        </div>
    </div>
</content>
<?php include_once "include/footer.php"; ?>
