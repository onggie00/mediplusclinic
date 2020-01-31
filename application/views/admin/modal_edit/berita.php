<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/berita/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->berita_id ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Judul Berita </label>
      <input class="form-control " type="text" name="judul" value="<?php echo $data->judul; ?>">
    </div>
    <div class="form-group">
      <label for="nama">Isi Berita </label>
      <textarea name="deskripsi" id="deskrispi_id" style="min-height:200px; resize:none;" class="form-control"> <?php echo $data->deskripsi; ?> </textarea>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Sumber Berita </label>
        <input class="form-control" type="text" name="sumber" value="<?php echo $data->sumber; ?>">
      </div>
      <div class="col-md-6">
        <label for="cuser">Gambar Berita </label>
        <input class="form-control" type="file" name="img">
      </div>
    </div>
    

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
