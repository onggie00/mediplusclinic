<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/dokter/file_rekam_medis/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->detail_data_scan_id; ?>">
  <fieldset>
    <?php 
    $get_pasien = $this->mymodel->getbywhere('pasien','pasien_id',$data->pasien_id,'row');
     ?>
    <div class="form-group">
      <label for="cname">Data Scan Pasien </label>
      <input type="hidden" class="form-control" name="histori_data_scan_id" value="<?php echo $data->histori_data_scan_id; ?>">
      <input type="text" disabled class="form-control" value="<?php echo $get_pasien->nama_lengkap; ?>">
    </div>
    <div class="form-group">
      <label for="cname">Dokter </label>
      <input class="form-control " name="hdokter_id" type="text" disabled value="<?php echo $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row')->nama_dokter; ?>">
      <input class="form-control " name="dokter_id" type="hidden" value="<?php echo $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row')->dokter_id; ?>" >
    </div>
    <div class="form-group row">
      <div class="col-md-4">
        <label for="cphone">Tipe File (required)</label>
        <select class="form-control" onchange="videocheck2(this);" name="type_file">
          <option value="0">Foto</option>
          <option value="1">Video</option>
          <option value="2">Dokumen</option>
        </select>
        
      </div>
      <div class="col-md-4" id="detail_image_file">
        <label for="cimg">Upload Gambar</label>
      <input class="form-control " name="img_file"  type="file" >
      </div>
      <div class="col-md-4" style="display:none;" id="detail_video_file">
        <label for="cimg">Upload Video</label>
      <input class="form-control " name="video"  type="file" >
      </div>
      <div class="col-md-4" style="display:none;" id="detail_pdf_file">
        <label for="cimg">Upload Dokumen</label>
      <input class="form-control " name="pdf"  type="file" >
      </div>
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>

<script type="text/javascript">
  function videocheck2(that) {
    if (that.value == "0") {
        document.getElementById("detail_video_file").style.display = "none";
        document.getElementById("detail_pdf_file").style.display = "none";
        document.getElementById("detail_image_file").style.display = "block";
    }else if (that.value == "2") {
        document.getElementById("detail_video_file").style.display = "none";
        document.getElementById("detail_pdf_file").style.display = "block";
        document.getElementById("detail_image_file").style.display = "none";
    }else {
        document.getElementById("detail_video_file").style.display = "block";
        document.getElementById("detail_pdf_file").style.display = "none";
        document.getElementById("detail_image_file").style.display = "none";
    }
}
</script>