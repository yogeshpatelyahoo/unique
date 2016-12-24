<?php
$currentController = $this->params['controller'];
$currentAction = $this->params['action'];
$firstParam = isset($this->params['pass']['0']) ? $this->params['pass']['0'] : "";
//referral pages
$refReceActive = ($currentAction=="received")? "active" : "";
$refSentActive = ($currentAction=="sent")? "active" : "";
$sendRefActive = ($currentAction=="sendReferrals" || $currentAction=="send-referrals")? "active" : "";
$recArchActive = ($currentAction=="archive" && $firstParam=="received")? "active" : "";
$sentArchActive = ($currentAction=="archive" && $firstParam=="sent")? "active" : "";
//message pages
$msgReceActive = ($currentAction=="inbox" && $firstParam!="archive")? "active" : "";
$msgSentActive = (($currentAction=="sentMessages" || $currentAction=="sent-messages") && ($firstParam!="archive"))? "active" : "";
$msgCompActive = ($currentAction=="composeMessage")? "active" : "";
$msgArchActive = ($currentAction=="inbox" && $firstParam=="archive")? "active" : "";
$msgSentArchActive = ($currentAction=="sentMessages" && $firstParam=="archive")? "active" : "";
//events pages
$upcomingEventsActive = ($currentAction=="index")? "active" : "";
$pastEventActive = ($currentAction=="pastEvents")? "active" : "";
$webcastActive = ($currentAction=="webcast")? "active" : "";
$addEventActive = ($currentAction=="addEvent")? "active" : "";
$tasksActive = ($currentAction=="tasks")? "active" : "";
//contact pages
$addcontactActive = ($currentAction=="addContact" || $currentAction=="add-contact")? "active" : "";
$invitepartnersActive = ($currentAction=="invitePartners" || $currentAction=="invite-partners")? "active" : "";
$listpartnersActive= ($currentAction=="partnersList" || $currentAction=="partners-list")? "active" : "";
$contactListActive = ($currentAction=="contactList" || $currentAction=="contact-list")? "active" : "";
$inviteguestsActive = ($currentAction=="inviteGuests" || $currentAction=="invite-guests")? "active" : "";
//Account pages
$accountActive = ($currentAction=="changePassword")? "active" : "";
$accProfileActive = ($currentAction=="profile" || $currentAction=="profileDetail")? "active" : "";
$accountNotifications = ($currentAction=="notifications")? "active" : "";
$socialActive = ($currentAction=="social")? "active" : "";
$accountTrainingVideo = ($currentAction=="trainingVideo")? "active" : "";
$accountBilling = ($currentAction=="billing" || $currentAction=="creditCard" || $currentAction=="purchaseReceipts")? "active" : "";
//dashboard
$dashboardActive = ($currentAction=="dashboard")? "active" : "";
//reviews
$reviewsActive = ($currentController=="reviews" && $currentAction=="index")? "active" : "";
//Team Pages
$currentTeamActive = ($currentController=="teams" && $currentAction=="teamList")? "active" : "";
$prevTeamActive = ($currentController=="teams" && $currentAction=="previousTeamList")? "active" : "";
$goalsActive = ($currentController=="teams" && $currentAction=="goals")? "active" : "";
?>
<div style="background:#fff; border:0" class="inner_pages_heading">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="intro-text"> </div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<section id="inner_pages_top_gap">
	<div class="container">
		<div class="row">
			<div class=" col-md-9 col-sm-4 col-xs-12 ">
            <div class=" col-md-2 col-sm-5 col-xs-12">
          <div class="product_thumbnail ">
            <a href="<?php echo Router::url(array('controller'=>'businessOwners','action'=>'profile'),true);?>" title="View Profile"><?php echo $this->Html->image($profileImage,array('alt'=> '','width'=>'80','height'=>'80'));?></a>
          </div>
          </div>
           <div class=" col-md-10 col-sm-7 col-xs-12 ">
          <div class="thumbnail_text">
		  <div class="logged-in">
            Hello <?php echo $loginUserName;?>
          </div>
            <span class="porduct_name">
            	<?php 
            	switch ($loginUserInfo['BusinessOwner']['group_role']) {
            		case 'leader':
            			echo 'Group Leader';
            			break;
            		case 'co-leader':
            			echo 'Group Co-Leader';
            			break;
            		case 'participant':
            			echo 'Participant';
            			break;
            		default:
            			echo '';
            			break;
            	}
            	?>
            </span>
            <div class="group1 groupFont"><?php echo Configure::read('GROUP_PREFIX').' '.$userGroup;?> 
            </div>
          </div>
          </div>
			</div>
			<div class=" col-md-3 col-sm-8 col-xs-12">
				<div class="logged_lixia" >
				<?php echo $this->Html->link($this->Html->image('video-img.png',array('alt'=> '','class'=>'center-block')),array('controller' =>'meetings'),array('escape' => false))?>
				</div>
                <div class = "installAddIn video_addin">
                    <a href = "<?php echo Configure::read('SITE_URL').'pages/faq-view/How-to-Download-Meeting-Add-in'?>" target = "_blank">Adobe Connect Install</a>
                </div>
                <!--<div class = "installAddIn">-->
                <!--    <a href = "http://www.adobe.com/go/adobeconnect_9_addin_mac" target = "_blank">Install Add-in for Mac</a>-->
                <!--</div>-->
			</div>
		</div>
		<div class="row">
		<div class="col-md-3 col-sm-12 group_shuffling pull-right">
		<div class="clearfix"></div>
	      <div class="media ">
	          <!-- <div class="media-left">
	           <?php echo $this->Html->image('upload_icon.png',array('alt'=> ''));?>
	          </div> -->
		          <div class="media-body">
		          	<h4 class="media-heading"> Group Shuffling Date: 
		          		<div class="groupShufflingDate">
		          			<?php
		          			$groupTimeZone = $loginUserInfo['Group']['timezone_id'];
		          			echo $shuffling_date = ($this->Session->read('Auth.Front.Groups.shuffling_date')!=NULL) ? date("M d, Y",$this->Functions->dateTime($this->Session->read('Auth.Front.Groups.shuffling_date'),$this->Session->read('Auth.Front.BusinessOwners.timezone_id'),$groupTimeZone)) : "";
		          			?>

		          		</div>
		          	</h4>
		          	<br/>
		          	<h4 class="media-heading"> Group Meeting Date: <div class="groupShufflingDate">
		          		<?php 
		          		$userTimeZone = $this->Session->read('Auth.Front.BusinessOwners.timezone_id');
		          		
		          		$currentDateTime = $this->Functions->getZoneCurrentTime($userTimeZone);
		          		$meetingDateTime = $loginUserInfo['AvailableSlots']['date'].' '.$loginUserInfo['Group']['meeting_time'];
		          		$meetingDate = $this->Functions->groupTimeConversion($meetingDateTime,$groupTimeZone,$userTimeZone);
		          		//$meetingDate = $this->Functions->groupTimeConversion($loginUserInfo['AvailableSlots']['date'],$userTimeZone);
		          		echo date("M d, Y @ h:i A", $meetingDate);
		          		//echo $nextMeeting = (date('Y-m-d',$currentDateTime) <= date('Y-m-d', $meetingDate) != NULL )? date("M d, Y", $meetingDate) : date("M d, Y", strtotime($loginUserInfo['Group']['second_meeting_date']));
		          		?>

		          	</div>
		          </h4>	

		      </div>
	        </div>
	      </div>
	    <div class="megamenu">
	        <div class=" col-md-9 col-sm-12">
	          <nav class="navbar navbar-default">
	            <div class="navbar-header">
	              <button data-target=".js-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
	            </div>
	            <div class="collapse navbar-collapse1 js-navbar-collapse">
	              <ul class="nav navbar-nav front_tabbing_nav">
	                <li class="dropdown mega-dropdown">
	                <?php echo $this->Html->link('DASHBOARD', array('controller' => 'dashboard', 'action' => 'dashboard'),array('class' =>'dropdown-toggle '.$dashboardActive));?>
	                </li>
	                <li class="dropdown mega-dropdown <?php if($this->params['controller']=="businessOwners") { echo 'open'; }?>"> <a class="dropdown-toggle <?php if($this->params['controller']=="businessOwners") { echo 'active'; }?>" href="<?php echo Router::url(array('controller'=>'businessOwners','action'=>'profile'));?>" aria-expanded="false">MY PROFILE </a>
	                  <ul class="dropdown-menu mega-dropdown-menu row">
	                    <li class="col-sm-311">
	                      <ul>
	                        <li><?php echo $this->Html->link('Me', array('controller' => 'businessOwners', 'action' => 'profile'),array('class'=>$accProfileActive)); ?></li>
	                        <li><?php echo $this->Html->link('Change Password', array('controller' => 'businessOwners', 'action' => 'change-password'),array('class'=>$accountActive)); ?></li>
	                        <li><?php echo $this->Html->link('Notifications', array('controller' => 'businessOwners', 'action' => 'notifications'),array('class'=>$accountNotifications)); ?></li>
	                        <li><?php echo $this->Html->link('Billing', array('controller' => 'businessOwners', 'action' => 'billing'),array('class'=>$accountBilling)); ?></li>
	                        <li><?php echo $this->Html->link('Social Media', array('controller'=>'businessOwners','action'=>'social'),array('class'=>$socialActive)); ?></li>
	                        
	                        <?php if($loginUserRole == 'leader' || $loginUserRole == 'co-leader'):?>
	                        <li><?php echo $this->Html->link('Training Video', array('controller' => 'businessOwners', 'action' => 'training-video'),array('class'=>$accountTrainingVideo)); ?></li>
	                    	<?php endif;?>
	                        <li class="divider"></li>
	                      </ul>
	                    </li>
	                  </ul>
	                </li>
	                <li class="dropdown mega-dropdown <?php if($this->params['controller']=="teams") { echo 'open'; }?>"> 
	                <?php $teamActive = $this->params['controller']=="teams" ? 'active' : '' ?>
	                <a class="dropdown-toggle <?php echo $teamActive;?>" href="<?php echo Router::url(array('controller' => 'teams', 'action' => 'team-list'));?>" aria-expanded="false">TEAM </a>
	                <?php //echo $this->Html->link('TEAM', array('controller' => 'teams', 'action' => 'teamList'),array('class' =>$active));?>
	                <?php if(!empty($team_alert) && $team_alert){?>
	                <div class="msg_counter_div">
					<?php echo $this->Html->link('<div class="msg_counter">NEW</div>', array('controller' => 'teams', 'action' => 'team-list'),array('escape' =>false)); ?>
	                </div>
	                <?php }?>
	                <ul class="dropdown-menu mega-dropdown-menu row">
	                    <li class="col-sm-311">
	                      <ul>
	                        <li><?php echo $this->Html->link('Current Team', array('controller' => 'teams', 'action' => 'team-list'),array('class'=>$currentTeamActive)); ?></li>
	                        <?php if(!empty($previousRecordCount)) {?>
							<li><?php echo $this->Html->link('Previous Team', array('controller' => 'teams', 'action' => 'previous-team-list'),array('class'=>$prevTeamActive)); ?></li>
							<?php }?>
							<li><?php echo $this->Html->link('Goals', array('controller' => 'teams', 'action' => 'goals'),array('class'=>$goalsActive)); ?></li>
	                      </ul>
	                    </li>
	                  </ul>
	                </li>
	                <li class="dropdown mega-dropdown <?php if($this->params['controller']=="referrals") { echo 'open'; }?>">	                
	                 <a class="dropdown-toggle <?php if($this->params['controller']=="referrals") { echo 'active'; }?>" href="<?php echo Router::url(array('controller'=>'referrals','action'=>'received'));?>" aria-expanded="false">REFERRALS </a>
                    <?php if($referalCounter>0){?>
	        		<div class="msg_counter_div">
					<?php echo $this->Html->link('<div class="msg_counter">'.$referalCounter.'</div>', array('controller' => 'referrals', 'action' => 'received'),array('escape' =>false)); ?>
	                </div>
	                <?php }?>
	                  <ul class="dropdown-menu mega-dropdown-menu row">
	                    <li class="col-sm-311">
	                      <ul>
	                        <li><?php echo $this->Html->link('Received', array('controller' => 'referrals', 'action' => 'received'),array('class'=>$refReceActive)); ?></li>
							<li><?php echo $this->Html->link('Sent', array('controller' => 'referrals', 'action' => 'sent'),array('class'=>$refSentActive)); ?></li>
							<li><?php echo $this->Html->link('Send Referral', array('controller' => 'referrals', 'action' => 'send-referrals'),array('class'=>$sendRefActive)); ?></li>
							<li><?php echo $this->Html->link('Sent Archive', array('controller' => 'referrals', 'action' => 'archive','sent'),array('class'=>$sentArchActive)); ?></li>
							<li><?php echo $this->Html->link('Received Archive', array('controller' => 'referrals', 'action' => 'archive','received'),array('class'=>$recArchActive)); ?></li>
	                      </ul>
	                    </li>
	                  </ul>
	                </li>
	                <li class="dropdown mega-dropdown <?php if($this->params['controller']=="messages") { echo 'open'; }?>"> <a class="dropdown-toggle <?php if($this->params['controller']=="messages") { echo 'active'; }?>" href="<?php echo Router::url(array('controller'=>'messages','action'=>'inbox'));?>" aria-expanded="false">MESSAGES </a>
	        		<?php if($messageCounter>0){?>
	        		<div class="msg_counter_div">
					<?php echo $this->Html->link('<div class="msg_counter" id="message_counter_element">'.$messageCounter.'</div>', array('controller' => 'messages', 'action' => 'inbox'),array('escape' =>false)); ?>
	                </div>
	                <?php }?>	                
	                  <ul class="dropdown-menu mega-dropdown-menu row">
	                    <li class="col-sm-311">
	                      <ul>
							<li><?php echo $this->Html->link('Inbox', array('controller' => 'messages', 'action' => 'inbox'),array('class'=>$msgReceActive)); ?></li>
							<li><?php echo $this->Html->link('Compose Message', array('controller' => 'messages', 'action' => 'compose-message'),array('class'=>$msgCompActive)); ?></li>
							<li><?php echo $this->Html->link('Sent Messages', array('controller' => 'messages', 'action' => 'sent-messages'),array('class'=>$msgSentActive)); ?></li>							
							<li><?php echo $this->Html->link('Inbox Archive', array('controller' => 'messages', 'action' => 'inbox','archive'),array('class'=>$msgArchActive)); ?></li>
							<li><?php echo $this->Html->link('Sent Archive', array('controller' => 'messages', 'action' => 'sent-messages','archive'),array('class'=>$msgSentArchActive)); ?></li>
							<li class="divider"></li>
						  </ul>
	                    </li>
	                  </ul>
	                </li>
	                <li class="dropdown mega-dropdown <?php if($this->params['controller']=="events") { echo 'open'; }?>"> <a data-toggle="dropdown <?php if($this->params['controller']=="events") { echo 'active'; }?>" class="dropdown-toggle <?php if($this->params['controller']=="events") { echo 'active'; }?>" href="<?php echo Router::url(array('controller'=>'events','action'=>'index'));?>" aria-expanded="false">EVENTS </a>
                    <?php if($eventCounter>0){?>
	        		<div class="msg_counter_div">
					<?php echo $this->Html->link('<div class="msg_counter">'.$eventCounter.'</div>', array('controller' => 'events', 'action' => 'index'),array('escape' =>false)); ?>
	                </div>
	                <?php }?>
                	<ul class="dropdown-menu mega-dropdown-menu row">
                		<li class="col-sm-311">
                			<ul>	                     
                				<li><?php echo $this->Html->link('Upcoming Events', array('controller' => 'events', 'action' => 'index'),array('class'=>$upcomingEventsActive)); ?></li>
                				<li><?php echo $this->Html->link('Past Events', array('controller' => 'events', 'action' => 'past-events'),array('class'=>$pastEventActive)); ?></li>
                				<?php
                				$title = '';
                				if($loginUserInfo['BusinessOwner']['group_role'] == 'leader' ):
                				$params = array('class'=>"$addEventActive ", 'title'=>$title);
                				if(!empty($loginUserInfo['BusinessOwner']['is_unlocked'])) {
                					
                					$link = array('controller' => 'events', 'action' => 'add-event');
                					
                				} else {
                					$params['class'].=' video_not_watched';
                					$params['data-toggle'] = "modal";
                					$params['data-target'] = "#modelLeaderunlock";
                					$link = 'javascript:void(0);';
                					$title = 'Please watch the training video to unlock the group leader/co-leader rights.';
                				}
                			
                				?>
                				<li><?php echo $this->Html->link('Create An Event', $link, $params); ?></li>
                				<?php endif;?>
                				<li><?php echo $this->Html->link('Webcast', array('controller' => 'events', 'action' => 'webcast'),array('class'=>$webcastActive)); ?></li>
                				<li><?php echo $this->Html->link('Tasks', array('controller' => 'events', 'action' => 'tasks'),array('class'=>$tasksActive)); ?></li>
                				<li><?php echo $this->Html->link('Create new task', 'javascript:void(0);',array('data-toggle'=>"modal", 'data-target'=>"#taskModal", 'onclick'=>"loadModel('', 'add');")); ?></li>
                				<li class="divider"></li>
                			</ul>
                		</li>
                	</ul>
	                </li>
                  <li class="dropdown mega-dropdown <?php if($this->params['controller']=="contacts") { echo 'open'; }?>"> <a class="dropdown-toggle <?php if($this->params['controller']=="contacts") { echo 'active'; }?>" href="<?php echo Router::url(array('controller'=>'contacts','action'=>'contact-list'));?>" aria-expanded="false">CONTACTS </a>
                    <ul class="dropdown-menu mega-dropdown-menu row">
                      <li class="col-sm-311">
                        <ul>
	                        <li><?php echo $this->Html->link('Contacts', array('controller' => 'contacts', 'action' => 'contact-list'),array('class'=>$contactListActive)); ?></li>
                            <li><?php echo $this->Html->link('Add A Contact', array('controller' => 'contacts', 'action' => 'add-contact'),array('class'=>$addcontactActive)); ?></li>
	                        <li><?php echo $this->Html->link('Member$ Referred by Me', array('controller' => 'contacts', 'action' => 'partners-list'),array('class'=>$listpartnersActive)); ?></li>
	                        <li><?php echo $this->Html->link('Invite Member$', array('controller' => 'contacts', 'action' => 'invite-partners'),array('class'=>$invitepartnersActive)); ?></li>
                        <li class="divider"></li>
                        <?php 
                        $title = '';
                        if( ( $loginUserInfo['BusinessOwner']['group_role'] == 'leader' || $loginUserInfo['BusinessOwner']['group_role'] == 'co-leader')  ):
                        	$params = array('class'=>"$inviteguestsActive", 'title'=>$title);
	                        if(!empty($loginUserInfo['BusinessOwner']['is_unlocked'])){
	                        	$link = array('controller' => 'contacts', 'action' => 'invite-guests');
	                        } else {
	                        	$params['class'].=' video_not_watched';
	                        	$params['data-toggle'] = "modal";
	                        	$params['data-target'] = "#modelLeaderunlock";
	                        	$link = 'javascript:void(0)';
	                        	$title = "Please watch the training video to unlock the group leader/co-leader rights.";
	                        }
                        ?>
                			<li><?php echo $this->Html->link('Invite Guests', $link, $params); ?></li>
                        <?php endif;?>
                        </ul>
	                    </li>
	                  </ul>         
	                 </li>
	                <li class="dropdown mega-dropdown"> 
	                
	                <?php $active = $this->params['controller']=="reviews" ? 'active' : '' ?>
	                <?php echo $this->Html->link('REVIEWS', array('controller' => 'reviews', 'action' => 'index'),array('class' =>$active));?>
	                <?php if($reviewCounter>0){?>
	        		<div class="msg_counter_div">
					<?php echo $this->Html->link('<div class="msg_counter">'.$reviewCounter.'</div>', array('controller' => 'reviews', 'action' => 'index'),array('escape' =>false)); ?>
	                </div>
	                <?php }?>
	                </li>
	              </ul>
	            </div>
	            <!-- /.nav-collapse -->
	          </nav>
	        </div>
	      </div>
	      
	    </div>		
<div class="clearfix"></div>
<div class="row margin_top_referral_search">  </div>
<div class="clearfix"></div>
