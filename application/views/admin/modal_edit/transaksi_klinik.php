<form class="cmxform" method="post" action="<?php echo site_url('admin/owner/biaya_klinik/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->trans_klinik_id ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih klinik </label>
      <select name="klinik_id" class="col-sm-12 form-control"  placeholder="klinik">
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
      <input class="form-control " type="number" min="0" name="biaya" value="<?php echo $data->biaya; ?>">
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
