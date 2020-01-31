<form class="cmxform" method="post" action="<?php echo site_url('admin/member/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Lengkap (required)</label>
      <input class="form-control " name="nama_lengkap" type="text" required>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon (required)</label>
        <input class="form-control uppercase " type="text" name="notelp" required>
      </div>
      <div class="col-md-6">
        <label for="cpass">Password (required)</label>
        <input class="form-control uppercase " type="password" name="password" required>
      </div>
    </div>
    <div class="form-group">
      <label for="cemail">Alamat </label>
      <textarea class="form-control uppercase" name="alamat" style="resize:none;"></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
