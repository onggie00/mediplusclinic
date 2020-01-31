<form class="cmxform" method="post" action="<?php echo site_url('admin/asisten/rekam_medis_asisten/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih Pasien (required)</label>
      <select name="pasien_id" class="col-sm-12 form-control" required>
          <?php 
          $get_pasien = $this->mymodel->getbywheresort('pasien','is_deleted','0','nama_lengkap','ASC');
          foreach ($get_pasien as $key => $value): ?>
            <option value="<?php echo $value->pasien_id; ?>"> <?php echo $value->nama_lengkap; ?> </option>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="nama">Nama Dokter </label>
      <input class="form-control " type="hidden" name="dokter_id" value="<?php 
        $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
      $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten_data->dokter_id,'row');
      echo $get_dokter->dokter_id;
       ?>">
      <input class="form-control " type="text" disabled name="hnama_dokter" value="<?php 
      
      echo $get_dokter->nama_dokter; 
      ?>">
    </div>
    <div class="form-group">
      <label for="cemail">Alasan Kunjungan (required)</label>
      <textarea class="form-control" name="alasan_kunjungan" style="resize:none;" required></textarea>
    </div>
    <div class="form-group">
      <label for="cemail">Keluhan Utama (required)</label>
      <textarea class="form-control" name="keluhan_utama" style="resize:none;" required></textarea>
    </div>
    <div class="form-group">
      <label for="cemail">Riwayat Medis (required)</label>
      <textarea class="form-control" name="riwayat_medis" style="resize:none;" required></textarea>
    </div>
    <div class="form-group">
      <label for="nama">Nomor Antrian (required)</label>
      <input class="form-control " type="number" min="1" name="nomor_antri" required>
    </div>
    <div class="form-group">
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