
<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?> <?=$ujian['title_ujian'] ?></h3>
				<h6>Dibuat pada <?php date_default_timezone_set('Asia/Jakarta'); echo date('d F Y, H:i', $ujian['date_created_ujian']); ?></h6>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$ujian['course_uuid'] ?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke List Section</a>
			</div>
			<div class="d-none d-lg-block d-sm-none">
				<button data-toggle="modal" data-target="#deleteUjian<?=$ujian['id_ujian'] ?>" class="btn btn-delete btn-sm"><i class="fas fa-trash mr-2"></i> Delete this Ujian</button>
			</div>
		</div>
	</div>

	<div>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active color-primary" id="ujian-siswa-tab" data-toggle="tab" href="#ujian-siswa" role="tab" aria-controls="ujian-siswa" aria-selected="true">Hasil Ujian Siswa</a>
			</li>
			<li class="nav-item">
				<a class="nav-link color-primary" id="edit-ujian-tab" data-toggle="tab" href="#edit-ujian" role="tab" aria-controls="edit-ujian" aria-selected="false">Form Edit Ujian</a>
			</li>
		</ul>	

		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="ujian-siswa" role="tabpanel" aria-labelledby="tugas-siswa-tab">
				<div class="card">
					<div class="card-body">
						<table class="table table-hover" id="tabel-data">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Siswa</th>
									<th>Waktu Mulai Ujian</th>
									<th>Status</th>
									<th>Jumlah Benar</th>
									<th>Jumlah Salah</th>
									<th>Nilai</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								foreach ($hasil_ujian as $hu): ?>
									<tr>
										<td><?=$i++?></td>
										<td><a href="#" class="font-weight-600" style="text-decoration: none"><img style="width: 30px; height: 30px; object-fit: cover;" src="<?=base_url('assets/upload/avatar/'.$hu['photo_profile']) ?>" alt="avatar" class="rounded-circle mr-1"><?=$hu['name'] ?></a></td>
										<td><?=date('d F Y, H:i', $hu['date_start'])?></td>
										<td>
											<?php if ($hu['status_ujian'] == 'Selesai'): ?>
												<span class="badge badge-success"><?=$hu['status_ujian'] ?></span>
												<?php else : ?>
													<span class="badge badge-danger"><?=$hu['status_ujian'] ?></span>
												<?php endif ?>
											</td>
											<td><?=$hu['jumlah_benar']?></td>
											<td><?=$hu['jumlah_salah']?></td>
											<td><?=$hu['hasil_nilai']?></td>
											<td>
												<button data-toggle="modal" data-target="#deleteUjianSiswa<?=$hu['id_ujian_siswa']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Delete</button>
											</td>
										</tr>
										<?php include 'deleteujiansiswa.php' ?>

									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="tab-pane fade show" id="edit-ujian" role="tabpanel" aria-labelledby="edit-ujian-tab">
					<div class="card">
						<div class="card-body">
							<h2>Form Edit Ujian</h2>
							<p>Form ini berguna untuk anda yang ingin memperbarui data ujian!</p>
							<form method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="form-group">
										<label for="" class="text-pks font-weight-bold">Title Ujian<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="title_ujian" placeholder="Masukkan title ujian..." value="<?=$ujian['title_ujian'] ?>">
										<?= form_error('title_ujian', '<small class="text-danger">', '</small>') ?>
									</div>

									<div class="form-group">
										<label for="" class="text-pks font-weight-bold">Deskripsi Ujian<span class="text-danger">*</span></label>
										<textarea style="height: 200px" name="deskripsi_ujian" id="editor" placeholder="Masukkan deskripsi..."><?=$ujian['deskripsi_ujian'] ?></textarea>
										<?= form_error('deskripsi_ujian', '<small class="text-danger">', '</small>') ?>
									</div>

									<div class="form-group">
										<label for="" class="text-pks font-weight-bold">Lama Pengerjaan<span class="text-danger">*</span></label>
										<input type="number" class="form-control" name="lama_pengerjaan" placeholder="Masukkan lama pengerjaan..." value="<?=$ujian['lama_pengerjaan'] ?>">
										<?= form_error('lama_pengerjaan', '<small class="text-danger">', '</small>') ?>
									</div>

									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="" class="text-pks font-weight-bold">Tanggal Mulai Ujian<span class="text-danger">*</span></label>
												<input type="datetime-local" class="form-control" name="tanggal_mulai_ujian" placeholder="Masukkan lama pengerjaan..." value="<?=date('Y-m-d\TH:i', $ujian['tanggal_mulai_ujian']); ?>">
												<?= form_error('tanggal_mulai_ujian', '<small class="text-danger">', '</small>') ?>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="" class="text-pks font-weight-bold">Tanggal Akhir Ujian<span class="text-danger">*</span></label>
												<input type="datetime-local" class="form-control" name="tanggal_akhir_ujian" placeholder="Masukkan lama pengerjaan..." value="<?=date('Y-m-d\TH:i', $ujian['tanggal_akhir_ujian']); ?>">
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
				</div>
			</div>
			<div>

				<div class="card mt-5">
					<div class="card-body">
						<h2>Soal Ujian</h2>
						<p>Tabel ini berisi data berupa soal-soal ujian yang dibuat!</p>
						<button data-toggle="modal" data-target="#createSoal" class="btn btn-primary mb-5"><i class="fas fa-fw fa-plus"></i> Buat Soal</button>
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Soal</th>
									<th scope="col">Kunci Jawaban</th>
									<th scope="col">Tanggal Buat</th>
									<th scope="col">Aktif</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								foreach ($soal_ujian as $su): ?>
									<tr>
										<td><?=$i++ ?></td>
										<td>
											<?php
											$kalimat = $su['soal'] ;
											$max = 35;
											$cetak = substr($kalimat, 0, $max);
											if (strlen($kalimat)>$max) {
												echo $cetak.'...';
											}else{
												echo $cetak;
											}?>
										</td>
										<td><?=$su['kunci_jawaban'] ?></td>
										<td>
											<?=date('d F Y, H:i', $su['date_created_soal']); ?>
										</td>
										<td>
											<?php if ($su['aktif'] != 1): ?>
												<span class="badge badge-danger">Tidak Aktif</span>
												<?php else : ?>
													<span class="badge badge-success">Aktif</span>
												<?php endif ?>
											</td>
											<td>
												<a href="<?=base_url('ujian/editSoal/'.$su['id_relasi']); ?>" class="btn btn-edit btn-sm mr-1"><i class="fas fa-pencil-alt"></i> Edit</a>
												<button data-toggle="modal" data-target="#deleteSoal<?=$su['id_relasi']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Delete</button>
											</td>
										</tr>
										<?php include 'delete_soal.php' ?>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>


					<?php include FCPATH.'application/views/ujian/deleteUjian_modal.php' ?>


					<div class="modal fade" id="createSoal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
						<div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div style="border-radius: 30px" class="modal-content border-0">
								<div class="modal-body p-5">
									<h1 style="font-weight: 500; ">Create<br/>New Video Section</h1>
									<form action="<?=base_url('ujian/createSoal/').$ujian['id_ujian'] ?>" method="post">
										<div class="form-group">
											<label>Soal<span class="text-danger">*</span></label>
											<textarea id="editor-soal" name="soal"></textarea>
										</div>
										<div class="form-group">
											<label>Opsi A<span class="text-danger">*</span></label>
											<input type="text" name="opsi_a" class="form-control" placeholder="Masukkan opsi A">
										</div>
										<div class="form-group">
											<label>Opsi B<span class="text-danger">*</span></label>
											<input type="text" name="opsi_b" class="form-control" placeholder="Masukkan opsi B">
										</div>
										<div class="form-group">
											<label>Opsi C<span class="text-danger">*</span></label>
											<input type="text" name="opsi_c" class="form-control" placeholder="Masukkan opsi C">
										</div>
										<div class="form-group">
											<label>Opsi D<span class="text-danger">*</span></label>
											<input type="text" name="opsi_d" class="form-control" placeholder="Masukkan opsi D">
										</div>
										<div class="form-group">
											<label>Kunci Jawaban<span class="text-danger">*</span></label>
											<input type="text" name="kunci" class="form-control" placeholder="Ex : D">
										</div>

										<div class="form-group text-center mt-5">
											<button type="submit" class="btn btn-primary-form w-100">Submit</button>
										</div>
										<div class="form-group text-center mt-1">
											<button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Cancel</p></button>
										</div>

										<span class="text-danger">*Wajib Diisi</span><br>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>


			<script>
				$('#createSoal').appendTo("body");
			</script>
