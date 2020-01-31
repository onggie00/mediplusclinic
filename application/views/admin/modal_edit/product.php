<form class="cmxform" method="post" action="<?php echo site_url('admin/product/updatedata') ?>">
  <input type="hidden" name="data_id" id="data_id" value="<?php echo $data->product_id; ?>" />
  <fieldset>
    <div class="form-group">
      <label for="cnameproduct">Nama Produk </label>
      <input class="form-control " name="product_name" type="text" value="<?php echo $data->product_name; ?>">
    </div>
    <div class="form-group">
      <label for="ccategory">Pilih Kategori Produk </label>
      <select class="form-control " id="category_product" name="category_product_id"  style="color:#000">
        <option value="">Pilih Kategori</option>
        <?php 
        $get_category = $this->mymodel->getbywheresort('category_product','is_deleted','0','nama_category','ASC');
        foreach ($get_category as $key => $value) {
          if ($value->description=="") {
            $value->description = "Tidak ada deskripsi";
          }
          if ($value->category_product_id == $data->category_product_id) {
            echo "<option selected='selected' value='".$value->category_product_id."' > ".$value->nama_category." </option>";
          }else{
            echo "<option value='".$value->category_product_id."' > ".$value->nama_category." </option>";
          }
        }
         ?>
      </select>
    </div>
    
    <div class="form-group">
      <label for="cdescription">Description </label>
      <textarea class="form-control" style="resize:none;" name="description"><?php echo $data->description; ?></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>