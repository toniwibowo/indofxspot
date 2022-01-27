<?php include_once "include/header.php"; ?>
<?php $row = $query->row_array(); ?>

<div class="main" role="main">
  <section class="page-header page-header-classic page-header-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
          <h1 data-title-border><?= ucwords($this->uri->segment(1)) ?></h1>
        </div>
        <div class="col-md-4 order-1 order-md-2 align-self-center">
          <ul class="breadcrumb d-block text-md-right">
            <?php if($site_lang=='en'): ?>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active"><?php echo $row['title_jp'] ?></li>

          <?php else: ?>

            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active"><?php echo $row['title_en'] ?></li>

          <?php endif; ?>

          </ul>
        </div>
      </div>
    </div>
  </section>



    <div class="container">

        
         <?php if($site_lang=='en'): ?>

        <div class="clearer about cellpadding">

        

        
        <h3 class="secTitle"><span><?php echo $row['title_en'] ?></span></h3>
        <!--<p class="sectagline">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->

        <?php if(count(unserialize($row['file_attachment'])) > 1): ?>
        <?php foreach(unserialize($row['file_attachment']) as $pict): ?>
        <img class="bigImage" src="<?php echo base_url().'assets/uploads/files/'.$pict; ?>"/>
        <?php endforeach ?>
        <?php endif ?>
        <!--<blockquote>
        <?php echo $row['resume_en'] ?>
        </blockquote>-->

        <?php echo $row['description_en'] ?>
        </div>

        <?php else: ?>


            <div class="clearer about cellpadding">

        

        
        <h3 class="secTitle"><span><?php echo $row['title_jp'] ?></span></h3>
        <!--<p class="sectagline">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->

        <?php if(count(unserialize($row['file_attachment'])) > 1): ?>
        <?php foreach(unserialize($row['file_attachment']) as $pict): ?>
        <img class="bigImage" src="<?php echo base_url().'assets/uploads/files/'.$pict; ?>"/>
        <?php endforeach ?>
        <?php endif ?>
        <!--<blockquote>
        <?php echo $row['resume_en'] ?>
        </blockquote>-->

        <?php echo $row['description_jp'] ?>
        </div>

    <?php endif; ?>


    </div>

    </div>

<?php include_once "include/footer.php"; ?>
