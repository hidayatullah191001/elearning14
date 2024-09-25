<div class="modal fade" id="profileUser<?=$au['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div style="border-radius: 30px" class="modal-content border-0">
      <div class="modal-body px-1 py-5">
        <div class="text-center mt-5">
          <img class="img-profile" src="<?=base_url('assets/upload/avatar/').$au['photo_profile'] ?>">
          <h3 class="color-dark" style="font-weight: 700"><?=$au['name'] ?></h3>
          <h5><?=$au['email'] ?></h5>      
        </div>

        <div class="px-5">
          <h6><b>Kelas</b> : <?=$au['nama_kelas'] ?></h6>
          <h6><b>NISN</b> : <?=$au['nisn'] ?></h6>
          <h6><b>No Telepon</b> : <?=$au['no_telp'] ?></h6>
        </div>

        <div class="row m-0 d-flex justify-content-center mt-5">
         <button class="btn btn-secondary-logout mr-4" type="button" data-dismiss="modal">Kembali</button>
       </div>
     </div>
   </div>
 </div>
</div>

<script>
  $('#profileUser<?=$au['id'] ?>').appendTo("body");
</script>