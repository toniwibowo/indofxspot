<!-- ARTIKEL TERBARU -->

   <?php
  //$where = "start_date <= NOW() AND end_date >= NOW()";
   $where = "posting_date <= NOW()";
  $this->db->where($where);
  $this->db->order_by('articles_id','DESC');
  $this->db->limit(3);
  $articles = $this->db->get('articles');

 // if($data_product->num_rows() > 0):
  //foreach($data_product->result_array() as $key=>$row):
  ?>

  <div class="card card-default">
    <div class="card-header">Latest Article</div>

    <div class="card-body">

<?php

 if($articles->num_rows() > 0):
  foreach($articles->result_array() as $key=>$r):

 ?>

      <div class="media">
        <img class="mr-3" width="100" src="<?php echo base_url('assets/uploads/files/'.$r['image_small']); ?>" alt="">
          <div class="media-body">
          <h5 class="media-heading">
            <a class="title-post" href="<?php echo site_url('blog/detail/'.$r['articles_id'].'/'.url_title($r['title'])); ?>"><?php echo $r['title']; ?></a>
          </h5>
            <p class="date"><i class="fa fa-calendar"></i> <?php
              $date = date('d M Y',strtotime($r['posting_date']));
              echo $date;
               ?></p>
          </div>
      </div>



<?php endforeach ?>
  <?php else : ?>



    <h4 class="text-center bg-primary">No Data Slider Found !</h4>
  <?php endif ?>

  </div>




  </div>


  <br />

  <!--END ARTIKEL TERBARU -->



  <!-- NEWS TERBARU -->

   <?php
  //$where = "start_date <= NOW() AND end_date >= NOW()";
  //$this->db->where($where);
  $this->db->order_by('news_id','DESC');
  $this->db->limit(3);
  $news = $this->db->get('news');

 // if($data_product->num_rows() > 0):
  //foreach($data_product->result_array() as $key=>$row):
  ?>

  <div class="card">
    <div class="card-header">Latest News</div>

    <div class="card-body">

<?php

 if($news->num_rows() > 0):
  foreach($news->result_array() as $key=>$r):

 ?>

      <div class="media">
        <img class="mr-3" width="100" src="<?php echo base_url('assets/uploads/files/'.$r['image_small']); ?>" alt="">
          <div class="media-body">
          <h5 class="media-heading">
            <a class="title-post" href="<?php echo site_url('news/detail/'.$r['news_id'].'/'.url_title($r['title'])); ?>"><?php echo $r['title']; ?></a>
          </h5>
            <p class="date"><i class="fa fa-calendar"></i> <?php
              $date = date('d M Y',strtotime($r['posting_date']));
              echo $date;
               ?></p>
          </div>
      </div>



<?php endforeach ?>

  <?php else : ?>

    <h4 class="text-center bg-primary">No Data Slider Found !</h4>
  <?php endif ?>

  </div>




  </div>




  <!--END NEWS TERBARU -->
