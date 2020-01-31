<form class="cmxform" method="post" action="<?php echo site_url('admin/dokter/jadwal_dokter/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->jadwal_dokter_id ?>">
  <fieldset>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Senin </label>
        <input class="form-control" type="text" name="senin" value="<?php echo $data->senin; ?>">
      </div>
      <div class="col-md-6">
        <label for="cuser">Selasa </label>
        <input class="form-control" type="text" name="selasa" value="<?php echo $data->selasa; ?>">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Rabu </label>
        <input class="form-control" type="text" name="rabu" value="<?php echo $data->rabu; ?>">
      </div>
      <div class="col-md-6">
        <label for="cpass">Kamis </label>
        <input class="form-control" type="text" name="kamis" value="<?php echo $data->kamis; ?>">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Jumat </label>
        <input class="form-control" type="text" name="jumat" value="<?php echo $data->jumat; ?>">
      </div>
      <div class="col-md-6">
        <label for="cimg">Sabtu </label>
      <input class="form-control " name="sabtu" type="text" value="<?php echo $data->sabtu; ?>">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Minggu </label>
        <input class="form-control" type="text" name="minggu" value="<?php echo $data->minggu; ?>">
      </div>
      <div class="col-md-6">
        <label for="cpass">Status Kehadiran </label>
        <select name="status_aktif" class="form-control">
          <?php 
        $cek = $this->mymodel->getbywhere('dokter','dokter_id',$data->dokter_id,'row');
          if ($cek->status_aktif == "0") {
            echo "<option value='0' selected='selected'>Tidak Hadir</option>";
            echo "<option value='1' >Hadir</option>";
          }else{
            echo "<option value='0' >Tidak Hadir</option>";
            echo "<option value='1' selected='selected' >Hadir</option>";
          }
         ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="nama">Batas Antrian Hari ini </label>
        <input class="form-control " type="number" min="0" name="batas_antrian" value="<?php echo $cek->batas_antrian; ?>">
      </div>
      <div class="col-md-6">
        <label for="nama">Ruangan Dokter </label>
        <input class="form-control " type="text"  name="ruangan" value="<?php echo $cek->ruangan; ?>">        
      </div>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
