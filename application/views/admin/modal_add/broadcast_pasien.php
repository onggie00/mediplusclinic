<form class="cmxform" method="post" action="<?php echo site_url('admin/owner/broadcast_pasien/send_email_all') ?>">
  <fieldset>
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
