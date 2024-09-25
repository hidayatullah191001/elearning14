
<section data-aos="fade-up" id="guru-info">
	<?=$this->session->flashdata('message') ?>
	<div class="row justify-content-between align-items-center m-0">
		<div>
			<h1><?=$title ?></h1>
			<p>Buat course kamu terlebih dahulu dan lakukan management content courses!</p>
		</div>
		<button data-toggle="modal" data-target="#createCourse" class="btn btn-primary"><i class="fas fa-fw fa-plus fa-sm mr-2"></i>Create Course</button>

	</div>
	<div class="mb-5"></div>
	<div class="row py-3">
		<div class="col-lg-7 col-md-5 col-sm-6">

			<?php if (count($courses) < 1): ?>
				<center>
					<img  src="<?=base_url('assets/ui/assets/img/ic_no_data.png') ?>">
					<h5>Oops!! Course yang kamu cari tidak ada. Coba Lagi!</h5>
				</center>
				<?php else : ?>
					<?php foreach ($courses as $course): ?>
						<a href="<?=base_url('course/detail/').$course['uuid'] ?>" style="color: inherit; text-decoration: none">
							<div class="card card-course mb-3">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-lg-5">
											<?php if ($course['thumbnail'] != null): ?>
												<img class="img-fluid-course" src="<?=base_url('assets/upload/thumbnail/') .$course['thumbnail']?>">
												<?php else : ?>
													<img class="img-fluid-course" src="<?=base_url('assets/ui/') ?>assets/img/learning.webp">
												<?php endif ?>
											</div>
											<div class="col">
												<h3><?=$course['nama_course'] ?></h3>

												<p class="badge badge-primary m-0"><i class="fas fa-fw fa-users"></i>
													<?php 
													$i = 0;
													foreach ($enroll_course as $ec): ?>
														<?php if ($ec['course_uuid'] == $course['uuid']): ?>
															<?php $i++; ?>
														<?php endif ?>
													<?php endforeach ?>
													<?=$i ?> Siswa Enroll</p>
													<p class="badge badge-warning m-0">Kelas : <?=$course['nama_kelas'] ?></p>
													<p class="badge badge-success">Tanggal Dibuat : <?=date('d F y', $course['date_created_course']) ?></p>
													<p class="badge <?=($course['is_publish'] == 1) ? 'badge-success' : 'badge-danger' ?>  mr-2"><i class="fas fa-fw fa-info"></i>Status : <?=($course['is_publish'] == 1) ? 'Publish' : 'Not Publish' ?></p>
													<?php
													$kalimat = $course['deskripsi'] ;
													$max = 150;
													$cetak = substr($kalimat, 0, $max);
													if (strlen($kalimat)>$max) {
														echo $cetak.'...';
													}else{
														echo $cetak;
													}?>
												</div>
											</div>
										</div>
									</div>
								</a>
							<?php endforeach ?>
						<?php endif ?>

					</div>
					<div class="col-lg-1"></div>
					<div class="col-lg-4">
						<h5>Search Course</h5>
						<form class="row align-items-center">
							<div class="col-lg-9">
								<input placeholder="Masukkan keyword..." type="text" name="search" class="form-control">
							</div>
							<div class="col">
								<button class="btn btn-primary">Cari</button>
							</div>
						</form>
						<div class="mt-5"></div>

						<h5>Platform's</h5>
						<a href="https://sman14plg.sch.id/" target="_blank" style="color: inherit; text-decoration: none">
							<div class="card card-category mb-2">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-lg-3 col-md-3 col-sm-3 col-3">
											<img class="img-fluid" src="<?=base_url('assets/ui/') ?>assets/img/sman14.png">
										</div>	
										<div class="col-lg col-md col-sm col">
											<b>SMA Negeri 14 Palembang</b>
										</div>
									</div>
								</div>
							</div>
						</a>
						<a href="https://perpussman14.site/" target="_blank" style="color: inherit; text-decoration: none">
							<div class="card card-category mb-2">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-lg-3 col-md-3 col-sm-3 col-3">
											<img class="img-fluid" src="<?=base_url('assets/ui/') ?>assets/img/perpustakaan.png">
										</div>	
										<div class="col-lg col-md col-sm col">
											<b>Perpustakaan Digital SMA Negeri 14 Palembang</b>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>

			</section>
		</div>


		<div class="modal fade" id="createCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
			<div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div style="border-radius: 30px" class="modal-content border-0">
					<div class="modal-body p-5">
						<h1 style="font-weight: 500; ">Create<br/>New Course</h1>
						<form method="post" enctype="multipart/form-data">
							<div class="modal-body">

								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Nama Course</label>
									<input type="text" class="form-control text-pks" name="nama" placeholder="Masukkan nama mata pelajaran...">
									<?= form_error('nama', '<small class="text-danger">', '</small>') ?>
								</div>

								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Kelas</label>
									<select id="kelas" class="form-control" name="kelas">
										<option selected="" disabled="">Pilih Kelas</option>
										<?php foreach ($kelas as $kls): ?>
											<option value="<?=$kls['id_kelas'] ?>" name="kelas_id"><?=$kls['nama_kelas'] ?></option>
										<?php endforeach ?>
									</select>
									<?= form_error('kelas', '<small class="text-danger">', '</small>') ?>
								</div>

								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Mata Pelajaran</label>
									<select class="form-control" name="mapel">
										<option selected="" disabled="">Pilih Mata Pelajaran</option>
										<?php foreach ($mapel as $mpl): ?>
											<option value="<?=$mpl['id_mapel'] ?>" name="mapel_id"><?=$mpl['mapel'] ?></option>
										<?php endforeach ?>
									</select>
									<?= form_error('mapel', '<small class="text-danger">', '</small>') ?>
								</div>

								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Deskripsi Course</label>
									<textarea name="deskripsi" id="editor" placeholder="Masukkan deskripsi..."></textarea>
									<?= form_error('deskripsi', '<small class="text-danger">', '</small>') ?>
								</div>

								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Thumbnail</label>
									<input type="file" name="thumbnail" class="form-control">
								</div>

								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Kunci Course</label>
									<input type="text" name="kunci" class="form-control" placeholder="Masukkan kunci course...">
									<?= form_error('kunci', '<small class="text-danger">', '</small>') ?>
								</div>

								<div class="form-group text-center mt-5">
									<button type="submit" class="btn btn-primary-form w-100">Submit</button>
								</div>
								<div class="form-group text-center mt-1">
									<button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Cancel</p></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>