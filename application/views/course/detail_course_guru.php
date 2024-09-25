
<section data-aos="fade-up" id="guru-info">
	<?=$this->session->flashdata('message') ?>

	<div class="row mb-5 align-items-center">
		<div class="col-lg-7">
			<img class="img-fluid" src="<?=base_url('assets/upload/thumbnail/').$course['thumbnail']?>">
		</div>
		<div class="col">
			<div class="row m-0 mt-4">
				<p class="badge <?=($course['is_publish'] == 1) ? 'badge-success' : 'badge-danger' ?>  mr-2"><i class="fas fa-fw fa-info"></i>Status : <?=($course['is_publish'] == 1) ? 'Publish' : 'Not Publish' ?></p>
				<p class="badge badge-primary"> <i class="fas fa-fw fa-calendar"></i> Tanggal Dibuat : <?=date('d F Y', $course['date_created_course']) ?></p>
			</div>
			<h1>Course <?=$course['nama_course'] ?></h1>
			<p><?=$course['deskripsi'] ?></p>
			<center>
				<a href="<?=base_url('course/editCourse/').$course['uuid'] ?>" class="btn btn-edit mb-3"><i class="fas fa-fw fa-pen"></i> Edit Course</a>
				<a href="<?=base_url('course/publishCourse/').$course['uuid'] ?>" class="mb-3 btn <?=($course['is_publish'] == 0) ? 'btn-berhasil' : 'btn-delete' ?>"><i class="fas <?=($course['is_publish'] == 0) ? 'fa-upload' : 'fa-download' ?>"></i><?=($course['is_publish'] == 0) ? ' Publish Course' : ' Tidak Publish' ?></a>
				<a href="<?=base_url('course/enrollUsers/').$course['uuid'] ?>" class="btn btn-delete mb-3"><i class="fas fa-fw fa-users"></i> Data Siswa</a>

				<a href="<?=base_url('absensi?course=').$course['uuid'] ?>" class="btn btn-lihat mb-3"><i class="fas fa-fw fa-tasks"></i> Absensi Siswa</a>
				<a href="<?=base_url('course/forumCourse/').$course['uuid'] ?>" class="btn btn-lihat mb-3"><i class="fas fa-fw fa-comments"></i> Diskusi</a>
				<a href="<?=base_url('course/annoucementCourse/').$course['uuid'] ?>" class="btn btn-lihat mb-3"><i class="fas fa-fw fa-bullhorn"></i> Annoucement</a>
				<a href="#" data-target="#deleteCourse<?=$course['uuid'] ?>" data-toggle="modal" class="btn btn-delete mb-3"><i class="fas fa-fw fa-trash"></i> Delete This Course</a>
				<?php include 'deleteCourse.php'; ?>
			</center>
		</div>
	</div>

	<div class="section">
		<div class="section-header">
			<div class="row m-0 justify-content-between align-items-center">
				<div>
					<h3 style="margin: 0px">Content Course</h3>
					<p class="color-black" style="margin: 0px">Create course section here</p>
				</div>
				<div>
					<button class="btn btn-primary" data-toggle="modal" data-target="#createSection"><i class="fas fa-fw fa-plus mr-2"></i>Create</button>
				</div>
			</div>
		</div>
		<div class="section-body">
			<?php if (count($sections) < 1): ?>
				<div class="text-center">
					<img style="width: 200px" src="<?=base_url('assets/ui/')?>assets/img/nodocument.png">
					<h4><b>Woo, Nothing Here</b></h4>
					<p class="color-dark">You don't have any section in this Course</p>
				</div>
				<?php else : ?>
					<?php foreach ($sections as $section): ?>
						<div class="section-background mb-4">
							<div class="row m-0 justify-content-between align-items-center mb-5">
								<h4 style="margin: 0px;"><b><?=$section['nama_section'] ?></b></h4>
								<div class="btn-group">
									<button type="button" class="btn btn-edit dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Tambah
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<button class="dropdown-item btn btn-light" data-toggle ="modal" data-target="#createVideo<?=$section['id_section'] ?>">Video</button>
										<a class="dropdown-item" href="<?=base_url('materi/createMateri/').$section['id_section']?>">Materi</a>
										<a class="dropdown-item" href="<?=base_url('tugas/createTugas/').$section['id_section'] ?>">Tugas</a>
										<a class="dropdown-item" href="<?=base_url('link/createLink/').$section['id_section'] ?>">Link</a>
										<a class="dropdown-item" href="<?=base_url('catatan/createCatatan/').$section['id_section'] ?>">Catatan</a>
										<a class="dropdown-item" href="<?=base_url('ujian/createUjian/').$section['id_section'] ?>">Ujian</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item text-danger" href="<?=base_url('course/delete_section/').$section['uuid_course'].'/'.$section['id_section'] ?>">Hapus Section</a>
									</div>
								</div>
							</div>
							<?php foreach ($videos as $video): ?>
								<?php if ($video['id_section'] == $section['id_section']): ?>
									<a href="<?=base_url('video/editVideo/').$video['id_video'] ?>" style="color: inherit; text-decoration: none">
										<div class="card-section mb-2">
											<div class="row d-flex justify-content-between align-items-center m-0">
												<div  class="col-lg col d-flex align-items-center">
													<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/video_icon.png">
													<h6 class="color-black" style="margin-top: 8px"><?=$video['title_video'] ?></h6>
												</div>
												<div class="d-none d-lg-block d-md-block d-sm-block">
													<a href="<?=base_url('video/editVideo/').$video['id_video'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteVideo<?=$video['id_video']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
												<div class="col-lg text-center d-sm-none">
													<a href="<?=base_url('video/editVideo/').$video['id_video'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteVideo<?=$video['id_video']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
											</div>
										</div>		
									</a>
									<?php include FCPATH.'application/views/video/deleteVideo_modal.php' ?>
								<?php endif ?>
							<?php endforeach ?>			

							<?php foreach ($materis as $materi): ?>
								<?php if ($materi['id_section'] == $section['id_section']): ?>
									<a href="<?=base_url('materi/editMateri/').$materi['id_materi'] ?>" style="color: inherit; text-decoration: none">
										<div class="card-section mb-2">
											<div class="row d-flex justify-content-between align-items-center m-0">
												<div  class="col-lg col d-flex align-items-center">
													<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/materi_icon.png">
													<h6 class="color-black" style="margin-top: 8px"><?=$materi['title_materi'] ?></h6>
												</div>
												<div class="d-none d-lg-block d-md-block d-sm-block">
													<a href="<?=base_url('materi/editMateri/').$materi['id_materi'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteMateri<?=$materi['id_materi']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
												<div class="col-lg text-center d-sm-none">
													<a href="<?=base_url('materi/editMateri/').$materi['id_materi'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteMateri<?=$materi['id_materi']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
											</div>
										</div>	
									</a>	
									<?php include FCPATH.'application/views/materi/deleteMateri_modal.php' ?>
								<?php endif ?>
							<?php endforeach ?>

							<?php foreach ($tugass as $tugas): ?>
								<?php if ($tugas['id_section'] == $section['id_section']): ?>
									<a href="<?=base_url('tugas/editTugas/').$tugas['id_tugas'] ?>" style="color: inherit; text-decoration: none" >
										<div class="card-section mb-2">
											<div class="row d-flex justify-content-between align-items-center m-0">
												<div  class="col-lg col d-flex align-items-center">
													<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/tugas_icon.png">
													<h6 class="color-black" style="margin-top: 8px"><?=$tugas['title_tugas'] ?></h6>
												</div>
												<div class="d-none d-lg-block d-md-block d-sm-block">
													<a href="<?=base_url('tugas/editTugas/').$tugas['id_tugas'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteTugas<?=$tugas['id_tugas']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
												<div class="col-lg text-center d-sm-none">
													<a href="<?=base_url('tugas/editTugas/').$tugas['id_tugas'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteTugas<?=$tugas['id_tugas']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
											</div>
										</div>		
									</a>
									<?php include FCPATH.'application/views/tugas/deleteTugas_modal.php' ?>
								<?php endif ?>
							<?php endforeach ?>

							<?php foreach ($links as $link): ?>
								<?php if ($link['id_section'] == $section['id_section']): ?>
									<a href="<?=base_url('link/editLink/').$link['id_link'] ?>" style="color: inherit; text-decoration: none">
										<div class="card-section mb-2">
											<div class="row d-flex justify-content-between align-items-center m-0">
												<div  class="col-lg col d-flex align-items-center">
													<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/link_icon.png">
													<h6 class="color-black" style="margin-top: 8px"><?=$link['title_link'] ?></h6>
												</div>
												<div class="d-none d-lg-block d-md-block d-sm-block">
													<a href="<?=base_url('link/editLink/').$link['id_link'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteLink<?=$link['id_link']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
												<div class="col-lg text-center d-sm-none">
													<a href="<?=base_url('link/editLink/').$link['id_link'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteLink<?=$link['id_link']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
											</div>
										</div>	
									</a>	
									<?php include FCPATH.'application/views/link/deleteLink_modal.php' ?>
								<?php endif ?>
							<?php endforeach ?>

							<?php foreach ($catatans as $catatan): ?>
								<?php if ($catatan['id_section'] == $section['id_section']): ?>
									<a href="<?=base_url('catatan/editCatatan/').$catatan['id_catatan'] ?>"  style="color: inherit; text-decoration: none">
										<div class="card-section mb-2">
											<div class="row d-flex justify-content-between align-items-center m-0">
												<div  class="col-lg col d-flex align-items-center">
													<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/notes_icon.png">
													<h6 class="color-black" style="margin-top: 8px"><?=$catatan['title_catatan'] ?></h6>
												</div>
												<div class="d-none d-lg-block d-md-block d-sm-block">
													<a href="<?=base_url('catatan/editCatatan/').$catatan['id_catatan'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteCatatan<?=$catatan['id_catatan']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
												<div class="col-lg text-center d-sm-none">
													<a href="<?=base_url('catatan/editCatatan/').$catatan['id_catatan'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteCatatan<?=$catatan['id_catatan']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
											</div>
										</div>	
									</a>	
									<?php include FCPATH.'application/views/catatan/deleteCatatan_modal.php' ?>
								<?php endif ?>
							<?php endforeach ?>

							<?php foreach ($ujians as $ujian): ?>
								<?php if ($ujian['id_section'] == $section['id_section']): ?>
									<a href="<?=base_url('ujian/view/').$ujian['id_ujian'] ?>" style="color: inherit; text-decoration: none">
										<div class="card-section mb-2">
											<div class="row d-flex justify-content-between align-items-center m-0">
												<div  class="col-lg col d-flex align-items-center">
													<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/ujian_icon.png">
													<h6 class="color-black" style="margin-top: 8px"><?=$ujian['title_ujian'] ?></h6>
												</div>
												<div class="d-none d-lg-block d-md-block d-sm-block">
													<a href="<?=base_url('ujian/editUjian/').$ujian['id_ujian'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteUjian<?=$ujian['id_ujian']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
												<div class="col-lg text-center d-sm-none">
													<a href="<?=base_url('ujian/editUjian/').$ujian['id_ujian'] ?>" class="btn btn-berhasil btn-sm mr-2"><i class="fas fa-eye"></i> Lihat</a>
													<button data-toggle="modal" data-target="#deleteUjian<?=$ujian['id_ujian']?>" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
												</div>
											</div>
										</div>		
									</a>
									<?php include FCPATH.'application/views/ujian/deleteUjian_modal.php' ?>
								<?php endif ?>
							<?php endforeach ?>
						</div>
						<?php include FCPATH.'application/views/video/createVideo_modal.php' ?>
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>
	</section>
</div>


<div class="modal fade" id="createSection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
	<div  class="modal-dialog modal-dialog-centered" role="document">
		<div style="border-radius: 30px" class="modal-content border-0">
			<div class="modal-body p-5">
				<h1 style="font-weight: 500; ">Create<br/>New Section</h1>
				<form method="post" action="<?= base_url('course/create_section/').$course['uuid'] ?>">
					<div class="modal-body">
						<div class="form-group">
							<label for="" class="text-pks font-weight-bold">Nama Section</label>
							<input type="text" class="form-control text-pks" name="nama" placeholder="Masukkan nama section...">
							<?= form_error('nama', '<small class="text-danger">', '</small>') ?>
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
</div>


