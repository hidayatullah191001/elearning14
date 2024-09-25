<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?> <?=$course['nama_course'] ?></h3>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$course['uuid'] ?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke Detail Course</a>
			</div>
		</div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<h2>Form Forum Course</h2>
			<p>Form ini berguna untuk anda untuk membuat forum course!</p>
			<form method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="" class="text-pks font-weight-bold">Title Forum<span class="text-danger">*</span></label>
						<input type="text" class="form-control text-pks" name="title" placeholder="Masukkan title course..." value="<?=($forum!= null) ? $forum['title_forum']  : ""?>">
						<?= form_error('title', '<small class="text-danger">', '</small>') ?>
					</div>

					<div class="form-group">
						<label for="" class="text-pks font-weight-bold">Deskripsi Forum<span class="text-danger">*</span></label>
						<textarea name="deskripsi" id="editor" placeholder="Masukkan deskripsi..."><?=($forum!= null) ? $forum['deskripsi_forum']  : ""?></textarea>
						<?= form_error('deskripsi', '<small class="text-danger">', '</small>') ?>
					</div>

					<div class="form-group text-center mt-5">
						<button type="submit" class="btn btn-primary-form">Submit</button>
					</div>
				</div>
				<div>
					<small class="text-danger text-sm m-0">*Wajib Diisi</small><br>
				</div>
			</form>
		</div>
	</div>