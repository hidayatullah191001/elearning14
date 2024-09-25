
<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?> <?=$tugas['title_tugas'] ?></h3>
				<h6>Dibuat pada <?php date_default_timezone_set('Asia/Jakarta'); echo date('d F Y, H:i', $tugas['date_created_tugas']); ?></h6>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$tugas['course_uuid'] ?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke List Section</a>
			</div>
			<div class="d-none d-lg-block d-sm-none">
				<button data-toggle="modal" data-target="#deleteTugas<?=$tugas['id_tugas'] ?>" class="btn btn-delete btn-sm"><i class="fas fa-trash mr-2"></i> Delete this tugas</button>
			</div>
		</div>
	</div>

	<div>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active color-primary" id="tugas-siswa-tab" data-toggle="tab" href="#tugas-siswa" role="tab" aria-controls="tugas-siswa" aria-selected="true">Tugas Siswa</a>
			</li>
			<li class="nav-item">
				<a class="nav-link color-primary" id="edit-tugas-tab" data-toggle="tab" href="#edit-tugas" role="tab" aria-controls="edit-tugas" aria-selected="false">Form Edit Tugas</a>
			</li>
		</ul>	

		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="tugas-siswa" role="tabpanel" aria-labelledby="tugas-siswa-tab">
				<div class="card">
					<div class="card-body">
						<h2>Tugas Siswa</h2>
						<p>Dibawah ini merupakan tugas siswa yang telah mengumpulkan!</p>
						<br>
						<table class="table table-striped mb-0 mt-4" id="tabel-data">
							<thead>
								<tr>
									<th>File Tugas Siswa</th>
									<th>Waktu Submit</th>
									<th>Nama Siswa</th>
									<th>Status</th>
									<th>Nilai</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>                         
								<?php if (count($tugas_siswa) < 1): ?>
									<tr>
										<td colspan="6" class="text-center">Tugas siswa tidak ditemukan!</td>
									</tr>
									<?php else : ?>
										<?php foreach ($tugas_siswa as $ts): ?>
											<tr>
												<td>
													<a target="_blank" href="<?=base_url('assets/upload/tugasSiswa/').$ts['file_tugas'] ?>"><?php
													$kalimat = $ts['file_tugas'] ;
													$max = 20;
													$cetak = substr($kalimat, 0, $max);
													if (strlen($kalimat)>$max) {
														echo $cetak.'...';
													}else{
														echo $cetak;
													}?></a>
												</td>
												<td>
													<?php 
													date_default_timezone_set('Asia/Jakarta');
													echo date('d F Y, H:i', $ts['date_uploaded']); ?>
												</td>
												<td>
													<a href="#" class="font-weight-600" style="text-decoration: none"><img style="width: 30px; height: 30px; object-fit: cover;" src="<?=base_url('assets/upload/avatar/'.$ts['photo_profile']) ?>" alt="avatar" class="rounded-circle mr-1"><?=$ts['name'] ?></a>
												</td>
												<td>
													<?php if ($ts['status'] == "Pending"): ?>
														<span class="badge badge-danger"><?=$ts['status'] ?></span>
														<?php else : ?>
															<span class="badge badge-success"><?=$ts['status'] ?></span>
														<?php endif ?>
													</td>
													<td><?=$ts['nilai'] ?></td>
													<td>
														<button data-toggle="modal" data-target="#nilaiModal<?=$ts['id_tugas_siswa']?>" class="btn btn-edit btn-sm mr-1"><i class="fas fa-pencil-alt"></i> Edit</button>
														<button data-toggle="modal" data-target="#deletetugassiswa<?=$ts['id_tugas_siswa']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Delete</button>
													</td>
												</tr>
												<?php include 'nilai_modal.php' ?>
												<?php include 'deletetugassiswa_modal.php' ?>
											<?php endforeach ?>
										<?php endif ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>





					<div class="tab-pane fade " id="edit-tugas" role="tabpanel" aria-labelledby="edit-tugas-tab">
						<div class="card">
							<div class="card-body">
								<h2>Form Edit Tugas</h2>
								<p>Form ini berguna untuk anda yang ingin memperbarui data tugas!</p>

								<form method="post" enctype="multipart/form-data">
									<div class="modal-body">
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="" class="text-pks font-weight-bold">Title tugas<span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="title_tugas" placeholder="Masukkan title tugas..." value="<?=$tugas['title_tugas'] ?>">
													<?= form_error('title_tugas', '<small class="text-danger">', '</small>') ?>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="" class="text-pks font-weight-bold">Deadline tugas<span class="text-danger">*</span></label>
													<input type="datetime-local" class="form-control" name="deadline_tugas" placeholder="Masukkan deadline tugas..." value="<?=date('Y-m-d\TH:i', $tugas['deadline_tugas']); ?>">
													<?= form_error('deskripsi_tugas', '<small class="text-danger">', '</small>') ?>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="" class="text-pks font-weight-bold">Deskripsi tugas<span class="text-danger">*</span></label>
											<textarea style="height: 200px" name="deskripsi_tugas" id="editor-tugas" placeholder="Masukkan deskripsi..."><?=$tugas['deskripsi_tugas'] ?></textarea>
											<?= form_error('deskripsi_tugas', '<small class="text-danger">', '</small>') ?>
										</div>

										<?php if ($tugas['file_tugas'] != null): ?>
											<div class="form-group">
												<label for="" class="text-pks font-weight-bold">Unduh Materi Lama</label><br>
												<a class="btn btn-primary" href="<?=base_url('assets/upload/tugas/').$tugas['file_tugas'] ?>"><i class="fas fa-download" ></i> Download Disini</a>
												<input type="text" name="oldtugas" hidden="" value="<?=$tugas['file_tugas'] ?>">
											</div>
										<?php endif ?>

										<div class="form-group">
											<label for="" class="text-pks font-weight-bold">File Tugas Baru</label>
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
					</div>

				</div>

			</div>



			<!-- Bagian Tanya Jawab -->

			<div class="card mt-5">
				<div class="card-body">
					<h2>Tanya Jawab</h2>
					<p>Gunakan form ini bertanya jawab apapun!</p>


					<?php if (count($comments) < 1): ?>
						<br><br>
						<center>
							<img src="<?=base_url('assets/ui/') ?>assets/img/not_found.png">
							<h6>Tidak ada data tanya jawab!</h6>
						</center>

						<br><br>
						<?php else : ?>
							<br><br>
							<?php foreach ($comments as $comment): ?>
								<div class="card m-0 mb-2">
									<div class="card-body">
										<div class="row align-items-center m-0">
											<div class="col-lg-0">
												<img style="width: 50px; object-fit: cover; height: 50px" class="img-fluid" src="<?=base_url('assets/upload/avatar/').$comment['photo_profile']?>">
											</div>
											<div class="col-lg">
												<h6 class="m-0"><b><?=$user['name'] ?></b></h6>
												<small><?=date('H:i, d F Y', $comment['date_comment']) ?></small>
											</div>
											<div>
												<?php if ($user['id'] == $comment['id_user']): ?>
													<a href="<?=base_url('tugas/deleteComment/').$tugas['id_tugas'].'/'.$comment['id_comment'] ?>" class="btn btn-delete btn-sm w-100"><i class="fas fa-trash"></i> Delete</a>
												<?php endif ?>
											</div>
										</div>
										<style type="text/css">
											p{
												margin: 0px;
											}
										</style>
										<div class="mt-2">
											<?=$comment['text'] ?>
										</div>
									</div>
								</div>
							<?php endforeach ?>

						<?php endif ?>
						<br><br>

						<div class="card mt-5">
							<div class="card-body">
								<h2>Kirim Pesan</h2>
								<form method="post" action="<?=base_url('tugas/comment/').$tugas['id_tugas'].'/'.$tugas['id_section_comment'] ?>" class="mt-3" enctype="multipart/form-data">
									<input type="text" hidden="" name="id_user" value="<?=$user['id']?>">
									<div class="form-group">
										<label for="" class="text-pks font-weight-bold">Message<span class="text-danger">*</span></label>
										<textarea id="editor-comment" placeholder="Buat message..." name="message"></textarea>
										<?= form_error('title_materi', '<small class="text-danger">', '</small>') ?>
									</div>
									<div class="form-group">
										<button class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<?php include FCPATH.'application/views/tugas/deleteTugas_modal.php' ?>