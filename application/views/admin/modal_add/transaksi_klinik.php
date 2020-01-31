<form class="cmxform" method="post" action="<?php echo site_url('admin/owner/biaya_klinik/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Pilih klinik (required)</label>
      <input type="text" class="form-control" name="hklinik_id" disabled value="<?php echo $this->mymodel->getbywhere('klinik','klinik_id',$data->klinik_id,'row')->nama_klinik; ?>" />
      <input type="hidden" class="form-control" name="klinik_id" value="<?php echo $data->klinik_id; ?>" />
      <!--<select name="klinik_id" class="col-sm-12 form-control" required placeholder="klinik">
          <?php 
          $get_klinik = $this->mymodel->getbywheresort('klinik','is_deleted','0','nama_klinik','ASC');
          foreach ($get_klinik as $key => $value): ?>
            <option value="<?php echo $value->klinik_id; ?>"> <?php echo $value->nama_klinik; ?> </option>
          <?php endforeach ?>
      </select>-->
    </div>
    <div class="form-group">
      <label for="status_pembayaran">Status Pembayaran (required)</label>
      <select name="status_pembayaran" class="col-sm-12 form-control" required >
          <option value="0">MENUNGGU PEMBAYARAN</option>
          <option value="1">LUNAS</option>
      </select>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="uname">Tanggal Pembayaran (required)</label>
        <input class="form-control " name="tanggal_pembayaran" type="date" required>
      </div>
      <div class="col-md-6">
        <label for="uname">Pilih Paket Masa AKtif (required)</label>
        <select required name="paket_aktif" class="form-control">
          <option value="1">1 Bulan</option>
          <option value="2">3 Bulan</option>
          <option value="4">1 Tahun</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="biaya">Biaya Pembayaran (required)</label>
      <input class="form-control " type="number" min="0" name="biaya" required>
    </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>
