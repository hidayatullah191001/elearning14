<div class="modal fade" id="updateMapel<?=$mpl['id_mapel'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body p-5">
        <h1 style="font-weight: 500; ">Update<br/>Data Mata Pelajaran</h1>
        <form method="post" action="<?= base_url('operator/update_mapel') ?>">
          <input type="text" name="id_mapel" hidden="" value="<?=$mpl['id_mapel'] ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="" class="text-pks font-weight-bold">Nama Mata Pelajaran</label>
              <input type="text" class="form-control text-pks"  name="mapel" placeholder="Masukkan nama mata pelajaran..." value="<?=$mpl['mapel'] ?>">
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