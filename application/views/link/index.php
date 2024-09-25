
<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?> <?=$link['title_link'] ?></h3>
				<h6>Dibuat pada <?php date_default_timezone_set('Asia/Jakarta'); echo date('d F Y, H:i', $link['date_created_link']); ?></h6>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$link['course_uuid'] ?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke List Section</a>
			</div>
		</div>
	</div>

	<?php if ($link['deskripsi_link']!=null): ?>
		<?=$link['deskripsi_link'] ?>
		<br><br>
	<?php endif ?>
	
	<?php if ($link['link'] != null): ?>
		Link : <a href="<?=$link['link'] ?>" target="_blank"><?=$link['link'] ?></a><br>
		Atau
		<br>
		<a class="btn btn-primary" href="<?=$link['link'] ?>" target="_blank"><i class="fas fa-download" ></i> Kunjungi Link</a>
	<?php endif ?>
	<br><br>

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
										<h6 class="m-0"><b><?=$comment['name'] ?></b></h6>
										<small><?=date('H:i, d F Y', $comment['date_comment']) ?></small>
									</div>
									<div>
										<?php if ($user['id'] == $comment['id_user']): ?>
											<a href="<?=base_url('link/deleteComment/').$link['id_link'].'/'.$comment['id_comment'] ?>" class="btn btn-delete btn-sm w-100"><i class="fas fa-trash"></i> Delete</a>
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
						<form method="post" action="<?=base_url('link/comment/').$link['id_link'].'/'.$link['id_section_comment'] ?>" class="mt-3" enctype="multipart/form-data">
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