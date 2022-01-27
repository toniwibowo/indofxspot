<?php include_once "template/include/header.php"; ?>
<content>
	<div class="container">
    	<div class="clearer about">
        <ol class="breadcrumb">
			<li><a href="">Home</a></li>
			<li class="active">Contact Us</li>
		</ol>

        <div class="row">
        	<div class="col-md-8 col-xs-12">
							<?php echo form_error('nama', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('no_telp', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('budget', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('harapan_area', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>

							<?php echo form_error('nama_apartemen', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('nama_perusahaan', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('email', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('jadwal_showing', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('jadwal_movin', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('perkiraan_include_pajak', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('alamat_kantor', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('keinginan_lain', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>

							<?php echo form_error('comment', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>
							<?php echo form_error('captcha', '<div class="bg-danger" style="padding:15px">', '</div>'); ?>


							<?php if($site_lang=='en'): ?>
							
				<h3 class="secTitle"><span>Form Permintaan Apartemen</span></h3><!-- class requesting-apartement -->
				
				<?php echo form_open('contact/send'); ?>
				
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" name="nama" value="<?php echo set_value('nama'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Nama Perusahaan</label>
								<input type="text" name="nama_perusahaan" value="<?php echo set_value('nama_perusahaan'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">No. Telp</label>
								<input type="text" name="no_telp" value="<?php echo set_value('no_telp'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Email</label>
								<input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Perkiraan Jadwal Move in</label>
								<input type="date" name="jadwal_movin" value="<?php echo set_value('jadwal_movin'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Perkiraan Jadwal Showing</label>
								<input type="date" name="jadwal_showing" value="<?php echo set_value('jadwal_showing'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Budget</label>
								<input type="text" name="budget" value="<?php echo set_value('budget'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Perkiraan Include Pajak</label>
								<input type="text" name="perkiraan_include_pajak" value="<?php echo set_value('perkiraan_include_pajak'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Harapan Area</label>
								<input type="text" name="harapan_area" value="<?php echo set_value('harapan_area'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Alamat Kantor</label>
								<input type="text" name="alamat_kantor" value="<?php echo set_value('alamat_kantor'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Nama Apartemen yang Diinginkan</label>
								<input type="text" name="nama_apartemen" value="<?php echo set_value('nama_apartemen'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">Keinginan Lain</label>
								<input type="text" name="keinginan_lain" value="<?php echo set_value('keinginan_lain'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-12 col-xs-12">
							<div class="form-group">
								<label>Comment :</label>
								<textarea name="comment" value="<?php echo set_value('comment'); ?>" class="form-control" rows="6"></textarea>
							</div>
						</div>
						
						<div class="col-md-12 col-xs-12">
							<div class="form-group">
								<button type="submit" name="" class="btn btn-info btn-block">Submit</button>
							</div>
						</div>
						
					</div>
				
				</form>

			<?php else: ?>	


				<h3 class="secTitle"><span>アパートに関するお問い合わせ</span></h3><!-- class requesting-apartement -->
				
				<?php echo form_open('contact/send'); ?>
				
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">名前</label>
								<input type="text" name="nama" value="<?php echo set_value('nama'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">会社名</label>
								<input type="text" name="nama_perusahaan" value="<?php echo set_value('nama_perusahaan'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">連絡先</label>
								<input type="text" name="no_telp" value="<?php echo set_value('no_telp'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">メールアドレス</label>
								<input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">入居希望時期</label>
								<input type="date" name="jadwal_movin" value="<?php echo set_value('jadwal_movin'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">内覧希望時期</label>
								<input type="date" name="jadwal_showing" value="<?php echo set_value('jadwal_showing'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">ご予算（月に約）</label>
								<input type="text" name="budget" value="<?php echo set_value('budget'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">税込み/税別</label>
								

								<select class="form-control" name="perkiraan_include_pajak" form="carform">
								<option value="">Pilih</option>
  									<option value="Termasuk Pajak">税込み</option>
  									<option value="Tidak Termasuk Pajak">税別</option>
								</select>

							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">希望アリア</label>
								<input type="text" name="harapan_area" value="<?php echo set_value('harapan_area'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">通勤オフィス所在地</label>
								<input type="text" name="alamat_kantor" value="<?php echo set_value('alamat_kantor'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">希望物件名</label>
								<input type="text" name="nama_apartemen" value="<?php echo set_value('nama_apartemen'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label for="">その他希望</label>
								<input type="text" name="keinginan_lain" value="<?php echo set_value('keinginan_lain'); ?>" class="form-control" />
							</div>
						</div>
						
						<div class="col-md-12 col-xs-12">
							<div class="form-group">
								<label>メーモ :</label>
								<textarea name="comment" value="<?php echo set_value('comment'); ?>" class="form-control" rows="6"></textarea>
							</div>
						</div>
						
						<div class="col-md-12 col-xs-12">
							<div class="form-group">
								<button type="submit" name="" class="btn btn-info btn-block">送信</button>
							</div>
						</div>
						
					</div>
				
				</form>


			<?php endif; ?>
            </div>

            <div class="col-md-4 col-xs-12">
                	<div class="news-widget">

								<!-- ARTIKEL TERBARU -->
								<div class="panel panel-default">
									<div class="panel-heading">Latest Article</div>
									<div class="panel-body">
										<?php
											$queryBlog = $this->db->order_by('news_id','DESC')->limit(3)->get('news');
											if($queryBlog->num_rows() > 0):
												foreach ($queryBlog->result_array() as $key):
										?>
										<div class="media">
									  		<div class="media-left media-top">
									    	<a href="<?php echo site_url('article/detail') ?>">
												<img class="media-object" src="<?php echo base_url().'assets/uploads/files/'.$key['image_small']; ?>" alt="">
											</a>
									  		</div>
									  		<div class="media-body">
												<h4 class="media-heading">
												<a class="title-news" href="<?php echo site_url('blog/detail').'/'.$key['news_id'].'/'.url_title($key['title_'.$site_lang],'-',true) ?>"><?php echo $key['title_'.$site_lang] ?></a>
												</h4>
									    		<p class="date"><i class="fa fa-calendar"></i> <?php echo date('d-M-Y',strtotime($key['posting_date'])) ?></p>
									  		</div>
										</div>

									<?php endforeach ?>
									<?php endif ?>

									</div>

								</div>

									</div>
           </div>
        </div>

        </div>
    </div>
</content>
<?php include_once "template/include/footer.php"; ?>
