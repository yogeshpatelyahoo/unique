<?php echo $this->Html->script('Front/all');?>
<?php $actionUrl = 'events/popup-function'; ?>
<div class="row margin_top_referral_search">
	<div class="col-md-9 col-sm-9">
        <div class="clearfix">&nbsp;</div>
        <div id="no-more-tables">
        	<div id="ajaxTableContent">
	            <table class="col-md-12 table-bordered table-striped table-condensed no-more-tables cf data_table">
	        		<thead class="cf">
	        			<tr>
	        				<th width="35%">&nbsp;&nbsp;Title</th>
	                        <th width="28%">Date and Time</th>
	                        <th width="30">Invitee(s)</th>
	                        <th width="20"></th>
	        			</tr>
	        		</thead>
	        		<tbody>
	                    <?php if (!empty($events)) {
	                        foreach ($events as $data) {
	                            $readClass = ($data['EventParticipant']['is_read']==1) ? "read" : "unread";
	                        ?>
	        		    <tr>
	        				<td class="<?php echo $readClass;?> tdCursor" onClick="redirectToDetail('<?php echo $data['Event']['id']; ?>')">&nbsp;&nbsp;
	                            <?php echo (strlen($data['Event']['title'])>40) ? substr(ucfirst($data['Event']['title']),0,40)."..." : ucfirst($data['Event']['title']); ?>
	                        </td>
	                        <td class="<?php echo $readClass;?> tdCursor" onClick="redirectToDetail('<?php echo $data['Event']['id']; ?>')">
	                        <?php //echo date('M d, Y', strtotime($data['Event']['event_date'])) . " @ " . date('h:i A', strtotime($data['Event']['event_time'])); ?>
	                        <?php 
	                        $eventDateTime = $data['Event']['event_date'].' '.$data['Event']['event_time'];
	                        $eventTimeZone = $this->Functions->getUserInfo($data['Event']['created_by']);
	                        echo date("M d, Y @ h:i A", $this->Functions->dateTime($eventDateTime,$this->Session->read('Auth.Front.BusinessOwners.timezone_id'),$eventTimeZone));
	                        ?>
	                        </td>
	                        <td class="<?php echo $readClass;?> tdCursor" onClick="redirectToDetail('<?php echo $data['Event']['id']; ?>')"><?php echo (strlen($data['EventParticipant']['particpants_name'])>30) ? substr($data['EventParticipant']['particpants_name'],0,30)."..." : $data['EventParticipant']['particpants_name']; ?></td>
	                        <td>
	                        <?php 
	                        $eventStartDateTime = strtotime($data['Event']['event_date'].' '.$data['Event']['event_time']);
                        	$eventEndDateTime = strtotime($data['Event']['event_date'].' '.$data['Event']['event_time']. ' + 90 minutes');
                        	$eventDeleteBeforeTime = strtotime($data['Event']['event_date'].' '.$data['Event']['event_time']. ' - 60 minutes');
                        	$currentDateTime = strtotime(Configure::read('CURRENT_DATE_TIME'));
	                        if($data['BusinessOwner']['group_role'] == 'leader'){
	                        	if($currentDateTime < $eventDeleteBeforeTime) {?>
	                        	<a class="search_table_bg" href="javascript:void(0)" data-toggle="modal" data-target="#myModal" onclick="popUp('<?php echo $actionUrl;?>', '<?php echo $data['Event']['id']; ?>','<?php echo 'events'; ?>', '<?php echo 'delete-event'; ?>', '<?php echo 'events'; ?>')" escape = false>
	                                      <span class="glyphicon glyphicon-trash table_search_icon" title="Delete"></span>
	                                    </a>
	                        <?php } else {?>
	                        	<a class="search_table_bg2" href="javascript:void(0)" escape = false>
	                                      <span class="glyphicon glyphicon-trash table_search_icon" title="Delete"></span>
                                </a>
	                        <?php }}
	                        	
	                        	if(strtotime(Configure::read('CURRENT_DATE')) == strtotime($data['Event']['event_date'])){
                        			echo $this->Html->link(
                                                   '<i class="fa fa-users referContact" title="Start Event"></i>',
                                                   array('controller' => 'events', 'action' => 'start'),
                                                   array('escape' => FALSE, 'class' => 'search_table_bg'));
	                        	} else {
                        		echo $this->Html->link(
                                                   '<i class="fa fa-users referContact" title="Start Event"></i>',
                                                   'javascript:void(0)',
                                                   array('escape' => FALSE, 'class' => 'search_table_bg2'));
								/*echo $this->Html->link(
                                                   '<i class="fa fa-users referContact" title="Start Event"></i>',
                                                   array('controller' => 'events', 'action' => 'start'),
                                                   array('escape' => FALSE, 'class' => 'search_table_bg'));*/
	                        	}
                                
                            ?>
	                        </td>
	                    </tr>
	                    <?php }} else { ?>
	                        <tr><td colspan='4' style='text-align:center'>No record found</td></tr>
	                    <?php } ?>

	        		</tbody>
	        	</table>
	            <div class="clearfix">&nbsp;</div>
            </div>
        </div>
	</div>
	<?php echo $this->element("Front/loginSidebar",array('tabpage' => 'events'));?>
</div>
<?php echo $this->element('Front/bottom_ads');?>
<script>
    function redirectToDetail(eventId)
    {
        redirecturl  =  'events/view-event-detail/'+eventId;
        window.location.href = redirecturl;
    }
</script>
