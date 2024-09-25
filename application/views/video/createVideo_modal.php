<div class="modal fade" id="createVideo<?=$section['id_section'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
	<div  class="modal-dialog modal-dialog-centered" role="document">
		<div style="border-radius: 30px" class="modal-content border-0">
			<div class="modal-body p-5">
				<h1 style="font-weight: 500; ">Create<br/>New Video Section</h1>
				<form method="post" action="<?=base_url('video/createVideo')?>">
					<input type="text" name="section_id" value="<?=$section['id_section'] ?>" hidden>
					<input type="text" name="course_uuid" value="<?=$course['uuid'] ?>" hidden>
					<div class="modal-body">
						<div class="form-group">
							<label for="" class="text-pks font-weight-bold">Title Video<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="title" placeholder="Masukkan title video...">
							<?= form_error('title', '<small class="text-danger">', '</small>') ?>
						</div>

						<div class="form-group">
							<label for="" class="text-pks font-weight-bold">Id Video<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="link" placeholder="Masukkan Id video...">
							<?= form_error('link', '<small class="text-danger">', '</small>') ?>
						</div>

						<div class="form-group text-center mt-5">
							<button type="submit" class="btn btn-primary-form w-100">Submit</button>
						</div>
						<div class="form-group text-center mt-1">
							<button class="btn btn-secondary-logout w-100"  data-dismiss="modal"><p class="color-black" style="margin: 0px"> Cancel</p></button>
						</div>
					</div>
					<div>
						<small class="text-danger text-sm m-0">* Video hanya bisa menggunakan video dari youtube</small><br>
						<small class="text-danger text-sm m-0">** Id Video youtube didapatkan dari link video youtube</small><br>
						<small class="text-danger text-sm m-0">*** Contoh Link : https://www.youtube.com/watch?v=<b>KWxENcTAe1A</b></small>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
	$('#createVideo<?=$section['id_section']?>').appendTo("body");
</script>
