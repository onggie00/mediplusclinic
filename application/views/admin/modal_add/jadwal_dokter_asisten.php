<form class="cmxform" method="post" action="<?php echo site_url('admin/asisten/jadwal_dokter_asisten/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih Dokter </label>
      <select name="dokter_id" class="col-sm-12 form-control" >
          <?php 
          $get_dokter = $this->mymodel->getbywheresort('dokter','is_deleted','0','nama_dokter','ASC');
          foreach ($get_dokter as $key => $value): ?>
            <?php 
            echo "<option value='".$value->dokter_id."' > ".$value->nama_dokter."</option>";
             ?>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Senin (required) </label>
        <input class="form-control"  required type="text" name="senin" placeholder="00.00 - 24.00">
      </div>
      <div class="col-md-6">
        <label for="cuser">Selasa (required) </label>
        <input class="form-control"  required type="text" name="selasa" placeholder="00.00 - 24.00">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Rabu (required) </label>
        <input class="form-control" required type="text" name="rabu" placeholder="00.00 - 24.00">
      </div>
      <div class="col-md-6">
        <label for="cpass">Kamis (required) </label>
        <input class="form-control" required type="text" name="kamis" placeholder="00.00 - 24.00">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Jumat (required) </label>
        <input class="form-control"  required type="text" name="jumat" placeholder="00.00 - 24.00">
      </div>
      <div class="col-md-6">
        <label for="cimg">Sabtu (required) </label>
      <input class="form-control " required name="sabtu" type="text" placeholder="00.00 - 24.00">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Minggu (required) </label>
        <input class="form-control" required type="text" name="minggu" placeholder="00.00 - 24.00">
      </div>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
