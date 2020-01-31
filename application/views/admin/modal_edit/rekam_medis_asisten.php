<form class="cmxform" method="post" action="<?php echo site_url('admin/asisten/rekam_medis_asisten/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->histori_data_scan_id; ?>">
  <fieldset>
    <?php 
    $get_pasien = $this->mymodel->getbywhere('pasien','pasien_id',$data->pasien_id,'row');
     ?>
    <div class="form-group">
      <label for="cname">Pilih Pasien (required)</label>
      <input type="hidden" class="form-control" name="pasien_id" value="<?php echo $data->pasien_id; ?>">
      <input type="text" disabled class="form-control" value="<?php echo $get_pasien->nama_lengkap; ?>">
    </div>
    <div class="form-group">
      <label for="nama">Nama Dokter </label>
      <input class="form-control " type="hidden" name="dokter_id" value="<?php 
      $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
      $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten_data->dokter_id,'row');
      echo $get_dokter->dokter_id;
       ?>">
      <input class="form-control " type="text" disabled name="hdokter_id" value="<?php 
      
      echo $get_dokter->nama_dokter; 
      ?>">
    </div>
    <div class="form-group">
      <label for="cemail">Alasan Kunjungan </label>
      <textarea class="form-control" name="alasan_kunjungan" style="resize:none;"><?php echo str_replace("<br />",'', $data->alasan_kunjungan); ?></textarea>
    </div>
    <div class="form-group">
      <label for="cemail">Keluhan Utama </label>
      <textarea class="form-control" name="keluhan_utama" style="resize:none;"><?php echo str_replace("<br />",'', $data->keluhan_utama); ?></textarea>
    </div>
    <div class="form-group">
      <label for="cemail">Riwayat Medis </label>
      <textarea class="form-control" name="riwayat_medis" style="resize:none;"><?php echo str_replace("<br />",'', $data->riwayat_medis); ?></textarea>
    </div>
    <div class="form-group">
      <label for="cemail"> Keterangan Obat </label>
      <textarea class="form-control" name="keterangan_obat" ><?php echo str_replace("<br />",'', $data->keterangan_obat); ?></textarea>
    </div>
    <div class="form-group">
      <label for="cemail">Lain-lain </label>
      <textarea class="form-control" name="keterangan_lain" ><?php echo str_replace("<br />",'', $data->keterangan_lain); ?></textarea>
    </div>
    <div class="form-group">
      <label for="nama">Nomor Antrian </label>
      <input class="form-control " type="hidden" name="nomor_antri" value="<?php echo $data->nomor_antri; ?>">
      <input class="form-control " type="number" disabled min="1" name="hnomor_antri" value="<?php echo $data->nomor_antri; ?>">
    </div>
    <div class="form-group">
      <label for="biaya">Biaya  </label>
      <input class="form-control " type="number" min="0" name="biaya" value="<?php echo $data->biaya; ?>">
      <label for="biaya"> <b>Biaya diisi 0 Apabila telah membayar biaya awal dan belum lewat masa berlakunya</b> </label>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
