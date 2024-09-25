<div class="container">
  <section id="operator-intro">
   <?=$this->session->flashdata('message') ?>

   <h1><?=$title ?></h1>
   <p>Operator bisa melakukan management data master seperti kelas dan mata pelajaran</p>
 </section>

 <section id="operator-info">
  <div class="row m-0 align-items-center justify-content-between">
    <h4>Data Kelas</h4>
    <button data-toggle="modal" data-target="#createKelas" class="btn btn-primary"><i class="fas fa-fw fa-plus fa-sm"></i> Tambah Kelas</button>
  </div>
  <div class="mt-5"></div>
  <table id="tabel-data" class="table" style="width:100%">
    <thead>
      <tr class="text-center">
        <th>No</th>
        <th>Kelas</th>
        <th>Tanggal Dibuat</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $i = 1;
      foreach ($kelas as $kls): ?>
        <tr class="text-center">
          <td><?=$i++ ?></td>
          <td><?=$kls['nama_kelas'] ?></td>
          <td><?=date('d F Y', $kls['date_created'])?></td>
          <td>
            <button data-toggle="modal" data-target="#updateKelas<?=$kls['id_kelas']?>" class="btn btn-edit btn-sm mb-2"><i class="fas fa-pen"></i> Update</button>
            <button data-toggle="modal" data-target="#deleteKelas<?=$kls['id_kelas']?>" class="btn btn-delete btn-sm mb-2"><i class="fas fa-trash"></i> Delete</button>
          </td>
        </tr>
        <?php include 'update_kelas.php' ?>
        <?php include 'delete_kelas.php' ?>
      <?php endforeach ?>
    </tbody>
  </table>
</section>

<section id="operator-info">
  <div class="row m-0 align-items-center justify-content-between">
    <h4>Data Mata Pelajaran</h4>
    <button data-toggle="modal" data-target="#createMapel" class="btn btn-primary"><i class="fas fa-fw fa-plus fa-sm"></i> Tambah Mata Pelajaran</button>
  </div>
  <div class="mt-5"></div>
  <?php if (count($mapel) < 1): ?>
    <div class="text-center">
      <img src="<?=base_url('assets/ui/') ?>assets/img/not_found.png">
      <h5 class="mt-2">Tidak ada data yang ditemukan!</h5 >
    </div>

    <?php else : ?>
     <table id="tabel-data-mapel" class="table" style="width:100%">
      <thead>
        <tr class="text-center">
          <th>No</th>
          <th>Mapel</th>
          <th>Tanggal Dibuat</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $i = 1;
        foreach ($mapel as $mpl): ?>
          <tr class="text-center">
            <td><?=$i++ ?></td>
            <td><?=$mpl['mapel'] ?></td>
            <td><?=date('d F Y', $mpl['date_created'])?></td>
            <td>
              <button data-toggle="modal" data-target="#updateMapel<?=$mpl['id_mapel']?>" class="btn btn-edit btn-sm mb-2"><i class="fas fa-pen"></i> Update</button>
              <button data-toggle="modal" data-target="#deleteMapel<?=$mpl['id_mapel']?>" class="btn btn-delete btn-sm mb-2"><i class="fas fa-trash"></i> Delete</button>
            </td>
          </tr>
          <?php include 'update_mapel.php' ?>
          <?php include 'delete_mapel.php' ?>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>

</section>


</div>

<div class="modal fade" id="createKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body p-5">
        <h1 style="font-weight: 500; ">Create<br/>New Kelas</h1>
        <form method="post" action="<?= base_url('operator/create_kelas') ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="" class="text-pks font-weight-bold">Nama Kelas</label>
              <input type="text" class="form-control text-pks" id="kelas" name="kelas" placeholder="Masukkan nama kelas...">
              <?= form_error('kelas', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group text-center mt-5">
              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
            <div class="form-group text-center mt-1">
              <button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Cancel</p></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="createMapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body p-5">
        <h1 style="font-weight: 500; ">Create<br/>New Mata Pelajaran</h1>
        <form method="post" action="<?= base_url('operator/create_mapel') ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="" class="text-pks font-weight-bold">Nama Mata Pelajaran</label>
              <input type="text" class="form-control text-pks" name="mapel" placeholder="Masukkan nama mata pelajaran...">
              <?= form_error('mapel', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group text-center mt-5">
              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
            <div class="form-group text-center mt-1">
              <button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Cancel</p></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>