  <section data-aos="fade-up" id="detail">
    <?php echo $this->session->flashdata('message') ?>

    <div class="row">
      <div class="col-lg-5">
        <img style="height: 250px; border-radius: 15px; object-fit: cover; width: 100%" src="<?=base_url('assets/upload/thumbnail/').$course['thumbnail'] ?>" alt="">
        <button class="d-sm-block d-none btn btn-primary-form w-100 mt-4" data-toggle="modal" data-target="#enrollCourse" >Enroll Course</button>
        <div class="mt-4">
          <h5><i class="fas fa-school mr-2 mb-2"></i>Kelas <?=$course['nama_kelas'] ?></h5>
          <h5><i class="fas fa-book-open mr-2 mb-2"></i>Mata Pelajaran <?=$course['mapel'] ?></h5>
          <!-- <h5><i class="fas fa-user-plus mr-2 mb-2"></i><?=$count_enroll ?> Siswa Enroll</h5> -->
          <h5><i class="fas fa-tasks mr-2 mb-2"></i>Absensi Tersedia</h5>
        </div>
      </div>
      <div class="col">
        <h1><?=$course['nama_course'] ?></h1>
        <span class="badge badge-success"><i class="fas fa-fw fa-calendar"></i> <?=date('d F Y', $course['date_created_course']) ?></span>
        
        <?php 
        $i = 0;
        foreach ($enroll_course as $ec): ?>
          <?php if ($ec['course_uuid'] == $course['uuid']): ?>
            <?php $i++; ?>
          <?php endif ?>
        <?php endforeach ?>
        <span class="badge badge-primary"><i class="fas fa-fw fa-users"></i> <?=$i ?> Siswa Enroll</span>
        <div class="mb-5"></div>
        <h5><b>Deskripsi Course</b></h5>
        <?=$course['deskripsi'] ?>
        <div class="mb-5"></div>
        <h5><b>Pengajar</b></h5>
        <div class="row m-0 align-items-center">
          <img style="width: 80px; height: 80px" class="avatar" src="<?=base_url('assets/upload/avatar/').$course['photo_profile'] ?>">
          <div class="col">
            <h5><?=$course['name'] ?></h5>
            <h6><?=$course['email'] ?></h6>
          </div>
        </div>
         <button class="d-sm-none d-block btn btn-primary-form w-100 mt-5" data-toggle="modal" data-target="#enrollCourse" >Enroll Course</button>
      </div>
    </div>
  </section>
  
  <div class="modal fade" id="enrollCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div  class="modal-dialog modal-dialog-centered" role="document">
      <div style="border-radius: 30px" class="modal-content border-0">
        <div class="modal-body px-1 py-5 text-center">
          <img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_lock.png">
          <h3 style="font-weight: 700">Masukkan Key Course</h3>
          <h6>Hubungi pengajar untuk meminta key course</h6>
          <form class="px-5 mt-3" method="post" action="<?=base_url('course/enroll/').$course['uuid'] ?>">
            <div class="form-group">
              <input style="height: 45px; border-radius: 30px" type="text" name="keyenroll" class="form-control" placeholder="Masukkan key enroll...">
            </div>
            <div class="row m-0 d-flex justify-content-center mt-4">
             <button class="btn btn-secondary-logout mr-4" type="button" data-dismiss="modal">Batal</button>
             <button type="submit" class="btn btn-primary-logout">Enroll Course</button>
           </div>
         </form>

       </div>
     </div>
   </div>
 </div>
</div>
