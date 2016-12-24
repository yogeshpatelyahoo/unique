<div class="row margin_top_referral_search">
	<div class="col-md-9 col-sm-8">
      <?php echo $this->Element('Front/social_profiles');?>
         <div class="clearfix">&nbsp;</div>
        <div class="row">
        <div class="col-md-12">
        <div class="referral_profile_head"></div>
        </div>
          <div class="col-md-4 text-center-twitter">
         
        <i class="fa fa-facebook twitter_icon"></i>

        </div>
        <div class="col-md-8">
        <div class=" twitter-Page-head">
        <?php if(!$fbConnected) {
            echo 'Authorize Unique to post on your behalf';
        } else {
            echo 'Unique is authorized to post on your behalf';
        }?>
        
        </div>

      <div class="media-body nf_media_body">
        <h4 class="media-heading">   
        <?php if(!$fbConnected) {?>
        <a href="#" class="btn btn-sm file_sent_btn allow_access" style="padding: 10px 40px;">Allow Access</a>   </h4>
        <?php } else {
                    echo $this->Html->link($this->Form->button('<i class="fa fa-circle-arrow-left"></i> Revoke Access', array('type' => 'button', 'class' => 'btn btn-sm file_sent_btn revoke_access')),array('controller'=>'businessOwners','action'=>'fb-revoke'), array('escape'=>false));
        }
                ?>
      </div>
      <div class="twitter_text">Unique does not store or have access to your Facebook <br>
            login credentials at any time. </div>
        </div>
     <div class="clearfix"></div>
        <div class="col-md-12 ">
            <div class="referral_profile_head"> <span>CONFIGURE POSTS</span></div>
        </div>
        <?php echo $this->Form->create('BusinessOwner');?>
        <div class="notification_box col-md-12">
          <div class="media  border-top00">
          <div class="media-left">
          <input type="checkbox" class="mt0_checkbox" name="fb_config[]" value="fbReferralSend" <?php if(in_array('fbReferralSend', $fbData)) { echo 'checked="checked"';}?>> 
          <?php echo $this->Form->hidden('config_type',array('value'=>'facebook'));?>
          </div>
      <div class="media-body nf_media_body">
        <h4 class="media-heading">When you send a referral    </h4>
        <div class="clearfix"></div>
          Automatically posts: "Just sent a referral to username via Unique"
      </div>
      
    </div>
    
    <div class="media  ">
      <div class="media-left">
          <input type="checkbox" class="mt0_checkbox" name="fb_config[]" value="fbMessageSend" <?php if(in_array('fbMessageSend', $fbData)) { echo 'checked="checked"';}?>>
      </div>
      
      <div class="media-body nf_media_body">
        <h4 class="media-heading">When you send a message </h4>
        <div class="clearfix"></div>
          Automatically posts: "Just sent a message to username via Unique"  
          </div>
      
        </div>
    <?php if ( $bizOwnerData['BusinessOwner']['group_role']=='leader' && $bizOwnerData['BusinessOwner']['is_unlocked']==1) {?>
    <div class="media  ">
      <div class="media-left">
          <input type="checkbox" class="mt0_checkbox" name="fb_config[]" value="fbInviteSend" <?php if(in_array('fbInviteSend', $fbData)) { echo 'checked="checked"';}?>>
  
      </div>
      <div class="media-body nf_media_body">
        <h4 class="media-heading">When you send an event invitation
       </h4>
        <div class="clearfix"></div>
        Automatically posts: "Just set up an event with @username via @Unique" 
          </div>
      
    </div>
    <?php }?>
      <div class="clearfix">&nbsp;</div>
       <div class="clearfix">&nbsp;</div> 
       <?php
       if ($fbConnected) {
        ?>
        <button class="btn btn-sm file_sent_btn pull-right" type="submit">Save</button>
        <?php } else { ?>
        <button class="btn btn-sm file_sent_btn pull-right disabled" type="button">Save</button>
        <?php } ?>
      </div>        
        </div>
      </div>
    <?php echo $this->element("Front/loginSidebar",array('tabpage' => 'facebookSidebar'));?>
    </div>
    <?php echo $this->element('Front/bottom_ads');?>
    </section>
    <script>
    var ajaxUrl = "<?php echo Router::url(array('controller'=>'users','action'=>'get-state-city'));?>";
    var imgPath = "<?php echo $this->webroot; ?>img/icons/error.png";
    $('.allow_access').click(function(e) {
        e.preventDefault();
    	window.open("<?php echo Router::url(array('controller'=>'BusinessOwners','action'=>'fb-login'),true);?>",null,
    	"height=400,width=800,status=yes,toolbar=no,menubar=no,location=no");
        });
    </script>
    <?php echo $this->Html->script ( 'Front/profile' );