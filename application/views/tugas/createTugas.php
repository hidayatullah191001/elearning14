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
			<h2>Form Tambah Tugas</h2>
			<p>Form ini berguna untuk anda menambahkan tugas baru!</p>
			<form method="post" action="<?=base_url('tugas/createTugas')?>" enctype="multipart/form-data">
					<input type="text" name="section_id" value="<?=$section['id_section'] ?>" hidden>
					<input type="text" name="course_uuid" value="<?=$section['uuid_course'] ?>" hidden>
					<div class="modal-body">
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Title tugas<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="title_tugas" placeholder="Masukkan title tugas...">
									<?= form_error('title_tugas', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Deadline tugas<span class="text-danger">*</span></label>
									<input type="datetime-local" class="form-control" name="deadline_tugas" placeholder="Masukkan deadline tugas...">
									<?= form_error('deskripsi_tugas', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="text-pks font-weight-bold">Deskripsi tugas<span class="text-danger">*</span></label>
							<textarea style="height: 200px" name="deskripsi_tugas" id="editor-tugas" placeholder="Masukkan deskripsi..."></textarea>
							<?= form_error('deskripsi_tugas', '<small class="text-danger">', '</small>') ?>
						</div>

						<div class="form-group">
							<label for="" class="text-pks font-weight-bold">File tugas</label>
							<input type="file" name="file_tugas" class="form-control">
							<?= form_error('file_tugas', '<small class="text-danger">', '</small>') ?>
						</div>

						<div class="form-group text-center mt-5">
							<button type="submit" class="btn btn-primary-form">Submit</button>
						</div>
					</div>
					<div>
						<small class="text-danger text-sm m-0">*Wajib Diisi</small><br>
						<small class="text-danger text-sm m-0">*Jenis file yang didukung : jpg, jpeg, png, doc, docx, ppt, pptx, xls, xlsx, rar, zip, pdf.</small><br>
					</div>
				</form>
		</div>
	</div>
