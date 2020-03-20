<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/dokter/file_rekam_medis/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih Riwayat Data Scan Pasien (required)</label>
      <select name="histori_data_scan_id" class="col-sm-12 form-control" required>
          <?php 
          $get_dokter = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
          $get_histori = $this->mymodel->getbywheresort('histori_data_scan',"dokter_id='".$get_dokter->dokter_id."' and is_deleted=",'0','histori_data_scan_id','DESC');
          foreach ($get_histori as $key => $value): ?>
            <option value="<?php echo $value->histori_data_scan_id; ?>"> <?php
    
    $convert = date("d m Y N",strtotime($value->created_at));
    $convert = explode(" ", $convert);
    $tgl = $convert[0];
    $bulan = $convert[1];
    $thn = $convert[2];
    $h = $convert[3];

    $bln = "";
    if ($bulan == 1) {
      $bln = "Januari";
    }else if ($bulan == 2) {
      $bln = "Februari";
    }else if ($bulan == 3) {
      $bln = "Maret";
    }else if ($bulan == 4) {
      $bln = "April";
    }else if ($bulan == 5) {
      $bln = "Mei";
    }else if ($bulan == 6) {
      $bln = "Juni";
    }else if ($bulan == 7) {
      $bln = "Juli";
    }else if ($bulan == 8) {
      $bln = "Agustus";
    }else if ($bulan == 9) {
      $bln = "September";
    }else if ($bulan == 10) {
      $bln = "Oktober";
    }else if ($bulan == 11) {
      $bln = "November";
    }else if ($bulan == 12) {
      $bln = "Desember";
    }


    $hari = "";
    if ($h == 1) {
      $hari = "Senin";
    }else if ($h == 2) {
      $hari = "Selasa";
    }else if ($h == 3) {
      $hari = "Rabu";
    }else if ($h == 4) {
      $hari = "Kamis";
    }else if ($h == 5) {
      $hari = "Jumat";
    }else if ($h == 6) {
      $hari = "Sabtu";
    }else if ($h == 7) {
      $hari = "Minggu";
    }


    $tgl_rekam = $hari.", ".$tgl." ".$bln." ".$thn;
    echo $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row')->nama_lengkap." - ".$tgl_rekam;
    ?> 
           </option>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="cname">Dokter (required)</label>
      <input class="form-control " name="hdokter_id" type="text" disabled value="<?php echo $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row')->nama_dokter; ?>">
      <input class="form-control " name="dokter_id" type="hidden" value="<?php echo $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row')->dokter_id; ?>" >
    </div>
    <div class="form-group row">
      <div class="col-md-4">
        <label for="cphone">Tipe File (required)</label>
        <select class="form-control" name="type_file">
          <option value="0">Foto</option>
          <option value="1">Video</option>
        </select>
        <label for="cimg"><b> Untuk File Video, Diharuskan upload gambar Thumbnail juga </b></label>
      </div>
      <div class="col-md-4">
        <label for="cimg">Upload Gambar</label>
      <input class="form-control " name="img_file" type="file" >
      </div>
      <div class="col-md-4">
        <label for="cimg">Upload Video</label>
      <input class="form-control " name="video" type="file" >
      </div>
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
