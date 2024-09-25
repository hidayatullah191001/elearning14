<div class="modal fade" id="deleteAbsensi<?=$absensi['id_absensi']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div  class="modal-dialog modal-dialog-centered" role="document">
  <div style="border-radius: 30px" class="modal-content border-0">
    <div class="modal-body px-1 py-5 text-center">
      <img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_trash.png">
      <h3 style="font-weight: 700">Delete Absensi Tanggal <?=date('d F y', $absensi['tanggal'] )?></h3>
      <h6>Kamu yakin ingin menghapus data ini?</h6>
      <div class="row m-0 d-flex justify-content-center mt-4">
       <button class="btn btn-batal mr-4" data-dismiss="modal">Cancel</button>
       <a href="<?=base_url('absensi/deleteAbsensi/').$absensi['id_absensi'] ?>"><button class="btn btn-delete">Delete</button></a>
     </div>
   </div>
 </div>
</div>
</div>

<script>
  $('#deleteAbsensi<?=$absensi['id_absensi']?>').appendTo("body");
</script>
