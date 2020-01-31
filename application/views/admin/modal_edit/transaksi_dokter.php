<form class="cmxform" method="post" action="<?php echo site_url('admin/owner/biaya_dokter/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->trans_dokter_id ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih Dokter </label>
      <select name="dokter_id" class="col-sm-12 form-control"  placeholder="Dokter">
          <?php 
          $get_dokter = $this->mymodel->getbywheresort('dokter','is_deleted','0','nama_dokter','ASC');
          foreach ($get_dokter as $key => $value): ?>
            <?php 
              if ($value->dokter_id == $data->dokter_id) {
                echo "<option selected='selected' value='".$value->dokter_id."' > ".$value->nama_dokter."</option>";
              }else{
                echo "<option value='".$value->dokter_id."' > ".$value->nama_dokter."</option>";
              }
             ?>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="status_pembayaran">Status Pembayaran </label>
      <select name="status_pembayaran" class="col-sm-12 form-control"  >
          <option value="100">Pilih Status Pembayaran</option>
          <?php 
            if ($data->status_pembayaran == "0") {
              echo "<option value='0' selected='selected'>MENUNGGU PEMBAYARAN</option>";
              echo "<option value='1'>LUNAS</option>";
            }else{
              echo "<option value='0'>MENUNGGU PEMBAYARAN</option>";
              echo "<option value='1' selected='selected'>LUNAS</option>";
            }
           ?>
      </select>
    </div>
    <div class="form-group">
      <label for="uname">Tanggal Pembayaran </label>
      <input class="form-control " name="tanggal_pembayaran" type="date" value="<?php echo date('Y-m-d',strtotime($data->tanggal_pembayaran)); ?>">
    </div>
    <div class="form-group">
      <label for="biaya">Biaya Pembayaran </label>
      <input class="form-control " type="number" min="0" name="biaya_pembayaran" value="<?php echo $data->biaya_pembayaran; ?>">
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
