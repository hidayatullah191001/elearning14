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
	<?php if (count($pengumumans) < 1): ?>
			<center>
					<img src="<?=base_url('assets/ui/') ?>assets/img/not_found.png">
					<h6>Tidak ada pengumuman!</h6>
				</center>
				<br><br>
	<?php else : ?>
		<?php foreach ($pengumumans as $pengumuman): ?>
		<div class="card mb-3">
			<div class="card-body">
				<h5><b><?=$pengumuman['title_pengumuman'] ?></b></h5>
				<?=$pengumuman['deskripsi_pengumuman'] ?>
				<small>Dibuat oleh <b><?=$pengumuman['name'] ?></b> Pada Tanggal <b><?=date('d F Y, H:i', $pengumuman['date_created_pengumuman']) ?></b></small>
			</div>
		</div>
	<?php endforeach ?>
	<?php endif ?>
