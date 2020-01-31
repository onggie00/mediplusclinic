<form class="cmxform" method="post" action="<?php echo site_url('admin/owner/biaya_dokter/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih Dokter (required)</label>
      <select name="dokter_id" class="col-sm-12 form-control" required placeholder="Dokter">
          <?php 
          $get_dokter = $this->mymodel->getbywheresort('dokter','is_deleted','0','nama_dokter','ASC');
          foreach ($get_dokter as $key => $value): ?>
            <option value="<?php echo $value->dokter_id; ?>"> <?php echo $value->nama_dokter; ?> </option>
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
      <label for="biaya">Biaya Pembayaran (required)</label>
      <input class="form-control " type="number" min="0" name="biaya_pembayaran" required>
    </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
