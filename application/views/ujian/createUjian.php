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
			<h2>Form Tambah Ujian</h2>
			<p>Form ini berguna untuk anda membuat ujian baru!</p>
			<form method="post" enctype="multipart/form-data">
				<input type="text" name="section_id" value="<?=$section['id_section'] ?>" hidden>
				<input type="text" name="course_uuid" value="<?=$section['uuid_course'] ?>" hidden>
				<div class="modal-body">

					<div class="form-group">
						<label for="" class="text-pks font-weight-bold">Title Ujian<span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="title_ujian" placeholder="Masukkan title Link...">
						<?= form_error('title_ujian', '<small class="text-danger">', '</small>') ?>
					</div>

					<div class="form-group">
						<label for="" class="text-pks font-weight-bold">Deskripsi Ujian<span class="text-danger">*</span></label>
						<textarea style="height: 200px" name="deskripsi_ujian" id="editor" placeholder="Masukkan deskripsi..."></textarea>
						<?= form_error('deskripsi_ujian', '<small class="text-danger">', '</small>') ?>
					</div>

					<div class="form-group">
						<label for="" class="text-pks font-weight-bold">Lama Pengerjaan<span class="text-danger">*</span></label>
						<input type="number" class="form-control" name="lama_pengerjaan" placeholder="Masukkan lama pengerjaan...">
						<?= form_error('lama_pengerjaan', '<small class="text-danger">', '</small>') ?>
					</div>

					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="" class="text-pks font-weight-bold">Tanggal Mulai Ujian<span class="text-danger">*</span></label>
								<input type="datetime-local" class="form-control" name="tanggal_mulai_ujian" placeholder="Masukkan lama pengerjaan...">
								<?= form_error('tanggal_mulai_ujian', '<small class="text-danger">', '</small>') ?>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="" class="text-pks font-weight-bold">Tanggal Akhir Ujian<span class="text-danger">*</span></label>
								<input type="datetime-local" class="form-control" name="tanggal_akhir_ujian" placeholder="Masukkan lama pengerjaan...">
								<?= form_error('tanggal_akhir_ujian', '<small class="text-danger">', '</small>') ?>
							</div>
						</div>
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
