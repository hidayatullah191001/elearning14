<div class="modal fade" id="updateUser<?=$us['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
	<div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div style="border-radius: 30px" class="modal-content border-0">
			<div class="modal-body p-5">
				<h1 style="font-weight: 500; ">Update<br/><?=$us['name'] ?> Account</h1>
				<form method="post" action="<?= base_url('operator/update_user') ?>">
					<input type="hidden" name="id" value="<?= $us['id']; ?>">
					<div class="modal-body">
						<div class="form-group">
							<label for="" class="text-pks font-weight-bold">Nama Lengkap</label>
							<input type="text" class="form-control text-pks" id="name" name="name" placeholder="Masukkan nama lengkap..." value="<?=$us['name'] ?>">
							<?= form_error('name', '<small class="text-danger">', '</small>') ?>
						</div>
						<div class="form-group">
							<label for="" class="text-pks font-weight-bold">Email</label>
							<input type="text" class="form-control text-pks" id="email" name="email" placeholder="Masukkan Email..." value="<?=$us['email'] ?>" readonly>
							<?= form_error('email', '<small class="text-danger">', '</small>') ?>
						</div>
						<div class="form-group">
							<label for="" class="text-pks font-weight-bold">Role</label>
							<select name="role_id" class="form-control border selectpicker" data-live-search="true">
								<?php foreach ($role as $rl) :?>
									<?php if ($us['role_id'] == $rl['id']) { 
										echo "<option selected value= '".$rl['id']."'>".$rl['role']."</option>'";
									}else{
										echo "<option value= '".$rl['id']."'>".$rl['role']."</option>'";
									}?>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<label for="mobile-id-icon">Aktif</label>
							<div class='form-check'>
								<div class="checkbox mt-2">
									<?php if ($us['is_active'] == 0): ?>
										<?= form_checkbox('is_active','1',FALSE)."Aktif kan Akun";?>
									<?php endif ?>

									<?php if ($us['is_active'] == 1): ?>
										<?= form_checkbox('is_active','1',TRUE)."Aktif kan Akun";?>
									<?php endif ?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="mobile-id-icon">Hapus Akun</label>
							<div class='form-check'>
								<div class="checkbox mt-2">
									<?php if ($us['is_deleted'] == 0): ?>
										<?= form_checkbox('is_deleted','1',FALSE)."Hapus Akun";?>
									<?php endif ?>

									<?php if ($us['is_deleted'] == 1): ?>
										<?= form_checkbox('is_deleted','1',TRUE)."Pulihkan";?>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group text-center mt-3">
						<button type="submit" class="btn btn-primary w-100">Submit</button>
					</div>
					<div class="form-group text-center mt-1">
						<button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Batal</p></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>