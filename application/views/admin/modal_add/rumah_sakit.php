<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/rumah_sakit/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Rumah Sakit / Klinik (required)</label>
      <input class="form-control " name="nama_klinik" type="text" required>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon (required)</label>
        <input class="form-control " type="text" name="phone" required>
      </div>
      <div class="col-md-6">
        <label for="cimg">Upload Foto Rumah Sakit / Klinik (required)</label>
      <input class="form-control " name="img" type="file" required>
      </div>
    </div>
    <div class="form-group">
      <label for="cname">Email (required)</label>
      <input class="form-control " name="email" type="email" required>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Jam Buka - Tutup (required)</label>
        <input class="form-control " type="text" name="jam_buka_tutup" placeholder="00.00 - 24.00" required>
      </div>
      <div class="col-md-6">
        <label for="cimg">Hari Buka - Tutup (required)</label>
      <input class="form-control " name="hari_buka_tutup" type="text" placeholder="Senin - Minggu" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Longitude (required)</label>
        <input class="form-control " type="text" name="longitude" required>
      </div>
      <div class="col-md-6">
        <label for="cimg">Latitude (required)</label>
      <input class="form-control " name="latitude" type="text" required>
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