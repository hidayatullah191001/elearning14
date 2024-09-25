<div class="modal fade" id="updatePengumuman<?=$pengumuman['id_pengumuman']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body p-5">
        <h1 style="font-weight: 500; ">Update<br/>Pengumuman</h1>
        <form method="post" action="<?= base_url('announcement/update_pengumuman') ?>">
          <input type="text" name="id_pengumuman" hidden="" value="<?=$pengumuman['id_pengumuman'] ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="" class="text-pks font-weight-bold">Title Pengumuman</label>
              <input type="text" class="form-control text-pks" id="title_pengumuman" name="title_pengumuman" placeholder="Masukkan nama title_pengumuman..." value="<?=$pengumuman['title_pengumuman'] ?>">
              <?= form_error('title_pengumuman', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
              <label for="" class="text-pks font-weight-bold">Deskripsi Pengumuman</label>
              <textarea name="deskripsi_pengumuman" id="editor-tugas"><?=$pengumuman['deskripsi_pengumuman'] ?></textarea>
              <?= form_error('deskripsi_pengumuman', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group text-center mt-5">
              <button type="submit" class="btn btn-primary-form w-100">Submit</button>
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