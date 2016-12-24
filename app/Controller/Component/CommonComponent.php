<?php

/**
 * This is a common component
 */
App::uses('Component', 'Controller');
class CommonComponent extends Component 
{
    /**
    * fetch list of all the countries
    * @return array of countries
    * @author Mystery Man
    */
    public function getAllCountries()
    {
        $model = ClassRegistry::init('Country');
        return $model->find('list', array(
                'fields' => array('Country.country_iso_code_2', 'Country.country_name'),
                'order' => array('Country.country_name = "United States"' => 'desc','Country.country_name' => 'asc')));
    }
    
    /**
     * To get list of states for a country
     * @param int $countryId country Code
     * @return Array of States
     * @author Mystery Man
     */      
    public function getStatesForCountry($countryId)
    {
        $model = ClassRegistry::init('State');
        return $model->find('list', array(
                'conditions' => array('State.country_code_char2' => $countryId),
                'fields' => array('State.state_subdivision_id', 'State.state_subdivision_name'),
                'order' => array('State.state_subdivision_name' => 'asc')));
    }

    /**
     * getCountryStateCity() function is used to fetch single state OR city name
     * @param int $condition (state id OR city id)
     * @return Array of States OR City OR Country Data
     * @author Mystery Man
     */      
    public function getCountryStateCity($conditions)
    {
        $model = ClassRegistry::init('Country');
        return $model->find('first', array(
                'conditions' => array('Country.location_id' => $conditions),
                'fields' => array('Country.location_id', 'Country.name')));
    }
    
    /**
     * List Professions
     * @return Array of all Profession
     * @author Laxmi Saini
     */
     
    public function getAllProfessions()
    {
        $model = ClassRegistry::init('Profession');
        return $model->find('list', array(
                'fields' => array('Profession.id', 'Profession.profession_name')));
    }
    
        
    /**
     * Get Latitude and Longitude From zip code
     * @param int $zipcode group zipcode
     * @return array $result3
     * @author Mystery Man
     */
    public function getLatLong($zipcode,$option=false)
    {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($zipcode) . "&sensor=false&key=AIzaSyBDLBccZR7OaTlaMRRCOjGVTVWCp16euJ8";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        if(!$option){
        	$result1[] = $result['results'][0];
	        //($result1[0]['address_components'][0]['types']);
	        $result2[] = $result1[0]['geometry'];
	        $result3[] = $result2[0]['location'];
	        return $result3[0];
        } else {
        	return $result;
        }
    }

    /**
     * Get timezone from latlong
     * @param int $latlong group latlong
     * @return array $result
     * @author Mystery Man
     */
    public function getTimeZone($latlong)
    {
    	$latlong = $latlong['lat'].','.$latlong['lng'];
        $url = "https://maps.googleapis.com/maps/api/timezone/json?location=". $latlong . "&timestamp=0&key=AIzaSyBDLBccZR7OaTlaMRRCOjGVTVWCp16euJ8";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        return $result;
    }

        
	/**
     * to get the counter of unread $entity
     * @param string $entity entity for which counter find
     * @param int $userId user id for which counter find
     * @return int $unreadCounter enitity unread counter
     * @author Jitendra Sharma
     */
    public function unreadCounter($entity=NULL,$userId=NULL)
    {
    	if($entity=='messages')
    		$model = ClassRegistry::init('MessageRecipient');
        if($entity=='referrals')
            $model = ClassRegistry::init('ReceivedReferral');
        if($entity=='events')
            $model = ClassRegistry::init('EventParticipant');
        if($entity=='reviews')
            $model = ClassRegistry::init('Review');
    	
    	if($userId!=NULL){
	    	// get the count of unread message
    		$model->recursive = 0;
            if($entity == 'referrals') {
                $unreadCounter = $model->find('count',array('conditions' => array('ReceivedReferral.to_user_id'=>$userId,'ReceivedReferral.is_archive'=>0,'ReceivedReferral.is_read'=>0)));
            } elseif($entity=='messages') {
                $unreadCounter = $model->find('count',array('conditions' => array('MessageRecipient.recipient_user_id'=>$userId,'MessageRecipient.is_archive'=>0,'MessageRecipient.is_read'=>0)));
            } elseif($entity=='events') {
                $unreadCounter = $model->find('count',array('conditions' => array('EventParticipant.participant_id'=>$userId,'EventParticipant.is_read'=>0, 'Event.event_completed' => 0)));
            }  elseif($entity=='reviews') {
                $unreadCounter = $model->find('count',array('conditions' => array('Review.user_id'=>$userId,'Review.is_read'=>0)));
            }
        }
        return $unreadCounter;
    }
    /**
     * To remove the session files uploded by dropzone
     * @author Mystery Man
     */
    public function clearDropzoneData()
    {
        if(CakeSession::check('referralsFiles') == true && CakeSession::read('referralsFiles')!='') {
            $sessionName = 'referralsFiles';
            $folderName = 'referrals';
        } else if(CakeSession::check('messagesFiles') == true && CakeSession::read('messagesFiles')!=''){
            $sessionName = 'messagesFiles';
            $folderName = 'messages';
        }
        if(!empty($sessionName)) {
            $tempFiles = explode(',',CakeSession::read($sessionName));
                foreach($tempFiles as $temp) {
                    if(!empty($temp)) {
                        $filepath = WWW_ROOT . 'files/'.$folderName.'/temp/' . $temp;
                        if(file_exists($filepath))
                        {
                          unlink($filepath);
                      }
                  }                    
              }            
        CakeSession::delete($sessionName);
      }        
    }
	
	/**
     * PUSH NOTIFICATION FOR IOS DEVICE
     * @param type $regId is device_token
     * @param type $message is messge to be sent
     * @param type $pnType is type of service
     * @param type $requestedData id data to be sent
     * @author Mystery Man
     */
    function iospushnotification ($regId, $message, $pnType, $requestedData) {
        $pempath = WWW_ROOT.'files/ck.pem';
        // Put your private key's passphrase here:
        $passphrase = 'pass1';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $pempath);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        // Open a connection to the APNS server
        $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        // Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );
        $body['pn_type'] = $pnType;
        $body['requested_data'] = $requestedData;
        // Encode the payload as JSON
        $payload = json_encode($body);
        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $regId) . pack('n', strlen($payload)) . $payload;
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        if (!$result) {
            return 0 ; //Message not delivered;
        } else {
            return 1 ; //Message successfully delivered
        }
        // Close the connection to the server
        fclose($fp);
    }

    /**
     * PUSH NOTIFICATION FOR ANDROID DEVICE
     * @param type $regId is device_token
     * @param type $message is messge to be sent
     * @param type $pnType is type of service
     * @param type $requestedData id data to be sent
     * @author Mystery Man
     */
    function androidpushnotification ($regId, $message, $pnType, $requestedData) {
        $fields = array(
            'registration_ids' => array($regId),
            'data' => array("message" => $message, "pn_type" => $pnType, "requested_data" => $requestedData),
        );
        $headers = array(
//            'Authorization: key=AIzaSyB3Y_nDVk1isAv94miFvThkMXLrZsQpmG4',
			'Authorization: key=AIzaSyDqmXox5F3D5DwBXdrLrfPzKHGYLDRLKUI',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        } else {
            return 1;
        }
        curl_close($ch);
    }

    /**
     * To get the the file name
     * @param string $fileName File Name
     * @author Mystery Man
     */
    public function getFileName($fileName)
    {
        $fileUploadName = date('his').uniqid().str_replace(' ','_',$fileName);
        return $fileUploadName;
    }
     /**
    * fetch list of all the countries
    * @return array of countries
    * @author Mystery Man
    */
    public function getCountries($name)
    {
        $model = ClassRegistry::init('Country');
        return $model->find('all', array(
                'conditions' => array('Country.country_name LIKE' => trim($name).'%'),
                'fields' => array('Country.country_iso_code_2', 'Country.country_name'),
                'order' => array('Country.country_name' => 'asc')));

    }

    /**
    * fetch list of all the countries
    * @return array of countries
    * @author Mystery Man
    */
    public function getStates($country,$state)
    {
        $model = ClassRegistry::init('Country');
        $countryId = $model->find('first', array('conditions' => array('Country.country_name' => trim($country)),
                                                'fields' => array('Country.country_iso_code_2')));
        if(!empty($countryId)) {
            $cid = $countryId['Country']['country_iso_code_2'];
        } else {
            $cid = 'null';
        }
        $model = ClassRegistry::init('State');
        $condition1 = array('State.country_code_char2' => $cid);
        $condition2['OR'] = array(
                                "State.state_subdivision_name LIKE" => "%" . $state . "%",
                                "State.state_abbreviation LIKE" => "%" . $state . "%"
                            );
        $condition = array_merge($condition1, $condition2);
        return $model->find('all', array(
                'conditions' => $condition,
                'fields' => array('State.state_subdivision_id', 'State.state_subdivision_name'),
                'order' => array('State.state_subdivision_name' => 'asc')));
    }

    /**
     * Function to check twitter connected and post tweets
     * @return bool 
     * @author Mystery Man
     * 
     */
    public function twitterCheckNPost($userData,$notification,$message)
    {
        if( isset($userData['BusinessOwners']['notifications_enabled']) ) {
            $twitterConfig = explode(',',$userData['BusinessOwners']['notifications_enabled']);
            if(!empty($twitterConfig) && in_array($notification,$twitterConfig)) {
                require_once (ROOT.DS.APP_DIR.DS.'Plugin/twitteroauth/twitteroauth.php');
                $consumer_key = Configure::read('twitter_consumer_key');
                $consumer_secret = Configure::read('twitter_consumer_secret');
                $oauth_token = $userData['User']['twitter_oauth_token'];
                $oauth_token_secret = $userData['User']['twitter_oauth_token_secret'];
                $connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token,$oauth_token_secret);
                $sent = $connection->post('statuses/update', array('status' => $message));
            }
        }
    }
    /**
     * Function to get Current account active date
     * @return datetime
     * @author Mystery Man
     *
     */
    
    public function getCurrentActiveDate($user_id)
    {
        $userModel = ClassRegistry::init('User');
        $subscrip = ClassRegistry::init('Subscription');
        $conditions = array(
            'User.id' => $user_id,
            'User.reactivate' => 1,
        );
        $return=NULL;
        if ( $userModel->hasAny($conditions) ) {
            $date = $subscrip->find('first',array('conditions'=>array('Subscription.is_active'=>1,'Subscription.user_id'=>$user_id)));
            $return = $date['Subscription']['created'];
        } else {
           $userData = $userModel->findById($user_id);
           $return = $userData['User']['created'];           
        }
        return $return;
    }

    public function groupTimeConversion($dateTime,$groupZone,$userZone)
    {
    	/*echo $dateTime;
    	echo '<br>';
    	echo $groupZone;
    	echo '<br>';
    	echo $userZone;*/

    	$dateTimeArr = explode(' ', $dateTime);
    	$dataArray = explode('-', $dateTimeArr[0]);
    	$newConvertedDate = $dataArray[1].'/'.$dataArray[2].'/'.$dataArray[0].' '.$dateTimeArr[1];
    	//pr($newConvertedDate);die;
    	/*echo $dateTime.':00';
    	echo '<br>';*/
    	//echo '<br>'.$userZone;die;
    	//date_default_timezone_set('Asia/Calcutta');
    	/*echo date_default_timezone_get();
    	$dateTimeStamp = strtotime($dateTime);
    	$t = strtotime(date('m/d/y H:i:s',$dateTimeStamp));
    	echo 'in UTC : ' . date('Y-m-d h:i:s A',$t).'<br>';
    	$time = CakeTime::convert($t, new DateTimeZone('Europe/London'));
    	echo 'in BTC : ' . date('Y-m-d h:i:s A',$time).'<br>';
    	$time2 = CakeTime::convert($time, new DateTimeZone('Asia/Calcutta'));
    	echo date('Y-m-d h:i:s A',$time2);die;*/


    	$triggerOn = $newConvertedDate;

		//echo $triggerOn; // echoes 04/01/2013 03:08 PM
		//echo '<br>';
		$schedule_date = new DateTime($triggerOn, new DateTimeZone($groupZone) );
		$schedule_date->setTimeZone(new DateTimeZone($userZone));
		$newTime =  $schedule_date->format('Y-m-d h:i:s A');
		$newTime = strtotime($newTime);
		//echo '<br>';
		//echo $triggerOn; // echoes 2013-04-01 22:08:00
		//die;

    	//$newTime =  CakeTime::convert($dateTimeStamp, new DateTimeZone('Asia/Calcutta'));
    	//$newTime =  CakeTime::convert($dateTimeStamp, new DateTimeZone($userZone));
    	//date_default_timezone_set('UTC');
    	//echo date('Y-m-d h:i:s A',$newTime);die;
    	return $newTime;
    }
    public function userTimeConversion($toZone,$dateTime,$fromZone=NULL)
    {
    	/*echo $userZone;
    	echo '<pre>';
    	echo $dateTime;
    	echo '<pre>';
    	echo $groupZone;die;*/
    	if($fromZone){
    		//$dateTime =  CakeTime::convert(strtotime($dateTime), new DateTimeZone($toZone));
    		//$dateTime = date('Y-m-d h:i:s A',$dateTime);
    		$schedule_date = new DateTime($dateTime, new DateTimeZone($fromZone) );
			$schedule_date->setTimeZone(new DateTimeZone($toZone));
			$newTime =  $schedule_date->format('Y-m-d h:i:s A');
			$newTime = strtotime($newTime);
			return $newTime;
    	} else {
    		$dateTimeStamp = strtotime($dateTime);
    		$newTime =  CakeTime::convert($dateTimeStamp, new DateTimeZone($toZone));
    		return $newTime;
    	}
    	
    }
    public function getZoneCurrentTime($zone)
    {
    	$currentTime =  CakeTime::convert(time(), new DateTimeZone($zone));
    	return $currentTime;
    }
    public function timeMachine($dateTime,$format=NULL,$timeBefore=NULL)
    {
    	$dateTime = (is_numeric($dateTime)) ? date('Y-m-d H:i:s',$dateTime) : $dateTime;
    	if(!$timeBefore){
    		if(!$format){
    			return strtotime($dateTime);
	    	} else {
	    		return date($format,strtotime($dateTime));
	    	}
    	} else {
    		if(!$format){    			
    			return strtotime($timeBefore,strtotime($dateTime));
	    	} else {
	    		return date($format,strtotime($timeBefore,strtotime($dateTime)));
	    	}
    	}    	
    }
    public function getMeetingZone($groupId)
    {
    	$group = ClassRegistry::init('Group');
    	$meetingZone = $group->findById($groupId,array('fields'=>'Group.timezone_id'));
    	return $meetingZone['Group']['timezone_id'];
    }
    public function getEventZone($eventId)
    {
    	$event = ClassRegistry::init('Event');
    	$event->bindModel(array('hasOne' => array(
										'Group' => array(
                                        'foreignKey' => false,
                                        'fields'=>'Group.timezone_id',
                                        'conditions' => array('Event.group_id = Group.id')
                                        ))));
    	$eventZone = $event->findById($eventId);
    	return $eventZone['Group']['timezone_id'];
    }
    
    public function readCache($key)
    {
    	return Cache::read($key,'timezone_cache');
    }
    
    public function writeCache($key, $data)
    {
    	 return Cache::write($key, $data, 'timezone_cache');
    }
}
