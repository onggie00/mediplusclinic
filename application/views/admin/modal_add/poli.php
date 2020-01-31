<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/poli/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Poli (required)</label>
      <input class="form-control " name="nama_poli" type="text" required>
    </div>
    <div class="form-group">
      <label for="cimg">Upload Foto Kategori (required)</label>
      <input class="form-control " name="img" type="file" required>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>