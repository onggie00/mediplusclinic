<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/poli/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->category_poli_id; ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Poli </label>
      <input class="form-control " name="nama_poli" type="text" value="<?php echo $data->nama_poli; ?>">
    </div>
    <div class="form-group">
      <label for="cimg">Upload Foto Kategori </label>
      <input class="form-control " name="img" type="file">
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>