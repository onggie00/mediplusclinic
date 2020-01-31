<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/pasien/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->pasien_id ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Nama Pasien </label>
      <input class="form-control " type="text" name="nama_lengkap" value="<?php echo $data->nama_lengkap; ?>">
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon </label>
        <input class="form-control" type="text" name="phone" value="<?php echo $data->phone; ?>">
      </div>
      <div class="col-md-6">
        <label for="cuser">Tanggal Lahir </label>
        <input class="form-control" type="date" name="tanggal_lahir" value="<?php echo date('Y-m-d',strtotime($data->tanggal_lahir)); ?>">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Longitude </label>
        <input class="form-control" type="text" name="longitude" value="<?php echo $data->longitude; ?>">
      </div>
      <div class="col-md-6">
        <label for="cpass">Latitude </label>
        <input class="form-control" type="text" name="latitude" value="<?php echo $data->latitude; ?>">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Email </label>
        <input class="form-control" type="email" name="email" value="<?php echo $data->email; ?>">
      </div>
      <div class="col-md-6">
        <label for="cimg">Upload Foto pasien </label>
      <input class="form-control " name="img" type="file" >
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-12">
        <label for="cphone">Username </label>
        <input class="form-control" type="text" name="husername" value="<?php echo $data->username; ?>">
        <input class="form-control" type="hidden" name="username" value="<?php echo $data->username; ?>">
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
