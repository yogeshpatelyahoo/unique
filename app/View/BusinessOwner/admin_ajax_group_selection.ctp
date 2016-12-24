<?php $this->Paginator->options(array('update' => '.panel-body','evalScripts' => true )); 
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
<div class="time_table">
<div class="row">
<!-- Start Here -->
<?php if(!empty($groups)) {?>
<div class="col-md-12">

<strong style="color:#707070;"><?php echo ucfirst($group_type);?> Groups</strong>
</div>
<div class="clearfix">&nbsp;</div>
<?php $i=1;foreach($groups as $group) {?>
                  
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
                    <div class="col-md-8 <?php if($group['Group']['total_member'] > 0){echo 'pull-right';}?> slide_toggle" style="text-align: right;"><span title="<?php echo $group['Country']['country_name'];?>"><?php echo $countryName;?></span> <br>
                      <span><?php echo $group['State']['state_subdivision_name'];?></span></div>
                      <div class="clearfix"></div>
                      <?php $timezone = $group['Group']['timezone_id'];
                      	if(strlen($timezone)>17) {
                      		$timezone = substr($timezone, 0, 14).'...';
		                }
                      ?>
                      <div class="day_name slide_toggle"><?php echo date('l',strtotime($group['Group']['first_meeting_date']));?></div>
                      <div class="day_time slide_toggle"> <?php echo date('h:i A',strtotime($group['Group']['meeting_time'])) . ' <span class="timeEst" title="'.$group['Group']['timezone_id'].'">'.$timezone.'</span>';?></div>
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
    <script>
    var grp_action = Array.prototype.slice.call(document.querySelectorAll('.group_action'));

	grp_action.forEach(function(html) {
	  var switchery = new Switchery(html, { color: '#64BD63', jackColor: '#fff',secondaryColor:'#FF0000',size:'small' });
	  
	});

    </script>