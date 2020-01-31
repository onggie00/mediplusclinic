<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/dokter/profile/ubahpassword') ?>">
  <input type="hidden" name="data_id3" value="<?php echo $data->dokter_id; ?>">
  <fieldset>

    <div class="form-group row">
      <div class="col-md-6" id="detail_image_file">
        <label for="cimg">Password Baru</label>
        <input class="form-control " name="password"  type="password" >
      </div>
      <div class="col-md-6" id="detail_image_file">
        <label for="cimg">Konfirmasi Password Baru</label>
        <input class="form-control " name="cpassword"  type="password" >
      </div>
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>