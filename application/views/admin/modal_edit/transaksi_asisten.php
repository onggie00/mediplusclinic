<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/asisten/transaksi_asisten/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->hantrian_dokter_id; ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih pasien </label>
      <select name="pasien_id" class="col-sm-12 form-control" >
          <?php 
          $get_pasien = $this->mymodel->getbywheresort('pasien','is_deleted','0','nama_lengkap','ASC');
          foreach ($get_pasien as $key => $value): ?>
          <?php if ($value->pasien_id == $data->pasien_id) { ?>
            <option value="<?php echo $value->pasien_id; ?>" selected="selected"> <?php echo $value->nama_lengkap; ?> </option>
          <?php }else { ?>
            <option value="<?php echo $value->pasien_id; ?>"> <?php echo $value->nama_lengkap; ?> </option>
          <?php } endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="biaya">Nama Dokter </label>
      <input class="form-control " type="hidden" name="dokter_id" value="<?php
      $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
      $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten_data->dokter_id,'row');
        echo $get_dokter->dokter_id;
       ?>">
       <input type="text" disabled class="form-control" value="<?php echo $get_dokter->nama_dokter; ?>">
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cname">Pilih Rumah Sakit </label>
        <select name="klinik_id" class="col-sm-12 form-control" >
            <?php 
            $get_klinik = $this->mymodel->getbywheresort('klinik','is_deleted','0','nama_klinik','ASC');
          foreach ($get_klinik as $key => $value): ?>
          <?php if ($value->klinik_id == $data->klinik_id) { ?>
            <option value="<?php echo $value->klinik_id; ?>" selected="selected"> <?php echo $value->nama_klinik; ?> </option>
          <?php }else { ?>
            <option value="<?php echo $value->klinik_id; ?>"> <?php echo $value->nama_klinik; ?> </option>
          <?php } endforeach ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="cuser">Ruangan </label>
        <input class="form-control" type="text" name="ruangan" value="<?php echo $data->ruangan; ?>">
      </div>
    </div>
    
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>