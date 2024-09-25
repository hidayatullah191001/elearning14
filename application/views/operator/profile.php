<div class="profile-head"></div>
<div class="container">
 <div class="row m-0 align-items-center">
    <img class="img-profile" src="<?=base_url('assets/upload/avatar/').$user['photo_profile'] ?>" alt="">
    <div class="col">
        <h3><?=$user['name'] ?></h3>
        <h6><?=$user['email'] ?></h6>
    </div>
</div>
<div class="mt-5"></div>

<?php echo $this->session->flashdata('message') ?>
<section id="profile">
    <div class="row">
        <div class="col col-lg-3 mb-4">
          <div class="card">
            <div class="card-body">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="btn btn-link active" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</a>
                    <a class="btn btn-link" id="v-pills-photo-tab" data-toggle="pill" data-target="#v-pills-photo" type="button" role="tab" aria-controls="v-pills-photo" aria-selected="false">Photo Profile</a>
                    <a class="btn btn-link" id="v-pills-password-tab" data-toggle="pill" data-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false">Ubah Password</a>
                    <button data-toggle="modal" data-target="#logoutModal" class="btn btn-delete">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-9">
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <div class="card">
                <div class="card-body">
                    <h4>Profile User</h4>
                    <form method="post" action="<?=base_url('operator/updateProfile') ?>" class="mt-5">
                        <input type="text" name="id_user" value="<?=$user['id'] ?>" hidden="">
                        <input type="text" name="id_operator" value="<?=$user['profile_id'] ?>" hidden="">
                        <input type="text" name="role_id" value="<?=$user['role_id'] ?>" hidden="">
                        <div class="form-group">
                            <label for="" style="font-weight: 500;">Nama Lengkap</label>
                            <input type="text" style="border-radius: 10px; height: 40px;" class="form-control" name="name" value="<?=$user['name'] ?>" placeholder="Masukkan nama lengkap...">
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: 500;">Email</label>
                            <input type="text" style="border-radius: 10px; height: 40px;" class="form-control" name="email" value="<?=$user['email'] ?>" readonly disabled>
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: 500;">NIP</label>
                            <input type="text" style="border-radius: 10px; height: 40px;" class="form-control" name="nip" value="<?=$user['nip'] ?>" placeholder="Masukkan nip..." required>
                        </div>

                        <div class="form-group">
                            <label for="" style="font-weight: 500;">No Telepon</label>
                            <input type="text" style="border-radius: 10px; height: 40px;" class="form-control" name="no_telp" value="<?=$user['no_telp'] ?>" placeholder="Masukkan No Telepon..." required>
                        </div> 
                        <div class="form-group text-center mt-5">
                            <button class="btn btn-primary">Perbarui Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-photo" role="tabpanel" aria-labelledby="v-pills-photo-tab">
            <div class="card">
                <div class="card-body">
                    <h4>Photo Profile</h4>
                    <form class="mt-5" enctype="multipart/form-data" action="<?=base_url('operator/updatePhoto') ?>" method="post">
                        <input type="text" name="id" value="<?=$user['profile_id'] ?>" hidden="">
                        <input type="text" name="role_id" value="<?=$user['role_id'] ?>" hidden="">

                        <div class="form-group">
                            <label for="" style="font-weight: 500;">Photo Sekarang</label><br>
                            <img style="width: 70px; object-fit: cover" src="<?=base_url('assets/upload/avatar/').$user['photo_profile'] ?>" alt="">
                            <input type="text" name="oldfoto" hidden="" value="<?=$user['photo_profile'] ?>">
                        </div>
                        <div class="form-group mt-4">
                            <label for="" style="font-weight: 500;">Upload Photo Baru</label>
                            <input type="file" style="border-radius: 10px; height: 40px;" class="form-control" name="image">
                        </div>
                        <div class="form-group text-center mt-5">
                            <button class="btn btn-primary">Perbarui Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
            <div class="card">
                <div class="card-body">
                    <h4>Ubah Password</h4>
                    <form method="post" action="<?=base_url('operator/ubahPassword') ?>" class="mt-5">
                        <div class="form-group">
                            <label for="" style="font-weight: 500;">Masukkan Password Baru</label>
                            <input type="password" style="border-radius: 10px; height: 40px;" class="form-control" name="password1" placeholder="Masukkan password...">
                        </div>
                        <div class="form-group">
                            <label for="" style="font-weight: 500;">Ulangi Password Baru</label>
                            <input type="password" style="border-radius: 10px; height: 40px;" class="form-control" name="password2" placeholder="Ulangi password...">
                        </div>
                        <div class="form-group text-center mt-5">
                            <button class="btn btn-primary">Perbarui Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



</section>
</div>