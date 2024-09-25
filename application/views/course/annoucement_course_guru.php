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
	<button data-toggle="modal" data-target="#createPengumuman" class="btn btn-primary"><i class="fas fa-fw fa-plus fa-sm"></i> Create Pengumuman</button>
	<div class="mb-5"></div>
	<table id="tabel-data" class="table" style="width:100%">
		<thead>
			<tr class="text-center">
				<th>No</th>
				<th>Tanggal Dibuat</th>
				<th>Title Pengumuman</th>
				<th>Deskripsi Pengumuman</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=1;
			foreach ($pengumumans as $pengumuman): ?>
				<tr class="text-center">
					<td><?=$i++ ?></td>
					<td><?=date('d F Y, H:i', $pengumuman['date_created_pengumuman']);?></td>
					<td><?=$pengumuman['title_pengumuman']?></td>
					<td>
						<?php
						$kalimat = $pengumuman['deskripsi_pengumuman'] ;
						$max = 35;
						$cetak = substr($kalimat, 0, $max);
						if (strlen($kalimat)>$max) {
							echo $cetak.'...';
						}else{
							echo $cetak;
						}?>
					</td>
					<td>
						<button data-toggle="modal" data-target="#updatePengumuman<?=$pengumuman['id_pengumuman']?>" class="btn btn-edit btn-sm mb-2"><i class="fas fa-pen"></i> Update</button>
						<button data-toggle="modal" data-target="#deletePengumuman<?=$pengumuman['id_pengumuman']?>" class="btn btn-delete btn-sm mb-2"><i class="fas fa-trash"></i> Delete</button>
					</td>
				</tr>
					<?php include 'update_pengumuman.php' ?>
					<?php include 'delete_pengumuman.php' ?>
				<?php endforeach ?>
			</tbody>
		</table>


		<div class="modal fade" id="createPengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
			<div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div style="border-radius: 30px" class="modal-content border-0">
					<div class="modal-body p-5">
						<h1 style="font-weight: 500; ">Create<br/>New Announcement</h1>
						<form method="post">
							<div class="modal-body">
								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Title Pengumuman</label>
									<input type="text" class="form-control text-pks" id="title_pengumuman" name="title_pengumuman" placeholder="Masukkan nama lengkap...">
									<?= form_error('title_pengumuman', '<small class="text-danger">', '</small>') ?>
								</div>
								<div class="form-group">
									<label for="" class="text-pks font-weight-bold">Deskripsi Pengumuman</label>
									<textarea id="editor" name="deskripsi_pengumuman" placeholder="Masukkan deskripsi pengumuman..."></textarea>
									<?= form_error('deskripsi_pengumuman', '<small class="text-danger">', '</small>') ?>
								</div>

								<div class="form-group text-center mt-3">
									<button type="submit" class="btn btn-primary-form w-100">Submit</button>
								</div>
								<div class="form-group text-center mt-1">
									<button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Cancel</p></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script>
			$('#createPengumuman').appendTo("body");
		</script>
