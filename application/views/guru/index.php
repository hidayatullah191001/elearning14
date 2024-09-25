
  <section data-aos="fade-up" id="guru-intro">
   <div class="text-center">
    <img class="avatar mb-3" src="<?=base_url('assets/upload/avatar/').$user['photo_profile'] ?>">
    <h2>Selamat Datang di Panel Guru</h2>
    <h1>E-Learning SMA Negeri 14 Palembang</h1>
    <p>Membantu proses belajar mengajar menjadi lebih efektif</p>
  </div>
</section>

<section data-aos="fade-up" id="guru-info">
  <div class="row align-items-center m-0">
    <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center mb-4">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <img class="img-fluid" src="<?=base_url('assets/ui/')?>assets/img/categories_icon.png">
            </div>
            <div class="col">
              <h3 class="font-weight-bold"><?=$count_course ?></h3>
              <h6>Total of Courses</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center mb-4">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <img class="img-fluid" src="<?=base_url('assets/ui/')?>assets/img/employee_icon.png">
            </div>
            <div class="col">
              <h3 class="font-weight-bold"><?=$count_siswa ?></h3>
              <h6>Total of Siswa</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center mb-4">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <img class="img-fluid" src="<?=base_url('assets/ui/')?>assets/img/courses_icon.png">
            </div>
            <div class="col">
              <h3 class="font-weight-bold"><?=$count_announcement ?></h3>
              <h6>Total of Annnouncement</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>