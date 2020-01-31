<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/manajemen_dokter/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->dokter_id ?>">
  <fieldset>
    <div class="form-group">
      <label for="nama">Nama Dokter </label>
      <input class="form-control " type="text" name="nama_dokter" value="<?php echo $data->nama_dokter; ?>">
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Telepon </label>
        <input class="form-control uppercase " type="text" name="phone" value="<?php echo $data->phone; ?>">
      </div>
      <div class="col-md-6">
        <label for="cuser">Username </label>
        <input class="form-control " type="text" name="husername" disabled value="<?php echo $data->username; ?>">
        <input class="form-control " type="hidden" name="username" value="<?php echo $data->username; ?>">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="cphone">Email </label>
        <input class="form-control" type="email" name="email" value="<?php echo $data->email; ?>">
      </div>
      <div class="col-md-6">
        <label for="cimg">Upload Foto Dokter </label>
      <input class="form-control " name="img" type="file" >
      </div>
    </div>
    <div class="form-group">
      <label for="cname">Pilih Rumah Sakit </label>
      <select name="klinik_id" class="col-sm-12 form-control" >
          <?php 
          $get_klinik = $this->mymodel->getbywheresort('klinik','is_deleted','0','nama_klinik','ASC');
          foreach ($get_klinik as $key => $value): ?>
            <?php 
              if ($value->klinik_id == $data->klinik_id) {
                echo "<option selected='selected' value='".$value->klinik_id."' > ".$value->nama_klinik."</option>";
              }else{
                echo "<option value='".$value->klinik_id."' > ".$value->nama_klinik."</option>";
              }
             ?>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="cname">Pilih Poli </label>
      <select name="category_poli_id" class="col-sm-12 form-control" >
          <?php 
          $get_category_poli = $this->mymodel->getbywheresort('category_poli','is_deleted','0','nama_poli','ASC');
          foreach ($get_category_poli as $key => $value): ?>
            <?php 
              if ($value->category_poli_id == $data->category_poli_id) {
                echo "<option selected='selected' value='".$value->category_poli_id."' > ".$value->nama_poli."</option>";
              }else{
                echo "<option value='".$value->category_poli_id."' > ".$value->nama_poli."</option>";
              }
             ?>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="cemail">Nomor Surat Izin Praktek (optional)</label>
      <input type="text" class="form-control" name="nomor_sip" value="<?php echo $data->nomor_sip; ?>">
    </div>
    <div class="form-group">
      <label for="cemail">Alamat Rumah</label>
      <textarea class="form-control" name="alamat" style="resize:none;"><?php echo $data->alamat; ?></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
