<div class="modal fade" id="nilaiModal<?=$ts['id_tugas_siswa']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body p-5">
        <h1 class="mb-4" style="font-weight: 500; ">Create<br/>New Video Section</h1>

        <?php if ($ts['catatan_tugas_siswa'] != null): ?>
         <h6><b>Catatan Siswa</b></h6>
         <?=$ts['catatan_tugas_siswa']?>
       <?php endif ?>

       <form class="mt-4" action="<?=base_url('tugas/nilaiTugasSiswa/').$ts['id_tugas_siswa'] ?>" method="post">
        <div class="form-group">
          <label>Nilai Tugas Siswa</label>
          <input type="number" max="100" name="nilai" class="form-control" value="<?=$ts['nilai'] ?>" placeholder="Masukkan nilai">
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


<script>
  $('#nilaiModal<?=$ts['id_tugas_siswa']?>').appendTo("body");
</script>
