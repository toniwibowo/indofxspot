<div class="row">
	<div class="col-sm-3">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="<?php echo $this->ion_auth->user()->row()->photo == '' ? base_url('assets/img/logo/icon-user.png') : base_url('assets/uploads/image/'.$this->ion_auth->user()->row()->photo) ?>" alt="User profile picture">
				<h3 class="profile-username text-center"><?php echo $this->ion_auth->user()->row()->full_name ?></h3>
				<p class="text-muted text-center"><?php echo $this->ion_auth->user()->row()->email ?></p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Username</b> <a class="pull-right"><?php echo $this->ion_auth->user()->row()->username; ?></a>
					</li>
					<li class="list-group-item">
						<b>Last login</b> <a class="pull-right"><?php echo date('d/m/Y H:i', $this->ion_auth->user()->row()->last_login); ?></a>
					</li>
					<li class="list-group-item">
						<b>Created</b> <a class="pull-right"><?php echo date('d/m/Y H:i', $this->ion_auth->user()->row()->created_on); ?></a>
					</li>
				</ul>

				<a href="<?php echo site_url('sketsanet/users/profile/edit/'.$this->ion_auth->user()->row()->id); ?>" class="btn btn-primary btn-block btn-flat">Update</a>
			</div><!-- /.box-body -->
		</div>
	</div>
</div>