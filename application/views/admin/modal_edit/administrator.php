<form class="cmxform" method="post" action="<?php echo site_url('admin/administrator/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->id; ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Lengkap </label>
      <input class="form-control " name="nama_lengkap" type="text" value="<?php echo $data->nama_lengkap; ?>">
    </div>
    <div class="form-group">
      <label for="cname">Nomor Telepon </label>
      <input class="form-control " name="notelp" type="text" value="<?php echo $data->notelp; ?>">
    </div>
    <div class="form-group">
      <label for="uname">Username </label>
      <input disabled class="form-control " name="husername" type="text" value="<?php echo $data->username; ?>">
      <input type="hidden" name="username" value="<?php echo $data->username; ?>" />
    </div>
    <div class="form-group">
      <label for="cemail">Password </label>
      <input class="form-control " type="password" name="password" >
    </div>
    <div class="form-group">
      <label for="cemail">Konfirmasi Password </label>
      <input class="form-control " type="password" name="cpassword" >
    </div>
    <div class="form-group">
      <label for="curl">Hak Akses </label>
      <select class="form-control " id="privileges" name="privileges" value="" style="color:#000">
        <option value="">Pilih Hak Akses</option>
      <?php 
      $get_data = $this->mymodel->getbywhere('admin','id',$data->id,'row');
        if ($get_data->privileges == '1') {
          echo "<option value='1' selected='selected'> Owner </option>";
          echo "<option value='2' > Admin </option>";
        }
        else if ($get_data->privileges == '2') {
          echo "<option value='1'> Owner </option>";
          echo "<option value='2' selected='selected'> Admin </option>";
        }
        
      ?>
      </select>
    </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
