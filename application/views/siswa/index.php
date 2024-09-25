<section id="intro">
  <div class="row align-items-center m-0">
    <div class="col mt-3"  data-aos="fade-right">
      <h2 class="d-sm-block d-none">Selamat Datang di</h2>
      <h2 class="d-sm-none d-block mt-5">Selamat Datang di</h2>
      <h1>E-Learning SMA Negeri 14 Palembang</h1>
      <p>Membantu proses belajar mengajar menjadi lebih efektif</p>
      <form action="<?=base_url('course') ?>">
        <div class="row d-flex align-items-center justify-content-between">
          <div class="col-lg-8 col-md-6 col-6">
            <input type="text" style="border-radius: 100px; height: 50px;" class="form-control" placeholder="Masukkan kata kunci..." name="search">
          </div>
          <div class="col">
            <button type="" class="btn btn-primary-form btn-sm">Cari Course</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-6"  data-aos="fade-left">
      <img style="width: 100%; padding: 40px;" src="<?=base_url('assets/ui/') ?>assets/img/Group 13283.png" alt="">
    </div>
  </div>
</section>

<section id="mapel" data-aos="fade-up">
  <div class="text-center mb-5">
    <h1>Mata Pelajaran</h1>
    <p>Ini adalah mata pelajaran yang telah disiapkan di dalam Learning Management System</p>
  </div>
  <div class="row px-4 justify-content-center">
    <?php foreach ($mapel as $mp): ?>
      <div class="col-lg-3">
        <div class="card card-category mr-3 mb-3">
          <div class="card-body text-center">
            <a href="<?=base_url('course?category=').$mp['id_mapel'] ?>" style="color: inherit; text-decoration: none;"><span><?=$mp['mapel'] ?> <img style="width: 30px" src="<?=base_url('assets/ui/')?>assets/img/category_icon.png"></span></a>
          </div>
        </div>  
      </div>
    <?php endforeach ?>
  </div>
</section>

<section id="course" data-aos="fade-up">
  <div class="text-center mb-5">
    <h1>Courses</h1>
    <p>Ini adalah beberapa course baru yang telah dibuat oleh guru</p>
  </div>
  <div class="row justify-content-center">
   <?php foreach ($new_course as $nc): ?>
     <div class="col-lg-4 col-md-4 col-sm-6 col mb-4">
      <div class="card">
        <div class="card-body">
          <img style="height: 180px; object-fit: cover; width: 100%" src="<?=base_url('assets/upload/thumbnail/').$nc['thumbnail'] ?>" alt="">
          <h5 class="mt-3"><?=$nc['nama_course'] ?></h5>
          <div class="row m-0 justify-content-between">
            <p><?=$nc['nama_kelas'] ?></p>
            <p class="float-right"><?=$nc['mapel'] ?></p>
          </div>
          <a href="<?=base_url('course/detailCourse/').$nc['uuid'] ?>"><button class="btn btn-primary w-100 mt-4">Lihat Detail</button></a>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>
<center class="mt-5">
  <a href="<?=base_url('course') ?>"><button class="btn btn-primary">Lihat Lebih Banyak <img style="width: 30px" src="<?=base_url('assets/ui/')?>assets/img/category_icon.png"></button></a>
</center>
</section>
