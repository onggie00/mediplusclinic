<form class="cmxform" method="post" action="<?php echo site_url('admin/administrator/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Lengkap (required)</label>
      <input class="form-control " name="nama_lengkap" type="text" required>
    </div>
    <div class="form-group">
      <label for="phone">Nomor Telepon (required)</label>
      <input class="form-control " name="notelp" type="text" required>
    </div>
    <div class="form-group">
      <label for="uname">Username (required)</label>
      <input class="form-control " name="username" type="text" required>
    </div>
    <div class="form-group">
      <label for="cemail">Password </label>
      <input class="form-control " type="password" name="password" >
    </div>
    <div class="form-group">
      <label for="cemail">Konfirmasi Password </label>
      <input class="form-control " type="password" name="cpassword" >
    </div>
    <div class="form-group">
      <label for="curl">Hak Akses (required)</label>
      <select class="form-control " id="privileges" name="privileges" required style="color:#000">
        <option value="">Pilih Hak Akses</option>
        <option value='1'>Owner</option>
        <option value='2'>Admin</option>
      </select>
    </div>
    
    <!--<div class="form-group">
      <label for="curl">Kabupaten / Kota (required)</label>
      <select class="form-control " id="kab_id" name="kab_id" required style="color:#000">
        <option value="">Pilih Provinsi</option>
      </select>
    </div>-->
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
