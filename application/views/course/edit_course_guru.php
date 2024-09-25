
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
			<h2>Form Edit Materi</h2>
			<p>Form ini berguna untuk anda yang ingin memperbarui data materi!</p>
			<form method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="" class="text-pks font-weight-bold">Nama Course<span class="text-danger">*</span></label>
						<input type="text" class="form-control text-pks" name="nama" placeholder="Masukkan nama course..." value="<?=$course['nama_course'] ?>">
						<?= form_error('nama', '<small class="text-danger">', '</small>') ?>
					</div>

					<div class="form-group">
						<label class="text-pks font-weight-bold">Kelas<span class="text-danger">*</span></label>
						<select name="kelas" id="kelas" class="form-control select2">
							<?php foreach ($kelas as $kls): ?>
								<?php if ($kls['id_kelas'] == $course['kelas_id']): ?>
									<option selected="" value="<?=$kls['id_kelas'] ?>"><?=$kls['nama_kelas'] ?></option>
									<?php else : ?>
										<option value="<?=$kls['id_kelas'] ?>"><?=$kls['nama_kelas'] ?></option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
							<?= form_error('kelas', '<small class="text-danger">', '</small>') ?>
						</div>

						<div class="form-group">
							<label class="text-pks font-weight-bold">Mata Pelajaran<span class="text-danger">*</span></label>
							<select name="mapel" class="form-control select2">
								<?php foreach ($mapel as $mpl): ?>
								<?php if ($mpl['id_mapel'] == $course['mapel_id']): ?>
								<option selected value="<?=$mpl['id_mapel'] ?>"><?=$mpl['mapel'] ?></option>
								<?php else : ?>
									<option value="<?=$mpl['id_mapel'] ?>"><?=$mpl['mapel'] ?></option>
								<?php endif ?>
								<?php endforeach ?>
							</select>
							<?= form_error('mapel', '<small class="text-danger">', '</small>') ?>
						</div>

						<div class="form-group">
							<label for="" class="text-pks font-weight-bold">Deskripsi Course<span class="text-danger">*</span></label>
							<textarea name="deskripsi" id="editor" placeholder="Masukkan deskripsi..."><?=$course['deskripsi'] ?></textarea>
							<?= form_error('deskripsi', '<small class="text-danger">', '</small>') ?>
						</div>

						<div class="form-group">
							<label class="text-pks font-weight-bold">Foto Thumbnail</label><br>	
							<img style="height: 100px; width: 200px; object-fit: cover;" src="<?=base_url('assets/upload/thumbnail/').$course['thumbnail'] ?>">
						</div>

							<div class="form-group">
							<label class="text-pks font-weight-bold">Update Thumbnail</label>
							<input type="text" hidden="" name="oldthumbnail" value="<?=$course['thumbnail'] ?>">
							<input type="file" class="form-control" name="thumbnail">
						</div>


						<div class="form-group">
							<label class="text-pks font-weight-bold">Kunci Course<span class="text-danger">*</span></label>
							<input name="kunci" id="kunci" type="text" class="form-control" placeholder="Buat kunci untuk akses kelas..." value="<?=$course['kunci'] ?>">
							<?= form_error('kunci', '<small class="text-danger">', '</small>') ?>
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