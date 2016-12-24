<div class="modal-dialog" role="document">
    <?php
        switch ($listPage) {
            case "referrals/received":
                $actionMessage = "Do you want to archive the referral(s)?";
                $checkAllId = "checkallarchive";
                break;
            case "referrals/sent":
                $actionMessage = "Do you want to archive the referral(s)?";
                $checkAllId = "checkallarchive";
                break;
            case "referrals/archive/sent":
                $actionMessage = "Do you want to delete the referral(s)? This cannot be undone";
                $checkAllId = "checkallarchive";
                break;
            case "referrals/archive/received":
                $actionMessage = "Do you want to delete the referral(s)? This cannot be undone";
                $checkAllId = "checkallarchive";
                break;
            case "messages/inbox/inbox":
                $actionMessage = "Do you want to archive the message(s)?";
                $checkAllId = "checkallarchive";
                break;
            case "messages/sent-messages/sentmessage":
                $actionMessage = "Do you want to archive the message(s)?";
                $checkAllId = "checkallarchive";
                break;
            case "messages/inbox/archive":
                $actionMessage = "Do you want to permanently delete the message(s)?";
                $checkAllId = "checkallarchive";
                break;
            case "messages/sent-messages/archive":
                $actionMessage = "Do you want to permanently delete the message(s)?";
                $checkAllId = "checkallarchive";
                break;
            case "contacts/contact-list":
                $actionMessage = "Do you want to permanently delete the contact(s)?";
                $checkAllId = "checkall";
                break;
            case "UID":
                $actionMessage = "Do you want to join the group?";
                $checkAllId = "";
                $redirect = 'dashboard/dashboard';
                break;
            case "cancel-membership":
                $actionMessage = "Do you want to cancel the membership?";
				$checkAllId = "";
                $redirect = 'dashboard/dashboard';
                break;
            case "dashboard/change-group":
                $actionMessage = "Do you want to submit the group change request?";
                $checkAllId = "dashboard";
                break;
            case "events/tasks":
                $actionMessage = "Do you want to permanently delete the task(s)?";
                $checkAllId = "checkall";
                break;
            case "events":
	            $actionMessage = "Do you want to permanently delete the event?";
	            $checkAllId = "";
	            $redirect = 'events';
	            break;
            case "billing":
            	$actionMessage = "Do you want to request Admin to change your group?";
            	$checkAllId = "";
            	$redirect = 'billing';
            	break;
            case "contacts/invite-guests":
                $actionMessage = "Do you want to delete the invited guest?";
                $checkAllId = "checkall";
                $redirect = 'contacts/invite-guests';
                break;
            default:
                $actionMessage = "Do you want to permanently delete?";
                $checkAllId = "checkallarchive";
        }
    ?>
    <div class="modal-content">
        <div class="modal-header" style="border:none">
        </div>
        <div class="modal-body popup_body">
            <h2>
              <?php echo $actionMessage; ?>
            <div class="modal_text"></div>
            
        </div>
        <div class="modal-footer popup_footer text-center">
            <button onclick="removeCheck('<?php echo $checkAllId; ?>');" type="button" class="btn btn-primary popup_cancel" data-dismiss="modal"><span class="pull-left">Cancel</span>  <!--<i class="fa fa-close pull-right"></i>--></button>
            <?php if ($listPage == "UID" || $listPage == "cancel-membership" || $listPage == 'events' || $listPage == "contacts/invite-guests") { ?>
                <button type="button" class="btn btn-default ok_btn" onClick="groupAction('<?php echo $id; ?>', '<?php echo $controller; ?>', '<?php echo $action; ?>', '<?php echo $UID; ?>','<?php echo $redirect;?>')"><span class="pull-left"  data-dismiss="modal">Ok</span>  <!--<i class="fa fa-check pull-right"></i>--></button>
            <?php } else { ?>
                <button type="button" class="btn btn-default ok_btn" onClick="actionOnPopUp('<?php echo $id; ?>', '<?php echo $controller; ?>', '<?php echo $action; ?>', '<?php echo $listPage; ?>')"><span class="pull-left"  data-dismiss="modal">Ok</span>  <!--<i class="fa fa-check pull-right"></i>--></button>
            <?php }?>
            
        </div>
    </div>
</div>