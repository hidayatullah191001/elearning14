<section data-aos="fade-up" id="guru-info">
	<?=$this->session->flashdata('message') ?>
	<div class="row justify-content-between align-items-center m-0">
		<div>
			<h1><?=$title ?></h1>
			<p>Daftar Pengumuman yang dibuat langsung oleh operator!</p>
		</div>
	</div>

	<div class="mb-5"></div>

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