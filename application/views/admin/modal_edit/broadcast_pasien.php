<form class="cmxform" method="post" action="<?php echo site_url('admin/owner/broadcast_pasien/send_email') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->pasien_id; ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Nama Lengkap </label>
      <input class="form-control " type="text" name="nama_lengkap" value="<?php echo $data->nama_lengkap; ?>">
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon </label>
        <input class="form-control uppercase " type="text" name="phone" value="<?php echo $data->phone; ?>">
      </div>
      <div class="col-md-6">
        <label for="cphone">Email </label>
        <input class="form-control" type="email" name="email" value="<?php echo $data->email; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="nama">Judul Pesan </label>
      <input class="form-control " type="text" name="judul">
    </div>

    <div class="form-group">
      <label for="cemail">Deskripsi Pesan </label>
      <textarea class="form-control" name="deskripsi" style="resize:none;"></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Kirim">
    </div>
  </fieldset>
</form>
