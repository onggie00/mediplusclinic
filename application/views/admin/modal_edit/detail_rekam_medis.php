<!--Rekam Medis Data-->
<h3>Detail Rekam Medis <b style="background-color:#f4f4f4;padding:4px;border-radius:5px;">
  <?php 
  $get_pasien = $this->mymodel->getbywhere('pasien','pasien_id',$data->pasien_id,'row');
  $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$data->dokter_id,'row');
  echo $get_pasien->nama_lengkap; ?></b> </h3>

<!--Detail Section-->
<table id="data3" class="table table-striped table-bordered table-responsive">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Tipe File</th>
              <th>File</th>
              <th>Tanggal Unggah File</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $nmr = 1;
            if (!empty($detail_data)) {
              foreach ($detail_data as $key => $value) {
                echo "<tr>";
                echo "<td>".$nmr."</td;>";
    $convert = date("d m Y",strtotime($value->created_at));
    $convert = explode(" ", $convert);
    $tgl = $convert[0];
    $bulan = $convert[1];
    $thn = $convert[2];
    $bln="";
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
    $tanggal = $tgl." ".$bln." ".$thn;
                if ($value->type_file == "0") {
                  echo "<td> Foto </td>"; 
                  echo "<td> <img src='".base_url("assets/image/data_scan/".$value->img_file)."' width='100px' height='100px'> </td>";
                  echo "<td> ".$tanggal." </td>";
                  echo "<td>";
                  echo '
                  <button type="button" name="update_detail" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-primary update_detail">
                     Ubah File</button>
                  <button type="button" name="delete_detail" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-danger delete_detail">
                     Hapus File</button>
                  <br/>
                  <a href="'.base_url('assets/image/data_scan/'.$value->img_file).'" target="_blank"><button type="button" name="download" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-warning download_detail">
                      Download File</button></a>
                       ';
                  echo "</td>";

                }else if($value->type_file == "1"){
                  echo "<td> Video </td>";
                  echo "<td> <video src='".base_url('assets/image/data_scan/'.$value->video_file)."' width='250px' controls>
                      </video> </td>";
                  echo "<td> ".$tanggal." </td>";
                  echo "<td>";
                  echo '
                  <button type="button" name="update_detail" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-primary update_detail">
                     Ubah File</button>
                  <button type="button" name="delete_detail" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-danger delete_detail">
                     Hapus File</button>
                  <br/>
                  <a href="'.base_url('assets/image/data_scan/'.$value->video_file).'" target="_blank"><button type="button" name="download" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-warning download_detail">
                      Download File</button></a>
                       ';
                  echo "</td>";
                }
                else if($value->type_file == "2"){
                  echo "<td> Dokumen </td>";
                  echo "<td><a href='".base_url('assets/image/data_scan/'.$value->pdf_file)."' target='_blank'>Lihat disini</a></td>";
                  echo "<td> ".$tanggal." </td>";
                  echo "<td>";
                  echo '
                  <button type="button" name="update_detail" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-primary update_detail">
                     Ubah File</button>
                  <button type="button" name="delete_detail" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-danger delete_detail">
                     Hapus File</button>
                  <br/>
                  <a href="'.base_url('assets/image/data_scan/'.$value->pdf_file).'" target="_blank"><button type="button" name="download" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-warning download_detail">
                      Download File</button></a>
                       ';
                  echo "</td>";
                }
                
                echo "</tr>";
              $nmr++;
              }
            
            }else{
              echo "<tr>";
              echo "<td>&nbsp;</td;>";
              echo "<td>Data Kosong</td>";
              echo "<td>Data Kosong</td>";
              echo "<td>Data Kosong</td>";
              echo "<td> Data Kosong</td>";
              echo "<td> Data Kosong</td>";
              echo "</tr>";
              $nmr++;
            }
            
             ?>
          </tbody>
      </table>
      <br>
  <form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/dokter/file_rekam_medis/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Data Scan Pasien </label>
      <input type="hidden" class="form-control" name="histori_data_scan_id" value="<?php echo $data->histori_data_scan_id; ?>">
      <input type="text" disabled class="form-control" value="<?php echo $get_pasien->nama_lengkap; ?>">
    </div>
    <div class="form-group">
      <label for="cname">Dokter (required)</label>
      <input class="form-control " name="hdokter_id" type="text" disabled value="<?php echo $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row')->nama_dokter; ?>">
      <input class="form-control " name="dokter_id" type="hidden" value="<?php echo $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row')->dokter_id; ?>" >
    </div>
    <div class="form-group row">
      <div class="col-md- hidden">
        <label for="cphone">Tipe File (required)</label>
        <select class="form-control" onchange="videocheck(this);" name="type_file">
          <option value="0">Foto</option>
          <option value="1">Video</option>
          <option value="2">Dokumen</option>
        </select>
        
      </div>
      <div class="col-md-8" id="image_file">
        <label for="cimg">Upload File</label>
      <input class="form-control " name="img_file[]" multiple type="file" >
      </div>
      <div class="col-md-4 hidden" style="display:none;" id="video_file">
        <label for="cimg">Upload Video</label>
      <input class="form-control " name="video[]" multiple type="file" >
      </div>
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>

<script type="text/javascript">
  function videocheck(that) {
    if (that.value == "0") {
        document.getElementById("video_file").style.display = "none";
        document.getElementById("image_file").style.display = "block";
    } else {
        document.getElementById("video_file").style.display = "block";
        document.getElementById("image_file").style.display = "none";
    }
}
</script>
