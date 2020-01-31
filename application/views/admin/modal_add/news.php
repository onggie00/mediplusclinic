<form class="cmxform"  method="post" action="<?php echo site_url('admin/news/insertdata') ?>" enctype="multipart/form-data">
  <fieldset>
    <div class="form-group">
      <label for="cname">Kategori Berita (required)</label>
      <select class="form-control" name="category_news_id" required>
        <?php foreach ($this->mymodel->getall('news_category') as $key => $value): ?>
          <option value="<?php echo $value->category_news_id ?>">
            <?php echo $value->category_name ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="cname">Judul Berita (required)</label>
      <input class="form-control " name="title" type="text" required>
    </div>
    <div class="form-group">
      <label for="cemail">Gambar</label>
      <input class="form-control " type="file" name="img_file" accept="image/png, image/jpeg">
    </div>
    <div class="form-group">
      <label for="cemail">Tumbnail</label>
      <input class="form-control " type="file" name="tumbnail_file"  accept="image/png, image/jpeg">
    </div>
    <div class="form-group">
      <label for="cemail">Deskripsi (required)</label>
      <textarea class="form-control " name="description" rows="8" cols="80" required><?php echo $data->description ?></textarea>
    </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Ubah">
    </div>
  </fieldset>
</form>
