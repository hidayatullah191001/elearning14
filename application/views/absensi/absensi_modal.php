<div class="modal fade" id="absensiCourse<?=$ab['id_absensi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div  class="modal-dialog modal-dialog-centered" role="document">
  <div style="border-radius: 30px" class="modal-content border-0">
    <div class="modal-body px-1 py-5 text-center">
      <img width="100" class="mb-3" src="<?=base_url('assets/ui/') ?>assets/img/ic_calendar.png">
      <h3 style="font-weight: 700">Absensi Tanggal <?php  date_default_timezone_set('Asia/Jakarta'); echo date('d F Y', $ab['tanggal']); ?></h3>
      <h6>Dari jam <?=date('H:i', $ab['jam_mulai'])?> - <?=date('H:i', $ab['jam_akhir'])?></h6>
      <form class="px-5 mt-3" method="post" action="<?=base_url('absensi?course=').$course['uuid'] ?>">
        <input type="text" value="<?=$ab['id_absensi'] ?>" name="id_absensi" hidden> 
        <div class="form-group">
          <select style="border-radius: 20px" class="form-control" name="keterangan">
            <option selected="" disabled="">Pilih keterangan...</option>
            <option value="Hadir">Hadir</option>
            <option value="Sakit">Sakit</option>
            <option value="Izin">Izin</option>
            <option value="Tidak Hadir">Tidak Hadir</option>
          </select>
        </div>
        <div class="row m-0 d-flex justify-content-center mt-4">
         <button class="btn btn-secondary-logout mr-4" type="button" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary-logout">Submit</button>
       </div>
     </form>

   </div>
 </div>
</div>
</div>


<script>
  $('#absensiCourse<?=$ab['id_absensi'] ?>').appendTo("body");
</script>
