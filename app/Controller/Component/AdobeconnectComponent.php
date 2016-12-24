<?php
/** 
 * Adobe Connect Component
 * Component having functions adobe connect api call
 * Developer - Mystery Man
 */

class AdobeconnectComponent extends Component
{
	public $components = array('Session','Common');
    function adobeConnectLogin($userEmail = NULL,$userPass = NULL)
    {
    	if(!empty($userEmail) && !empty($userPass)) {
    		$email = $userEmail;
    		$password = $userPass;
    	} else {
			$this->AdobeconnectCredential = ClassRegistry::init('AdobeconnectCredential');
		    $adobeCredential = $this->AdobeconnectCredential->find('first');
		    App::uses('Encryption', 'Controller/Component');
		    $this->Encryption = new EncryptionComponent(new ComponentCollection());
		    $email = $adobeCredential['AdobeconnectCredential']['adobe_email'];
		    $password = $this->Encryption->decode($adobeCredential['AdobeconnectCredential']['adobe_password']);
    	}
		$params = array(
			"action" => "login",
			"login" => $email,
			"password" => $password,
		);
		$checkLogin = $this->curlExecute($params);
		if($checkLogin['status']['@attributes']['code'] == 'ok'){
			$breezSessionCookie = $this->curlExecute($params,NULL,true);
			return $breezSessionCookie;
		}else if($checkLogin == 'invalid'){
			return 'invalid';
		} else {
			return 'invalid';
		}
    }
    
    function curlExecute($params,$breezSession = '',$header = false)
    {
    	$postData = '';
		foreach($params as $k => $v) 
		{ 
			$postData .= $k . '='.$v.'&';
		}
		rtrim($postData, '&');

    	$ch = curl_init();  
		curl_setopt($ch,CURLOPT_URL,Configure::read('ADOBECONNECTURL'));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HEADER, $header);
		curl_setopt($ch, CURLOPT_POST, count($postData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		if($breezSession != '') {
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: ".$breezSession." "));
		}
		$output=curl_exec($ch);
		if($header == false) {
			if(!empty($output)){
				$xml = new SimpleXMLElement($output);
				$json = json_encode($xml);
				$data = json_decode($json,TRUE);
				return $data;
			} else {
				return 'invalid';
			}
			
		} else {
			$header_text = substr($output, 0, strpos($output, "\r\n\r\n"));
			foreach (explode("\r\n", $header_text) as $i => $line)
			if ($i === 0)
			    $headers['http_code'] = $line;
			else
			{
			    list ($key, $value) = explode(': ', $line);

			    $headers[$key] = $value;
			}
			$breezSessionCookie = $headers['Set-Cookie'];
			$breezsessionarr = explode(';',$breezSessionCookie);
			return $breezsessionarr[0];
		}		
    }

    function createUser($params,$breezSession)
    {
		$createUser = $this->curlExecute($params,$breezSession);
		return $createUser;
    }

    /*function createGroupFolder($folderName,$breezSession)
    {
		$scoInfo = $this->getShortcuts($breezSession);
		$params = array(
					"action" => "sco-update",
					'type' => 'folder',
					'name' => $folderName,
					'url' => $folderName,
					'folder-id' => $scoInfo['shortcuts']['sco']['2']['@attributes']['sco-id']
				);
		return $this->curlExecute($params,$breezSession);
    }*/
	public function getShortcuts($breezSession) 
	{	
		$params = array("action" => "sco-shortcuts");
		return $this->curlExecute($params,$breezSession);
	}
	public function createMeeting($meetingName,$dateBegin,$dataEnd,$breezSession)
	{
		$socFolderInfo = $this->getShortcuts($breezSession);
		foreach($socFolderInfo['shortcuts']['sco'] as $folderInfo){
			if($folderInfo['@attributes']['type'] == 'user-meetings'){
				$folderId = $folderInfo['@attributes']['sco-id'];
			}
		}
		$params = array(
				'action' => 'sco-update',
				'type' => 'meeting',
				'name' => $meetingName,
				'folder-id' => $folderId,
				'date-begin' => $dateBegin,
				'date-end' => $dataEnd,
				'url-path' => $meetingName
			);
		$result = $this->curlExecute($params,$breezSession);
		$params = array(
						'action' => 'permissions-update',
						'acl-id' => $result['sco']['@attributes']['sco-id'],
						'principal-id' => 'public-access',
						'permission-id' => 'denied'
					);
		$this->curlExecute($params,$breezSession);
		return $result;
	}

	public function removeMeeting($scoid,$breezSession)
	{
		$params = array(
				'action' => 'sco-delete',
				'sco-id' => $scoid
			);
		return $this->curlExecute($params,$breezSession);
	}

	public function getHostGroupId($breezSession)
	{
		$params = array('action' => 'principal-list','filter-type' => 'live-admins');
		$data =  $this->curlExecute($params,$breezSession);
		return $data['principal-list']['principal']['@attributes']['principal-id'];
	}
	public function addRemoveUserToMeeting($info,$adobeMeetingId,$breezSession,$action)
	{
		$hostGroupId = $this->getHostGroupId($breezSession);
		if($action == 'add'){
			$userRole = $info['BusinessOwner']['group_role'];
			switch ($userRole ) {
				case 'leader':
					$permissionId = 'host';
					$params = array(
						'action' => 'group-membership-update',
						'group-id' => $hostGroupId,
						'principal-id' => $info['User']['principal_id'],
						'is-member' => true 
					);
					$this->curlExecute($params,$breezSession);
				break;

				case 'co-leader':
					$permissionId = 'mini-host';
				break;
				
				default:
					$permissionId = 'view';
				break;
			}
			$params = array(
						'action' => 'permissions-update',
						'acl-id' => $adobeMeetingId,
						'principal-id' => $info['User']['principal_id'],
						'permission-id' => $permissionId
					);
		} else if($action == 'remove') {
			$userRole = $info['BusinessOwner']['group_role'];
			switch ($userRole ) {
				case 'leader':
					$permissionId = 'host';
					$params = array(
						'action' => 'group-membership-update',
						'group-id' => $hostGroupId,
						'principal-id' => $info['User']['principal_id'],
						'is-member' => 0 
					);
					$this->curlExecute($params,$breezSession);
					$permissionId = 'remove';
				break;

				case 'co-leader':
					$permissionId = 'remove';
				break;
				
				default:
					$permissionId = 'remove';
				break;
			}
			$params = array(
						'action' => 'permissions-update',
						'acl-id' => $adobeMeetingId,
						'principal-id' => $info['User']['principal_id'],
						'permission-id' => $permissionId
					);
		}		
		$result = $this->curlExecute($params,$breezSession);
		return $result;
	}

	public function checkService($breezSession)
	{
		$params = array(
					'action' => 'principals-delete',
					'principal-id' => '1446245612',
					//'session' => $breezSession
				);
		/*$params = array(
					'action' => 'group-membership-update',
					'group-id' => '1331244919',
					'principal-id' => '1425850721',
					'is-member' => 0 
				);*/
		//to remove other members in meeting
		/*$params = array(
					'action' => 'permissions-update',
					'acl-id' => '1425905222',
					'principal-id' => '1425005694',
					'permission-id' => 'remove'
				);*/
		/*$params = array(
				'action' => 'principal-list',
				'filter-type' => 'live-admins'
			);*/
		$res = $this->curlExecute($params,$breezSession);
		pr($res);die;
	}

	public function initMeeting($meetingName,$dateBegin,$dataEnd,$breezSession)
	{
		$socFolderInfo = $this->getShortcuts($breezSession);
		$params = array(
				'action' => 'sco-update',
				'type' => 'meeting',
				'name' => $meetingName,
				'folder-id' => $socFolderInfo['shortcuts']['sco']['2']['@attributes']['sco-id'],
				'date-begin' => $dateBegin,
				'date-end' => $dataEnd,
				'url-path' => $meetingName
			);
		return $this->curlExecute($params,$breezSession);
	}
    function getSlotTimes($slots)
    {
    	$slotTimes = array(
            't1' => '12:00 AM - 01:30 AM',
            't2' => '12:30 AM - 02:00 AM',
            't3' => '01:00 AM - 02:30 AM',
            't4' => '01:30 AM - 03:00 AM',
            't5' => '02:00 AM - 03:30 AM',
            't6' => '02:30 AM - 04:00 AM',
            't7' => '03:00 AM - 04:30 AM',
            't8' => '03:30 AM - 05:00 AM',
            't9' => '04:00 AM - 05:30 AM',
            't10' => '04:30 AM - 06:00 AM',
            't11' => '05:00 AM - 06:30 AM',
            't12' => '05:30 AM - 07:00 AM',
            't13' => '06:00 AM - 07:30 AM',
            't14' => '06:30 AM - 08:00 AM',
            't15' => '07:00 AM - 08:30 AM',
            't16' => '07:30 AM - 09:00 AM',
            't17' => '08:00 AM - 09:30 AM',
            't18' => '08:30 AM - 10:00 AM',
            't19' => '09:00 AM - 10:30 AM',
            't20' => '09:30 AM - 11:00 AM',
            't21' => '10:00 AM - 11:30 AM',
            't22' => '10:30 AM - 12:00 PM',
            't23' => '11:00 AM - 12:30 PM',
            't24' => '11:30 AM - 01:00 PM',
            't25' => '12:00 PM - 01:30 PM',
            't26' => '12:30 PM - 02:00 PM',
            't27' => '01:00 PM - 02:30 PM',
            't28' => '01:30 PM - 03:00 PM',
            't29' => '02:00 PM - 03:30 PM',
            't30' => '02:30 PM - 04:00 PM',
            't31' => '03:00 PM - 04:30 PM',
            't32' => '03:30 PM - 05:00 PM',
            't33' => '04:00 PM - 05:30 PM',
            't34' => '04:30 PM - 06:00 PM',
            't35' => '05:00 PM - 06:30 PM',
            't36' => '05:30 PM - 07:00 PM',
            't37' => '06:00 PM - 07:30 PM',
            't38' => '06:30 PM - 08:00 PM',
            't39' => '07:00 PM - 08:30 PM',
            't40' => '07:30 PM - 09:00 PM',
            't41' => '08:00 PM - 09:30 PM',
            't42' => '08:30 PM - 10:00 PM',
            't43' => '09:00 PM - 10:30 PM',
            't44' => '09:30 PM - 11:00 PM',
            't45' => '10:00 PM - 11:30 PM',
            't46' => '10:30 PM - 12:00 AM',
            't47' => '11:00 PM - 12:30 AM',
            't48' => '11:30 PM - 01:00 AM',
            );
		return $slotTimes[$slots];
    }

    public function getFirstMeetingTime($slotId)
    {
    	$value = $this->getSlotTimes($slotId);
    	$startTime = explode(' ',$value);
    	return $startTime[0].' '. $startTime[1];
    }

    public function logoutAdobeConnect()
    {
    	$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,'https://foxhopr.adobeconnect.com/api/xml?action=logout');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$output=curl_exec($ch);		
		curl_close($ch);
		setcookie('BREEZESESSION', '', time()-300);
    }

    /**
     *function to check adobe connect Meeting time slot availability according to given date 
     * @param string $date selected date 
     *@author Mystery Man
     */
    public function checkAdobeConnectMeetingSlots($date,$type,$zone=NULL)
    {
    	if($this->Session->check('Auth.Front')){
    		$timeZone = $this->Session->read('Auth.Front.BusinessOwners.timezone_id');
    	} else {
    		$timeZone = $zone;
    	}
    	//echo $timeZone;die;
    	date_default_timezone_set($timeZone);
    	//$currentDateTime = $this->Common->getZoneCurrentTime($timeZone);
    	//echo date('Y-m-d h:i:s A',$currentDateTime);die;
        $this->AdobeConnectMeeting = ClassRegistry::init('AdobeConnectMeeting');
        $this->AvailableSlots = ClassRegistry::init('AvailableSlots');
        $range1  = strtotime(date('Y-m-d'));
		$range2  = strtotime(date('Y-m-d'). '+30days');

		$timeT1  = strtotime(date($date));
		$timeT2  = strtotime(date($date));
		$timeArray = array();
		$timeArray[] = date('Y-m-d', $timeT1);
		while($timeT1 > strtotime(date('Y-m-d'). '-30days')) {
			$timeT1 = strtotime((date('Y-m-d', $timeT1).' -14days'));
			if($timeT1 >= $range1){
				$timeArray[] = date('Y-m-d',$timeT1);
			}
		}
		while(strtotime(date('Y-m-d'). '+30days') > $timeT2) {
			$timeT2 = strtotime((date('Y-m-d', $timeT2).' +14days'));
			if($timeT2 <= $range2){
				$timeArray[] = date('Y-m-d',$timeT2);
			}
		}
		$data = $this->AdobeConnectMeeting->find('all',array('conditions'=>array('AdobeConnectMeeting.type'=>$type)));
		$availableSlots = array();
		foreach($data as $d) {
			$AdobeId = $d['AdobeConnectMeeting']['nmh'] % 4;
			switch ($AdobeId) {
				case 1:
				$slots = explode(',',Configure::read('SLOT_POSITION_FIRST'));
				foreach($slots as $position) {
					$usedSlots = $this->AvailableSlots->find('all',array('conditions'=>array(
																			'AvailableSlots.nmh'=>$d['AdobeConnectMeeting']['nmh'],
																			'AvailableSlots.slot_id'=>$position,
																			'AvailableSlots.date'=>$timeArray
																	)
																)
															);
					if(empty($usedSlots)){
						$availableSlots[][$d['AdobeConnectMeeting']['nmh']] = str_replace('t', '', $position);
					}
				}
				break;
				case 2:
				$slots = explode(',',Configure::read('SLOT_POSITION_SECOND'));
				foreach($slots as $position) {
					$usedSlots = $this->AvailableSlots->find('all',array('conditions'=>array(
																			'AvailableSlots.nmh'=>$d['AdobeConnectMeeting']['nmh'],
																			'AvailableSlots.slot_id'=>$position,
																			'AvailableSlots.date'=>$timeArray
																	)
																)
															);
					if(empty($usedSlots)){
						$availableSlots[][$d['AdobeConnectMeeting']['nmh']] = str_replace('t', '', $position);
					}
				}
				break;
				case 3:
				$slots = explode(',',Configure::read('SLOT_POSITION_THIRD'));
				foreach($slots as $position) {
					$usedSlots = $this->AvailableSlots->find('all',array('conditions'=>array(
																			'AvailableSlots.nmh'=>$d['AdobeConnectMeeting']['nmh'],
																			'AvailableSlots.slot_id'=>$position,
																			'AvailableSlots.date'=>$timeArray
																	)
																)
															);
					if(empty($usedSlots)){
						$availableSlots[][$d['AdobeConnectMeeting']['nmh']] = str_replace('t', '', $position);
					}
					
				}
				break;
				case 0:
				$slots = explode(',',Configure::read('SLOT_POSITION_FOURTH'));
				foreach($slots as $position) {
					$usedSlots = $this->AvailableSlots->find('all',array('conditions'=>array(
																			'AvailableSlots.nmh'=>$d['AdobeConnectMeeting']['nmh'],
																			'AvailableSlots.slot_id'=>$position,
																			'AvailableSlots.date'=>$timeArray
																	)
																)
															);
					if(empty($usedSlots)){
						$availableSlots[][$d['AdobeConnectMeeting']['nmh']] = str_replace('t', '', $position);
					}		    				
				}
				break;
			}
		}
		$slotArray = array();
     	$finalArray = array();
		foreach($availableSlots as $xVal) {
			foreach($xVal as $key => $value){					
				if(!in_array($value,$finalArray)){
					array_push($finalArray,$value);
					$timing = $this->getSlotTimes('t'.$value);
                    $keyMeetTime = $this->getFirstMeetingTime('t'.$value);
                    if (!((strtotime(date('Y/m/d')) == strtotime($date)) && (strtotime(date('H:i')) >= strtotime(date('H:i', strtotime($keyMeetTime)))))) {
    					$slotArray[$value] = $key.';'.$timing;
                    }
				}			     		
			}					
		}
		ksort($slotArray);
		$positionArray = array();
		foreach($slotArray as $x => $x_value) {
			$explodeData = explode(';',$x_value);
            App::uses('Encryption', 'Controller/Component');
            $this->Encryption = new EncryptionComponent(new ComponentCollection());
            //$this->OneTimer->getTime();
			$availSlot = $this->Encryption->encode($explodeData[0].':t'.$x);
	     	$positionArray[][$availSlot] = $explodeData[1];
		}
		if(!empty($positionArray)){
			date_default_timezone_set('UTC');
			return $positionArray;
		} else {
			return array();
		}
    }

    public function removePrincipalId($prinicipalId,$breezSession)
    {
    	$params = array(
					'action' => 'principals-delete',
					'principal-id' => $prinicipalId,
				);
		return $this->curlExecute($params,$breezSession);
    }

    public function adobeConnectLogout($breezSession)
    {
    	$params = array(
					'action' => 'logout',
					'session' => $breezSession,
				);
		return $this->curlExecute($params);
    }

    /**
     * function to update password in adobe connect
     * @params array $userInfo
     * @return array $txData
     * @author Mystery Man
     */
    public function adobeUpdatePassword($userInfo,$newPassword)
    {
        $breezSessionData = $this->adobeConnectLogin();
		if ($breezSessionData != 'invalid'){
			$adobePass = substr($newPassword,0,20);
            $params = array(
    			"action" => "user-update-pwd",
				"user-id" => $userInfo['User']['principal_id'],
				"password-old" => substr($userInfo['User']['password'],0,20),
				"password" => $adobePass,
				"password-verify" => $adobePass,
			);
            $curlResponse = $this->createUser($params,$breezSessionData);
            return $curlResponse;
		}
    }
}
