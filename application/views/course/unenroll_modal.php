<div class="modal fade" id="unenrollCourse<?=$course['id_enroll'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div  class="modal-dialog modal-dialog-centered" role="document">
  <div style="border-radius: 30px" class="modal-content border-0">
    <div class="modal-body px-1 py-5 text-center">
      <img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_trash.png">
      <h3 class="color-dark" style="font-weight: 700">Unenroll Course</h3>
      <h6>Kamu yakin ingin menghapus course ini?</h6>
      <div class="row m-0 d-flex justify-content-center mt-4">
       <button class="btn btn-secondary-logout mr-4" type="button" data-dismiss="modal">Batal</button>
       <a href="<?=base_url('course/deleteEnroll/').$course['id_enroll'] ?>"><button class="btn btn-primary-logout">Unenroll</button></a>
     </div>
   </div>
 </div>
</div>
</div>

<script>
  $('#unenrollCourse<?=$course['id_enroll'] ?>').appendTo("body");
</script>