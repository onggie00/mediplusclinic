<form class="cmxform" method="post" action="<?php echo site_url('admin/asisten/biaya_pasien_asisten/insertdata') ?>">
  <fieldset>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cname">Pilih Pasien (required)</label>
        <select name="pasien_id" class="col-sm-12 form-control" required placeholder="Dokter">
            <?php 
            $get_pasien = $this->mymodel->getbywheresort('pasien','is_deleted','0','nama_lengkap','ASC');
            foreach ($get_pasien as $key => $value): ?>
              <option value="<?php echo $value->pasien_id; ?>"> <?php echo $value->nama_lengkap; ?> </option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="cname">Dokter (required)</label>
      <select name="dokter_id" class="col-sm-12 form-control" required placeholder="Dokter">
          <?php 
          $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
          $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten_data->dokter_id,'row');
          echo "<option value='".$get_dokter->dokter_id."'>".$get_dokter->nama_dokter."</option>";
          ?>
      </select>
      </div>
    </div>
    <div class="form-group">
      <label for="uname">Tanggal Pembayaran (required)</label>
      <input class="form-control " name="date_payment" type="date" required >
    </div>
    <div class="form-group">
      <label for="uname">Tanggal Expired (1 Tahun) (required)</label>
      <input class="form-control " name="date_expired" type="date" required >
    </div>
    <div class="form-group">
      <label for="biaya">Biaya Pembayaran (required)</label>
      <input class="form-control " type="number" min="0" name="biaya" required >
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
