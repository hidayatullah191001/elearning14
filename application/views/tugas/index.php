
<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$tugas['title_tugas'] ?></h3>
				<h6>Dibuat pada <?= date('d F Y, H:i', $tugas['date_created_tugas']); ?></h6>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$tugas['course_uuid'] ?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke List Section</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg">
			<div>
				<h5 style="font-weight: 600">Deskripsi</h5>
				<?=$tugas['deskripsi_tugas'] ?>
				<div class="mt-5"></div>
			</div>
			<div>
				<h5 style="font-weight: 600">Deadline Tugas</h5>
				<i class="fas fa-calendar mr-2 text-danger"></i><span class="text-danger" style="font-weight: 500"><?=date('d F Y, H:i', $tugas['deadline_tugas']);?></span>
				<div class="mt-5"></div>
			</div>
			<?php if ($tugas['file_tugas'] != null): ?>
				<h5 style="font-weight: 600">Lampiran File Tugas</h5>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('assets/upload/tugas/').$tugas['file_tugas'] ?>"><i class="fas fa-download mr-2"></i>Download Lampiran File Tugas</a>			
				<div class="mt-5"></div>
			<?php endif ?>
		</div>
		<div class="col-lg-7">
			<?php if ($tugas['file_tugas'] != null): ?>
				<?php 
				if (time() > $tugas['deadline_tugas']): ?>
					<center>
						<img width="100" src="<?=base_url('assets/ui/')?>assets/img/ic_clock.png">
						<h5>Maaf, pengumpulan tugas telah ditutup!</h5>
					</center>
					<?php else : ?>
						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header bg-primary" id="headingOne">
									<h2 class="mb-0">
										<button class="m-0 p-0 btn btn-link btn-block text-left color-white" style="font-size: 18px; font-weight: 600; text-decoration: none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Upload Tugas
										</button>
									</h2>
								</div>
								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
									<div class="card-body">
										<form enctype="multipart/form-data" method="post">
											<p>File Tugas :</p>
											<input type="file" name="file_tugas" class="form-control mb-2" required="">
											<p>Catatan Tugas :</p>
											<textarea class="form-control mb-2" name="catatan_siswa" placeholder="Buat Cataan Tugas"></textarea>
											<?= form_error('catatan_siswa', '<small class="text-danger">', '</small>') ?><br>
											<small class="text-danger">*Jenis file yang didukung : jpg, jpeg, png, doc, docx, ppt, pptx, xls, xlsx, rar, zip, pdf.</small><br>
											<small class="text-danger">*Tugas yang diserahkan tidak dapat dihapus. Harap periksa dengan benar</small>
											<center>
												<button class="mt-4 btn btn-primary"><i class="fas fa-paper-plane mr-2"></i>Serahkan Tugas</button>
											</center>
										</form>
									</div>
								</div>
							</div>
						</div>
					<?php endif ?>

					<?php if (count($tugas_siswa) > 0): ?>
						<div class="table-responsive">
							<table class="table table-sm mt-5">
								<thead>
									<tr class="text-center">
										<th scope="col">No</th>
										<th scope="col">Waktu Submit</th>
										<th scope="col">File</th>
										<th scope="col">Catatan</th>
										<th scope="col">Status</th>
										<th scope="col">Nilai</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i=1;
									foreach ($tugas_siswa as $ts): ?>
										<tr class="text-center">
											<th scope="row"><?=$i++ ?></th>
											<td><?=date('d F Y, H:i', $ts['date_uploaded']); ?></td>
											<td><a target="_blank" href="<?=base_url('assets/upload/tugas_siswa/').$ts['file_tugas'] ?>">
												<?php
												$kalimat = $ts['file_tugas'] ;
												$max = 10;
												$cetak = substr($kalimat, 0, $max);
												if (strlen($kalimat)>$max) {
													echo $cetak.'...';
												}else{
													echo $cetak;
												}?></a></td>
												<td>
													<?php
													$kalimat = $ts['catatan_tugas_siswa'] ;
													$max = 10;
													$cetak = substr($kalimat, 0, $max);
													if (strlen($kalimat)>$max) {
														echo $cetak.'...';
													}else{
														echo $cetak;
													}?></td>
													<td>
														<?php if ($ts['status'] == 'Pending'): ?>
															<span class="badge badge-danger">Pending</span>
															<?php else: ?>
																<span class="badge badge-success">Success</span>
															<?php endif ?>
														</td>
														<td><?=$ts['nilai'] ?></td>
														<td>
															<button data-toggle="modal" data-target="#detailtugas<?=$ts['id_tugas_siswa']?>" class="btn btn-warning btn-sm mr-1" title="Lihat"><i class="fas fa-eye"></i></button>
														</td>
													</tr>
													<?php include 'detailtugas_modal.php' ?>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
								<?php endif ?>
							<?php endif ?>
						</div>
					</div>
					<br><br>

					<!-- Bagian Tanya Jawan -->

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
														<h6 class="m-0"><b><?=$comment['name'] ?></b></h6>
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