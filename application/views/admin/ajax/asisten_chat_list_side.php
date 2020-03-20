<?php  foreach ($chat_room as $key => $value): ?>

  <?php	$pas = $this->mymodel->getbywhere("pasien","pasien_id",$value->pasien_id,"row");
    $last_chat = $this->mymodel->getlastwhere("chat","pasien_id",$value->pasien_id,"chat_id");
    ?>
  <a href="<?php echo site_url('admin/asisten/chat/data?id='.$value->pasien_id) ?>">
    <div class="chat_list <?php if(isset($_REQUEST['id']) && $_REQUEST['id'] == $value->pasien_id )echo "active_chat"; ?>">
      <div class="chat_people">
        <div class="chat_img">
          <?php
          if (!empty($pas->img_file)) {
            echo '<img src="'.base_url("assets/image/pasien/".$pas->img_file).'" alt="" >';
          }else{
            echo '<img src="'.base_url("assets/image/pasien/kosong.png").'" alt="">';
          }
           ?>

        </div>
        <div class="chat_ib">
          <h5 class="padding0"><?php echo $pas->nama_lengkap ?> <span class="chat_date"><?php echo date('M d',strtotime($last_chat->created_at)) ?></span></h5>
          <p><?php echo $last_chat->chat ?></p>
        </div>
      </div>
    </div>
  </a>

<?php endforeach; ?>
