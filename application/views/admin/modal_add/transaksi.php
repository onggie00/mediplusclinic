<form class="cmxform" method="post" action="<?php echo site_url('admin/dokter/transaksi/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih pasien (required)</label>
      <select name="pasien_id" class="col-sm-12 form-control" required >
          <?php 
          $get_pasien = $this->mymodel->getbywheresort('pasien','is_deleted','0','nama_lengkap','ASC');
          foreach ($get_pasien as $key => $value): ?>
            <option value="<?php echo $value->pasien_id; ?>"> <?php echo $value->nama_lengkap; ?> </option>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="biaya">Nama Dokter </label>
      <input class="form-control " type="hidden" name="dokter_id" value="<?php 
        $get_dokter = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
        echo $get_dokter->dokter_id;
       ?>">
       <input type="text" disabled class="form-control" value="<?php echo $get_dokter->nama_dokter; ?>">
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cname">Pilih Rumah Sakit (required)</label>
        <select name="klinik_id" class="col-sm-12 form-control" required>
            <?php 
            $get_klinik = $this->mymodel->getbywheresort('klinik','is_deleted','0','nama_klinik','ASC');
            foreach ($get_klinik as $key => $value): ?>
              <option value="<?php echo $value->klinik_id; ?>"> <?php echo $value->nama_klinik; ?> </option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="cuser">Ruangan (required)</label>
        <input class="form-control" type="text" name="ruangan" required>
      </div>
    </div>
    <div class="form-group hidden">
      <label for="biaya">Biaya  </label>
      <input class="form-control " type="number" min="0" name="biaya" required>
      <label for="biaya"> <b>Biaya diisi 0 Apabila telah membayar biaya awal dan belum lewat masa berlakunya</b> </label>
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
