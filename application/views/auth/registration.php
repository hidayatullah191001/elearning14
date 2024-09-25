
<div class="container-fluid px-0">
  <div class="row">
    <div class="col-lg-6 no-padding">
      <div class="auth-background">
        <div class="col text-center">
          <img class="icon-auth mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_auth_login.png" alt="">
          <h4 style="font-weight: 700; color: white;">Welcome to Learning Management System</h4>
          <h4 style="font-weight: 300; color: white;">SMA Negeri 14 Palembang</h4>
          <button class="btn-daftar btn btn-primary mt-5">Daftar Akun</button>
          <button class="btn-daftar btn btn-primary mt-5 ml-3">Masuk</button>
        </div>
      </div>
    </div> 
    <div id="register" class="col-lg-6">
      <h1>Create <br/>Your Account</h1>
      <p class="color-black">Sudah punya akun? <a href="<?=base_url('auth') ?>" class="color-primary" style="text-decoration: none
      ; font-weight: 600;">Masuk disini</a></p>
      <div class="mb-5"></div>
      <form method="POST" action="<?=base_url('auth/registration') ?>">
        <div class="form-group">
          <label for="" style="font-weight: 500;">Nama Lengkap</label>
          <input id="name" type="text" class="form-control" name="name" autofocus placeholder="Masukkan nama lengkap..." value="<?= set_value('name') ?>">
          <?= form_error('name', '<small class="text-danger">', '</small>') ?>
        </div>
        <div class="form-group">
          <label for="" style="font-weight: 500;">Email</label>
          <input id="email" type="email" class="form-control" name="email" value="<?= set_value('email') ?>" placeholder="Masukkan email...">
          <?= form_error('email', '<small class="text-danger">', '</small>') ?>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="" style="font-weight: 500;">Password</label>
              <input id="password1" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password1" placeholder="Masukkan password..."> 
              <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="" style="font-weight: 500;">Ulangi Password</label>
               <input id="password2" type="password" class="form-control" name="password2" placeholder="Ulangi password...">
               <?= form_error('password2', '<small class="text-danger">', '</small>') ?>
            </div>
          </div>
        </div>
        <div class="form-group text-center mt-5 mb-5">
          <button class="btn btn-primary-form w-100">Daftar</button>
        </div>
      </form>
    </div> 
  </div>
</div>