<div class="container">
    <form class="cmxform" method="post" action="<?php echo site_url('admin/asisten/dashboard/updatedata') ?>">
    <input type="hidden" name="data_id" value="<?php echo $data->dokter_id; ?>">
    <fieldset>
      <div class="form-group row">
        
      <div class="form-group">
        <label for="nama">Biaya Awal </label>
        <input class="form-control " type="number" min="0" name="biaya" value="<?php echo $data->biaya; ?>">
      </div>
      
      <div class="form-group text-right">
        <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
          <input class="btn btn-primary" type="submit" value="Ubah">
      </div>
    </fieldset>
  </form>
</div>
