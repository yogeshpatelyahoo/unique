<?php

/**
 * Events component for customised application functions
 */
App::uses('Component', 'Controller');

class EventsComponent extends Component {
	public $components = array('Encryption','Session','Adobeconnect');

	public function eventDelete($eventId, $userId = NULL)
    {
        $eventParticipant = ClassRegistry::init('EventParticipant');
        $event = ClassRegistry::init('Event');
     	$availableSlots = ClassRegistry::init('AvailableSlots');

     	$eventData = $availableSlots->find('first',array('conditions'=>array('type'=>'events','type_id'=>$eventId)));
    	$breezSessionData = $this->Adobeconnect->adobeConnectLogin();
    	if($breezSessionData != 'invalid') {
    		$callBackData = $this->Adobeconnect->removeMeeting($eventData['AvailableSlots']['adobe_type_id'],$breezSessionData);
    		if ($callBackData['status']['@attributes']['code'] == 'ok'){
                if (empty($userId)) {
    	    		$eventMembersData = $eventParticipant->getEventMembers($eventId);
                } else {
    	    		$eventMembersData = $eventParticipant->getEventTeamMembers($eventId, $userId);
                }
	    		$emailLib = new Email();
    			foreach($eventMembersData as $members){
    				$userEmailArr[] = $members['BusinessOwner']['email'];
    			}
    			$eventArr = $event->find('first',array('conditions'=>array('Event.id'=>$eventId)));
                $event->delete($eventId);
	    		$availableSlots->delete($this->Encryption->decode($eventData['AvailableSlots']['id']));
	    		$returnData = array('userEmailArr'=>$userEmailArr, 'eventData' => $eventArr,'response'=>'Event has been deleted successfully','code'=>'success');
    		} else {
    			$returnData = array('response'=>'Event not deleted, Try again after some time','code'=>'error');
    		}
    	} else {
			$returnData = array('response'=>'Event not deleted, Try again after some time','code'=>'error');
    	}
		return $returnData;    	
    }
}
