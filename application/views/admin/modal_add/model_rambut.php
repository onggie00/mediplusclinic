<form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/model_rambut/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cname">Nama Model Rambut (required)</label>
      <input class="form-control uppercase " name="nama" type="text" required >
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="category_id">Kategori Model Rambut (required)</label>
        <select class="form-control" name="category_id" id="category_id" required>
          <option value="0">Pilih Kategori</option>
          <?php 
            $get_data = $this->mymodel->getall('category_model');
            foreach ($get_data as $key => $value) {
              echo "<option value='".$value->id."'> ".$value->nama." </option>";
            }
           ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="cname">Upload Foto Baru </label>
        <input type="file" id="img" class="form-control"
                  style="background:#EFEFEF;" name="img" value=""  accept="image/jpg, image/jpeg, image/png">
      </div>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>