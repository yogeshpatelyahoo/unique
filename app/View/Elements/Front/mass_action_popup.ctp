<div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php
          $onClick = 'actionOnMassDelete';
        switch($listPage){
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
            case "referrals/archive/received/unarchive":
            case "referrals/archive/sent/unarchive":
                $actionMessage = "Do you want to restore the referral(s)?";
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
            case "messages/inbox/unarchive":
            case "messages/sent-messages/archive":
                $actionMessage = "Do you want to restore the message(s)?";
                $checkAllId = "checkallarchive";
                $onClick = 'actionOnMassUnarchive';
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
                break;
            case "teams/team-list":
                $actionMessage = "Please tell us why you want to remove the user";
                $checkAllId = "checkallteam";
                
                break;
            case "events/tasks":
                $actionMessage = "Do you want to permanently delete the task(s)?";
                $checkAllId = "checkall";
                break;                
            default:
                $actionMessage = "Do you want to permanently delete?";
                $checkAllId = "checkall";
        }
        ?>
        <div class="modal-header" style="border:none">
        </div>
        
        <div class="modal-body popup_body">
            <h2>
              <?php echo $actionMessage; ?>
            <div class="modal_text"></div>
        </div>
        <div class="modal-footer popup_footer text-center">
        <?php if($listPage == 'teams/team-list') {?>
        <div class="form-group"> <textarea type="text" class="form-control" id="kickoff_message" name="kickoff_message" maxlength="350"></textarea></div>
        <?php }?>
            <button onclick="removeCheck('<?php echo $checkAllId; ?>');" type="button" class="btn btn-primary popup_cancel" data-dismiss="modal"><span class="pull-left">Cancel</span>  <!--<i class="fa fa-close pull-right"></i>--></button>
            <button type="button" class="btn btn-default ok_btn" onClick="<?php echo $onClick;?>('<?php echo $formId; ?>', '<?php echo $controller; ?>', '<?php echo $action; ?>', '<?php echo $listPage; ?>')"><span class="pull-left"  <?php if($listPage != 'teams/team-list') {?>data-dismiss="modal" <?php }?>>Ok</span>  <!--<i class="fa fa-check pull-right"></i>--></button>
        </div>
    </div>
</div>
