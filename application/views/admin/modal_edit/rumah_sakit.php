<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/rumah_sakit/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->klinik_id; ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Rumah Sakit / Klinik </label>
      <input class="form-control " name="nama_klinik" type="text" value="<?php echo $data->nama_klinik; ?>">
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon </label>
        <input class="form-control " type="text" name="phone" value="<?php echo $data->phone; ?>">
      </div>
      <div class="col-md-6">
        <label for="cimg">Upload Foto Rumah Sakit / Klinik </label>
      <input class="form-control " name="img" type="file">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Jam Buka - Tutup </label>
        <input class="form-control " type="text" name="jam_buka_tutup" value="<?php echo $data->jam_buka_tutup; ?>">
      </div>
      <div class="col-md-6">
        <label for="cimg">Hari Buka - Tutup </label>
      <input class="form-control " name="hari_buka_tutup" type="text" value="<?php echo $data->hari_buka_tutup; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="cname">Email </label>
      <input class="form-control " name="email" type="email" value="<?php echo $data->email; ?>">
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Longitude </label>
        <input class="form-control " type="text" name="longitude" value="<?php echo $data->longitude; ?>">
      </div>
      <div class="col-md-6">
        <label for="cimg">Latitude </label>
      <input class="form-control " name="latitude" type="text" value="<?php echo $data->latitude; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="cemail">Alamat </label>
      <textarea class="form-control" name="alamat" style="resize:none;"><?php echo $data->alamat; ?></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>