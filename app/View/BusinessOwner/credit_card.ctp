<div class="row margin_top_referral_search">
      <div class="col-md-9 col-sm-8">
  
         <div class="clearfix">&nbsp;</div>
     
<?php echo $this->Form->create('BusinessOwner',array('url'=>array('controller'=>'businessOwners','action'=>'credit-card'),'class'=>'form-horizontal credit_card_form','id'=>'creditCardForm','inputDefaults' => array('label' => false,'div' => false,'errorMessage'=>true),'novalidate'=>true));
        ?>
<?php if(!empty($savedCards)) {
        if($savedCards['BusinessOwners']['credit_card_number']!='') {
            ?>
       <div class="credit_card_text">
       The credit card ending with <?php echo $this->Encryption->decode($savedCards['BusinessOwners']['credit_card_number']);?> is currently associated with your account.<br/>
       
       </div>
       <?php }?>
       <?php }?>
         <div class="clearfix">&nbsp;</div>
       <div class="card_info_heading">UPDATE CREDIT CARD INFORMATION</div>
         <div class="clearfix">&nbsp;</div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Card Number<span class="star">*</span></label>
    <div class="col-sm-5">
    <?php echo $this->Form->input('CC_Number',array('id'=>'card_number','autocomplete'=>"off",'placeholder'=>"Card Number",'class'=>'form-control','maxlength'=>'16','autocomplete'=>false, 'autofocus'=>true));?>
      
    </div>
    <div class="col-sm-3">
      <?php echo $this->Form->input('CC_cvv',array('placeholder'=>"CVC",'class'=>"form-control",'type'=>'password','maxlength'=>3,'autocomplete'=>false))?>
    </div>
    
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Expiration Date<span class="star">*</span></label>
    <div class="col-sm-5">
      <?php echo $this->Form->month('CC_month', array('id'=>'expiration_month','empty' => 'Month','class'=>"form-control seclect_value seclect_bulk sel_custom"));?>
    </div>
     <div class="col-sm-3">
      <?php echo $this->Form->year('CC_year', 2030, date('Y'),array('class'=>'form-control seclect_value seclect_bulk sel_custom','orderYear'=>'asc','empty'=>'Year'));?>
    </div>
    
  </div>
  
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Name as it appears on card<span class="star">*</span></label>
    <div class="col-sm-8">
      <?php echo $this->Form->input('CC_Name',array('placeholder'=>"",'class'=>"form-control"));?>
    </div>
    
  </div>
  
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Enter Billing Address details<span class="star">*</span></label>
    <div class="col-sm-4">
      <?php echo $this->Form->input('Transaction.city',array('type'=>'text','id'=>'city','placeholder'=>"City",'class'=>'form-control','autocomplete'=>'off', 'maxlength'=>false));?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('Transaction.state',array('type'=>'text','id'=>'state','placeholder'=>'State','class'=>'form-control', 'required' => false));?>
        <?php echo $this->Form->input('Transaction.state_id',array('type'=>'hidden','id'=>'state_id','class'=>'form-control'));?>
    </div>
    
    <div class="clearfix">&nbsp;</div>
      <label for="inputEmail3" class="col-sm-4 control-label">&nbsp;</label>
    
    <div class="col-sm-4">
      <?php echo $this->Form->input('Transaction.zipcode',array('type'=>'text','id'=>'zipcode','placeholder'=>"Zip Code",'class'=>'form-control','autocomplete'=>'off', 'maxlength'=>false));?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('Transaction.country',array('type'=>'text','id'=>'country','placeholder'=>"Country",'class'=>'form-control','required' => false));?>
        <?php echo $this->Form->input('Transaction.country_id',array('type'=>'hidden','id'=>'country_id','class'=>'form-control'));?>
    </div>
    
    
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    
    <?php echo $this->Form->button('Save',array('class'=>"btn btn-sm file_sent_btn pull-right ML_btn",'type'=>"submit"));?>
    <a href="<?php echo Router::url(array('controller'=>'businessOwners','action'=>'billing'),true);?>" class="btn btn-sm file_sent_btn pull-right" >Cancel</a>
    
    </div>
  </div>

<?php echo $this->Form->end();?>
      </div>
          <?php echo $this->element("Front/loginSidebar",array('tabpage' => 'billing'));?>
    </div>
<style>
            label {
    font-family: "Open Sans","lucida grande","Segoe UI",arial,verdana,"lucida sans unicode",tahoma,sans-serif;
}
            </style>
<?php echo $this->element('Front/bottom_ads');
    echo $this->Html->script('Front/all');