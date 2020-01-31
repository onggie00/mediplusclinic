<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/asisten/profile_asisten/ubahfoto') ?>">
  <input type="hidden" name="data_id2" value="<?php echo $data->asisten_dokter_id; ?>">
  <fieldset>

    <div class="form-group">
      <div class="" id="detail_image_file">
        <label for="cimg">Upload Foto Profile</label>
        <input class="form-control " name="img_file"  type="file" >
      </div>
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah Foto">
    </div>
  </fieldset>
</form>