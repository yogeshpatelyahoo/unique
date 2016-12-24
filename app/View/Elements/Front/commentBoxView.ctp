<div class="media">
<div class="pull-left">
<?php
      if( $referralData['profile_image']!='' ) {
        echo $this->Html->image('uploads/profileimage/'.$referralData['user_id'].'/resize/'.$referralData['profile_image'], array('alt' => 'Sample Image', 'class' => 'media-object', 'height' => 50, 'width' => 50));
      } else if($referralData['social_profile']!='' && $referralData['social_profile']=='facebook') { ?>
          <img src="https://graph.facebook.com/<?php echo $referralData['social_profile_id']; ?>/picture?width=50&height=50" alt="" width="50" height="50" class='text-center' id='newProfile' data-flag="0">
    <?php } else { echo $this->Html->image('no_image.png', array('alt' => 'no_image', 'class' => 'media-object', 'height' => 50, 'width' => 50));
      } ?>
      </div>
	<div class="media-body">
		<div class="media-heading"><?php echo ucFirst($referralData['fname']) . " " . ucFirst($referralData['lname']); ?>:
			<span class="alex-proto"><?php echo html_entity_decode($referralData['comment']); ?> </span>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="send_date">Posted  on <?php echo date("M d, Y @ h:i A", $this->Functions->dateTime($referralData['created'],$this->Session->read('Auth.Front.BusinessOwners.timezone_id')));?></div>
	</div>
</div>
<script>
$(document).ready(function(){
var ajacContainer=$('.ajaxUpdate');
ajacContainer.scrollTop(ajacContainer[0].scrollHeight);
});
</script>
