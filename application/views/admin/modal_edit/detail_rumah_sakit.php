<!--Rekam Medis Data-->
<h5> <b >
  <?php 
  echo "Nama Rumah Sakit / Klinik : <br/>".$klinik->nama_klinik; ?></b> </h5>
<br/>
<!--Detail Section-->
<table id="data3" class="table table-striped table-bordered table-responsive">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Nama Poli</th>
              <th>Total Dokter</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/rumah_sakit/deletepoliklinik') ?>">
            <?php 
            $nmr = 1;
            if (!empty($data)) {
              foreach ($data as $key => $value) {
                $get_poli = $this->mymodel->getbywhere('category_poli','category_poli_id',$value->category_poli_id,'row');
                echo "<tr>";
                echo "<td>".$nmr."</td;>";
                echo "<td>".$get_poli->nama_poli."</td>";
                echo "<td>".count($this->mymodel->getbywhere('dokter',"klinik_id='".$value->klinik_id."' and category_poli_id=",$value->category_poli_id,'result'))."</td>";
                echo "<td>";
                echo '
                <button type="button" name="delete_detail" id="'.$value->poli_klinik_id.'" class="btn btn-sm btn-danger delete_detail">
                   Hapus Poli</button>
                     ';
                echo "</td>";
                
                echo "</tr>";
              $nmr++;
              }
            
            }else{
              echo "<tr>";
              echo "<td>&nbsp;</td;>";
              echo "<td>Data Kosong</td>";
              echo "<td>Data Kosong</td>";
              echo "<td>Data Kosong</td>";
              echo "</tr>";
              $nmr++;
            }
            
             ?>
           </form>
          </tbody>
      </table>
      <br>
  <form enctype="multipart/form-data" class="cmxform" method="post" action="<?php echo site_url('admin/owner/rumah_sakit/insertpoliklinik') ?>">
  <input type="hidden" name="klinik_id" value="<?php echo $klinik->klinik_id; ?>">
  <fieldset>
    <div class='form-group row'>
    <?php 
    $get_all_poli = $this->mymodel->getbywhere('category_poli','is_deleted','0','result');
      foreach ($get_all_poli as $key => $value) {
      ?>
      
        <?php 
          if (empty($this->mymodel->getbywhere('poli_klinik',"category_poli_id='".$value->category_poli_id."' and klinik_id=",$klinik->klinik_id,'row'))) {
            $get_poli2 = $this->mymodel->getbywhere('category_poli','category_poli_id',$value->category_poli_id,'row');
            echo "<div class='col-4'>";
            echo "<label><input name='check_poli[]' type='checkbox' value='".$value->category_poli_id."' /> ".$get_poli2->nama_poli."</label>";
            echo "</div>";
          }else{
            //$get_poli2 = $this->mymodel->getbywhere('category_poli','category_poli_id',$value->category_poli_id,'row');
            //echo "<label><input type='checkbox' checked='checked' value='".$value->category_poli_id."' /> ".$get_poli2->nama_poli."</label>";
          }
         ?>
    <?php 
      }
     ?>
   </div>
    <div class="form-group text-right">
      <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
        <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </fieldset>
</form>

<script type="text/javascript">
  function videocheck(that) {
    if (that.value == "0") {
        document.getElementById("video_file").style.display = "none";
        document.getElementById("image_file").style.display = "block";
    } else {
        document.getElementById("video_file").style.display = "block";
        document.getElementById("image_file").style.display = "none";
    }
}
</script>
