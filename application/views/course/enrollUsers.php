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
			<h2>Siswa Enroll</h2>
			<p>Tabel ini berisi data siswa yang melakukan enroll course!</p><br><br>
			<?php if (count($enroll_users) < 1): ?>
				<center>
					<img style="width: 150px" src="<?=base_url('assets/ui/assets/img/nodocument.png') ?>">
					<h5>Tidak ada siswa yang enroll di course ini!</h5>
				</center>
			<?php else : ?>
				<table  class="table table-hover" id="tabel-data">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama</th>
						<th scope="col">Email</th>
						<th scope="col">Kelas</th>
						<th scope="col">Tanggal Enroll</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					foreach ($enroll_users as $eu): ?>
						<tr>
							<td><?=$i++ ?></td>
							<td><a href="#" data-toggle="modal" data-target="#profileUser<?=$eu['id_enroll'] ?>" class="font-weight-600" style="text-decoration: none"><img style="width: 30px; height: 30px; object-fit: cover;" src="<?=base_url('assets/upload/avatar/'.$eu['photo_profile']) ?>" alt="avatar" class="rounded-circle mr-1"><?=$eu['name'] ?></a></td>
							<td><?=$eu['email'] ?></td>
							<td><?=$eu['nama_kelas'] ?></td>
							<td>
								<?=date('d F Y, H:i', $eu['date_enroll']); ?>
							</td>
							<td>
								<button data-toggle="modal" data-target="#deleteEnroll<?=$eu['id_enroll']?>" class="btn btn-delete btn-sm mb-2"><i class="fas fa-trash"></i> Delete</button>
							</td>
						</tr>
						<?php include "deleteEnroll_modal.php" ?>
						<?php include "profileUser_modal.php" ?>
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