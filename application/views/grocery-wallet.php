<div class="row">

  <div class="col-lg-12" style="margin-top:2rem; margin-bottom:2rem">
    <?php if ($this->session->flashdata('update-wallet') != null): ?>
      <div class="alert alert-success" role="alert"><?= $this->session->flashdata('update-wallet') ?> </div>
    <?php endif; ?>

    <form class="" action="<?= site_url('admin/wallet/upload_csv') ?>" method="post" enctype="multipart/form-data">
      <div class="input-group">
        <input type="file" class="form-control" name="csv-file" accept=".csv">
        <div class="input-group-btn">
          <a class="btn btn-warning clearAll" href="#!" >Clear All</a>
          <button class="btn btn-danger" name="submit-csv" type="submit">Upload</button>
        </div>
        
      </div>
    </form>
  </div>

	<div class="col-lg-12">
		<div><?php echo $output; ?></div>
	</div>
</div>

<script>
  $('.clearAll').click(function(e){
    e.preventDefault()
    if (confirm('Are you sure want to clear all data?') === true) {
      window.location.href = '<?= site_url('admin/wallet/clear_all') ?>'
    }else{
      return false
    }
  })
</script>

