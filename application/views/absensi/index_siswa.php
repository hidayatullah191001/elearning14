
<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?> <?=$course['nama_course'] ?></h3>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$course['uuid'] ?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke List Section</a>
			</div>
		</div>
	</div>
	<?php if (count($absensis) < 1): ?>
		<div class="col text-center">
			<img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_calendar.png">
			<h3 class="color-dark" style="font-weight: 700">Belum ada absensi terbaru saat ini!</h3>
		</div>
		<?php else : ?>

			<div class="col-lg-4">

				<?php
				date_default_timezone_set('Asia/Jakarta');
				$now = time();
				$time_now = date('H:i', $now);
				$date_now = date('d F Y', $now);
				foreach ($absensis as $ab): ?>
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
										<?php include 'absensi_modal.php' ?>

									<?php endforeach ?>
								</div>
							<?php endif ?>



							<table class="table table-hover table-sm mt-5">
								<thead>
									<tr class="text-center">
										<th scope="col">No</th>
										<th scope="col">Tanggal Absen</th>
										<th scope="col">Jam Dibuka</th>
										<th scope="col">Jam Ditutup</th>
										<th scope="col">Waktu Submit</th>
										<th scope="col">Keterangan</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i=1;
									foreach ($absensi_siswas as $as): ?>
										<tr class="text-center">
											<td><?=$i++; ?></td>
											<td><?=date('d F Y', $as['tanggal']) ?></td>
											<td><?=date('H:i', $as['jam_mulai']) ?></td>
											<td><?=date('H:i', $as['jam_akhir']) ?></td>
											<td><?=date('d F Y, H:i', $as['date_attended']) ?></td>
											<td><b><?=$as['keterangan']?></b></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>

