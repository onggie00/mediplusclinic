<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/category_model/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->id ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Kategori </label>
      <input class="form-control uppercase " name="nama" type="text" value="<?php echo $data->nama; ?>" >
    </div>
    <div class="form-group">
      <label for="cname">Upload Foto Baru </label>
      <input type="file" id="img" class="form-control"
                  style="background:#EFEFEF;" name="img" value=""  accept="image/jpg, image/jpeg, image/png">
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>