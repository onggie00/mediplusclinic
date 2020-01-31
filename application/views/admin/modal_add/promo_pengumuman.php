<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/promo_pengumuman/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Judul Highlight (required)</label>
      <input class="form-control uppercase " name="judul_highlight" type="text" required>
    </div>
    <div class="form-group">
      <label for="calamat">Deskripsi Highlight (required) </label>
      <textarea class="form-control" name="deskripsi_highlight" style="resize:none;" required></textarea>
    </div>
    <div class="form-group">
      <label for="cname">Keterangan (required)</label>
      <input class="form-control uppercase " name="judul_highlight" type="text" required>
    </div>
    <div class="form-group">
      <label for="cimg">Upload Foto Highlight </label>
      <input class="form-control " name="img" type="file" >
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>