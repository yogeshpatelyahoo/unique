<?php $actionUrl = 'businessOwners/popup-function';
$cancelPopup = "popUp('$actionUrl', '','users', 'cancel-membership', 'cancel-membership')";
$upgradeDowngradeBtn="";

if(empty($disableClassChangeGroup)){
    $cancelButton='<a class="search_table_bg2" href="javascript:void(0);" onclick="'.$cancelPopup.'" escape = false type="button" data-toggle="modal" data-target="#myModal" title="Cancel"><span class="glyphicon glyphicon-remove table_search_icon"></span></a>';
} else {
    $cancelButton = '<a class="search_table_bg2 disabled" href="javascript:void(0);" escape = false type="button" title="Cancel"><span class="glyphicon glyphicon-remove table_search_icon"></span></a>';
}
if($userData['Groups']['group_type'] == 'local') {
    if(!empty($subscriptionData['Subscription']['is_active'])) {
        if(date('Y-m-d') > date('Y-m-d', strtotime($userData['BusinessOwners']['group_update']. ' + 30 days'))){
            if(empty($disableClassChangeGroup)){
                $upgradeDowngradeBtn = '<a class="search_table_bg2" href="'.Router::url(array('controller'=>'groups','action'=>'group-change',$this->Encryption->encode('local'))).'" title="Upgrade"><span class="glyphicon glyphicon-upload table_search_icon"></span></a>';
            } else {
                $upgradeDowngradeBtn = '<a class="disabled search_table_bg2" href="#"><span class="glyphicon glyphicon-upload table_search_icon" title="Upgrade"></span></a>';
            }
            
        } else {
            $upgradeDowngradeBtn = '<a class="disabled search_table_bg2" href="#"><span class="glyphicon glyphicon-upload table_search_icon" title="Upgrade"></span></a>';
        }        
    } else {
        $cancelButton = '<a class="search_table_bg2 disabled" href="javascript:void(0);" escape = false type="button" title="Cancel"><span class="glyphicon glyphicon-remove table_search_icon"></span></a>';
        $upgradeDowngradeBtn = '<a class="disabled search_table_bg2" href="#"><span class="glyphicon glyphicon-upload table_search_icon" title="Upgrade"></span></a>';
    }
} elseif($userData['Groups']['group_type'] == 'global') {
    if(!empty($subscriptionData['Subscription']['is_active'])) {
        if(date('Y-m-d') > date('Y-m-d', strtotime($userData['BusinessOwners']['group_update']. ' + 30 days'))){
            if(empty($disableClassChangeGroup)){
                $upgradeDowngradeBtn = '<a class="search_table_bg2" href="'.Router::url(array('controller'=>'groups','action'=>'group-change',$this->Encryption->encode('global'))).'" title="Downgrade"><span class="glyphicon glyphicon-download table_search_icon"></span></a>';
            } else {
                $upgradeDowngradeBtn = '<a class="disabled search_table_bg2" href="#" title="Downgrade"><span class="glyphicon glyphicon-download table_search_icon"></span></a>';
            }
            
        } else {
            $upgradeDowngradeBtn = '<a class="disabled search_table_bg2" href="#" title="Downgrade"><span class="glyphicon glyphicon-download table_search_icon"></span></a>';
        } 
        
    } else {
        $cancelButton = '<a class="search_table_bg2 disabled" href="javascript:void(0);" escape = false type="button" title="Cancel"><span class="glyphicon glyphicon-remove table_search_icon"></span></a>';
        $upgradeDowngradeBtn = '<a class="disabled search_table_bg2" href="#" title="Downgrade"><span class="glyphicon glyphicon-download table_search_icon"></span></a>';
    }
}
$currentGrp = $userData['Groups']['group_type'];
if (date('Y-m-d') > date('Y-m-d', strtotime($loginUserInfo['BusinessOwner']['group_change']. ' + 30 days')) && empty($disableClassChangeGroup)){
    $groupChangeButton = '<a class="search_table_bg2" href="'.Router::url(array('controller'=>'groups','action'=>'group-change',$this->Encryption->encode('change'))).'" title="Change Group"><i class="fa fa-exchange"></i></a>';
} else {
    $groupChangeButton = '<a class="search_table_bg2 disabled" href="javascript:void(0);" title="Change Group"><i class="fa fa-exchange"></i></a>';
}
$currentGrpHtml = $inactiveGrpHtml = "";
$currentGrpHtml.= $cancelButton.'<a class="search_table_bg2" href="'.Router::url(array('controller'=>'businessOwners','action'=>'credit-card'),true).'" title="Credit Card"><span class="glyphicon glyphicon-credit-card table_search_icon"></span></a> 
                  <a class="search_table_bg2" href="'.Router::url(array('controller'=>'businessOwners','action'=>'purchase-receipts'),true).'" title="Receipts"><span class="glyphicon glyphicon-list-alt table_search_icon"></span></a> '.$groupChangeButton;
$inactiveGrpHtml.= $upgradeDowngradeBtn.'<a class="disabled search_table_bg2" href="#" title="Credit Card"><span class="glyphicon glyphicon-credit-card table_search_icon"></span></a> 
                  <a class="disabled search_table_bg2" href="#" title="Receipts"><span class="glyphicon glyphicon-list-alt table_search_icon"></span></a>
                  <a class="search_table_bg2 disabled" href="javascript:void(0);" title="Change Group"><i class="fa fa-exchange"></i>';
$change_class = '';
$changeUrl = Router::url(array('controller'=>'businessOwners', 'action'=>'registerGroupChangeRequest', ));

if((isset($previousChangeRequest) && $previousChangeRequest) ||  $disableClassChangeGroup) {
	$change_class = 'disabled';
	$changeUrl = '';
} 
?>
<div class="row margin_top_referral_search">
<div class="col-md-9 col-sm-8">
<p><a class="btn btn-sm back_btn pull-right <?php echo $change_class;?>" data-wa-link="nav_sign up dropdown" href="javascript:void(0);" onclick="popUp('businessOwners/popup-function', '','businessOwners', 'registerGroupChangeRequest', 'billing')" data-toggle="modal" data-target="#myModal" id="registerGroupChangeRequest" <?php if($change_class == 'disabled') {echo 'title="Your request has been already registered"';}?>> Request Group Change </a></p>

</div>
    <div class="col-md-9 col-sm-8">
  <div class="clearfix">&nbsp;</div>
      <div id="no-more-tables">      
            <table class="col-md-12 table-bordered table-striped   table-condensed table-condensed no-more-tables cf payment_receipt_table data_table belling_table">
        		<thead class="cf">
        			<tr>
        		<th>   Plans</th>
              <th>Fee </th>
              <th>&nbsp;</th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
              											
               
                <td>Local</td>
                <td>$49.99	</td>
                  <td>
                 <?php if($currentGrp == 'local') {echo $currentGrpHtml;} else {echo $inactiveGrpHtml;}?>
                   <div class="clearfix"></div> 
                
                </td>
              </tr>
        			<tr>
               <td>Global</td>
               <td>$49.99	</td>
                 <td>
                 <?php if($currentGrp == 'global') {echo $currentGrpHtml;} else {echo $inactiveGrpHtml;}?>
                   <div class="clearfix"></div> 
                </td>
              </tr>
        		</tbody>
        	</table>
        	<div id="billingpageid">*On cancellation, your membership will be immediately expired<br/>
				*Plan can be changed once every 30 days
            </div>
            <div class="clearfix">&nbsp;</div>
            
        </div>
<!-- Paypal Button -->
        <div class="clearfix">&nbsp;</div>
        <div id="login">
    <div class="referrals_reviews_head padd-top0 paypal_connect">Paypal Connect</div>
    <br/>
    <!--<div class="col-md-2 text-center-twitter"><i class="fa fa-paypal paypal_icon"></i></div>-->
    <div class="col-md-12">
            <div class=" paypal-Page-head">
            Connect Unique to access your account information        
            </div>

      <div class="media-body nf_media_body">
        <h4 class="media-heading">
        <?php if(empty($paypalData)) {?>  
        <div id="paypal_button">
            <span id="myContainer">
            </span>
        </div>
        <div class="twitter_text paypal_text">Unique does not store or have access to your PayPal Account login credentials at any time. </div>
        <?php } else {?>
            <div class="media-body nf_media_body">
        <h4 class="media-heading">   
        <a href="<?php echo Router::url(array('controller'=>'businessOwners', 'action'=>'billing', 'revokePayPal'), true);?>">
            <button type="button" class="btn btn-sm file_sent_btn revoke_access"><i class="fa fa-circle-arrow-left"></i> Revoke Access</button>
        </a>     
        </h4></div>
        <div class="twitter_text">If you have changed you primary PayPal email, revoke and allow access again to continue receiving the wallet balance. </div>
        <?php }?>
             </h4></div>
        </div>
<div class="col-md-8">

<script src="https://www.paypalobjects.com/js/external/api.js"></script>
<script>
paypal.use( ["login"], function(login) {
  login.render ({
    "appid": "<?php echo Configure::read('paypal_client_id');?>",
    "scopes": "profile email address",
    "containerid": "myContainer",
    "locale": "en-us",
    "returnurl": "<?php echo Router::url(array('controller'=>'businessOwners', 'action'=>'billing', 'payPalCallback'), true);?>"
  });
});

</script>
</div>
</div>
<!-- Paypal Button -->
      </div>
        <?php echo $this->element("Front/loginSidebar",array('tabpage' => 'billing'));?>
    </div>
    <?php echo $this->element('Front/bottom_ads');
    echo $this->Html->script('Front/all');
