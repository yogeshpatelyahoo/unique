<?php $this->Paginator->options(array('update' => '.panel-body','evalScripts' => true )); ?>
<?php echo $this->HTML->css(array("../assets/plugins/switches/dist/switchery", '../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min', 'bootstrap-multiselect'));
echo $this->HTML->script(array("../assets/plugins/switches/dist/switchery", '../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min','Front/bootstrap-multiselect'));

echo $this->Paginator->options(array(
		'url' => array(
				"perpage"=>$perpage,				
				'group_type'=>$group_type,
				'profession'=>$professionId,
				'meeting_time'=>$meetingTime,
				'country'=>$countryId,
				'country_name'=>$countryName,
				'zip'=>$zipCode,
				'city'=>$city,
				'state'=>$stateId,
				'milesfilter'=>$miles,
		),
		'update' => '.panel-body',
		'evalScripts' => true
));
			?>
<!-- start: PAGE HEADER -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: PAGE TITLE & BREADCRUMB -->
        <ol class="breadcrumb">
            <li>
                <i class="clip-file"></i>
                <?php echo $this->Html->link('Groups', array('controller' => 'groups', 'action' => 'index', 'admin' => true));?>
            </li>
            <li class="active">Group List</li>
            <li class="search-box">
            <form class="sidebar-search">
                <div class="form-group">
                    <input type="text" id="searching" name="search" placeholder="Start Searching...">                    
                </div>
              
            </form>
            </li>
        </ol>
        <div class="page-header">
            <h1>Group List
                 
            </h1>
            <div class="row">
            <div class="col-md-3">
            
			<div class="pull-left col-md-4" style="margin-top: 7px; text-align: center;">Local</div>
				<input type="checkbox" class="js-switch col-md-4"  <?php if(!empty($group_type) && $group_type == 'global') {echo 'checked';}?> alt="Test"/>			
			<div class="pull-right col-md-4" style="margin-top: 7px;text-align: center;padding-left: 0;">Global</div>
			
            </div>
            </div>
        </div>
       
        <!-- end: PAGE TITLE & BREADCRUMB -->
    </div>
</div>
<div class="row">
<div class="col-md-12">
        <!-- start: BASIC TABLE PANEL -->
        <div class="panel panel-default">
         
            <?php
//          $ajaxUrl = Configure::read("SITE_URL").'admin/businessOwners/getData';
            $ajaxUrl = Router::url(array('controller'=>'businessOwners','action'=>'getData','admin'=>true));
            $professionUrl = Router::url(array('controller'=>'businessOwners','action'=>'getProfessionList','admin'=>true), true);
            echo $this->Form->input('',array('type'=>'hidden','id'=>'ajaxUrl','value'=>$ajaxUrl));
            echo $this->Form->input('',array('type'=>'hidden','id'=>'professionUrl','value'=>$professionUrl));

            ?>
            <div>
               <?php
                echo $this->Form->create('BusinessOwner', array('url' => array('controller' => 'businessOwners', 'action' => 'groupSelection', 'admin'=>true), 'class' => 'smart-wizard form-horizontal', 'id' => 'filterBusinessOwners', 'autocomplete'=>'false', 'inputDefaults' => array('error' => false)));
                echo $this->Form->input('group_type',array('type'=>'hidden','id'=>'group_type','value'=>$group_type, 'class'=>'group_type'));
                ?>
                <div class="col-md-12">
                <div style="padding: 10px 0;">
                <div  class="col-md-3"><strong style="color:#707070;">Filter By Profession:</strong></div>
                <div class="col-md-4">
                            <?php 
                            echo $this->Form->select('BusinessOwner.category_id', $categories,
                                array(
                                        'label' => false, 
                                        'class' => 'form-control filter', 
                                        'id' => 'category',
                                        'onChange' => 'ajaxChange("'.$professionUrl.'", this.value)',
                                        'empty' => 'Select Category'));
                            ?>
                        </div>
                <div class="col-md-4">
                <div id="professionDiv">
                            <?php 
                            
                            echo $this->Form->select('BusinessOwner.profession_id', $professions,
                                array(
                                        'label' => false, 
                                        'class' => 'form-control filter', 
                                        'id' => 'profession',
                                		'value'=>$professionId,
                                		'required' => false,
                                        'empty' => 'Select Profession'));
                            ?>
                            </div>
                        </div>
                         <div class="clearfix"></div>
                     </div>   
                </div> 
                <div class="clearfix"></div>
                <div class="col-md-12" style="border-top: 1px solid #ddd;">
                <div style="padding: 10px 0;">
                <div style="" class="col-md-3"><strong style="color:#707070;">Filter By Meeting Date Time:</strong></div>
                
                <div class="col-md-4">
                            <div id="meetingTimeDiv">
                                <div class="input-group bootstrap-timepicker custom_picker">
                                <?php
                                
                                    echo $this->Form->input('BusinessOwner.meeting_time',array('type'=>'text','label'=>false,'div'=>false,'class'=>'form-control time-picker filter','id'=>'meeting_time','placeholder'=>'Meeting Time'));
                                ?>
                                <!-- <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> -->
                                </div>
                            </div>
                  </div>
                  
                  <div class="col-md-4 custom_multi">
                         <select class="form-control daysFilter" name="data[BusinessOwner][daysFilter][]" multiple="multiple" >
			                <option value="Monday" <?php if(in_array("Monday", $days)) {echo 'selected="selected"';}?>>Monday </option>
			                <option value="Tuesday" <?php if(in_array("Tuesday", $days)) {echo 'selected="selected"';}?>>Tuesday</option>
			                <option value="Wednesday" <?php if(in_array("Wednesday", $days)) {echo 'selected="selected"';}?>>Wednesday</option>
			                <option value="Thursday" <?php if(in_array("Thursday", $days)) {echo 'selected="selected"';}?>>Thursday</option>
			                <option value="Friday" <?php if(in_array("Friday", $days)) {echo 'selected="selected"';}?>>Friday</option>
			                <option value="Saturday" <?php if(in_array("Saturday", $days)) {echo 'selected="selected"';}?>>Saturday</option>
			                <option value="Sunday" <?php if(in_array("Sunday", $days)) {echo 'selected="selected"';}?>>Sunday</option>
             			</select>
             	
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12" style="border-top: 1px solid #ddd;">
                 <div style="padding: 10px 0;">
                <div class="col-md-2"><strong style="color:#707070;">Filter By Location:</strong></div>
                <div class="col-md-2">
                            <?php
                                echo $this->Form->input('BusinessOwner.country',array('type'=>'text','id'=>'country','placeholder'=>"Country",'class'=>'form-control','required' => false, 'label' => false));
                                echo $this->Form->input('BusinessOwner.country_id',array('type'=>'hidden','id'=>'country_id','class'=>'form-control'));?>
                            <?php 
                            ?>
                        </div>
                        <div class="col-md-2">
                            <div id="stateDiv">
                                <?php
                                    echo $this->Form->input('BusinessOwner.state',array('type'=>'text','id'=>'state','placeholder'=>'State','class'=>'form-control', 'label' => false, 'required' => false));
                                    echo $this->Form->input('BusinessOwner.state_id',array('type'=>'hidden','id'=>'state_id','class'=>'form-control'));?>
                            </div>
                        </div>
                <div class="col-md-2">
                           
                                <?php
                                    echo $this->Form->input('BusinessOwner.city',array('type'=>'text','label'=>false,'div'=>false,'class'=>'form-control time-picker filter','id'=>'city','placeholder'=>'City'));
                                ?>
                                <!-- <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> -->
                               
                        </div>
                        <div class="col-md-2">
                           
                                <?php
                                 $params = array('type'=>'text','label'=>false,'div'=>false,'class'=>'form-control time-picker filter','id'=>'zip_code','placeholder'=>'Zip');
                                 $disabled = 'false';
                                 if($countryId==''){
                                 	$params['disabled'] = true;
                                 }
                                  echo $this->Form->input('BusinessOwner.zip',$params);
                                ?>
                                <!-- <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> -->
                               
                        </div>
                         <div class="col-md-2">
                         
                                <select class="form-control milesfilter" name="data[BusinessOwner][milesfilter]" id="miles_filter" <?php if($countryId==''){ echo 'disabled="disabled"';}?>>
                                	<option value="" <?php if($miles == '') {echo 'selected';}?>>Select miles </option>
					                <option value="5" <?php if($miles == '5') {echo 'selected';}?>>5 miles </option>
					                <option value="10" <?php if($miles == '10') {echo 'selected';}?>>10 miles</option>
					                <option value="25" <?php if($miles == '25') {echo 'selected';}?>>25 miles</option>
					                <option value="50" <?php if($miles == '50') {echo 'selected';}?>>50 miles</option>
				              </select>
                               
                        </div>
                        <div class="clearfix"></div>
                </div>
                </div>
                <table id="filter-table-1" class="table table-hover">
                    <thead></thead><tr>
                        <td colspan="5" id="errormsgdi">
                            <label class="error" for='deshdash' id="errorMsg" style="display: none">Please select some criteria to apply the filter</label>
                        </td>
                    </tr>
                   
                    <tr>
                        <td colspan="5">
                            <div class="input text pull-right">
                                    <?php echo $this->Html->link($this->Form->button('<i class="fa fa-circle-arrow-left"></i>Clear Filter', array('type' => 'button','onclick'=>'resetForm()', 'class' => 'btn btn-light-grey go-back cancel')), array('controller' => 'businessOwners', 'action' => 'groupSelection', 'admin' => true), array('escape' => false)); ?>
                                    <?php echo $this->Form->button('Filter <i class="fa fa-arrow-circle-right"></i>', array('type' => 'submit', 'class' => 'btn btn-bricky'));?>
                            </div>
                        </td>
                    </tr>
                </table>
                <?php echo $this->Form->end(); ?>
                
            </div>
        </div>
    </div>

</div>
<div class="row">
	
	<div class="clearfix"></div>
    <div class="col-md-12">
        <!-- start: BASIC TABLE PANEL -->
        <div class="panel panel-default">
            <div class="panel-body" >
                <div class="ajaxLoading">
                
                <div class="time_table">
                <div class="row">
                             <!-- Start Here -->   
                <?php if(!empty($groups)) {
                	?>
                	<div class="col-md-12">

<strong style="color:#707070;"><?php echo ucfirst($group_type);?> Groups</strong>
</div>
<div class="clearfix">&nbsp;</div>
<?php 
                	$i=1;foreach($groups as $group) {
                ?>  
                     
                <div class="col-md-3 col-sm-4 group_box <?php if($group['Group']['is_active']==1){echo 'enabled';} else {echo 'disabled';}?>">
                  <div id="ul1" class="pic time_box ">
                  <?php if($group['Group']['total_member'] == 0) {?>
                  <div class="col-md-4 group_action_wrap">
                  <input type="checkbox" class="group_action" <?php if($group['Group']['is_active']==1) {echo 'checked';}?> />
                  <input type="hidden" value="<?php echo $group['Group']['id'];?>" class="group_id">
                  </div>
                  <?php }?>
                  <?php $countryName =  $group['Country']['country_name'];
                  if(strlen($countryName)>17) {
                  	$countryName = substr($countryName, 0, 14).'...';
                  }
                  ?>
                    <div class="col-md-8 <?php if($group['Group']['total_member'] > 0){echo 'pull-right';}?> slide_toggle" style="text-align: right;"><span title="<?php echo $group['Country']['country_name'];?> "><?php echo $countryName;?></span> <br>
                      <span><?php echo $group['State']['state_subdivision_name'];?></span></div>
                      <div class="clearfix"></div>
                      <?php $timezone = $group['Group']['timezone_id'];
                      	if(strlen($timezone)>17) {
                      		$timezone = substr($timezone, 0, 14).'...';
		                }
                      ?>
                      <div class="day_name slide_toggle"><?php echo date('l',strtotime($group['Group']['first_meeting_date']));?></div>
                      <div class="day_time slide_toggle"> <?php echo date('h:i A',strtotime($group['Group']['meeting_time'])) .' <span class="timeEst" title="'.$group['Group']['timezone_id'].'">'.$timezone.'</span>';?></div>
                      <div class="rating_icon slide_toggle"> 
                        <?php                         
                        for($j = 0; $j < 20;$j++) {
                          if($j % 10 == 0){
                            echo '<div class="clearfix"></div>';
                          }
                          if($j < $group['Group']['total_member']) {
                            if ($group['Group']['group_type'] == 'local') {
                            	
                                echo '<i class="fa fa-user icon_yellow"></i> ';
                            } else {
                                echo '<i class="fa fa-user icon_blue"></i> ';
                            }
                          } else {
                              echo '<i class="fa fa-user "></i> ';
                          }
                        }
                        ?>

                      </div>
                        <div class="group_code slide_toggle"> <?php echo Configure::read('GROUP_PREFIX').' '.$this->Encryption->decode($group['Group']['id']);?></div>
                                                 
                         <?php 
                        if($group['Group']['group_type'] == 'local') {
                          echo $this->Html->image('local.png',array('alt'=> '','class'=>'local'));
                        } else {
                          echo $this->Html->image('global.png',array('alt'=> '','class'=>'local'));
                        }
                        ?>                </div>
                </div>  
                     <?php if( $i%4==0 ){
                     	echo '<div class="clearfix clearfix_margin"></div>';
                     }?>   
                 <?php $i++;}
                } else {
                	echo '<p style="text-align:center;margin-top:10px;">No record found.</p>';
                }
                 ?>
                 </div>
                   <div class="clearfix clearfix_margin"></div>
              </div>
                          

</div>
                <?php
     if($this->Paginator->numbers()){
    ?>

    <div class="paging" style="float:right;">
        <ul class="pagination" style="margin:0px;">
            <li>
              <?php echo $this->Paginator->prev(__('Previous',true)); ?>      
          </li>
          <li>
              <?php echo $this->Paginator->numbers(array('separator'=>false)); ?>      
          </li>
          <li>
             <?php echo $this->Paginator->next(__('Next',true)); ?>
          </li>
        </ul>
    </div>
    <?php } ?>
    <?php echo $this->Js->writeBuffer(); ?>
            </div>
        </div>
        <!-- end: BASIC TABLE PANEL -->
    </div>
</div>
<script>

	
		var reqMeetingTime = "<?php echo $meetingTime;?>";
		var groupSelectionUrl = "<?php echo Router::url(array('controller'=>'businessOwners', 'action'=>'groupSelection', 'admin'=>true), true);?>";
		var groupEnableDisable = '<?php echo Router::url(array('controller'=>'businessOwners', 'action'=>'changeGroupStatus', 'admin'=>true), true);?>';
		<?php if(isset($this->request->data['BusinessOwner'])){?>
		
	    var profession_val = "<?php echo ($professionId);?>";
	    
	    var meeting_val = "<?php echo $this->request->data['BusinessOwner']['meeting_time']?>";  
    <?php }else{?>
	    var profession_val = "";
	    var meeting_val = "";
    <?php }?> 
    var professionId = '<?php echo (!empty($professionId)) ? $this->Encryption->decode($professionId) : ''?>';

			</script>
<?php echo $this->HTML->script('admin_group_listing');?>			
