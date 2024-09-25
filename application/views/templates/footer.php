</div>
<!-- Akhir Container -->
<footer>
  <div class="row">
    <div class="col-lg-5 col-md-5 col-sm-12 col-12">
      <img width="150" src="<?=base_url('assets/ui/') ?>assets/img/ic_logo.png" alt="">
      <p style="font-weight: 200;" class="mt-4 mb-4">Learning Management System merupakan manajemen 
        konten online atau platform pengiriman konten online. Guna LMS adalah 
        untuk mendukung proses belajar-mengajar di SMA Negeri 14 Palembang menjadi 
      lebih interaktif dan juga lebih efektif</p>    
    </div>
    <div class="col">
      <h5>Site Links</h5>
      <ul class="list-unstyled">
        <?php if ($user['role_id'] == 1): ?>
          <li class="py-2"><a href="<?=base_url('siswa') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Home</a></li>
          <li class="py-2"><a href="<?=base_url('course') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Courses</a></li>
          <li class="py-2"><a href="<?=base_url('course/mycourse') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">My Courses</a></li>
          <li class="py-2"><a href="<?=base_url('forum') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Discussion</a></li>
          <li class="py-2"><a href="<?=base_url('announcement') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Announcement</a></li>
          <li class="py-2"><a href="<?=base_url('siswa/profile') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Profile</a></li>
        <?php elseif($user['role_id'] == 2) : ?>
          <li class="py-2"><a href="<?=base_url('guru') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Home</a></li>
          <li class="py-2"><a href="<?=base_url('course') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Courses</a></li>
          <li class="py-2"><a href="<?=base_url('report') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Report</a></li>
          <li class="py-2"><a href="<?=base_url('announcement') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Announcement</a></li>
          <li class="py-2"><a href="<?=base_url('guru/profile') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Profile</a></li>
        <?php elseif($user['role_id'] == 3) : ?>
          <li class="py-2"><a href="<?=base_url('operator') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Home</a></li>
          <li class="py-2"><a href="<?=base_url('operator/management_users') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Management Users</a></li>
          <li class="py-2"><a href="<?=base_url('operator/master') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Data Master</a></li>
          <li class="py-2"><a href="<?=base_url('operator/pengumuman') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Pengumuman</a></li>
          <li class="py-2"><a href="<?=base_url('operator/profile') ?>" style="text-decoration: none; color: #fff; font-weight: 200;">Profile</a></li>
        <?php endif ?>
      </ul>
    </div>
    <div class="col">
      <h5>Any Question?</h5>
      <ul class="list-unstyled">
        <li class="py-2" style="font-weight: 200;">Jl. Pangeran Ayin Kenten Sako Palembang Sumatera Selatan</li>
        <li class="py-2" style="font-weight: 200;">0711-811588</li>
        <li class="py-2" style="font-weight: 200;">admin.lms14@gmail.com</li>
      </ul>
    </div>
  </div>
  <center class="mt-5">
    <h6 style="font-weight: 400;">Copyright ©2023 All rights reserved | E-Learning SMA Negeri 14 Palembang</h6>
  </center>
</footer>


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div  class="modal-dialog modal-dialog-centered" role="document">
  <div style="border-radius: 30px" class="modal-content border-0">
    <div class="modal-body px-1 py-5 text-center">
      <img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_logout.png">
      <h3 style="font-weight: 700">Logout Account</h3>
      <h6>Are you sure will logout</h6>
      <div class="row m-0 d-flex justify-content-center mt-4">
       <button class="btn btn-secondary-logout mr-4" type="button" data-dismiss="modal">Batal</button>
       <a href="<?=base_url('auth/logout') ?>"><button class="btn btn-primary-logout">Logout</button></a>
     </div>
   </div>
 </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>



<!-- Data Tables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


<script>
  AOS.init();

</script>

<script>
  ClassicEditor
  .create( document.querySelector( '#editor' ) )
  .catch( error => {
    console.error( error );
  } );

  ClassicEditor
  .create( document.querySelector( '#editor-tugas' ) )
  .catch( error => {
    console.error( error );
  } );

  ClassicEditor
  .create( document.querySelector( '#editor-soal' ) )
  .catch( error => {
    console.error( error );
  } );

  ClassicEditor
  .create( document.querySelector( '#editor-comment' ) )
  .catch( error => {
    console.error( error );
  } );
</script>

<button class="theme-toggle" id="toggle-theme">
  <i class='fas fa-fw fa-moon' style="color: white"></i>
</button>

<script>

</script>


<script>
  $(document).ready(function() {
    var table = $('#tabel-data').DataTable( {
      responsive: true
    } );

    new $.fn.dataTable.FixedHeader( table );
  } );

  $(document).ready(function() {
    var table = $('#tabel-data-mapel  ').DataTable( {
      responsive: true
    } );

    new $.fn.dataTable.FixedHeader( table );
  } );

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