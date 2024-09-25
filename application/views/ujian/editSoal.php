
<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?></h3>
				<h6>Dibuat pada <?php date_default_timezone_set('Asia/Jakarta'); echo date('d F Y, H:i', $ujian['date_created_ujian']); ?></h6>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('ujian/view/').$ujian['id_ujian'] ?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke View Ujian</a>
			</div>
			<div class="d-none d-lg-block d-sm-none">
				<button data-toggle="modal" data-target="#deleteSoal<?=$ujian['id_relasi'] ?>" class="btn btn-delete btn-sm"><i class="fas fa-trash mr-2"></i> Delete this Soal</button>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<h2>Form Edit Soal Ujian</h2>
			<p>Form ini berguna untuk anda yang ingin memperbarui data soal ujian!</p>
			<form method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label>Soal<span class="text-danger">*</span></label>
						<textarea id="editor-soal" name="soal"><?=$ujian['soal'] ?></textarea>
						<?= form_error('soal', '<small class="text-danger">', '</small>') ?>
					</div>
					<div class="form-group">
						<label>Opsi A<span class="text-danger">*</span></label>
						<input type="text" name="opsi_a" class="form-control" placeholder="Masukkan opsi A" value="<?=$ujian['opsi_a'] ?>">
						<?= form_error('opsi_a', '<small class="text-danger">', '</small>') ?>
					</div>
					<div class="form-group">
						<label>Opsi B<span class="text-danger">*</span></label>
						<input type="text" name="opsi_b" class="form-control" placeholder="Masukkan opsi B" value="<?=$ujian['opsi_b'] ?>">
						<?= form_error('opsi_b', '<small class="text-danger">', '</small>') ?>
					</div>
					<div class="form-group">
						<label>Opsi C<span class="text-danger">*</span></label>
						<input type="text" name="opsi_c" class="form-control" placeholder="Masukkan opsi C" value="<?=$ujian['opsi_c'] ?>">
						<?= form_error('opsi_c', '<small class="text-danger">', '</small>') ?>
					</div>
					<div class="form-group">
						<label>Opsi D<span class="text-danger">*</span></label>
						<input type="text" name="opsi_d" class="form-control" placeholder="Masukkan opsi D" value="<?=$ujian['opsi_d'] ?>">
						<?= form_error('opsi_d', '<small class="text-danger">', '</small>') ?>
					</div>
					<div class="form-group">
						<label>Kunci Jawaban<span class="text-danger">*</span></label>
						<input type="text" name="kunci" class="form-control" placeholder="Ex : D" value="<?=$ujian['kunci_jawaban'] ?>">
						<?= form_error('kunci', '<small class="text-danger">', '</small>') ?>
					</div>
					<div class="form-group">
						<label>Aktif<span class="text-danger">*</span></label>
						<select class="form-control" name="aktif">
							<?php if ($ujian['aktif'] == 1): ?>
								<option selected="" value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
								<?php else : ?>
									<option selected="" value="0">Tidak Aktif</option>
									
									<option value="1">Aktif</option>
								<?php endif ?>
							</select>
							<?= form_error('kunci', '<small class="text-danger">', '</small>') ?>
						</div>				

						<div class="form-group text-center mt-5">
							<button type="submit" class="btn btn-primary-form">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<?php include FCPATH.'application/views/ujian/deleteSoal_modal.php' ?>

