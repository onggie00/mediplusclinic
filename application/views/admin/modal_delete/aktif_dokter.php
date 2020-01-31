<form class="cmxform"  method="post" action="<?php echo site_url('admin/owner/manajemen_dokter/aktif') ?>">
  <input type="hidden" name="data_id2" id="data_id2" value="">
  <fieldset>
    <div class="form-group">
      <label for="">Anda Yakin Mengaktifkan Dokter ini ?</label>
    </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ya, Aktifkan">
    </div>
  </fieldset>
</form>