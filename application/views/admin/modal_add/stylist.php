<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/stylist/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Lengkap (required)</label>
      <input class="form-control uppercase " name="nama_lengkap" type="text" required >
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Nomor Telepon (required)</label>
        <input class="form-control " name="notelp" type="text" required >
      </div>
      <div class="col-md-6">
        <label for="cname">Upload Foto Baru </label>
        <input type="file" id="img" class="form-control"
                  style="background:#EFEFEF;" name="img" value=""  accept="image/jpg, image/jpeg, image/png">
      </div>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>