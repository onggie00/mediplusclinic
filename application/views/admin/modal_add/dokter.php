<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/manajemen_dokter/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Nama Dokter (required)</label>
      <input class="form-control " type="text" name="nama_dokter" required>
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
      <div class="col-md-6">
        <label for="cphone">Email (required)</label>
        <input class="form-control" type="email" name="email" required>
      </div>
      <div class="col-md-6">
        <label for="cimg">Upload Foto Dokter (required)</label>
      <input class="form-control " name="img" type="file" required>
      </div>
    </div>
    <div class="form-group">
      <label for="cname">Pilih Rumah Sakit (required)</label>
      <select name="klinik_id" class="col-sm-12 form-control" required>
          <?php 
          $get_klinik = $this->mymodel->getbywheresort('klinik','is_deleted','0','nama_klinik','ASC');
          foreach ($get_klinik as $key => $value): ?>
            <option value="<?php echo $value->klinik_id; ?>"> <?php echo $value->nama_klinik; ?> </option>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="cname">Pilih Poli (required)</label>
      <select name="category_poli_id" class="col-sm-12 form-control" required>
          <?php 
          $get_poli = $this->mymodel->getbywheresort('category_poli','is_deleted','0','nama_poli','ASC');
          foreach ($get_poli as $key => $value): ?>
            <option value="<?php echo $value->category_poli_id; ?>"> <?php echo $value->nama_poli; ?> </option>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="cemail">Nomor Surat Izin Praktek (optional)</label>
      <input type="text" class="form-control" name="nomor_sip">
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
