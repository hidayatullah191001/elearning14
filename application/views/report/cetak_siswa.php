<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		*{
			font-family: "Times New Roman", Times, serif;
		}

		p{
			font-size: 12px;
		}

		h4{
			font-size: 16px;
			font-weight: bold;
		}

		h6{
			font-size: 14px;
			font-weight: bold;
		}

		tr, td{
			font-size: 12px;
		}

		#table {
			border-collapse: collapse;
			width: 100%;
		}

		#table td, #table th {
			border-right: 0px;
			border-left: : 0px;
			border-top : 1px solid #ddd;
			border-bottom: 1px solid #ddd;
			padding: 8px;
		}

	</style>
</head>
<body>

	<table id="table">

		<p style="margin: 0px; padding: 0px">Nama : <?=$siswa['name'] ?></p>
		<p style="margin: 0px; padding: 0px">Email : <?=$siswa['email'] ?></p>
		<p style="margin: 0px; padding: 0px">NISN : <?=$siswa['nisn'] ?></p>
		<p style="margin: 0px; padding: 0px">No Telepon : <?=$siswa['no_telp'] ?></p>
		<p style="margin: 0px; padding: 0px">Kelas : <?=$siswa['nama_kelas'] ?></p>
		<p style="margin: 0px; padding: 0px">Course : <?=$enrollCourse['nama_course'] ?></p>
		<p style="margin: 0px; padding: 0px">Guru Pengajar : <?=$enrollCourse['name'] ?></p>
		<br><br>
		<table id="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Absensi</th>
					<th>Waktu Attended</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i2=1;
				foreach ($absensi_siswa as $as): ?>
					<?php if ($as['course_uuid'] == $enrollCourse['uuid']): ?>
						<tr style="text-align: center;">
							<td><?=$i2++ ?></td>
							<td><?=date('d F Y', $as['tanggal'])?>, <?=date('H:i', $as['jam_mulai'])?> - <?=date('H:i', $as['jam_akhir'])?></td>
							<td><?=date('d F Y, H:i', $as['date_attended']) ?></td>
							<td><?=$as['keterangan']?></td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
			</tbody>
		</table>
		<div style="margin-top: 30px"></div>
		<table id="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Section</th>
					<th>Total Nilai Tugas Course</th>
					<th>Total Nilai Ujian Course</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				$tugas = 0;
				$ujian = 0;
				foreach ($sections as $section): ?>
					<?php if ($section['uuid_course'] == $enrollCourse['uuid']): ?>
						<tr style="text-align: center">
							<td><?=$i++ ?></td>
							<td><?=$section['nama_section']?></td>
							<?php foreach ($tugas_siswa as $ts): ?>
								<?php if ($section['id_section'] == $ts['id_section'] && $ts['id_siswa'] == $siswa['id']): ?>
									<?php $tugas = $ts['nilai'] ?>
								<?php endif ?>
							<?php endforeach ?>

							<td><?=$tugas?></td>
							<?php foreach ($ujian_siswa as $us): ?>
								<?php if ($section['id_section'] == $us['id_section'] && $us['id_siswa'] == $siswa['id']): ?>
									<?php $ujian = $us['hasil_nilai'] ?>
								<?php endif ?>
							<?php endforeach ?>
							<td><?=$ujian?></td>

						</tr>
					<?php endif ?>
				<?php endforeach ?>
			</tbody>
		</table>
		

	</table>
</body>
</html>