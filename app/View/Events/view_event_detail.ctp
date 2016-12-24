<div class="row margin_top_referral_search">
    <div class="col-md-9 col-sm-8">
        <div class="row"> 
            <div class="col-md-8">
            </div>
            <div class="col-md-4 text-right">
                <?php if (!empty($referer)) {?>
                    <a href="<?php echo $referer; ?>" class="back_btn_new pull-right text-center padauto "><i class="fa fa-arrow-circle-left"></i> Back</a>
                <?php } ?>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="panel panel-default mypanel">
        <!-- Default panel contents -->
            <div class="panel-heading message_subject"><?php echo ucfirst($eventData['Event']['title']); ?><span class="panel_inbox pull-right"></span>
                <div class="panel_body_head inbox_users" >From:
                    <span class="color_black"><?php
                        echo isset($eventCreator) ? $eventCreator['BusinessOwner']['fname'] . " " . $eventCreator['BusinessOwner']['lname'] : ''; ?></span>
                    <div class="panel_body_subhead">To:  <span class="color_black"><?php echo $participantsName; ?></span>
                    </div>					
                    <?php //echo 'Date and Time: <span class="color_black">'.date('M d, Y', strtotime($eventData['Event']['event_date'])) . " @ " . date('h:i A', strtotime($eventData['Event']['event_time'])).'</span>'; ?>
                    <?php 
                        $eventDateTime = $eventData['Event']['event_date'].' '.$eventData['Event']['event_time'];
                        $eventTimeZone = $this->Functions->getUserInfo($eventData['Event']['created_by']);
                        echo 'Date and Time: <span class="color_black">'. date("M d, Y @ h:i A", $this->Functions->dateTime($eventDateTime,$this->Session->read('Auth.Front.BusinessOwners.timezone_id'),$eventTimeZone)).'</span>';
                        ?>
                </div>
            </div>
            <div class="panel-body padd-top0">
                <div class="panel-body-text inbox_message_text">
                    <?php
                        echo html_entity_decode(ucfirst($eventData['Event']['description']));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->element("Front/loginSidebar",array('tabpage' => 'eventDetail'));?>
</div>
<?php echo $this->element('Front/bottom_ads');?>
