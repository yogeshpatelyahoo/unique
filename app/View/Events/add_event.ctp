<?php 
$style = "display:none;";
if(isset($this->request->data['Event']['sendto']) && $this->request->data['Event']['sendto']==0){
	$style = "display:block;";
}
?>
<?php
echo $this->Html->css('../assets/plugins/bootstrap-datepicker/css/datepicker');
echo $this->Html->script('../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker');
?>
<?php echo $this->Html->script('Front/all');?>
<div class="row margin_top_referral_search">
	<div class="col-md-9 col-sm-8">
        <div class="clearfix">&nbsp;</div>
        <?php
        	echo $this->Form->create('Event', array('url' => array('controller' => 'events', 'action' => 'add-event', 'admin'=>false), 'class' => 'form-horizontal form_compose', 'id' => 'addEvent','inputDefaults' => array('error' => false)));
        ?>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 col-md-3 col-xs-12">Invitee(s)<span class="star">*</span>
                </label>
                <div class="col-sm-8 col-md-9 col-xs-12">
                    <?php echo $this->Form->select('sendto', array('1'=>'All Team Members','0'=>'Choose Group Members'),array('class' => 'form-control seclect_value seclect_bulk','id' => 'sendto','required'=>false,'empty' => false,'tabindex'=>"1"));?>							
                </div>
            </div>
            <div class="form-group" style="<?php echo $style;?>" id="recipient_list_field">
                <label for="inputEmail3" class="col-sm-4 col-md-3 col-xs-12">Add Recipients<span class="star">*</span>
                </label>
               <div class="col-sm-8 col-md-9 col-xs-12">
                    <?php echo $this->Form->select('members_list', $usersList , array('class' => 'form-control seclect_value seclect_bulk', 'multiple'=>'multiple','id' => 'members_list', 'placeholder'=>'Add Members','autocomplete'=>'off','required'=>false,'tabindex'=>"2",'style'=>"height: 25px"));?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $this->Form->label('', 'Date'.$this->Html->tag('span', '*', array('class' => 'symbol star', 'for' => 'metaKeywords')), array('class' => 'col-sm-4 col-md-3 col-xs-12')); ?>
             <div class="col-sm-8 col-md-9 col-xs-12">
                     <?php
                    $disable = (isset($timeError)) ? 'true' : 'false';
                        echo $this->Form->input('event_date', array(
                                                    'type' => 'text',
                                                    'label' => false,
                                                    'div' => false,
                                                    'data-date-viewmode' => 'years',
                                                    'data-date-format' => 'dd-mm-yyyy',
                                                    'class' => 'form-control date-picker',
                                                    'readonly' => '1',
                                                    'disabled' => $disable
                                                    )
                                                );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $this->Form->label('', 'Time'.$this->Html->tag('span', '*', array('class' => 'symbol star', 'for' => 'meetingTime')), array('class' => 'col-sm-4 col-md-3 col-xs-12')); ?>
            	<div class="col-sm-8 col-md-9 col-xs-12 action_bulk ">
            		
            			<select name="data[Event][slot]" class="selectNew form-control seclect_value seclect_bulk" id="check" style="width:100%">
            				<option>Select Event Time</option>
            			</select>

            		
                    <!-- <i class="fa fa-info-circle timezone_tooltip" data-toggle="tooltip" data-placement="right" title="Time is listed in EST timezone"></i> -->
            	</div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 col-md-3 col-xs-12" for="inputEmail3">Title<span class="star">*</span></label>
                <div class="col-sm-8 col-md-9 col-xs-12">
                    <?php
                        echo $this->Form->input('title',array('type'=>'text','label'=>false,'div'=>false,'maxlength'=>false,'class'=>'form-control'));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 col-md-3 col-xs-12">Description<span class="star">*</span></label>
              <div class="col-sm-8 col-md-9 col-xs-12">
                <textarea name="data[Event][description]" rows="10" class="form-control" required="required"></textarea>
                <?php
                    //echo $this->Form->input('description',array('type'=>'textarea','label'=>false,'div'=>false,'rows'=>10,'class'=>'form-control'));
                ?>
                <div id="billingpageid" class="informationnote">NOTE: Events can be created once in 15 days.</div>
                    <div class="clearfix">&nbsp;</div>
                    <?php echo $this->Form->button('Create Event',array('class'=>'btn btn-sm file_sent_btn pull-right', 'type'=>'submit','disabled'=>$disable));?>
                </div>
            </div>
        <?php echo $this->Form->end(); ?>
    </div>
	<?php echo $this->element("Front/loginSidebar",array('tabpage' => 'addEvent'));?>
</div>
<!--<script>var action = 'listing'; </script>-->
<?php echo $this->element('Front/bottom_ads');?>

<script type="text/javascript">
var shuffling_date = "<?php echo ($this->Session->read('Auth.Front.Groups.shuffling_date')!=NULL) ? date("Y,n,d",strtotime($this->Session->read('Auth.Front.Groups.shuffling_date')) - 1) : "";?>";
</script>
<?php echo $this->HTML->script('Front/events_add_event');?>