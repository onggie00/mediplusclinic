<form class="cmxform"  method="post" action="<?php echo site_url('admin/asisten/file_rekam_medis_asisten/deletedata') ?>">
  <input type="hidden" name="data_id" id="data_detail_id" value="">
  <fieldset>
    <div class="form-group">
      <label for="">Anda Yakin Menghapus Detail Data Scan ini ?</label>
    </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Hapus">
    </div>
  </fieldset>
</form>