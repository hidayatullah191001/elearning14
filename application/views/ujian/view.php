<?php date_default_timezone_set('Asia/Jakarta'); ?>
<div class="container">

	<section style="margin-top: 100px;" id="course">
		<div class="row">
			<div class="col-lg-8">
				<form name="form1" method="post" id="formfield">
					<?php 
					$i = 1;
					foreach ($soal as $sl): ?>
						<input type="hidden" name="id[]" value=<?=$sl['id_soal']; ?>>
						<input type="hidden" name="jumlah" value=<?=count($soal); ?>>
						<tr>
							<td class="text-dark"><?=$i++.'. '.str_replace('<p>', ' ', $sl['soal']) ?></td>
							</tr>
							<table>
								<tr>
									<td>A.</td>
									<td><input name="pilihan[<?=$sl['id_soal'];?>]" type="radio" value="A"></td>
									<td><?=$sl['opsi_a'];?></td>
								</tr>
								<tr>
									<td>B.</td>
									<td><input name="pilihan[<?=$sl['id_soal'];?>]" type="radio" value="B"></td>
									<td><?=$sl['opsi_b'];?></td>
								</tr>
								<tr>
									<td>C.</td>
									<td><input name="pilihan[<?=$sl['id_soal'];?>]" type="radio" value="C"></td>
									<td><?=$sl['opsi_c'];?></td>
								</tr>
								<tr>
									<td>D.</td>
									<td><input name="pilihan[<?=$sl['id_soal'];?>]" type="radio" value="D"></td>
									<td><?=$sl['opsi_d'];?></td>
								</tr>
							</table>
							<br>
						<?php endforeach ?>
						<tr>
							<td>&nbsp;</td>
							<td><input type="button" name="submit" value="Jawab" id="submitBtn" data-toggle="modal" data-target="#akhiriUjian" class="btn btn-primary" /></td>
						</tr>
						<div class="modal fade" id="akhiriUjian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
							<div  class="modal-dialog modal-dialog-centered" role="document">
								<div style="border-radius: 30px" class="modal-content border-0">
									<div class="modal-body px-1 py-5">
										<div class="text-center">
											<img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_info.png">
											<h3 style="font-weight: 700">Perhatian!</h3>
										</div>
										<h6 class="mx-4 text-center">Apakah kamu sudah yakin dengan jawaban kamu dan ingin mengakhiri ujian ini?</h6>
										<div class="row m-0 d-flex justify-content-center mt-4">
											<button class="btn btn-batal mr-4" type="button" data-dismiss="modal">Batal</button>
											<button id="submitForm" type="submit" name="submit" class="btn btn-primary">Akhiri Ujian</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p class="m-0">Nama Siswa : <b><?=$user['name']?></b></p>
							<p class="m-0">Sisa waktu : <span id="timer"></span></p>
							<?php
							$time_start = date('d F Y, H:i:s', $ujian_siswa['date_start']);
							?>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<script>
		var countDownDate = new Date("<?=$time_start ?>").getTime();

		var x = setInterval(function() {
			var submit = document.getElementById('submit');
			var now = new Date().getTime();
			var distance = countDownDate - now;
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			document.getElementById("timer").innerHTML = hours + "h "
			+ minutes + "m " + seconds + "s ";
			if (distance <= 0) {
				clearInterval(x);
				document.getElementById("timer").innerHTML = "EXPIRED";
				alert('Waktu telah berakhir');
				window.close();
				submit.disaabled = true;
			}
		}, 1000
		);
	</script>