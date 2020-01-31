<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/dokter/manajemen_asisten/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Nama Lengkap (required)</label>
      <input class="form-control " type="text" name="nama_lengkap" required>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon (required)</label>
        <input class="form-control" type="text" name="phone" required>
      </div>
      <div class="col-md-6">
        <label for="cuser">Username (required)</label>
        <input class="form-control" type="text" name="username" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Password (required)</label>
        <input class="form-control" type="password" name="password" required>
      </div>
      <div class="col-md-6">
        <label for="cpass">Konfirmasi Password (required)</label>
        <input class="form-control" type="password" name="cpassword" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-12">
        <label for="cimg">Upload Foto </label>
      <input class="form-control " name="img" type="file" >
      </div>
    </div>
    
    <div class="form-group">
      <label for="cemail">Alamat Rumah</label>
      <textarea class="form-control" name="alamat" style="resize:none;"></textarea>
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
