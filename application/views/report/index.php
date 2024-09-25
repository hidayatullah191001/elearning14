
<section data-aos="fade-up" id="guru-info">
	<?=$this->session->flashdata('message') ?>
	<div class="row justify-content-between align-items-center m-0">
		<div>
			<h1><?=$title ?></h1>
			<p>Halaman ini berguna untuk mencetak laporan siswa!</p>
		</div>
	</div>
	<div class="mb-5"></div>

	<?php if (count($reportUser) < 1): ?>
		<center>
			<img src="<?=base_url('assets/ui/') ?>assets/img/not_found.png">
			<h6>Belum ada siswa yang enroll course kamu!</h6>
		</center>
		<br><br>
		<?php else : ?>
			<table class="table table-stripped" id="tabel-data">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Siswa</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					foreach ($reportUser as $ru): ?>
						<tr>
							<td><?=$i++ ?></td>
							<?php foreach ($alluser as $au): ?>
								<?php if ($ru['id_siswa'] == $au['id']): ?>
									<td><a href="#" data-toggle="modal" data-target="#profileUser<?=$au['id'] ?>" class="font-weight-600" style="text-decoration: none"><img style="width: 30px; height: 30px; object-fit: cover;" src="<?=base_url('assets/upload/avatar/'.$au['photo_profile']) ?>" alt="avatar" class="rounded-circle mr-1"><?=$au['name'] ?></a></td>
									<?php include 'profileUser.php' ?>

								<?php endif ?>
							<?php endforeach ?>
							<td><a href="<?=base_url('report/cetak/').$ru['id_siswa'] ?>" class="btn btn-lihat btn-sm"><i class="fas fa-fw fa-print"></i> Cetak</a></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		<?php endif ?>
