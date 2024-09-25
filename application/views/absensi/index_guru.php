<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?></h3>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$course['uuid']?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke Detail Course</a>
			</div>
		</div>
	</div>

	<div class="card mt-5">
		<div class="card-body">
			<h2>Absensi Siswa</h2>
			<p>Tabel ini berisi data absensi course!</p>
			<button data-toggle="modal" data-target="#createAbsensi" class="btn btn-primary mb-5"><i class="fas fa-fw fa-plus"></i> Buat Absensi</button>
			<?php if (count($absensis) < 1): ?>
				<center>
					<img style="width: 150px" src="<?=base_url('assets/ui/assets/img/nodocument.png') ?>">
					<h5>Kamu belum membuat data absensi!</h5>
				</center>
			<?php else : ?>
				<table  class="table table-hover">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Jam Mulai</th>
						<th scope="col">Jam Akhir</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					foreach ($absensis as $absensi): ?>
						<tr>
							<td><?=$i++ ?></td>
							<td><?=date('d F Y', $absensi['tanggal'] )?></td>
							<td>
								<?=date('H:i', $absensi['jam_mulai']); ?>
							</td>
							<td>
								<?=date('H:i', $absensi['jam_akhir']); ?>
							</td>
							<td>
								<button data-toggle="modal" data-target="#updateAbsensi<?=$absensi['id_absensi']?>" class="btn btn-edit btn-sm mb-2"><i class="fas fa-pen"></i> Edit</button>
								<a href="<?=base_url('absensi/viewAbsensi?absensi=').$absensi['id_absensi'] ?>" class="btn btn-berhasil btn-sm mb-2"><i class="fas fa-eye"></i> Lihat</a>
								<button data-toggle="modal" data-target="#deleteAbsensi<?=$absensi['id_absensi']?>" class="btn btn-delete btn-sm mb-2"><i class="fas fa-trash"></i> Delete</button>
							</td>
						</tr>
						<?php include 'deleteAbsensi_modal.php' ?>
						<?php include 'updateAbsensi_modal.php' ?>
					<?php endforeach ?>
				</tbody>
			</table>
			<?php endif ?>
		</div>
	</div>
</section>

<div class="modal fade" id="createAbsensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
	<div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div style="border-radius: 30px" class="modal-content border-0">
			<div class="modal-body p-5">
				<h1 style="font-weight: 500; ">Create<br/>New Attendance</h1>
				<form action="" method="post">
					<div class="form-group">
						<label>Tanggal Absen<span class="text-danger">*</span></label>
						<input type="date" class="form-control" value="<?=date('Y-m-d')?>" id="tanggal" name="tanggal" >
					</div>
					<div class="form-group">
						<label>Mulai Jam Absen<span class="text-danger">*</span></label>
						<input type="time" class="form-control" value="0" id="mulai" name="mulai" >
					</div>
					<div class="form-group">
						<label>Akhir Jam Absen<span class="text-danger">*</span></label>
						<input type="time" class="form-control" value="0" id="akhir" name="akhir">
					</div>

					<div class="form-group text-center mt-5">
						<button type="submit" class="btn btn-primary-form w-100">Submit</button>
					</div>
					<div class="form-group text-center mt-1">
						<button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Cancel</p></button>
					</div>

					<span class="text-danger">*Wajib Diisi</span><br>
				</div>

			</form>
		</div>
	</div>
</div>
</div>


<script>
	$('#createAbsensi').appendTo("body");
</script>