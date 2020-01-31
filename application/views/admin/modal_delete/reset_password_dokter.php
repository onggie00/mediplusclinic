<form class="cmxform"  method="post" action="<?php echo site_url('admin/owner/manajemen_dokter/resetpassword') ?>">
  <input type="hidden" name="data_id" id="data_id3" value="">
  <fieldset>
    <div class="form-group">
      <label for="">Anda Yakin Mereset Password Dokter ini ? <br/><i>Password akan di reset menjadi (12345678).</i></label>
    </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Reset">
    </div>
  </fieldset>
</form>