<?php

/**
 * Component using for message related information
 */
App::uses('Component', 'Controller');
class MessagesComponent extends Component 
{   
	public $components = array('Encryption');
	/**
     * to get the attachment list of messages
     * @param int $messageId message id
     * @return array $attachments attachements list 
     * @author Jitendra Sharma
     */
    public function messageAttachment($messageId=NULL)
    {
    	$attachmentData = array();    	
    	if($messageId!=NULL){
    		$messageId = $this->Encryption->decode($messageId);
	    	$model = ClassRegistry::init('MessageAttachment');
	        $attachmentData = $model->find("all",array('conditions'=>array('MessageAttachment.message_id'=>$messageId)));
        }
        return $attachmentData;
    }
    
    /**
     * to get the recipientsID
     * @param int $messageId message id
     * @return array $recipients Recipients list 
     * @author Mystery Man
     */
    public function messageRecipient($messageId=NULL)
    {
    	$attachmentData = array();
    	if($messageId!=NULL){
	    	$model = ClassRegistry::init('MessageRecipient');
	        $recipientsData = $model->find("all",array('conditions'=>array('MessageRecipient.message_id'=>$messageId)));
        }
        return $recipientsData;
    }
    
    /**
     * to get the recipientsID
     * @param int $messageId message id
     * @return array $recipients Recipients list
     * @author Mystery Man
     */
    public function messageRecipientList($messageId=NULL)
    {
        $receiversName = array();
        if($messageId!=NULL){
            $model = ClassRegistry::init('MessageRecipient');
            $modelBiz = ClassRegistry::init('BusinessOwner');
            $recipientsData = $model->find("all",array('conditions'=>array('MessageRecipient.message_id'=>$messageId)));
            foreach ($recipientsData as $mR) {
                $rcvrData = $modelBiz->find('first', array('conditions' => array('BusinessOwner.user_id' => $mR['MessageRecipient']['recipient_user_id'])));
                if (!empty($rcvrData['BusinessOwner']['fname'])) {
                    $receiversName[]=ucfirst($rcvrData['BusinessOwner']['fname']). " ".ucfirst($rcvrData['BusinessOwner']['lname']);
                }
            }
        }
        return $receiversName;
    }
   
}