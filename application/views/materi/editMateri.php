
<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?> <?=$materi['title_materi'] ?></h3>
				<h6>Dibuat pada <?php date_default_timezone_set('Asia/Jakarta'); echo date('d F Y, H:i', $materi['date_created_materi']); ?></h6>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$materi['course_uuid'] ?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke List Section</a>
			</div>
			<div class="d-none d-lg-block d-sm-none">
				<button data-toggle="modal" data-target="#deleteMateri<?=$materi['id_materi'] ?>" class="btn btn-delete btn-sm"><i class="fas fa-trash mr-2"></i> Delete this Materi</button>
			</div>
		</div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<h2>Form Edit Materi</h2>
			<p>Form ini berguna untuk anda yang ingin memperbarui data materi!</p>
			<form method="post" class="mt-5" enctype="multipart/form-data">
				<div class="form-group">
					<label for="" class="text-pks font-weight-bold">Title Materi<span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="title_materi" placeholder="Masukkan title materi..." value="<?=$materi['title_materi'] ?>">
					<?= form_error('title_materi', '<small class="text-danger">', '</small>') ?>
				</div>

				<div class="form-group">
					<label for="" class="text-pks font-weight-bold">Deskripsi Materi<span class="text-danger">*</span></label>
					<textarea style="height: 200px" name="deskripsi_materi" id="editor" placeholder="Masukkan deskripsi..."><?=$materi['deskripsi_materi'] ?></textarea>
					<?= form_error('deskripsi_materi', '<small class="text-danger">', '</small>') ?>
				</div>

				<div class="form-group">
					<label for="" class="text-pks font-weight-bold">Unduh Materi Lama</label><br>
					<a class="btn btn-primary" href="<?=base_url('assets/upload/materi/').$materi['file_materi'] ?>"><i class="fas fa-download" ></i> Download Disini</a>
					<input type="text" name="oldmateri" hidden="" value="<?=$materi['file_materi'] ?>">
				</div>

				<div class="form-group">
					<label for="" class="text-pks font-weight-bold">File Materi Baru</label>
					<input type="file" name="file_materi" class="form-control">
					<?= form_error('file_materi', '<small class="text-danger">', '</small>') ?>
				</div>

				<div class="form-group text-center mt-4">
					<button type="submit" class="btn btn-primary-form">Submit</button>
				</div>
			</form>
		</div>
	</div>

	<!-- Bagian Tanya Jawan -->

	<div class="card mt-5">
		<div class="card-body">
			<h2>Tanya Jawab</h2>
			<p>Gunakan form ini bertanya jawab apapun!</p>


			<?php if (count($comments) < 1): ?>
				<br><br>
				<center>
					<img src="<?=base_url('assets/ui/') ?>assets/img/not_found.png">
					<h6>Tidak ada data tanya jawab!</h6>
				</center>

				<br><br>
				<?php else : ?>
					<br><br>
					<?php foreach ($comments as $comment): ?>
						<div class="card m-0 mb-2">
							<div class="card-body">
								<div class="row align-items-center m-0">
									<div class="col-lg-0">
										<img style="width: 50px; object-fit: cover; height: 50px" class="img-fluid" src="<?=base_url('assets/upload/avatar/').$comment['photo_profile']?>">
									</div>
									<div class="col-lg">
										<h6 class="m-0"><b><?=$user['name'] ?></b></h6>
										<small><?=date('H:i, d F Y', $comment['date_comment']) ?></small>
									</div>
									<div>
										<?php if ($user['id'] == $comment['id_user']): ?>
											<a href="<?=base_url('materi/deleteComment/').$materi['id_materi'].'/'.$comment['id_comment'] ?>" class="btn btn-delete btn-sm w-100"><i class="fas fa-trash"></i> Delete</a>
										<?php endif ?>
									</div>
								</div>
								<style type="text/css">
									p{
										margin: 0px;
									}
								</style>
								<div class="mt-2">
									<?=$comment['text'] ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>

				<?php endif ?>
				<br><br>
				
				<div class="card mt-5">
					<div class="card-body">
						<h2>Kirim Pesan</h2>
						<form method="post" action="<?=base_url('materi/comment/').$materi['id_materi'].'/'.$materi['id_section_comment'] ?>" class="mt-3" enctype="multipart/form-data">
							<input type="text" hidden="" name="id_user" value="<?=$user['id']?>">
							<div class="form-group">
								<label for="" class="text-pks font-weight-bold">Message<span class="text-danger">*</span></label>
								<textarea id="editor-comment" placeholder="Buat message..." name="message"></textarea>
								<?= form_error('title_materi', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<button class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php include FCPATH.'application/views/materi/deleteMateri_modal.php' ?>