<?php if (isset($_REQUEST['id'])): ?>
  <?php  $chat = $this->mymodel->getbywheresort("chat","pasien_id= ".$_REQUEST['id'],"","chat_id","asc"); ?>

    <?php foreach ($chat as $key => $value):?>
      <?php	$pas = $this->mymodel->getbywhere("pasien","pasien_id",$value->pasien_id,"row");
        ?>
      <?php if ($value->customer_is_sender ==1): ?>
        <div class="incoming_msg">
          <div class="received_msg">
            <div class="received_withd_msg">
              <?php if ($value->chat != ""): ?>
                <p><?php echo nl2br($value->chat) ?></p>
              <?php endif; ?>

              <?php if ($value->chat != "" && $value->galery_type != 0): ?>
              <br>
              <?php endif; ?>
                <?php if ($value->galery_type == 1): ?>
                    <img src="<?php echo $value->url_galery ?>" alt="" class="img-responsive">
                <?php endif; ?>
                <?php if ($value->galery_type == 2): ?>
                  <a href="<?php echo $value->url_galery ?>" target="_blank">
                    <button type="button" class="btn btn-success" name="button">Watch Video</button>
                  </a>
                <?php endif; ?>
              <span class="time_date"> <?php echo date('H:i | d-m-Y',strtotime($value->created_at)) ?></span></div>
          </div>
        </div>
        <?php else: ?>
          <div class="outgoing_msg">
            <div class="sent_msg">
              <?php if ($value->chat != ""): ?>
                <p><?php echo nl2br($value->chat) ?></p>
              <?php endif; ?>

              <?php if ($value->chat != "" && $value->galery_type != 0): ?>
              <br>
              <?php endif; ?>
                <?php if ($value->galery_type == 1): ?>
                    <img src="<?php echo $value->url_galery ?>" alt="" class="img-responsive">
                <?php endif; ?>
                <?php if ($value->galery_type == 2): ?>
                  <a href="<?php echo $value->url_galery ?>" target="_blank">
                    <button type="button" class="btn btn-success" name="button">Watch Video</button>
                  </a>
                <?php endif; ?>
              <span class="time_date"> <?php echo date('H:i | d-m-Y',strtotime($value->created_at)) ?></span> </div>
          </div>
      <?php endif; ?>

  <?php endforeach; ?>
<?php endif; ?>
