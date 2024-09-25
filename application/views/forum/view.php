<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$topik['title_topik'] ?></h3>
				<h6>Dibuat oleh <?=$topik['name'] ?> pada <?=date('d F Y, H:i', $topik['date_created_topik']); ?></h6>
				<?php if ($topik['id_forum'] == 0): ?>
					<a style="text-decoration: none" class="color-primary" href="<?=base_url('forum')?>"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
				<?php else : ?>
					<a style="text-decoration: none" class="color-primary" href="<?=base_url('forum?id=').$topik['id_forum']?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke List Forum</a>
				<?php endif ?>
			</div>
			<?php if ($topik['id_siswa'] == $user['id']): ?>
				<?php if (isset($_GET['forum']) != null): ?>
				<div class="d-none d-lg-block d-sm-none">
					<button data-toggle="modal" data-target="#deleteTopik<?=$topik['id_forum_topik'] ?>" class="btn btn-delete btn-sm"><i class="fas fa-trash mr-2"></i> Delete this Topik</button>
				</div>
				<?php else : ?>
					<div class="d-none d-lg-block d-sm-none">
					<button data-toggle="modal" data-target="#deleteTopikDiscussion<?=$topik['id_forum_topik'] ?>" class="btn btn-delete btn-sm"><i class="fas fa-trash mr-2"></i> Delete this Topik</button>
				</div>
				<?php endif ?>
				
			<?php endif ?>
		</div>
	</div>

	<?=$topik['deskripsi_topik'] ?>

	<?php if (count($chat) < 1): ?>
		<br><br>
		<center>
			<img src="<?=base_url('assets/ui/') ?>assets/img/not_found.png">
			<h6>Belum ada diskusi. Kirim pesan untuk menjadi yang pertama!</h6>
		</center>

		<br><br>
		<?php else : ?>
			<br><br>
			<?php foreach ($chat as $cht): ?>
				<div class="card m-0 mb-2">
					<div class="card-body">
						<div class="row align-items-center m-0">
							<div class="col-lg-0">
								<img style="width: 50px; object-fit: cover; height: 50px" class="img-fluid" src="<?=base_url('assets/upload/avatar/').$cht['photo_profile']?>">
							</div>
							<div class="col-lg">
								<h6 class="m-0"><b><?=$cht['name'] ?></b></h6>
								<small><?=date('H:i, d F Y', $cht['date_created_chat']) ?></small>
							</div>
							<div>
								<?php if ($user['id'] == $cht['id_siswa']): ?>
									<a href="<?=base_url('forum/deleteChat/').$cht['id_forum_chat']?>" class="btn btn-delete btn-sm w-100"><i class="fas fa-trash"></i> Delete</a>
								<?php endif ?>
							</div>
						</div>
						<style type="text/css">
							p{
								margin: 0px;
							}
						</style>
						<div class="mt-2">
							<?=$cht['message'] ?>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			<br><br><br><br><br><br>
		<?php endif ?>

		<div  class="card">
			<div class="card-body">
				<h2>Kirim Pesan</h2>
				<form method="post" action="<?=base_url('forum/view?topik=').$topik['id_forum_topik']?>" class="mt-3" enctype="multipart/form-data">
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
<?php include "deleteTopik_modal.php" ?>
<?php include "deleteTopikDiscussion_modal.php" ?>