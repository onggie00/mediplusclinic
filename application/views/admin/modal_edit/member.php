<form class="cmxform" method="post" action="<?php echo site_url('admin/member/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->id ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Lengkap </label>
      <input class="form-control " name="nama_lengkap" type="text" value="<?php echo $data->nama_lengkap; ?>" >
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon </label>
        <input class="form-control " type="text" name="notelp" value="<?php echo $data->notelp; ?>" >
      </div>
      <div class="col-md-6">
        <label for="cpass">Password </label>
        <input class="form-control " type="password" name="password" >
      </div>
    </div>
    <div class="form-group">
      <label for="cemail">Alamat </label>
      <textarea class="form-control uppercase" name="alamat" style="resize:none;"><?php echo $data->alamat; ?></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
