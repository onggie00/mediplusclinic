<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/banner/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Gambar Banner (required) (Max. size 600x300)</label>
      <input class="form-control " name="img_file[]" type="file" multiple required>
    </div>
    

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
