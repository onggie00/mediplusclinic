<form class="cmxform" method="post" action="<?php echo site_url('admin/product/insertdata') ?>">
  <fieldset>
    <div class="form-group">
      <label for="cnameproduct">Nama Produk (required)</label>
      <input class="form-control " name="product_name" type="text" required>
    </div>
    <div class="form-group">
      <label for="ccategory">Pilih Kategori Produk (required)</label>
      <select class="form-control " id="category_product" name="category_product_id" required style="color:#000">
        <option value="">Pilih Kategori</option>
        <?php 
        $get_category = $this->mymodel->getbywheresort('category_product','is_deleted','0','nama_category','ASC');
        foreach ($get_category as $key => $value) {
          if ($value->description=="") {
            $value->description = "Tidak ada deskripsi";
          }
          echo "<option value='".$value->category_product_id."' > ".$value->nama_category." </option>";
        }
         ?>
      </select>
    </div>
    
    <div class="form-group">
      <label for="cdescription">Description </label>
      <textarea class="form-control" style="resize:none;" name="description"></textarea>
    </div>
    
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>