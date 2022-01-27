<?php include_once "template/include/header.php"; ?>
<content>
	<div class="container">
    	<div class="clearer about cellpadding">

		<?php
		$this->db->where('pages_id',2);
		$queryAbout = $this->db->get('pages');

		$row = $queryAbout->row_array();
		?>

		<ol class="breadcrumb">
			<li><a href="">Home</a></li>
			<li class="active">About Us</li>
		</ol>

		<h3 class="secTitle"><span><?php echo $row['title_'.$site_lang] ?></span></h3>
		<!--<p class="sectagline">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->

        <?php if(count(unserialize($row['file_attachment'])) > 0): ?>
		<?php foreach(unserialize($row['file_attachment']) as $pict): ?>
		<img class="bigImage" src="<?php echo base_url().'assets/uploads/files/'.$pict; ?>"/>
        <?php endforeach ?>
		<?php endif ?>
        <!--<blockquote>
  		<?php echo $row['resume_'.$site_lang] ?>
		</blockquote>-->

        <?php echo $row['description_'.$site_lang] ?>
        </div>
    </div>
</content>
<?php include_once "template/include/footer.php"; ?>
