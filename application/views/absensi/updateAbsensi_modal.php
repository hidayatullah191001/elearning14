<div class="modal fade" id="updateAbsensi<?=$absensi['id_absensi']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
	<div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div style="border-radius: 30px" class="modal-content border-0">
			<div class="modal-body p-5">
				<h1 style="font-weight: 500; ">Update<br/>Attendance <?=date('d F Y', $absensi['tanggal']) ?></h1>
				<form action="<?=base_url('absensi/updateAbsensi/').$absensi['id_absensi'] ?>" method="post">
					<div class="form-group">
						<label>Tanggal Absen<span class="text-danger">*</span></label>
						<input type="date" class="form-control" value="<?=date('Y-m-d', $absensi['tanggal']) ?>" id="tanggal" name="tanggal" >
					</div>
					<div class="form-group">
						<label>Mulai Jam Absen<span class="text-danger">*</span></label>
						<input type="time" class="form-control" value="<?=date('H:i', $absensi['jam_mulai']) ?>" id="mulai" name="mulai" >
					</div>
					<div class="form-group">
						<label>Akhir Jam Absen<span class="text-danger">*</span></label>
						<input type="time" class="form-control" value="<?=date('H:i', $absensi['jam_akhir']) ?>" id="akhir" name="akhir">
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
	$('#updateAbsensi<?=$absensi['id_absensi']?>').appendTo("body");
</script>