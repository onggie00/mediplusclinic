<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/dokter/notifikasi_dokter/broadcast') ?>">
  <input type="hidden" name="id_asisten">
  <fieldset>
    <div class="form-group">
      <label for="cname">Judul (required)</label>
      <input class="form-control " name="title" type="text" required>
    </div>
    <div class="form-group">
      <label for="cemail">Deskripsi (required)</label>
      <textarea class="form-control" name="deskripsi" required style="resize:none;"></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Kirim Pesan Ke Semua">
    </div>
  </fieldset>
</form>