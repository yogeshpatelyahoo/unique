<?php 
$error_class = "";
$error_class = $this->Session->flash('error');
if ($error_class){
  $error_class = "error";
}
$error_class2 = "";
$error_class2 = $this->Session->flash('error2');
if ($error_class2){
  $error_class2 = "error";
}
echo $this->Html->script('Front/all');
?>
<div class="row margin_top_referral_search">
  <div class="col-md-9 col-sm-8">
       
  <div class="row">
    <div class="clearfix">&nbsp;</div>
    <div class="col-md-8 col-md-offset-2">

        <?php
        echo $this->Form->create('User',array('id'=>'ChangePassword','url'=>array('controller'=>'businessOwners','action'=>'change-password'),'class'=>'form-horizontal change_password','inputDefaults' => array('label' => false,'div' => false,'errorMessage'=>true),'novalidate'=>true));
        ?>
        <?php if ( !( $userInfo['User']['is_password_changed']==0 && $userInfo['User']['social_profile']!='' ) ) {?>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="inputEmail3">Current Password<span class="fill-must">*</span></label>
          <div class="col-sm-8">
            <?php echo $this->Form->input('password',array('type'=>'password','id'=>'current_password','class'=>"form-control $error_class $error_class2", 'autofocus'=>true));?>
          </div>
        </div>
        <?php }?>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="inputPassword3">New Password<span class="fill-must">*</span></label>
          <div class="col-sm-8">
            <?php echo $this->Form->input('new_password',array('type'=>'password','id'=>'new_password','class'=>"form-control $error_class2"));?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="inputPassword3"> Confirm Password<span class="fill-must">*</span></label>
          <div class="col-sm-8">
            <?php echo $this->Form->input('confirm_password',array('type'=>'password','id'=>'confirm_password','class'=>'form-control'));?>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">            
            <button type="submit" id="submitbutton" class="btn btn-sm file_sent_btn pull-right ML_btn">Save</button>
             <button type="reset" id="resetbutton" class="btn btn-sm file_sent_btn pull-right ">Cancel</button> 
          </div>
        </div>
      <?php echo $this->Form->end();?>       
    </div>        
  </div>   
</div>
<?php echo $this->element("Front/loginSidebar",array('tabpage' => 'changePassword'));?>  
</div>
<?php echo $this->element('Front/bottom_ads');
echo $this->Html->script('Front/changepassword');