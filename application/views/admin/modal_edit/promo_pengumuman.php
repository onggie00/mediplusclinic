<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/promo_pengumuman/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->id ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Judul Highlight </label>
      <input class="form-control uppercase " name="judul_highlight" type="text" value="<?php echo $data->judul_highlight; ?>">
    </div>
    <div class="form-group">
      <label for="calamat">Deskripsi Highlight  </label>
      <textarea class="form-control" name="deskripsi_highlight" style="resize:none;" ><?php echo $data->deskripsi_highlight; ?></textarea>
    </div>
    <div class="form-group">
      <label for="cname">Keterangan </label>
      <input class="form-control uppercase " name="judul_highlight" type="text" value="<?php echo $data->keterangan; ?>">
    </div>
    <div class="form-group">
      <label for="cimg">Upload Foto Highlight </label>
      <input class="form-control " name="img" type="file" >
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>