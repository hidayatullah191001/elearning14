<div class="modal fade" id="updateKelas<?=$kls['id_kelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body p-5">
        <h1 style="font-weight: 500; ">Update<br/>Data Kelas</h1>
        <form method="post" action="<?= base_url('operator/update_kelas') ?>">
          <input type="text" name="id_kelas" hidden="" value="<?=$kls['id_kelas'] ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="" class="text-pks font-weight-bold">Nama Kelas</label>
              <input type="text" class="form-control text-pks" id="kelas" name="kelas" placeholder="Masukkan nama kelas..." value="<?=$kls['nama_kelas'] ?>">
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