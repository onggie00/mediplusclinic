<form class="cmxform"  method="post" action="<?php echo site_url('admin/owner/manajemen_dokter/nonaktif') ?>">
  <input type="hidden" name="data_id" id="data_id" value="">
  <fieldset>
    <div class="form-group">
      <label for="">Anda Yakin Menonaktifkan Dokter ini ?</label>
    </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ya, Nonaktifkan">
    </div>
  </fieldset>
</form>