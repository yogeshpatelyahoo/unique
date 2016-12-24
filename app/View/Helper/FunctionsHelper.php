<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('Functions', 'Controller/Component');
App::uses('CakeTime', 'Utility');
class FunctionsHelper extends AppHelper 
{
    
    public function encrypt($string)
    {
        $collection = new ComponentCollection();
        $obj=new FunctionsComponent($collection);
        return $obj->encrypt($string);
    }
    
    public function formatURL($url=null) 
    {
        $return = $url;
        if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }
        return $return;
    }

    public function dateTime($string,$timeZone=false,$firstConversion=false)
    {
    	//echo $timeZone.'-----'.$string.'-------'.$firstConversion;die;
    	//$triggerOn = '04/01/2013 03:00 PM';
    	/*$triggerOn = $string;
$user_tz = 'America/Vancouver';

echo $triggerOn; // echoes 04/01/2013 03:08 PM
echo '<br>';
$schedule_date = new DateTime($triggerOn, new DateTimeZone($user_tz) );
$schedule_date->setTimeZone(new DateTimeZone('Asia/Calcutta'));
$triggerOn =  $schedule_date->format('Y-m-d H:i:s');

echo $triggerOn; // echoes 2013-04-01 22:08:00



die;*/




    	if($timeZone){
    		$collection = new ComponentCollection();
        	$obj = new CommonComponent($collection);
        	if($firstConversion){
        		$string = $obj->userTimeConversion($timeZone,$string,$firstConversion);
        	} else {
        		$string = $obj->userTimeConversion($timeZone,$string);
        	}
    	}
        return $string;
    }
    public function getZoneCurrentTime($zone)
    {
    	$collection = new ComponentCollection();
    	$obj = new CommonComponent($collection);
    	$currentTime =  $obj->getZoneCurrentTime($zone);
    	return $currentTime;
    }
    public function groupTimeConversion($dateTime,$groupZone,$userZone)
    {
    	$collection = new ComponentCollection();
    	$obj = new CommonComponent($collection);
    	$groupTime =  $obj->groupTimeConversion($dateTime,$groupZone,$userZone);
    	return $groupTime;
    }

    public function getUserInfo($userId)
    {
    	App::import("Model", "User");  
		$model = new User();  
		$result = $model->findById($userId,array('BusinessOwners.timezone_id')); 
		return $result['BusinessOwners']['timezone_id'];
    }
}