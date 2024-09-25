
<section data-aos="fade-up" id="guru-info">
	<?=$this->session->flashdata('message') ?>
	<div class="row justify-content-between align-items-center m-0">
		<div>
			<h1><?=$title ?></h1>
			<p>Halaman ini berguna untuk mencetak laporan siswa!</p>
		</div>
	</div>
	<div class="mb-5"></div>

	<table class="table table-stripped" id="tabel-data">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Course</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 1;
			foreach ($reportUser as $ru): ?>
				<tr>
					<td><?=$i++ ?></td>
					<td><?=$ru['nama_course'] ?></td>
					<td><a href="<?=base_url('report/cetak/').$ru['id_siswa'].'/'.$ru['id_course'] ?>" class="btn btn-lihat btn-sm"><i class="fas fa-fw fa-print"></i> Cetak</a></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
