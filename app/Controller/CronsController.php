<?php

/**
 * This is a Crons controller to handle all the cron jobs
 *
 */
App::uses('Email', 'Lib');
class CronsController extends AppController 
{
    public $uses = array('BusinessOwner', 'Subscription', 'User', 'Group', 'PrevGroupRecord', 'SendReferral', 'Review', 'Setting', 'Goal', 'Membership', 'AvailableSlots', 'CreditCard', 'Task','EventParticipant','Event','InviteGuest', 'InvitePartner', 'PaypalDetail', 'PaypalPayoutStatus');
    public $components=array('Adobeconnect');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->autoRender = false;
        $this->autoLayout = false;
        $this->Auth->allow(array(
                            'calculateShufflingPercentage',
                            'shufflingEmailNotification',
                            'shufflingMissedEmailNotification',
                            'deactivateUser',
                            'trainingVideoReminderMail',
                            'meetingReminderMail',
                            'addUserToAdobeMeeting',
                            'removeUserToAdobeMeeting',
                            'eventReminderMail',
                            'addUserToAdobeEvent',
                            'removeUserToAdobeEvent',
                            'meetingMailToGuest',
                            'updateReferralAmount',
                            'updateInvitePartnerAmount',
                            'updateBatchStatus'
                            )
                        );
    }

    /**
    * function is used to send reminder mail to leader and co-leader
    * to watch the training video
    * @author Mystery Man
    */
    public function trainingVideoReminderMail()
    {
        $data = $this->BusinessOwner->find('all', array(
                                'conditions' => array('BusinessOwner.group_role' => array('leader', 'co-leader'), 'BusinessOwner.is_unlocked' => 0),
                                'fields' => array('BusinessOwner.email', 'BusinessOwner.fname', 'BusinessOwner.lname', 'BusinessOwner.group_role')
                                ));
        if (!empty($data)) {
            foreach ($data as $row) {
                $emailLib = new Email();
                $subject = "Unique: Watch Training Video";
                $template = "training_video_reminder";
                $format = "both";
                $to = $row['BusinessOwner']['email'];
                $prams = array('username' => $row['BusinessOwner']['fname'].' '.$row['BusinessOwner']['lname']);
                $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
                if( $mailForm  && !empty($mailForm) ) {
                	$prams = array_merge($prams, $mailForm);
                }
                $emailLib->sendEmail($to, $subject, $prams, $template, $format);
            }
        }
    }

    /**
    * function is used to deactivate the user and group who has cancelled membership
    * @author Mystery Man
    */
    public function deactivateUser()
    {
        $subscritpionData = $this->Subscription->find('all', array('conditions' => array('Subscription.is_active' => 0, 'Subscription.next_subscription_date' => date('Y-m-d'))));
        foreach ($subscritpionData as $subscription) {
            $nextDate = $subscription['Subscription']['next_subscription_date'];
            if (date('Y-m-d') == $nextDate) {
                $this->User->id = $subscription['Subscription']['user_id'];
                $this->User->saveField('deactivated_by_user', 1);
                $businessId = $this->BusinessOwner->findByUserId($subscription['Subscription']['user_id']);
                //Store previous group members information
                $gdata = $this->BusinessOwner->getMyGroupMemberList($this->Encryption->decode($businessId['Group']['id']),$subscription['Subscription']['user_id']);
                $prevMember = NULL;
                $prevRecord['PrevGroupRecord'] = array();
                foreach ($gdata as $key => $val) {
                    $data['user_id'] = $subscription['Subscription']['user_id'];
                    $data['group_id'] = $this->Encryption->decode($businessId['Group']['id']);
                    $data['members_id'] = $key;
                    array_push($prevRecord['PrevGroupRecord'],$data);
                }
                $this->PrevGroupRecord->saveAll($prevRecord['PrevGroupRecord']);       
                $this->BusinessOwner->id = $this->Encryption->decode($businessId['BusinessOwner']['id']);
                $parts = explode(',', $businessId['Group']['group_professions']); 
                    while (($i = array_search($businessId['BusinessOwner']['profession_id'], $parts)) !== false) {
                        unset($parts[$i]);
                    }
                $updateProfessions = implode(',', $parts);
                $updateMember = $businessId['Group']['total_member'] - 1;
				$this->BusinessOwner->saveField('group_id', NULL);
                $this->Group->updateAll(array('Group.group_professions' => "'".$updateProfessions."'", 'Group.total_member' => "'".$updateMember."'"), array('Group.id' => $businessId['BusinessOwner']['group_id']));
            }
        }
    }

	/**
     * function is used to calculate the percentage of group member 
     * based on referral and ratings
     * @author Jitendra Sharma
     */
    public function calculateShufflingPercentage()
    {
   		$currentDate = date("Y-m-d");
   		$endDate = date("Y-m-d", strtotime("+7 days"));
   		//$currentDate."==".$endDate;
   		$this->Group->unbindModel(array('belongsTo' => array('Country', 'State', 'User')));
   		$this->Group->bindModel(array(
   				'hasMany' => array( 
   					'BusinessOwner' => array(
   						'className' => 'BusinessOwner',
   						'foreignKey' => 'group_id',
   						'fields' => array('BusinessOwner.user_id', 'BusinessOwner.group_id'),
   					 )
   				)
   			)
   		);
   		$groupInfo = $this->Group->find('all', array(
				'conditions' => array('Group.shuffling_date >=' => $currentDate,'Group.shuffling_date <=' => $endDate,'Group.total_member >' => 0)
		));
   		if (!empty($groupInfo)) {
	   		foreach ($groupInfo as $groups) {
	   			$totalGroupReferral = "";
	   			$shufflingParams = array();
	   			foreach ($groups['BusinessOwner'] as $groupMember) {
	   				//get referral send by group member
	   				$totalGroupReferral += $shufflingParams[$groupMember['user_id']]['ReferralSend'] = $this->SendReferral->find('count', array(
	   					'conditions' => array('SendReferral.from_user_id' => $groupMember['user_id'],'SendReferral.group_id' => $groupMember['group_id'])
	   				));
	   				//get rating of group member
	   				$this->Review->recursive = -1;
	   				$ratingInfo = $this->Review->find("first", array(
					    "fields" => array("ROUND(AVG(Review.rating)) AS AverageRating"),
					    'conditions' => array('Review.user_id' => $groupMember['user_id'],'Review.group_id' => $groupMember['group_id'])
					));
	   				$shufflingParams[$groupMember['user_id']]['rating'] = ($ratingInfo['0']['AverageRating']) ? $ratingInfo['0']['AverageRating'] : 0;
	   			}
	   			// calculate shuffling percentage
	   			foreach ($shufflingParams as $userId => $params) {
	   				// get the % of Ttl (ReferralSend by user / totalReferralSend in group by all users)
	   				$ttlPercent = ($totalGroupReferral>0) ? $params['ReferralSend']/$totalGroupReferral : 0.00;
	   				// get the rating %
	   				$ratingPercent = $params['rating']/Configure::read('MAX_RATING');
	   				
	   				// update shuffling percentage of respective user
	   				$criteria = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1)));
	   				$criteria = explode(":", $criteria['Setting']['key_value']);
	   				$referralConfig = $criteria[0];
	   				$ratingConfig = $criteria[1];
	   				$shufflingPercent = ($ttlPercent*$referralConfig/100) + ($ratingPercent*$ratingConfig/100);
	   				// update user shuffling percent
	   				$this->BusinessOwner->updateAll(
	   					array('BusinessOwner.shuffling_percent' => $shufflingPercent),
	   					array('BusinessOwner.user_id' => $userId)
	   				);
	   			}
	   		}
   		}
    }
    
    /**
     * function is used to send email notification before 24 hrs of Shuffling (every 24 hrs)
     * @author Jitendra Sharma
     */
    public function shufflingEmailNotification()
    {
    	$currentDate = date("Y-m-d",strtotime("+1 days"));
   		$this->Group->unbindModel(array('belongsTo' => array('Country','State','User')));
   		$this->Group->bindModel(array(
   			'hasMany' => array(
   				'BusinessOwner' => array(
   					'className' => 'BusinessOwner',
   					'foreignKey' => 'group_id',
   					'fields' => array('BusinessOwner.user_id', 'BusinessOwner.group_id', 'BusinessOwner.email', 'BusinessOwner.member_name'),
   					)
   				)
   			)
   		);
   		$groupInfo = $this->Group->find('all', array(
   				'conditions' => array('Group.shuffling_date' => $currentDate, 'Group.total_member >' => 0)
   		));
   		$groupCount = count($groupInfo);
   		if (!empty($groupInfo)) {
	   		$emailLib = new Email();
	   		$subjectMembers = "Unique: Group Shuffling";
	   		$subjectAdmin = "Unique: Group Shuffling";
	   		$templateMembers = "group_shuffling_member_notify";
	   		$templateAdmin = "group_shuffling_admin_notify";
	   		$format = "both";
	   		// send email to admin
	   		$adminEmail = AdminEmail;
	   		$params = array('groupCount' => $groupCount);
	   		$mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
	   		if( $mailForm  && !empty($mailForm) ) {
	   			$params = array_merge($params, $mailForm);
	   		}
	   		$emailLib->sendEmail($adminEmail, $subjectAdmin, $params, $templateAdmin, $format);
	    	foreach ($groupInfo as $groups) {
	   			foreach ($groups['BusinessOwner'] as $groupMember) {
	   				// send email to all group member
	                $to = $groupMember['email'];
	                $params = array('username' => $groupMember['member_name']);
	                $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
	                if( $mailForm  && !empty($mailForm) ) {
	                	$params = array_merge($params, $mailForm);
	                }
	                $emailLib->sendEmail($to, $subjectMembers, $params, $templateMembers, $format);
	   			}
	   		}
   		}
    }
    
    /**
     * function is used to send email notification to admin if he misses the shuffling (every 24 hrs)
     * @author Jitendra Sharma
     */
    public function shufflingMissedEmailNotification()
    {
    	$initialDate = date("Y-m-d",strtotime("-1 days"));
    	$endDate = date("Y-m-d",strtotime("-3 days"));
    	$this->Group->unbindModel(array('belongsTo' => array('Country','State','User')));
    	$groupInfo = $this->Group->find('all', array(
    		'conditions' => array('Group.shuffling_date >=' => $endDate,'Group.shuffling_date <=' => $initialDate, 'Group.total_member >' => 0)
    	));
    	$groupCount = count($groupInfo);
    	if (!empty($groupInfo)) {
    		$emailLib = new Email();
    		$subjectAdmin = "Unique: Group Shuffling";
    		$templateAdmin = "shuffling_missed_admin_notify";
    		$format = "both";
    		// send email to admin
    		$adminEmail = AdminEmail;
    		$params = array('groupCount' => $groupCount);
    		$mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
    		if( $mailForm  && !empty($mailForm) ) {
    			$params = array_merge($params, $mailForm);
    		}
    		$ok = $emailLib->sendEmail($adminEmail, $subjectAdmin, $params, $templateAdmin, $format);
    	}
    }

    /**
     * Function to send email notification to User if the group has net been changed after being registered for more than 48 hours 
     * @author Mystery Man
     */
    public function groupNotChangedMails()
    {
        $conditions = array('GroupChangeRequest.request_type' => 'cr', 'GroupChangeRequest.is_moved' => 0);
        $pendingRequests = $this->GroupChangeRequest->find('all', array('conditions' => $conditions));
        $cuttentTimeStamp = strtotime(date('Y-m-d'));
        if (!empty($pendingRequests)) {
            $count = 0;
            foreach ($pendingRequests as $row) {
                $timeDiff = round(abs($cuttentTimeStamp - strtotime($row['GroupChangeRequest']['created'])) / (60*60),0);
                if($timeDiff < 48) {
                    //Send Mails
                    $count++;
                    $emailLib = new Email();
                    $to = $userInfo['BusinessOwner']['email'];
                    $subject = 'Unique: Group change request status';
                    $template ='group_change_pending';
                    $variable = array('name'=>$row['BusinessOwner']['fname'] . " " . $row['BusinessOwner']['lname']);
                    $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail002'));
                    if( $mailForm  && !empty($mailForm) ) {
                    	$variable = array_merge($variable, $mailForm);
                    }
                    $success = $emailLib->sendEmail($to, $subject, $variable, $template, 'both');
                }
            }
        }
    }

    /**
     * Function for sending resetting goals
     * @author Mystery Man
     **/
    public function goalsResetCron()
    {
        $groups = $this->Group->find('all');
        $emailPost = array();
        foreach ($groups as $group) {
            $groupID = $this->Encryption->decode($group['Group']['id']);
            $conditions = array('BusinessOwner.group_id'=>$groupID);
            $fields = array('BusinessOwner.fname', 'BusinessOwner.lname', 'BusinessOwner.email');
            $bizData = $this->BusinessOwner->find('all', array('conditions' => $conditions, 'fields' => $fields));
            // Send mail to all group members
            if (!empty($bizData)) {
                foreach ($bizData as $row) {
                    $emailLib = new Email();
                    $to = $row['BusinessOwner']['email'];
                    $subject = 'Unique: Your Goals have been reset';
                    $template ='group_goals_reset';
                    $message = "Your individual goals have been reset.<br/>Please login and click Team tab to open the Goals subtab to set the new goals for the present month. ";
                    $variable = array('name'=>$row['BusinessOwner']['fname'] . " " . $row['BusinessOwner']['lname'],'message'=>$message);
                    $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
                    if( $mailForm  && !empty($mailForm) ) {
                    	$variable = array_merge($variable, $mailForm);
                    }
                    $success = $emailLib->sendEmail($to, $subject, $variable, $template, 'both');
                }
            }
            $leaderColeaderData = $this->BusinessOwner->find('all', array('conditions' => array('BusinessOwner.group_id' => $groupID, 'BusinessOwner.group_role' => array('leader', 'co-leader')), 'fields' => $fields));
            // Send mail to all leaders/Co-leaders
            if (!empty($leaderColeaderData)) {
                foreach ($leaderColeaderData as $row) {
                    $emailLib = new Email();
                    $to = $row['BusinessOwner']['email'];
                    $subject = 'Unique: Your Goals have been reset';
                    $template = 'group_goals_reset';
                    $message = "The group members goal have been reset.<br/>Please login and click Team tab to open the Goals sub tab and set the group member goals for the present month. ";
                    $fullName = $row['BusinessOwner']['fname'] . " " . $row['BusinessOwner']['lname'];
                    $variable = array('name' => $fullName, 'message' => $message);
                    $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
                    if( $mailForm  && !empty($mailForm) ) {
                    	$variable = array_merge($variable, $mailForm);
                    }
                    $success = $emailLib->sendEmail($to, $subject, $variable, $template, 'both');
                }
            } 
        }        
    }

    /** function used to add user to adobe meeting group before meeting start
	* Crons runs every 5 minute 
	* Add users to adobe connect meeting before 15 minutes of meeting start
 	* @author Mystery Man
 	**/
    public function addUserToAdobeMeeting()
    {
    	$breezSessionData = $this->Adobeconnect->adobeConnectLogin();
    	if ($breezSessionData != 'invalid') {
    		$slotData = $this->AvailableSlots->getSlotData(false,'meetings');
	    	if (!empty($slotData)) {
	    		foreach ($slotData as $sData) {
	    			$timeArr = explode(' ', $sData['AvailableSlots']['slot_time']);
	    			$actualMeetingTime = strtotime($timeArr[0].' '.$timeArr[1]);
	    			$timeBefore = strtotime(date('h:i A', strtotime('-15 minutes', strtotime($timeArr[0].' '.$timeArr[1]))));
	    			$currentTime = strtotime(date('h:i A'));
	    			if($currentTime > $timeBefore && $currentTime < $actualMeetingTime){
	    				$adobeMeetingId = $sData['AvailableSlots']['adobe_type_id'];
	    				$groupMembers = $this->BusinessOwner->getGroupMembers($this->Encryption->encode($sData['AvailableSlots']['type_id']));
	    				if (!empty($groupMembers)) {
	    					$allAlloted = 0;
	    					foreach ($groupMembers as $info) {
	    						if (empty($info['User']['adobe_allocated'])) {
	    							$callBackData = $this->Adobeconnect->addRemoveUserToMeeting($info,$adobeMeetingId,$breezSessionData,'add');
				                    if ($callBackData['status']['@attributes']['code'] == 'ok') {
				                    	$this->User->id = $info['BusinessOwner']['user_id'];
			                    		$this->User->saveField('adobe_allocated',1);
				                    } else {
				                    	$allAlloted++;
				                    }
	    						}
	    					}
	    					if ($allAlloted == 0){
	    						$this->AvailableSlots->id = $this->Encryption->decode($sData['AvailableSlots']['id']);
	    						$this->AvailableSlots->saveField('is_active', 1);
	    					}
	    				}
	    			}
	    		}
	    	}
    	}
    }

    /**
	*function used to remove user from adobe meeting after meeting ends
	* Crons runs every 10 minute 
	* Remove users to adobe connect meeting after meeting stop if user not present in meeting
	* if user attend the meeting then after meeting ends logged in user automatically removed from meeting
	*@author Mystery Man
	**/
    public function removeUserToAdobeMeeting()
    {    	
    	$breezSessionData = $this->Adobeconnect->adobeConnectLogin();
    	if ($breezSessionData != 'invalid') {
    		$slotData = $this->AvailableSlots->getSlotData(true, 'meetings');
	    	if (!empty($slotData)) {
	    		foreach($slotData as $sData) {
	    			$timeArr = explode(' ', $sData['AvailableSlots']['slot_time']);
	    			$endMeetingTime = strtotime($timeArr[3].' '.$timeArr[4]);
	    			$currentTime = strtotime(date('h:i A'));
	    			if($currentTime > $endMeetingTime){
	    				$adobeMeetingId = $sData['AvailableSlots']['adobe_type_id'];
	    				$groupMembers = $this->BusinessOwner->getGroupMembers($this->Encryption->encode($sData['AvailableSlots']['group_id']));
	    				if (!empty($groupMembers)) {
	    					$allUnAlloted = 0;
	    					foreach ($groupMembers as $info){
	    						if (!empty($info['User']['adobe_allocated'])) {
	    							$callBackData = $this->Adobeconnect->addRemoveUserToMeeting($info, $adobeMeetingId, $breezSessionData, 'remove');
				                    if ($callBackData['status']['@attributes']['code'] == 'ok') {
				                    	$this->User->id = $info['BusinessOwner']['user_id'];
			                    		$this->User->saveField('adobe_allocated',0);
			                    		$this->User->saveField('adobe_mail_sent',0);
				                    } else {
				                    	$allUnAlloted++;
				                    }
	    						}
	    					}
	    					if ($allUnAlloted == 0) {
	    						$this->AvailableSlots->id = $this->Encryption->decode($sData['AvailableSlots']['id']);
	    						$this->AvailableSlots->saveField('is_active', 0);
	    						$this->AvailableSlots->saveField('is_started', 0);
	    					}
	    				}
	    			}
	    		}
	    	}
    	}
    }

    /**
    *run cron every 10 minute to send reminder meeting mail before two hours of meeting start.
    * Meeting reminder mail
    *@author Mystery Man
    */
    public function meetingReminderMail()
    {
		$emailLib = new Email();
		$slotData = $this->AvailableSlots->getSlotData(false,'meetings');
    	if (!empty($slotData)) {
    		foreach ($slotData as $sData) {
    			$timeArr = explode(' ', $sData['AvailableSlots']['slot_time']);
    			$actualMeetingTime = strtotime($timeArr[0].' '.$timeArr[1]);
    			$timeBefore = strtotime(date('h:i A', strtotime('-2 hours', strtotime($timeArr[0].' '.$timeArr[1]))));
    			$currentTime = strtotime(date('h:i A'));
    			if ($currentTime > $timeBefore && $currentTime < $actualMeetingTime) {
    				$groupMembers = $this->BusinessOwner->getGroupMembers($this->Encryption->encode($sData['AvailableSlots']['type_id']));
    				if (!empty($groupMembers)) {
    					foreach ($groupMembers as $info) {
    						if (empty($info['User']['adobe_mail_sent'])) {
    							$to = $info['BusinessOwner']['email'];
			                    $subject = 'Unique: Meeting Link';
			                    $template ='meeting';
			                    $fullName = $info['BusinessOwner']['member_name'];
	                			$url = Configure::read('SITE_URL') . 'meetings';
			                    $variable = array('name' => $fullName, 'url' => $url);
			                    $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
			                    if( $mailForm  && !empty($mailForm) ) {
			                    	$variable = array_merge($variable, $mailForm);
			                    }
			                    $success = $emailLib->sendEmail($to, $subject, $variable, $template, 'both');
			                    if ($success) {
			                    	$this->User->id = $info['BusinessOwner']['user_id'];
			                    	$this->User->saveField('adobe_mail_sent',1);
			                    }
    						}		                    
    					}
    				}
    			}
    		}
    	}
    }

    /** function used to add user to adobe event before event start
    * Crons runs every 5 minute 
	* Add users to adobe connect event before 15 minutes of event start
	*@author Mystery Man
	**/
    public function addUserToAdobeEvent()
    {
    	//echo date('h:i:s A');die;
		//$emailLib = new Email();    	
    	$breezSessionData = $this->Adobeconnect->adobeConnectLogin();
    	if ($breezSessionData != 'invalid') {
    		$slotData = $this->AvailableSlots->getSlotData(false,'events');
	    	if (!empty($slotData)) {
	    		foreach ($slotData as $sData) {
	    			$timeArr = explode(' ', $sData['AvailableSlots']['slot_time']);
	    			$actualMeetingTime = strtotime($timeArr[0].' '.$timeArr[1]);
	    			$timeBefore = strtotime(date('h:i A', strtotime('-15 minutes', strtotime($timeArr[0].' '.$timeArr[1]))));
	    			$currentTime = strtotime(date('h:i A'));
	    			if($currentTime > $timeBefore && $currentTime < $actualMeetingTime){
	    				$adobeMeetingId = $sData['AvailableSlots']['adobe_type_id'];
    					$eventMembers = $this->EventParticipant->getEventMembers($sData['AvailableSlots']['type_id']);
	    				if (!empty($eventMembers)) {
	    					$allAlloted = 0;
	    					foreach ($eventMembers as $info) {
	    						if (empty($info['EventParticipant']['adobe_allocated'])) {
	    							$callBackData = $this->Adobeconnect->addRemoveUserToMeeting($info,$adobeMeetingId,$breezSessionData,'add');
				                    if ($callBackData['status']['@attributes']['code'] == 'ok') {
				                    	$this->EventParticipant->id = $this->Encryption->decode($info['EventParticipant']['id']);
			                    		$this->EventParticipant->saveField('adobe_allocated',1);
				                    } else {
				                    	$allAlloted++;
				                    }
	    						}
	    					}
	    					if ($allAlloted == 0){
	    						$this->AvailableSlots->id = $this->Encryption->decode($sData['AvailableSlots']['id']);
	    						$this->AvailableSlots->saveField('is_active', 1);
	    					}
	    				}
	    			}
	    		}
	    	}
    	}
    }

    /**
	*function used to remove user from adobe event after event ends
	* Remove users to adobe connect event after event stops, if user not present in event.
	* if user attend the event then after event ends logged in user automatically removed from event
	*@author Mystery Man
	**/
    public function removeUserToAdobeEvent()
    {
    	$breezSessionData = $this->Adobeconnect->adobeConnectLogin();
    	if ($breezSessionData != 'invalid') {
    		$slotData = $this->AvailableSlots->getSlotData(true, 'events');
	    	if (!empty($slotData)) {
	    		foreach($slotData as $sData) {
	    			$timeArr = explode(' ', $sData['AvailableSlots']['slot_time']);
	    			$endMeetingTime = strtotime($timeArr[3].' '.$timeArr[4]);
	    			$currentTime = strtotime(date('h:i A'));
	    			if($currentTime > $endMeetingTime){
	    				$adobeMeetingId = $sData['AvailableSlots']['adobe_type_id'];
    					$eventMembers = $this->EventParticipant->getEventMembers($sData['AvailableSlots']['type_id']);
	    				if (!empty($eventMembers)) {
	    					$allUnAlloted = 0;
	    					foreach ($eventMembers as $info){
	    						if (!empty($info['EventParticipant']['adobe_allocated'])) {
	    							$callBackData = $this->Adobeconnect->addRemoveUserToMeeting($info, $adobeMeetingId, $breezSessionData, 'remove');
				                    if ($callBackData['status']['@attributes']['code'] == 'ok') {
				                    	$this->EventParticipant->id = $this->Encryption->decode($info['EventParticipant']['id']);
			                    		$this->EventParticipant->saveField('adobe_allocated',0);
				                    } else {
				                    	$allUnAlloted++;
				                    }
	    						}
	    					}
	    					if ($allUnAlloted == 0) {
	    						$this->AvailableSlots->id = $this->Encryption->decode($sData['AvailableSlots']['id']);
	    						$this->AvailableSlots->saveField('is_active', 0);
	    						$this->AvailableSlots->saveField('is_started', 0);
	    						$this->Event->id = $this->Encryption->decode($info['Event']['id']);
	                    		$this->Event->saveField('event_completed',1);
	    					}
	    				}
	    			}
	    		}
	    	}
    	}
    }

    /**
     *function used to remove adobe completed events from adobe account
     *@author Mystery Man
     **/
    public function removeAdobeCompletedEvents()
    {
    	$eventData = $this->Event->find('all',array('conditions'=>array('Event.event_completed'=>1)));
    	if(!empty($eventData)){
    		$breezSessionData = $this->Adobeconnect->adobeConnectLogin();
    		if($breezSessionData != 'invalid'){
    			foreach($eventData as $data){
    				$slotData = $this->AvailableSlots->getSlotDataByGroup($this->Encryption->decode($data['Event']['id']), 'events');
    				//pr($slotData);die;
    				$this->Adobeconnect->removeMeeting($slotData['AvailableSlots']['adobe_type_id'],$breezSessionData);
		    		$this->AvailableSlots->delete($this->Encryption->decode($slotData['AvailableSlots']['id']));
    			}
    		}
    	}
    }

    /**
    *run cron every 10 minute to send reminder event mail before two hours of event start.
    *@author Mystery Man
    */
    public function eventReminderMail()
    {
		$emailLib = new Email();
		$slotData = $this->AvailableSlots->getSlotData(false,'events');
    	if (!empty($slotData)) {
    		foreach ($slotData as $sData) {
    			$timeArr = explode(' ', $sData['AvailableSlots']['slot_time']);
    			$actualMeetingTime = strtotime($timeArr[0].' '.$timeArr[1]);
    			$timeBefore = strtotime(date('h:i A', strtotime('-2 hours', strtotime($timeArr[0].' '.$timeArr[1]))));
    			$currentTime = strtotime(date('h:i A'));
    			if ($currentTime > $timeBefore && $currentTime < $actualMeetingTime) {
    				$eventMembers = $this->EventParticipant->getEventMembers($sData['AvailableSlots']['type_id']);
    				if (!empty($eventMembers)) {
    					if (empty($info['User']['adobe_mail_sent'])) {
	    					foreach ($eventMembers as $info) {
								$to = $info['BusinessOwner']['email'];
			                    $subject = 'Unique: Event Reminder';
			                    $template ='eventReminderMail';
			                    $fullName = $info['BusinessOwner']['fname'].' '.$info['BusinessOwner']['lname'];
	                			$url = Configure::read('SITE_URL') . 'events/start';
			                    $variable = array('name' => $fullName, 'url' => $url);
			                    $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
			                    if( $mailForm  && !empty($mailForm) ) {
			                    	$variable = array_merge($variable, $mailForm);
			                    }
			                    $success = $emailLib->sendEmail($to, $subject, $variable, $template, 'both');
			                    if ($success) {
			                    	$this->User->id = $info['BusinessOwner']['user_id'];
			                    	$this->User->saveField('adobe_mail_sent',1);
			                    }
	    					}
	    				}
    				}
    			}
    		}
    	}
    }

    /**
	*function used to register guest on adobe before 1 hour of meeting start
	* Crons runs on every 5 minutes
	*@author Mystery Man
	**/

    public function registerGuestToAdobe()
    {
    	$slotData = $this->AvailableSlots->getSlotData(false,'meetings');
    	if (!empty($slotData)) {
    		$breezSessionData = $this->Adobeconnect->adobeConnectLogin();
    		foreach ($slotData as $sData) {
    			$timeArr = explode(' ', $sData['AvailableSlots']['slot_time']);
    			$actualMeetingTime = strtotime($timeArr[0].' '.$timeArr[1]);
    			$timeBefore = strtotime(date('h:i A', strtotime('-1 hour', strtotime($timeArr[0].' '.$timeArr[1]))));
    			$currentTime = strtotime(date('h:i A'));
    			//if($currentTime >= $timeBefore && $currentTime < $actualMeetingTime){
    				$adobeMeetingId = $sData['AvailableSlots']['adobe_type_id'];
					$invitedGuest = $this->InviteGuest->find('all',array('conditions'=>array('InviteGuest.inviter_group_id'=>$sData['AvailableSlots']['type_id'])));
					//pr($invitedGuest);die;
    				if (!empty($invitedGuest)) {
							if($breezSessionData != 'invalid'){
								foreach($invitedGuest as $guests){
	    						if(empty($guests['InviteGuest']['invitee_principal_id'])){

	    							//Create User in Adobe Connect panel
		    	                    $adobePass = substr($guests['InviteGuest']['invitee_password'],0,20);
		    	                    $params = array(
		                    			"action" => "principal-update",
										"first-name" => ucwords(strtolower($guests['InviteGuest']['invitee_fname'])),
										"last-name" => ucwords(strtolower($guests['InviteGuest']['invitee_lname'])),
										"login" => $guests['InviteGuest']['invitee_email'],
										"password" => $adobePass,
										"type" => "user",
										"has-children" => "0",
										"email" => $guests['InviteGuest']['invitee_email']
									);
		    	                    $curlResponse = $this->Adobeconnect->createUser($params,$breezSessionData);
		    	                    if($curlResponse['status']['@attributes']['code'] == 'ok'){		    	                    	
		    	                    	$this->InviteGuest->id = $this->Encryption->decode($guests['InviteGuest']['id']);
		    	                    	$this->InviteGuest->saveField('invitee_principal_id',$curlResponse['principal']['@attributes']['principal-id']);
		    	                    }		    	                    
		    	                    //Create User in Adobe Connect panel ends

	    						} 
							}    					   						
    					}
    				}
    			}
    		//}
    	}
    }

    /**
    *run cron every 10 minute to send meeting link to guest before 30 min of meeting start.
    *@author Mystery Man
    */
    public function meetingMailToGuest()
    {
    	$emailLib = new Email();
    	$slotData = $this->AvailableSlots->getSlotData(false,'meetings');
    	if (!empty($slotData)) {
    		foreach ($slotData as $sData) {
    			$timeArr = explode(' ', $sData['AvailableSlots']['slot_time']);
    			$actualMeetingTime = strtotime($timeArr[0].' '.$timeArr[1]);
    			$timeBefore = strtotime(date('h:i A', strtotime('-30 minutes', strtotime($timeArr[0].' '.$timeArr[1]))));
    			$currentTime = strtotime(date('h:i A'));
    			//if($currentTime >= $timeBefore && $currentTime < $actualMeetingTime){
    				$adobeMeetingId = $sData['AvailableSlots']['adobe_type_id'];
					$invitedGuest = $this->InviteGuest->find('all',array('conditions'=>array('InviteGuest.inviter_group_id'=>$sData['AvailableSlots']['type_id'])));
					//pr($invitedGuest);die;
    				if (!empty($invitedGuest)) {
						foreach($invitedGuest as $guests){
							if(empty($guests['InviteGuest']['is_mailed']) && !empty($guests['InviteGuest']['invitee_principal_id'])){
								$to = $guests['InviteGuest']['invitee_email'];
			                    $subject = 'Unique: Join the Group Meeting';
			                    $fullName = $guests['InviteGuest']['invitee_fname'].' '.$guests['InviteGuest']['invitee_lname'];
			                    $template ='guestMeetingMail';
			                    $groupId = $this->Encryption->encode($guests['InviteGuest']['inviter_group_id']);
			                    $userEmail = $this->Encryption->encode($guests['InviteGuest']['invitee_email']);
	                			$url = Configure::read('SITE_URL') . 'meetings/guest/'.$groupId.'/'.$userEmail;
			                    $variable = array('name' => $fullName, 'url' => $url);
			                    $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
			                    if( $mailForm  && !empty($mailForm) ) {
			                    	$variable = array_merge($variable, $mailForm);
			                    }
			                    $success = $emailLib->sendEmail($to, $subject, $variable, $template, 'both');
			                    if ($success) {
			                    	$this->InviteGuest->id = $this->Encryption->decode($guests['InviteGuest']['id']);
			                    	$this->InviteGuest->saveField('is_mailed',1);
			                    }
    						} 
						}
    				}
    			}
    		//}
    	}
    }
    /*public function meetingReminder()
    {
    	//echo date('h:i:s A');
		$emailLib = new Email();    	
    	$breezSessionData = $this->Adobeconnect->adobeConnectLogin();
    	if($breezSessionData != 'invalid') {
    		$slotData = $this->AvailableSlots->getSlotData();
	    	if(!empty($slotData)) {
	    		foreach($slotData as $sData) {
	    			$timeArr = explode(' ', $sData['AvailableSlots']['slot_time']);
	    			$actialMeetingTime = strtotime($timeArr[0].' '.$timeArr[1]);
	    			$timeBefore = strtotime(date('h:i A',strtotime('-2 hours',strtotime($timeArr[0].' '.$timeArr[1]))));
	    			$currentTime = strtotime(date('h:i A'));
	    			if($currentTime > $timeBefore && $currentTime < $actialMeetingTime){
	    				$adobeMeetingId = $sData['AvailableSlots']['adobe_group_id'];
	    				$groupMembers = $this->BusinessOwner->getGroupMembers($this->Encryption->encode($sData['AvailableSlots']['group_id']));
	    				if(!empty($groupMembers)) {
	    					foreach($groupMembers as $info){
	    						$callBackData = $this->Adobeconnect->addRemoveUserToMeeting($info,$adobeMeetingId,$breezSessionData);
			                    $to = $info['BusinessOwner']['email'];
			                    $subject = 'Unique: Meeting Link';
			                    $template ='meeting';
			                    $fullName = $info['BusinessOwner']['member_name'];
                    			$url = Configure::read('SITE_URL') . 'meetings';
			                    $variable = array('name'=>$fullName, 'url'=>$url);
			                    $success = $emailLib->sendEmail($to, $subject, $variable, $template, 'both');
	    					}
	    					$this->AvailableSlots->id = $this->Encryption->decode($sData['AvailableSlots']['id']);
	    					$this->AvailableSlots->saveField('is_active', 1);
	    				}
	    			}
	    		}
	    	}
    	}
    }*/
    
    /**
     * function to send email notification for the expiring credit cards
     * @author Mystery Man
     */
    public function ccExpireNotification()
    {
        $curMonth = date("M y");
        $emailLib = new Email();
        $conditions = array('MONTH(CreditCard.expiry_notify_date)' => date('n', strtotime($curMonth)),  'YEAR(CreditCard.expiry_notify_date)' => date('Y', strtotime($curMonth)));
        $notifyData = $this->CreditCard->find('all', array('conditions' => $conditions));
        if (!empty($notifyData)) {
            $i = 0;
            foreach ($notifyData as $row) {
                $to = $row['BusinessOwner']['email'];
                $subject = 'Unique: Credit Card Expiry Notification';
                $template ='cc_expiry_notify';
                $fullName = $row['BusinessOwner']['fname'].' '.$row['BusinessOwner']['lname'];
                $variable = array('credit_card_number' => $this->Encryption->decode($row['BusinessOwner']['credit_card_number']), 'fullName' => $fullName);
                $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
                if( $mailForm  && !empty($mailForm) ) {
                	$variable = array_merge($variable, $mailForm);
                }
                $emailLib->sendEmail($to, $subject, $variable, $template, 'both');
                $i++;
            }
            echo $i.' Users notified successfully';
            exit;
        }
    }
    
    /**
     * function to cancel membership for the declined TX
     * @author Mystery Man
     */
    public function cancelUserAfterDeclinedTx()
    {
        require_once (ROOT.DS.APP_DIR.DS.'Plugin/authorizedotnet/AuthorizeNet.php');
        $conditions = array('User.declined_date !=' => NULL);
        $conditions[] = 'DATE(DATE_SUB(NOW(), INTERVAL 7 DAY)) >= date(User.declined_date)';
        $conditions['Subscription.is_active'] = 1;
        $usersData = $this->User->find('all', array('conditions' => $conditions));
        //pr($usersData);exit;
        if (!empty($usersData)) {
            foreach ($usersData as $userData) {
                $loginUserId = $this->Encryption->decode($userData['User']['id']);
                $fields = array('BusinessOwner.id','BusinessOwner.user_id,BusinessOwner.group_id,BusinessOwner.email,BusinessOwner.fname,BusinessOwner.lname,BusinessOwner.group_role', 'Group.total_member', 'Group.group_leader_id', 'Group.id', 'BusinessOwner.group_rank');
                $userGroups = $this->BusinessOwner->find('all', array(
                        'fields' => $fields,
                        'conditions'=>array('BusinessOwner.group_id' => $this->Encryption->decode($userData['Groups']['id']))));
                $request = new AuthorizeNetARB;
                $response = $request->cancelSubscription($userData['Subscription']['subscription_id']);
                if ($response->xml->messages->message->text == 'Successful.') {
                    $this->Subscription->updateAll(array('Subscription.is_active' => 0), array( 'Subscription.subscription_id' => $userData['Subscription']['subscription_id']));
                    $format = "both";
                    if ($userData['BusinessOwners']['group_rank'] < $userData['Groups']['total_member']) {
                        $updateMemberRank = $this->updateMemberRank($userData['Groups']['id'], $userData['BusinessOwners']['group_rank'], $loginUserId);
                    }
                    //cancel user
                    $cancelUser = $this->cancelUser($loginUserId);
                    if ($userData['BusinessOwners']['group_role'] == 'participant') {
                        $check = $this->participantCancelPlan($userData, $format);
                    } else if ($userData['BusinessOwners']['group_role'] == 'co-leader') {
                        $check = $this->coLeaderCancelPlan($userGroups, $format, $loginUserId);
                    } else {
                        $check = $this->leaderCancelPlan($userGroups, $format, $loginUserId);
                    }
                }
            }
        }        
    }
    
    /**
     * function used to check the adobe services
     * @author Mystery Man
     */
    /*public function check()
    {
    	$breezSessionData = $this->Adobeconnect->adobeConnectLogin();
    	$d = $this->Adobeconnect->checkService($breezSessionData);
    	pr($d);die;
    }*/
    
    /**
     * function send mails for the tasks scheduled for today
     * @author Mystery Man
     */
    public function taskScheduleMailer()
    {
        $conditions = array('DAY(Task.event_date)'=>date('d'), 'MONTH(Task.event_date)'=>date('n'), 'Task.is_notified'=>0);
        $todaysTasks = $this->Task->find('all',array('conditions'=>$conditions));
        if (!empty($todaysTasks)) {
            $emailLib = new Email();
            $subject = "Unique: Task Scheduled for Today";
            $template = "task_scheduled";
            $format = "both";
            $i=0;
            foreach ($todaysTasks as $task) {
                $business_owner_name = $task['BusinessOwner']['fname']." ".$task['BusinessOwner']['lname'];
                $variable = array('username' => $business_owner_name,
                    'task_name'=>$task['Task']['name'],
                    'task_date'=>date('m-d-Y, h:i A', strtotime($task['Task']['event_date'])),
                    'url' => Router::url(array('controller'=>'events', 'action'=>'tasks'), true)
                );
                $to = $task['BusinessOwner']['email'];
                $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail007'));
                if( $mailForm  && !empty($mailForm) ) {
                	$variable = array_merge($variable, $mailForm);
                }
                if($emailLib->sendEmail($to, $subject, $variable, $template, $format)) {
                    $this->Task->id = $this->Encryption->decode($task['Task']['id']);
                    $this->Task->saveField('is_notified', 1);
                }
                $i++;
            }
            echo $i.' Users Notified';
        } else {
            echo 'No events Scheduled for today';
        }
    }

    /**
     * function used to update the referral amount for payout wallet once in 24 hours
     * @author Mystery Man
     */
    public function updateReferralAmount()
    {
        $paypalUsers = $this->PaypalDetail->find('all', array('fields' => array('PaypalDetail.id', 'PaypalDetail.user_id', 'PaypalDetail.total_amount')));
        if (!empty($paypalUsers)) {
            foreach ($paypalUsers as $user) {
                $amount = $this->InvitePartner->find('all', array('conditions' => array('InvitePartner.status' => array('active', 'inactive'), 'InvitePartner.inviter_userid' => $user['PaypalDetail']['user_id'])));
                $totalAmt = 0;
                foreach ($amount as $amt) {
                    $totalAmt = $totalAmt + $amt['InvitePartner']['referral_amount'];
                }
                if ($totalAmt != $user['PaypalDetail']['total_amount']) {
                    $this->PaypalDetail->id = $this->Encryption->decode($user['PaypalDetail']['id']);
                    $this->PaypalDetail->saveField('total_amount', $totalAmt);
                }
            }
        }
    }

    /**
     * function used to update the referral amount for invite partners once in 24 hours
     * @author Mystery Man
     */
    public function updateInvitePartnerAmount()
    {
        $date = date('Y-m-d', strtotime('-30 days', strtotime(date('Y-m-d'))));
        $conditions = array('InvitePartner.status' => 'active', 'InvitePartner.last_updated_date' => $date);
        $partnersData = $this->InvitePartner->find('all', array('conditions' => $conditions));
        foreach ($partnersData as $partners) {
            $data['last_updated_date'] = date('Y-m-d');
            $data['referral_amount'] = $partners['InvitePartner']['referral_amount'] + Configure::read('REFERRAL_AMOUNT');
            $this->InvitePartner->id = $this->Encryption->decode($partners['InvitePartner']['id']);
            $this->InvitePartner->save($data);
        }
   }



    public function updateBatchStatus()
	{
        require_once (ROOT.DS.APP_DIR.DS.'Plugin/PayPalLogin/PayPal-PHP-SDK/paypal/rest-api-sdk-php/sample/bootstrap.php');
        $fields = array('DISTINCT PaypalPayoutStatus.batch_id');
        $statusData = $this->PaypalPayoutStatus->find('all', array('conditions' => array('PaypalPayoutStatus.status' => 'pending'), 'fields' => $fields));
        if (!empty($statusData)) {
            foreach ($statusData as $data) {
                $batch_id = $data['PaypalPayoutStatus']['batch_id'];
                try {
                    $output = \PayPal\Api\Payout::get($batch_id, $apiContext);
                    $outData = json_decode($output);
                    if (!empty($outData->items)) {
                    	foreach ($outData->items as $payouts) {
                    		if ($payouts->transaction_status == "SUCCESS") {
                    			$payoutEmail = $payouts->payout_item->receiver;
                    			$payoutGetUser = explode('-', $payouts->payout_item->sender_item_id);
                    			$payoutUserId = $payoutGetUser[1];
                    			$conditions = array('PaypalPayoutStatus.batch_id' => $batch_id, 'PaypalDetail.user_id' => $payoutUserId, 'PaypalDetail.paypal_email' => $payoutEmail);
                    			$paypalStatusId = $this->PaypalPayoutStatus->find('first', array('conditions' => $conditions, 'fields' => array('PaypalPayoutStatus.id')));
                    			if (!empty($paypalStatusId)) {
                    				$this->PaypalPayoutStatus->id = $this->Encryption->decode($paypalStatusId['PaypalPayoutStatus']['id']);
                    				$this->PaypalPayoutStatus->saveField('status', 'paid');
                    			}
                    		}
                    	}
                    }
                } catch (Exception $ex) {
                    ResultPrinter::printError("Get Payout Batch Status", "PayoutBatch", null, $payoutBatchId, $ex); exit(1);
                }
            }
        }
	}

    /**
     *function used to send mail to the users who has not activated their mail
     *@author Mystery Man
     */
    public function mailtoInactiveUser()
    {
        $fields = array('User.username', 'BusinessOwner.fname', 'BusinessOwner.lname');
        $userList = $this->User->find('all', array('conditions' => array('User.is_active' => 0), 'fields' => $fields));
        if (!empty($userList)) {
            $emailLib = new Email();
            foreach ($userList as $users) {
                $subject = "Unique: Watch Training Video";
                $template = "training_video_reminder";
                $format = "both";
                $to = $users['User']['username'];
                $emailLib->sendEmail($to, $subject, array('username' => $users['BusinessOwner']['fname'].' '.$users['BusinessOwner']['lname']), $template, $format);
            }
        }
    }
}