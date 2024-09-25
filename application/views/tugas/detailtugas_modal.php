<div class="modal fade" id="detailtugas<?=$ts['id_tugas_siswa']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body p-5">
        <div class="mb-3">
          <h6 class="color-dark" style="font-weight: 700">Waktu Submit</h6>
          <p><?=date('d F Y, H:i', $ts['date_uploaded']); ?></p>
        </div>
        <div class="mb-3">
          <h6 class="color-dark" style="font-weight: 700">File Tugas Submit</h6>
          <a target="_blank" href="<?=base_url('assets/upload/tugas_siswa/').$ts['file_tugas'] ?>">
            <?php 
            $kalimat = $ts['file_tugas'] ;
            $max = 55;
            $cetak = substr($kalimat, 0, $max);
            if (strlen($kalimat)>$max) {
              echo $cetak.'...';
            }else{
              echo $cetak;
            }?></a>
          </div>
          <div class="mb-3">
            <h6 class="color-dark" style="font-weight: 700">Catatan Tugas Siswa</h6>
            <p><?=$ts['catatan_tugas_siswa'] ?></p>
          </div>
          <div class="mb-3">
            <h6 class="color-dark" style="font-weight: 700">Status Tugas Siswa</h6>
            <?php if ($ts['status'] == "Pending"): ?>
              <span class="badge badge-danger"><?=$ts['status'] ?></span>
              <?php else : ?>
                <span class="badge badge-success"><?=$ts['status'] ?></span>
              <?php endif ?>
            </div>
            <div class="mb-3">
              <h6 class="color-dark" style="font-weight: 700">Nilai Tugas Siswa</h6>
              <p><?=$ts['nilai'] ?></p>
            </div>
            <div class="row m-0 d-flex justify-content-center mt-4">
             <button class="btn btn-primary-form" type="button" data-dismiss="modal">Selesai</button>
           </div>
         </div>
       </div>
     </div>
   </div>

   <script>
  $('#detailtugas<?=$ts['id_tugas_siswa']?>').appendTo("body");
</script>
