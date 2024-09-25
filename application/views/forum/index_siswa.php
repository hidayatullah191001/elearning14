<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$forum['title_forum'] ?></h3>
				<h6>Dibuat pada <?=date('d F Y, H:i', $forum['date_created_forum']); ?></h6>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$forum['course_uuid']?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke Detail Course</a>
			</div>
		</div>
	</div>

	<div class="card mt-5">
		<div class="card-body">
			<h2><?=$forum['title_forum'] ?></h2>
			<p><?=$forum['deskripsi_forum'] ?></p>
			<button data-toggle="modal" data-target="#createTopikDiskusi" class="btn btn-primary mb-5"><i class="fas fa-fw fa-plus"></i> Buat Topik Diskusi</button>
			<?php if (count($forum_topik) < 1): ?>
				<center>
					<img style="width: 150px" src="<?=base_url('assets/ui/assets/img/nodocument.png') ?>">
					<h5>Tidak ada topik diskusi. Buat topik untuk memulai diskusi!</h5>
				</center>
				<?php else : ?>
					<table id="tabel-data" class="table table-hover">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Topik</th>
								<th scope="col">Tanggal Dibuat</th>
								<th scope="col">Dibuat Oleh</th>
								<th scope="col">Jumlah Reply</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							
							foreach ($forum_topik as $ft): ?>
								<tr>
									<td><?=$i++ ?></td>
									<td><a href="<?=base_url('forum/view?topik=').$ft['id_forum_topik'].'&forum='.$ft['id_forum'] ?>"><?=$ft['title_topik']?></a></td>
									<td><?=date('d F Y, H:i', $ft['date_created_topik'])?></td>
									<td>
										<a href="#" class="font-weight-600" style="text-decoration: none"><img style="width: 30px; height: 30px; object-fit: cover;" src="<?=base_url('assets/upload/avatar/'.$ft['photo_profile']) ?>" alt="avatar" class="rounded-circle mr-1"><?=$ft['name'] ?></a>
									</td>
									<?php 
									$reply = 0;
									foreach ($chats as $cht): ?>
										<?php if ($ft['id_forum_topik'] == $cht['id_forum_topik']): ?>
											<?php $reply++; ?>
										<?php endif ?>
									<?php endforeach ?>
									<td><?=$reply ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php endif ?>
			</div>
		</div>
	</section>

	<div class="modal fade" id="createTopikDiskusi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
		<div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div style="border-radius: 30px" class="modal-content border-0">
				<div class="modal-body p-5">
					<h1 style="font-weight: 500; ">Create<br/>New Topic Discussion</h1>
					<form action="" method="post">
						<div class="form-group">
							<label>Topik<span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="topik" name="topik" placeholder="Masukkan topik diskusi...">
						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<textarea id="editor" name="deskripsi" placeholder="Masukkan deskripsi diskusi..."></textarea>
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
	$('#createTopikDiskusi').appendTo("body");
</script>