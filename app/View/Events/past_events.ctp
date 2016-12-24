<?php echo $this->Html->script('Front/all');?>
<div class="row margin_top_referral_search">
	<div class="col-md-9 col-sm-9">
        <div class="clearfix">&nbsp;</div>
        <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed no-more-tables cf data_table">
        		<thead class="cf">
        			<tr>
        				<th width="35%">&nbsp;&nbsp;Title</th>
                        <th width="25%">Date and Time</th>
                        <th width="30">Invitee(s)</th>
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
                        <?php 
                        $eventDateTime = $data['Event']['event_date'].' '.$data['Event']['event_time'];
                        $eventTimeZone = $this->Functions->getUserInfo($data['Event']['created_by']);
                        echo date("M d, Y @ h:i A", $this->Functions->dateTime($eventDateTime,$this->Session->read('Auth.Front.BusinessOwners.timezone_id'),$eventTimeZone));
                        ?>
                        	
                        </td>
                        <td class="<?php echo $readClass;?> tdCursor" onClick="redirectToDetail('<?php echo $data['Event']['id']; ?>')"><?php echo (strlen($data['EventParticipant']['particpants_name'])>30) ? substr($data['EventParticipant']['particpants_name'],0,30)."..." : $data['EventParticipant']['particpants_name']; ?></td>
                    </tr>
                    <?php }} else { ?>
                        <tr><td colspan='3' style='text-align:center'>No record found</td></tr>
                    <?php } ?>

        		</tbody>
        	</table>
            <div class="clearfix">&nbsp;</div>
        </div>
	</div>
	<?php echo $this->element("Front/loginSidebar",array('tabpage' => 'pastEvents'));?>
</div>
<?php echo $this->element('Front/bottom_ads');?>

<script>
    function redirectToDetail(eventId)
    {
        redirecturl  =  '<?php echo Router::url(array('controller'=>'events','action'=>'view-event-detail'));?>/'+eventId;
        window.location.href = redirecturl;
    }
</script>
