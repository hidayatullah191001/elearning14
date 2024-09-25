
<div class="container">
	<section id="operator-intro">
	 <?=$this->session->flashdata('message') ?>

		<h1><?=$title ?></h1>
		<p>Operator bisa melakukan management users siswa atapun guru</p>
	</section>

	<section id="operator-info">
		<button data-toggle="modal" data-target="#createAccount" class="btn btn-primary"><i class="fas fa-fw fa-plus fa-sm"></i> Create Account</button>
		<div class="mb-5"></div>
		<table id="tabel-data" class="table" style="width:100%">
			<thead>
				<tr class="text-center">
					<th>No</th>
					<th>Tanggal Gabung</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Role</th>
					<th>Status Akun</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 1;
				foreach ($userr as $us): ?>
					<tr class="text-center">
						<td><?=$i++ ?></td>
						<td><?=date('d F Y', $us['date_created']) ?></td>
						<td><?=$us['name'] ?></td>
						<td><?=$us['email'] ?></td>
						<td>
							<?php foreach ($role as $rl) : ?>
								<?php if ($us['role_id'] == $rl['id']): ?>
									<p><?= $rl['role'] ?></p>
								<?php endif ?>
							<?php endforeach ?>
						</td>
						<td><?php  if($us['is_active'] > 0) {?>
							<p class="badge badge-success">Active</p>
						<?php } else { ?>
							<p class="badge badge-danger">Not Actived</p>
							<?php } ?></td>
							<td>
								<button data-toggle="modal" data-target="#updateUser<?=$us['id']?>" class="btn btn-edit btn-sm mb-2"><i class="fas fa-pen"></i> Update</button>
								<?php if ($us['role_id'] != 3): ?>
									<button data-toggle="modal" data-target="#deleteUser<?=$us['id']?>" class="btn btn-delete btn-sm mb-2"><i class="fas fa-trash"></i> Delete</button>
								<?php endif ?>
								
							</td>
						</tr>
						<?php include "update_user.php" ?>
						<?php include "delete_user.php" ?>
					<?php endforeach ?>
				</tbody>
			</table>
		</section>
	</div>

	<div class="modal fade" id="createAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
		<div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div style="border-radius: 30px" class="modal-content border-0">
				<div class="modal-body p-5">
					<h1 style="font-weight: 500; ">Create<br/>New Account</h1>
					<form method="post" action="<?= base_url('operator/add_user') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label for="" class="text-pks font-weight-bold">Nama Lengkap</label>
								<input type="text" class="form-control text-pks" id="name" name="name" placeholder="Masukkan nama lengkap...">
								<?= form_error('name', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="" class="text-pks font-weight-bold">Email</label>
								<input type="text" class="form-control text-pks" id="email" name="email" placeholder="Masukkan Email...">
								<?= form_error('email', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="" class="text-pks font-weight-bold">Role</label>
								<select name="role_id" class="form-control border selectpicker" data-live-search="true">
									<option value="0" disabled="" selected="">Select Role</option>
									<?php foreach ($role as $rl) : ?>
										<option value="<?= $rl['id'] ?>"><?= $rl['role'] ?></option>
									<?php endforeach ?>
								</select>
							</div>

							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label for="" class="text-pks font-weight-bold">Password</label>
										<div class="input-group mb-3">
											<input type="password" class="form-control text-pks" placeholder="Password..." id="password1" name="password1">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2"><i class="fas fa-fw fa-eye"  id="togglePassword1"></i></span>
											</div>
										</div>
										<?= form_error('password1', '<small class="text-danger">', '</small>') ?>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label for="" class="text-pks font-weight-bold">Konfirmasi Password</label>
										<div class="input-group mb-3">
											<input type="password" class="form-control text-pks" placeholder="Konfirmasi password..." id="password2" name="password2">
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2"><i class="fas fa-fw fa-eye" id="togglePassword2"></i></span>
											</div>
										</div>
										<?= form_error('password2', '<small class="text-danger">', '</small>') ?>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<button type="submit" class="btn btn-primary w-100">Submit</button>
						</div>
						<div class="form-group text-center mt-1">
							<button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Cancel</p></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


