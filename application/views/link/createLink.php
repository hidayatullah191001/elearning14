<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?></h3>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$section['uuid_course']?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke List Section</a>
			</div>
		</div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<h2>Form Tambah Link</h2>
			<p>Form ini berguna untuk anda menambahkan link baru!</p>
			<form method="post" enctype="multipart/form-data">
				<input type="text" name="section_id" value="<?=$section['id_section'] ?>" hidden>
				<input type="text" name="course_uuid" value="<?=$section['uuid_course'] ?>" hidden>
				<div class="modal-body">
					<div class="form-group">
						<label for="" class="text-pks font-weight-bold">Title Link<span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="title_link" placeholder="Masukkan title Link...">
						<?= form_error('title_link', '<small class="text-danger">', '</small>') ?>
					</div>

					<div class="form-group">
						<label for="" class="text-pks font-weight-bold">Isi Link<span class="text-danger">*</span></label>
						<textarea style="height: 200px" name="deskripsi_link" id="editor" placeholder="Masukkan deskripsi..."></textarea>
						<?= form_error('deskripsi_link', '<small class="text-danger">', '</small>') ?>
					</div>

					<div class="form-group">
						<label for="" class="text-pks font-weight-bold">Link<span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="link" placeholder="Masukkan Link...">
						<?= form_error('link', '<small class="text-danger">', '</small>') ?>
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
