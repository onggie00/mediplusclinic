<?php if (isset($_REQUEST['id'])): ?>
  <?php   $chat = $this->mymodel->getbywheresort("chat_asisten_dokter","pasien_id= ".$_REQUEST['id'],"","chat_id","asc"); ?>

    <?php foreach ($chat as $key => $value): ?>
      <?php	$pas = $this->mymodel->getbywhere("pasien","pasien_id",$value->pasien_id,"row");
        ?>
      <?php if ($value->customer_is_sender ==1): ?>
        <div class="incoming_msg">
          <div class="received_msg">
            <div class="received_withd_msg">
              <p><?php echo nl2br($value->chat) ?></p>
              <span class="time_date"> <?php echo date('H:i | d-m-Y',strtotime($value->created_at)) ?></span></div>
          </div>
        </div>
        <?php else: ?>
          <div class="outgoing_msg">
            <div class="sent_msg">
                <p><?php echo nl2br($value->chat) ?></p>
              <span class="time_date"> <?php echo date('H:i | d-m-Y',strtotime($value->created_at)) ?></span> </div>

          </div>
      <?php endif; ?>

  <?php endforeach; ?>
<?php endif; ?>
