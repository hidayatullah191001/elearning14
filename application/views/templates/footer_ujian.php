<footer>
  <div class="row">
    <div class="col-lg-5 col-md-3 col text-center">
      <img width="150" src="<?=base_url('assets/ui/') ?>assets/img/ic_logo.png" alt="">
      <p style="font-weight: 200;" class="mt-4 mb-4">Learning Management System merupaakan manajemen 
        konten online atau platform pengiriman konten online. Guna LMS adalah 
        untuk mendukung proses belajar-mengajar di SMA Negeri 14 Palembang menjadi 
      lebih interaktif dan juga lebih efektif</p>    
    </div>
  </div>
  <center class="mt-5">
    <h6 style="font-weight: 400;">Copyright ©2023 All rights reserved | E-Learning SMA Negeri 14 Palembang</h6>
  </center>
</footer>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<button class="theme-toggle" id="toggle-theme">
  <i class='fas fa-fw fa-moon' style="color: white"></i>
</button>

<script>
  $(document).ready(function () {
    $('#toggle-theme').on('click', function () {
      if ($('body').hasClass('dark-theme')) {
        $(this).toggleClass('btn-light');
        $(this).addClass('btn-dark');
        $('body').toggleClass('dark-theme');
        $('h4').toggleClass('dark-theme');
        $('p').toggleClass('dark-theme');
        $('.modal-content').toggleClass('dark-theme');
        $('.card').toggleClass('dark-theme');
        $('#toggle-theme').html("<i class='fas fa-fw fa-moon' style='color: white'></i>");
        localStorage.setItem("mode", "light-theme");
      } else {
        $(this).toggleClass('btn-light');
        $(this).removeClass('btn-dark');
        $('body').toggleClass('dark-theme');
        $('h4').toggleClass('dark-theme');
        $('p').toggleClass('dark-theme');
        $('span').toggleClass('dark-theme');
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
          $('h4').addClass('dark-theme');
          $('p').addClass('dark-theme');
          $('.modal-content').addClass('dark-theme');

          $('.card').addClass('dark-theme');
          document.getElementById("toggle-theme").checked = true;
        } else {
          $('#toggle-theme').addClass('btn-dark');
          $('#toggle-theme').removeClass('btn-light');
          $('#toggle-theme').html("<i class='fas fa-fw fa-moon' style='color: white'></i>");
          $('body').removeClass('dark-theme');          $('h4').removeClass('dark-theme');
          $('p').removeClass('dark-theme');
          $('.modal-content').removeClass('dark-theme');
          $('.card').removeClass('dark-theme');
          document.getElementById("toggle-theme").checked = false;
        };
      });
    </script>

</body>
</html>