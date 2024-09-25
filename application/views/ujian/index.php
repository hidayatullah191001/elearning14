<section data-aos="fade-up" id="guru-info">
	<?php echo $this->session->flashdata('message') ?>
	<div style="margin-bottom: 50px" class="section-header">
		<div class="row m-0 justify-content-between align-items-center">
			<div>
				<h3><?=$title ?> <?=$ujian['title_ujian'] ?></h3>
				<a style="text-decoration: none" class="color-primary" href="<?=base_url('course/detail/').$ujian['course_uuid']?>"><i class="fas fa-arrow-left mr-2"></i>Kembali ke List Section</a>
			</div>
		</div>
	</div>

	<div class="text-center">
		<h5 style="font-weight: 600">Deskripsi</h5>
		<?=$ujian['deskripsi_ujian'] ?>
		<div class="row d-flex justify-content-center mt-4">
			<div class="col-4">
				<h5 style="font-weight: 600">Tanggal & Waktu Ujian Dimulai</h5>
				<?=date('d F Y, H:i', $ujian['tanggal_mulai_ujian']) ?>
			</div>
			<div class="col-4">
				<h5 style="font-weight: 600">Tanggal & Waktu Ujian Ditutup</h5>
				<?=date('d F Y, H:i', $ujian['tanggal_akhir_ujian']) ?>
			</div>
		</div>
		<div class="mt-3">
			<h5 style="font-weight: 600">Lama Pengerjaan</h5>
			<p><?=$ujian['lama_pengerjaan'] ?> Menit</p>
		</div>
		<div class="mt-4"></div>
		<?php if (time() > $ujian['tanggal_mulai_ujian'] && time() < $ujian['tanggal_akhir_ujian']): ?>
		
			<?php if ($count_ujian_siswa < 1): ?>
				<button class="btn btn-primary" data-toggle="modal" data-target="#modalUjian">Kerjakan Ujian</button>
			<?php elseif($ujian_siswa['status'] == 'Proses' && ($ujian_siswa['date_start'] - time()) > 0): ?>
				<button class="btn btn-primary" data-toggle="modal" data-target="#modalUjian">Kerjakan Ujian</button>
			<?php endif ?>


		<?php elseif($ujian['tanggal_mulai_ujian'] < time()) : ?>
			<span class="alert alert-danger">Ujian belum dibuka!</span>
		<?php elseif(time() > $ujian['tanggal_akhir_ujian']) : ?>
			<span class="alert alert-danger">Ujian telah ditutup!</span>
		<?php endif ?>
	</div>

	<?php if ($count_ujian_siswa > 0): ?>
		<div class="table-responsive">
			<table class="table table-sm mt-5">
				<thead>
					<tr class="text-center">
						<th scope="col">No</th>
						<th scope="col">Waktu Submit</th>
						<th scope="col">Hasil Nilai</th>
						<th scope="col">Jumlah Soal</th>
						<th scope="col">Jawaban Benar</th>
						<th scope="col">Jawaban Salah</th>
						<th scope="col">Jawaban Kosong</th>
						<th scope="col">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					foreach ($ujian_siswa_all as $usa): ?>
						<tr class="text-center">
							<td><?=$i++ ?></td>
							<td><?=date('d F Y, H:i:s', $usa['date_created_ujian_siswa']) ?></td>
							<td><?=$usa['hasil_nilai'] ?></td>
							<td><?=$usa['jumlah_soal'] ?></td>
							<td class="text-success"><?=$usa['jumlah_benar'] ?></td>
							<td class="text-danger"><?=$usa['jumlah_salah'] ?></td>
							<td><?=$usa['jumlah_kosong'] ?></td>
							<td>
								<?php if ($usa['status'] == "Selesai"): ?>
									<span class="badge badge-success "><?=$usa['status'] ?></span>
									<?php else: ?>
										<span class="badge badge-danger"><?=$usa['status'] ?></span>
									<?php endif ?>
								</td>
							</tr>	
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		<?php endif ?>

		<div class="modal fade" id="modalUjian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
			<div  class="modal-dialog modal-dialog-centered" role="document">
				<div style="border-radius: 30px" class="modal-content border-0">
					<div class="modal-body px-1 py-5">
						<div class="text-center">
							<img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_info.png">
							<h3 style="font-weight: 700">Perhatian!</h3>
						</div>
						<h6 class="mx-4">
							1. Ujian akan dimulai ketika kamu klik tombol Mulai Ujian.<br>
							2. Pastikan jawaban sudah terisi semua sebelum mengakhiri ujian.<br>
							3. Jangan menghapus tab ujian jika belum selesai.<br>
							4. Jika kamu menghapus tab ujian, maka jawaban yang telah diisi akan hilang, namun waktu tetap berjalan.<br>
						5. Ujian hanya berlaku satu kali submit. Pastikan jawaban kamu sudah terisi semua!</h6>
						<div class="row m-0 d-flex justify-content-center mt-4">
							<button class="btn btn-secondary-logout mr-4" type="button" data-dismiss="modal">Batal</button>

							<?php 
							if ($count_ujian_siswa < 1 || $ujian_siswa['status'] == 'Proses' || ($ujian_siswa['date_start'] - time()) > 0) {
								$target = "_blank";
							}elseif($ujian_siswa['status'] == 'Proses' && ($ujian_siswa['date_start'] - time()) <= 0){
								$target = "";
							}else{
								$target= "";
							}
							?>
							<a href="<?=base_url('ujian/start?course_uuid=').$ujian['course_uuid'].'&section='.$ujian['id_section'].'&ujian='.encryptId($ujian['id_ujian']) ?>" target=<?=$target ?>>
								<button type="submit" class="btn btn-primary-logout">Mulai Ujian</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script>
			$('#modalUjian').appendTo("body");
		</script>
