<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/banner/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->banner_id ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Gambar Banner (Max. Size 600x300) </label>
      <input class="form-control " name="img_file[]" type="file" required>
    </div>
    
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
