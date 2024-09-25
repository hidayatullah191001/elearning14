

<div class="modal fade" id="loginMobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body p-5">
        <h1 style="font-weight: 500; ">Login to <br/>Your Account</h1>
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
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
          </div>
          <div class="form-group text-center mt-1">
            <button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Batal</p></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="registrationMobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body px-5 py-5">
        <h1 style="font-weight: 500;">Create <br/>Your Account</h1>
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
          <div class="form-group text-center mt-5">
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
          </div>
          <div class="form-group text-center mt-1">
            <button  class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Batal</p></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<button class="theme-toggle" id="toggle-theme">
	<i class='fas fa-fw fa-moon' style="color: white"></i>
</button>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#toggle-theme').on('click', function () {
            if ($('body').hasClass('dark-theme')) {
                $(this).toggleClass('btn-light');
                $(this).addClass('btn-dark');
                $('body').toggleClass('dark-theme');
                $('p').toggleClass('dark-theme');
                $('.modal-content').toggleClass('dark-theme');
                $('.card').toggleClass('dark-theme');
           		$('#toggle-theme').html("<i class='fas fa-fw fa-moon' style='color: white'></i>");
                localStorage.setItem("mode", "light-theme");
            } else {
                $(this).toggleClass('btn-light');
                $(this).removeClass('btn-dark');
                $('body').toggleClass('dark-theme');
                $('p').toggleClass('dark-theme');
                $('.modal-content').toggleClass('dark-theme');

                $('#toggle-theme').html("<i class='fas fa-fw fa-sun' style='color: white'></i>");
                $('.card').toggleClass('dark-theme');
                localStorage.setItem("mode", "dark-theme");
            }
        })
        //check for localStorage, add as browser preference if missing
        if (!localStorage.getItem("mode")) {
            if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
                localStorage.setItem("mode", "dark-theme");
            } else {
                localStorage.setItem("mode", "light-theme");
            }
        }

        //set interface to match localStorage
        if (localStorage.getItem("mode") == "dark-theme") {
            $('#toggle-theme').removeClass('btn-dark');
            $('#toggle-theme').addClass('btn-light');
            $('#toggle-theme').html("<i class='fas fa-fw fa-sun' style='color: white'></i>");
            $('body').addClass('dark-theme');
            $('p').addClass('dark-theme');
            $('.modal-content').addClass('dark-theme');

            $('.card').addClass('dark-theme');
            document.getElementById("toggle-theme").checked = true;
        } else {
            $('#toggle-theme').addClass('btn-dark');
            $('#toggle-theme').removeClass('btn-light');
            $('#toggle-theme').html("<i class='fas fa-fw fa-moon' style='color: white'></i>");
            $('body').removeClass('dark-theme');
            $('p').removeClass('dark-theme');
            $('.modal-content').removeClass('dark-theme');
            $('.card').removeClass('dark-theme');
            document.getElementById("toggle-theme").checked = false;
        };
    });
</script>

</body>
</html>