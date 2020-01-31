<form class="cmxform" method="post" action="<?php echo site_url('admin/owner/transaksi_pasien/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih pasien (required)</label>
      <select name="pasien_id" class="col-sm-12 form-control" required placeholder="pasien">
          <?php 
          $get_pasien = $this->mymodel->getbywheresort('pasien','is_deleted','0','nama_lengkap','ASC');
          foreach ($get_pasien as $key => $value): ?>
            <option value="<?php echo $value->pasien_id; ?>"> <?php echo $value->nama_lengkap; ?> </option>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="status_pembayaran">Status Pembayaran (required)</label>
      <select name="status_pembayaran" class="col-sm-12 form-control" required >
          <option value="100">Pilih Status Pembayaran</option>
          <option value="0">MENUNGGU PEMBAYARAN</option>
          <option value="1">LUNAS</option>
      </select>
    </div>
    <div class="form-group">
      <label for="uname">Tanggal Pembayaran </label>
      <input class="form-control " name="tanggal_pembayaran" type="date" >
    </div>
    <div class="form-group">
      <label for="biaya">Biaya Pembayaran </label>
      <input class="form-control " type="number" min="0" name="biaya_pembayaran" >
    </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
