<style type="text/css">
	.link-section-header{
		color: inherit; 
		text-decoration: none;
		transition: 0.2s;
	}

	.link-section-header:hover{
		color: #335EF7;
		text-decoration:none;
	}
</style>
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
			<div class="row">
				<?php if ($forum != null): ?>
					<div class="col">
						<a href="<?=base_url('forum?id=').$forum['id_forum'] ?>" class="btn btn-lihat w-100 btn-sm"><i class="fas fa-fw fa-comments"></i> Forum Diskusi</a>
					</div>
				<?php endif?>
				<?php if ($count_pengumuman > 0): ?>
					
					<div class="col">
						<a href="<?=base_url('course/annoucementCourse/').$course['uuid'] ?>" class="btn btn-lihat w-100 btn-sm"><i class="fas fa-fw fa-bullhorn"></i> Annoucement <span class="badge badge-pill badge-danger"><?=$count_pengumuman ?></span></a>
					</div>
				<?php endif ?>
			</div>
			<button data-toggle="modal" data-target="#unenrollCourse<?=$course['id_enroll'] ?>" class="btn btn-delete btn-sm w-100 mt-2"><i class="fas fa-fw fa-sign-out-alt"></i>Unenroll Course</button>
			<?php include 'unenroll_modal.php' ?>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8">
			<div class="section">
				<div class="section-header">
					<div class="row m-0 justify-content-between align-items-center">
						<div>
							<h3 style="margin: 0px"><i class="fas fa-fw fa-school"></i> Content Course</h3>
							<p class="color-black" style="margin: 0px">This is content course!</p>
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
									</div>
									<?php foreach ($videos as $video): ?>
										<?php if ($video['id_section'] == $section['id_section']): ?>
											<a href="<?=base_url('video?id=').$video['id_video'] ?>" style="color: inherit; text-decoration: none">
												<div class="card-section mb-2">
													<div class="row d-flex justify-content-between align-items-center m-0">
														<div  class="col-lg col d-flex align-items-center">
															<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/video_icon.png">
															<h6 class="color-black" style="margin-top: 8px"><?=$video['title_video'] ?></h6>
														</div>
													</div>
												</div>		
											</a>
										<?php endif ?>
									<?php endforeach ?>			

									<?php foreach ($materis as $materi): ?>
										<?php if ($materi['id_section'] == $section['id_section']): ?>
											<a href="<?=base_url('materi?id=').$materi['id_materi'] ?>" style="color: inherit; text-decoration: none">
												<div class="card-section mb-2">
													<div class="row d-flex justify-content-between align-items-center m-0">
														<div  class="col-lg col d-flex align-items-center">
															<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/materi_icon.png">
															<h6 class="color-black" style="margin-top: 8px"><?=$materi['title_materi'] ?></h6>
														</div>
													</div>
												</div>	
											</a>
										<?php endif ?>
									<?php endforeach ?>

									<?php foreach ($tugass as $tugas): ?>
										<?php if ($tugas['id_section'] == $section['id_section']): ?>
											<a href="<?=base_url('tugas?id=').$tugas['id_tugas'] ?>" style="color: inherit; text-decoration: none" >
												<div class="card-section mb-2">
													<div class="row d-flex justify-content-between align-items-center m-0">
														<div  class="col-lg col d-flex align-items-center">
															<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/tugas_icon.png">
															<h6 class="color-black" style="margin-top: 8px"><?=$tugas['title_tugas'] ?></h6>
														</div>
													</div>
												</div>		
											</a>
										<?php endif ?>
									<?php endforeach ?>

									<?php foreach ($links as $link): ?>
										<?php if ($link['id_section'] == $section['id_section']): ?>
											<a href="<?=base_url('link?id=').$link['id_link'] ?>" style="color: inherit; text-decoration: none">
												<div class="card-section mb-2">
													<div class="row d-flex justify-content-between align-items-center m-0">
														<div  class="col-lg col d-flex align-items-center">
															<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/link_icon.png">
															<h6 class="color-black" style="margin-top: 8px"><?=$link['title_link'] ?></h6>
														</div>
													</div>
												</div>	
											</a>
										<?php endif ?>
									<?php endforeach ?>

									<?php foreach ($catatans as $catatan): ?>
										<?php if ($catatan['id_section'] == $section['id_section']): ?>
											<a href="<?=base_url('catatan?id=').$catatan['id_catatan'] ?>"  style="color: inherit; text-decoration: none">
												<div class="card-section mb-2">
													<div class="row d-flex justify-content-between align-items-center m-0">
														<div  class="col-lg col d-flex align-items-center">
															<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/notes_icon.png">
															<h6 class="color-black" style="margin-top: 8px"><?=$catatan['title_catatan'] ?></h6>
														</div>
													</div>
												</div>	
											</a>
										<?php endif ?>
									<?php endforeach ?>

									<?php foreach ($ujians as $ujian): ?>
										<?php if ($ujian['id_section'] == $section['id_section']): ?>
											<a href="<?=base_url('ujian?id=').$ujian['id_ujian'] ?>" style="color: inherit; text-decoration: none">
												<div class="card-section mb-2">
													<div class="row d-flex justify-content-between align-items-center m-0">
														<div  class="col-lg col d-flex align-items-center">
															<img class="mr-4" width="70" src="<?=base_url('assets/ui/') ?>assets/img/ujian_icon.png">
															<h6 class="color-black" style="margin-top: 8px"><?=$ujian['title_ujian'] ?></h6>
														</div>
													</div>
												</div>		
											</a>
										<?php endif ?>
									<?php endforeach ?>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
				</div>
			</div>
			<div class="col-lg">
				<div class="section" style="margin-bottom: 100px">
					<div class="section-header">
						<div class="row m-0 justify-content-between align-items-center">
							
							<a class="link-section-header" href="<?=base_url('absensi?course=').$course['uuid'] ?>">
								<h3 style="margin: 0px"><i class="fas fa-fw fa-calendar"></i> Attendance</h3>
								<p class="color-black" style="margin: 0px">This is Attendance Course</p>
							</a>
						</div>
					</div>


					<div class="section-body">
						<?php if (count($absensis) < 1): ?>
							<div class="col text-center">
								<img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_calendar.png">
								<h5 class="mb-5" style="font-weight: 700">Belum ada absensi!</h5>
							</div>
							<?php else : ?>
								<div class="section-background">
									<?php
									$now = time();
									$time_now = date('H:i', $now);
									$date_now = date('d F Y', $now);
									foreach ($absensis as $ab) :?>
										<div class="card-section mb-2">
											<div class="row d-flex justify-content-between align-items-center m-0">
												<div class="col-lg col d-flex align-items-center">
													<a data-toggle = "modal" data-target="#absensiCourse<?=$ab['id_absensi'] ?>">
														<h6 class="color-dark" style="margin: 0px">
															<?php if ($date_now > date('d F Y', $ab['tanggal'])): ?>
																<?php if($ab['check'] == 1) :?>
																	<i class="fas fa-fw fa-check text-success"></i>
																	<?php else : ?>
																		<i class="fas fa-fw fa-times text-danger"></i>
																	<?php endif ?>
																	<?php else : ?>
																		<?php if (($time_now >= date('H:i', $ab['jam_mulai']) && $time_now <= date('H:i', $ab['jam_akhir']))) : ?>
																		<?php if($ab['check'] == 1) :?>
																			<i class="fas fa-fw fa-check text-success"></i>
																			<?php else : ?>
																				<i class="fas fa-fw fa-plus text-warning"></i>
																			<?php endif ?>
																			<?php else : ?>
																				<?php if($ab['check'] == 1) :?>
																					<i class="fas fa-fw fa-check text-success"></i>
																					<?php else : ?>
																						<i class="fas fa-fw fa-times text-danger"></i>
																					<?php endif ?>
																				<?php endif ?>
																			<?php endif ?>
																			Tanggal <?=date('d F Y', $ab['tanggal']) ?>, <?=date('H:i', $ab['jam_mulai']) ?> - <?=date('H:i', $ab['jam_akhir']) ?></h6>

																		</a>
																	</div>
																</div>
															</div>		
															<?php include FCPATH.'application/views/absensi/absensi_modal.php' ?>
														<?php endforeach ?>
													</div>
												<?php endif ?>
											</div>

										</div>

										<div class="section">
											<div class="section-header">
												<div class="row m-0 justify-content-between align-items-center">
													<div>
														<h3 style="margin: 0px"><i class="fas fa-fw fa-tasks"></i> Task</h3>
														<p class="color-black" style="margin: 0px">This is Task Course</p>
													</div>
												</div>
											</div>
											<div class="section-body">
												<?php if (count($tugas_sides) < 1): ?>
													<div class="col text-center">
														<img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_success.png">
														<h5 class="mb-5" style="font-weight: 700">Belum ada Tugas!</h5>
													</div>
													<?php else : ?>
														<div class="section-background">
															<?php
															$time_now_tugas = time();
															$date_now_tugas = date('d F Y, H.i',$time_now_tugas);
															foreach ($tugas_sides as $tugas): ?>

																<a style="color: inherit; text-decoration: none" 
																href="<?=base_url('tugas?id=').$tugas['id_tugas'] ?>">
																<div class="card-section mb-2">
																	<div class="row d-flex justify-content-between align-items-center m-0">
																		<div  class="col-lg col d-flex align-items-center">
																			<h6 class="color-dark" style="margin: 0px">
																				<?php if ($date_now_tugas > date('d F Y, H.i', $tugas['deadline_tugas']) ): ?>
																					<?php if($tugas['check'] == 1) :?>
																						<i class="fas fa-fw fa-check text-success"></i>
																						<?php else : ?>
																							<i class="fas fa-fw fa-times text-danger"></i>
																						<?php endif ?>
																						<?php else : ?>
																							<?php if($tugas['check'] == 1) :?>
																								<i class="fas fa-fw fa-check text-success"></i>
																								<?php else : ?>
																									<i class="fas fa-fw fa-plus text-warning"></i>
																								<?php endif ?>
																							<?php endif ?>
																							<?=$tugas['title_tugas'] ?></h6>
																						</div>
																					</div>
																				</div>
																			</a>
																		<?php endforeach ?>
																	</div>
																<?php endif ?>

															</div>
														</div>

													</div>
												</div>

											</section>
										</div>
