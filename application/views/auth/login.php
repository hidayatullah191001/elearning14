<div class="container-fluid px-0">
  <div class="row">

    <div class="col-lg-6 col-md-6 col-sm-6 no-padding">
      <div  class="auth-background">
        <div class="col text-center">
          <img class="icon-auth mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_auth_login.png" alt="">
          <h4 style="font-weight: 700; color: white;">Welcome to Learning Management System</h4>
          <h4 style="font-weight: 300; color: white;">SMA Negeri 14 Palembang</h4>
          <button class="btn-daftar btn btn-primary mt-5 mr-3" data-toggle="modal" data-target="#loginMobile">Login</button>
          <button class="btn-daftar btn btn-primary mt-5" data-toggle="modal" data-target="#registrationMobile">Create Account</button>
        </div>
      </div>
    </div> 
    
    <div id="loginauth" class="col-lg-6 col-md-6 col-sm-6">
      <h1 class="">Login to<br/>Your Account</h1>
      <p class="color-black">Belum punya akun? <a href="<?=base_url('auth/registration') ?>" class="color-primary" style="text-decoration: none
      ; font-weight: 600;">Daftar disini</a></p>
      <?php echo $this->session->flashdata('message') ?>
      <div class="mb-5"></div>
      <form method="POST" action="<?=base_url('auth') ?>" class="needs-validation">
        <div class="form-group">
          <label for="" style="font-weight: 500;">Email</label>
          <input id="email" type="email" class="form-control" name="email" tabindex="1" value="<?php echo set_value('email') ?>" placeholder="Masukkan email..." required autofocus>
          <?= form_error('email', '<small class="text-danger">', '</small>') ?>
          <div class="invalid-feedback">
            Please fill in your email
          </div>
        </div>
        <div class="form-group">
          <label for="" style="font-weight: 500;">Password</label>
          <input id="password" type="password"  placeholder="Masukkan password..." class="form-control" name="password" tabindex="2" required>
          <?= form_error('password', '<small class="text-danger">', '</small>') ?>
          <div class="invalid-feedback">
            please fill in your password
          </div>
        </div>
        <div class="form-group text-center mt-5">
          <button type="submit" class="btn btn-primary-form w-100">Masuk</button>
        </div>
      </form>
    </div>
  </div>

</div>
