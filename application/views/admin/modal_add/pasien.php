<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/pasien/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Nama Pasien (required)</label>
      <input class="form-control " type="text" name="nama_lengkap" required>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon (required)</label>
        <input class="form-control" type="text" name="phone" required>
      </div>
      <div class="col-md-6">
        <label for="cuser">Tanggal Lahir (required)</label>
        <input class="form-control" type="date" name="tanggal_lahir" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Longitude (required)</label>
        <input class="form-control" type="text" name="longitude" required>
      </div>
      <div class="col-md-6">
        <label for="cpass">Latitude (required)</label>
        <input class="form-control" type="text" name="latitude" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Email (required)</label>
        <input class="form-control" type="email" name="email" required>
      </div>
      <div class="col-md-6">
        <label for="cimg">Upload Foto pasien (required)</label>
      <input class="form-control " name="img" type="file" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Username (required)</label>
        <input class="form-control" type="text" name="username" required>
      </div>
      <div class="col-md-6">
        <label for="cimg">Password (required)</label>
      <input class="form-control " name="password" type="password" required>
      </div>
    </div>
    <div class="form-group">
      <label for="cemail">Alamat </label>
      <textarea class="form-control" name="alamat" style="resize:none;"></textarea>
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
