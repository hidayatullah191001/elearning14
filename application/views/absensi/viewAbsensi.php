<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?> <?=date('d F Y', $absensi['tanggal']) ?>, <?=date('H:i', $absensi['jam_mulai']) ?> -  <?=date('H:i', $absensi['jam_akhir']) ?></h3>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('absensi?course=').$absensi['course_uuid']?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke Absensi Course</a>
			</div>
		</div>
	</div>

	<div class="mt-5">
		<?php if (count($absensis) < 1): ?>
				<center>
					<img style="width: 150px" src="<?=base_url('assets/ui/assets/img/not_found.png') ?>">
					<h5>Tidak ditemukan siswa yang melakukan absensi!</h5>
				</center>
			<?php else : ?>
				<table  class="table table-hover">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama Siswa</th>
						<th scope="col">Jam Absensi</th>
						<th scope="col">Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					foreach ($absensis as $absensi): ?>
						<tr>
							<td><?=$i++ ?></td>
							<td><a href="#" class="font-weight-600" style="text-decoration: none"><img style="width: 30px; height: 30px; object-fit: cover;" src="<?=base_url('assets/upload/avatar/'.$absensi['photo_profile']) ?>" alt="avatar" class="rounded-circle mr-1"><?=$absensi['name'] ?></a></td>
							<td>
								<?=date('d F Y, H:i', $absensi['date_attended']); ?>
							</td>
							<td>
								<?=$absensi['keterangan']; ?>
							</td>
							
						</tr>

					<?php endforeach ?>
				</tbody>
			</table>
			<?php endif ?>
	</div>
</section>