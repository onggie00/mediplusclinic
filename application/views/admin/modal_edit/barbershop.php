<form class="cmxform" method="post" action="<?php echo site_url('admin/barbershop/updatedata') ?>">
  <input type="hidden" name="data_id" value="<?php echo $data->id; ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Barbershop </label>
      <input class="form-control " name="nama" type="text" value="<?php echo $data->nama; ?>">
    </div>
    <div class="form-group">
      <label for="cname">Nomor Telepon </label>
      <input class="form-control " name="notelp" type="text" value="<?php echo $data->notelp; ?>">
    </div>
    <div class="form-group">
      <label for="calamat">Alamat </label>
      <textarea class="form-control uppercase" name="alamat" style="resize:none;"><?php echo $data->alamat; ?></textarea>
    </div>
    <div class="form-group">
      <label for="cname">Nama Owner </label>
      <input class="form-control " name="owner" type="text" value="<?php echo $data->owner; ?>">
    </div>
    <div class="form-group">
      <label for="cbuka">Jam Buka </label>
      <input class="form-control " placeholder="00.00" name="jam_buka" type="text" value="<?php echo $data->jam_buka; ?>">
    </div>
    <div class="form-group">
      <label for="ctutup">Jam Tutup </label>
      <input class="form-control " placeholder="00.00" name="jam_tutup" type="text" value="<?php echo $data->jam_tutup; ?>">
    </div>

    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
