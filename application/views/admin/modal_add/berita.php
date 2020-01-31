<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/berita/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Judul Berita (required)</label>
      <input class="form-control " type="text" name="judul" required>
    </div>
    <div class="form-group">
      <label for="nama">Isi Berita (required)</label>
      <textarea name="deskripsi" id="deskrispi_id" style="min-height:200px;resize:none;" class="form-control"></textarea>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Sumber Berita (required)</label>
        <input class="form-control" type="text" name="sumber" required>
      </div>
      <div class="col-md-6">
        <label for="cuser">Gambar Berita (required)</label>
        <input class="form-control" type="file" name="img_file" required>
      </div>
    </div>
    

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
