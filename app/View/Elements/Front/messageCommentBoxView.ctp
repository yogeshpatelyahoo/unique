<div class="media-left">
  <?php
      if( $messageComment['profile_image']!='' ) {
        echo $this->Html->image('uploads/profileimage/'.$messageComment['user_id'].'/resize/'.$messageComment['profile_image'], array('alt' => 'Sample Image', 'class' => 'media-object', 'height' => 50, 'width' => 50));
      } else if($messageComment['social_profile']!='' && $messageComment['social_profile']=='facebook') { ?>
          <img src="https://graph.facebook.com/<?php echo $messageComment['social_profile_id']; ?>/picture?width=50&height=50" alt="" width="50" height="50" class='text-center' id='newProfile' data-flag="0">
    <?php } else { echo $this->Html->image('no_image.png', array('alt' => 'no_image', 'class' => 'media-object', 'height' => 50, 'width' => 50));
      } ?>
    
  </div>
 <div class=" col-md-9 padd-left0 padd-right0 alex-proto"><b><?php echo ucFirst($messageComment['fname']) . " " . ucFirst($messageComment['lname']); ?>: </b> <?php echo $messageComment['comment']; ?> 
    <div class="send_time"> Posted  on 
    <?php echo date("M d, Y @ h:i A", $this->Functions->dateTime($messageComment['created'],$this->Session->read('Auth.Front.BusinessOwners.timezone_id')));?>
    </div><br/>
</div><br/>

<script>
$(document).ready(function(){
var ajacContainer=$('.ajaxUpdatemsg');
ajacContainer.scrollTop(ajacContainer[0].scrollHeight);
});
</script>