<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/dokter/manajemen_asisten/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->dokter_id ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Nama  Lengkap</label>
      <input class="form-control " type="text" name="nama_lengkap" value="<?php echo $data->nama_lengkap; ?>">
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon </label>
        <input class="form-control uppercase " type="text" name="phone" value="<?php echo $data->phone; ?>">
      </div>
      <div class="col-md-6">
        <label for="cuser">Username </label>
        <input class="form-control " type="text" name="husername" disabled value="<?php echo $data->username; ?>">
        <input class="form-control " type="hidden" name="username" value="<?php echo $data->username; ?>">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-12">
        <label for="cimg">Upload Foto  </label>
      <input class="form-control " name="img" type="file" >
      </div>
    </div>

    <div class="form-group">
      <label for="cemail">Alamat Rumah</label>
      <textarea class="form-control" name="alamat" style="resize:none;"><?php echo $data->alamat; ?></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
