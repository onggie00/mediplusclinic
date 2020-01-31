<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/dokter/notifikasi_dokter/kirimpesan') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->pasien_id; ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Masukkan Judul Pesan (required)</label>
      <input class="form-control " name="title" type="text" required >
    </div>
   <div class="form-group">
      <label for="cemail">Deskripsi (required)</label>
      <textarea class="form-control" name="deskripsi" required style="resize:none;"></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Kirim">
    </div>
  </fieldset>
</form>