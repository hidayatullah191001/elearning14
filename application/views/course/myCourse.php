<section data-aos="fade-up" id="guru-info">
  <?=$this->session->flashdata('message') ?>
  <div class="row justify-content-between align-items-center m-0">
    <div>
      <h1><?=$title ?></h1>
      <p>Mulai dan pelajari course yang telah kamu enroll!</p>
    </div>
  </div>
  <div class="mb-5"></div>
  <div class="d-sm-none d-block">
    <h5>Search Course</h5>
    <form class="row align-items-center justify-content-between mb-3">
      <div class="col-lg-9 col-9">
        <input placeholder="Masukkan keyword..." type="text" name="search" class="form-control">
      </div>
      <div class="col">
        <button class="btn btn-primary">Cari</button>
      </div>
    </form>
  </div>
  <div class="row py-3">


    <div class="col-lg-7 col-md-6 col-sm-7">
      <?php if (count($courses) < 1): ?>
        <center>
          <img  src="<?=base_url('assets/ui/assets/img/ic_no_data.png') ?>">
          <h5>Oops!! Course yang kamu cari tidak ada. Coba Lagi!</h5>
        </center>
        <?php else : ?>
          <?php foreach ($courses as $course): ?>
            <a href="<?=base_url('course/detail/').$course['uuid'] ?>" style="color: inherit; text-decoration: none">
              <div class="card card-course mb-3">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-lg-5">
                      <?php if ($course['thumbnail'] != null): ?>
                        <img class="img-fluid-course" src="<?=base_url('assets/upload/thumbnail/') .$course['thumbnail']?>">
                        <?php else : ?>
                          <img class="img-fluid-course" src="<?=base_url('assets/ui/') ?>assets/img/learning.webp">
                        <?php endif ?>
                      </div>
                      <div class="col">
                        <h3 class="mt-1"><?=$course['nama_course'] ?></h3>
                        <p class="badge badge-warning m-0">Kelas : <?=$course['nama_kelas'] ?></p>
                        <p class="badge badge-success"><p class="badge badge-success">Mata Pelajaran : <?=$course['mapel'] ?></p>
                        <?php
                        $kalimat = $course['deskripsi'] ;
                        $max = 100;
                        $cetak = substr($kalimat, 0, $max);
                        if (strlen($kalimat)>$max) {
                          echo $cetak.'...';
                        }else{
                          echo $cetak;
                        }?>
                      </div>
                    </div>
                  </div>
                </div>
              </a>

            <?php endforeach ?>
          <?php endif ?>
        </div>

        <div class="col-lg-1 col-md-1"></div>
        <div class="col-lg-4 col-md">
          <div class="d-sm-block d-none">
            <h5>Search Course</h5>
            <form class="row align-items-center">
              <div class="col-lg-9 col-md-9">
                <input placeholder="Masukkan keyword..." type="text" name="search" class="form-control">
              </div>
              <div class="col">
                <button class="btn btn-primary">Cari</button>
              </div>
            </form>
          </div>

          <div class="mt-5"></div>

          <h5>Platform's</h5>
          <a href="https://sman14plg.sch.id/" target="_blank" style="color: inherit; text-decoration: none">
            <div class="card card-category mb-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                    <img class="img-fluid" src="<?=base_url('assets/ui/') ?>assets/img/sman14.png">
                  </div>  
                  <div class="col-lg col-md col-sm col">
                    <b>SMA Negeri 14 Palembang</b>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <a href="https://perpussman14.site/" target="_blank" style="color: inherit; text-decoration: none">
            <div class="card card-category mb-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                    <img class="img-fluid" src="<?=base_url('assets/ui/') ?>assets/img/perpustakaan.png">
                  </div>  
                  <div class="col-lg col-md col-sm col">
                    <b>Perpustakaan Digital SMA Negeri 14 Palembang</b>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

    </section>
  </div>
