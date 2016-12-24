<?php

/**
 * This is an advertisement controller
 */
App::uses('Email', 'Lib');
class EmailSetupsController extends AppController 
{

    public $components = array('Email', 'Common',);    
    public $helpers = array('Encryption');
    public $uses = array('EmailMaster');

    /**
     * Before filter for inheriting parents beforeFilter and adding from there on
     * @author Mystery Man
     */
    public function beforeFilter()
    {
    	parent::beforeFilter();
    }
    
    /**
     * List Emails
     * @author Mystery Man
     */
    public function admin_index() 
    {
    	if($this->request->is('POST')) {
    		$requestData = $this->request->data['EmailMaster'];
    		$data = array();
    		foreach ($requestData as $fields) {
    			$data[] = array('email_from'=>$fields['email_from'], 'from_name'=>$fields['from_name'], 'id'=>$this->Encryption->decode($fields['id']));
    		}
    		if($this->EmailMaster->saveMany($data)) {
    			$this->Session->setFlash('Changes have been saved.', 'flash_good');
    		} else {
    			$this->Session->setFlash('Error occured while saving your changes', 'flash_bad');
    		}
    	}
    	$data = $this->EmailMaster->find('all');
    	$this->set('emailMasterData', $data);
    }
    
    /**
     * List Emails
     * @author Mystery Man
     */
    public function admin_sendTestMail( $emailMasterID=NULL )
    {
    	if($emailMasterID) {
    		$emailEntry = $this->EmailMaster->find( 'first', array( 'conditions'=>array( 'id'=>$this->Encryption->decode($emailMasterID) ) ) );
	    	$emailLib = new Email();
	    	$to = AdminEmail;
	    	$subject = 'Unique mail test service';
	    	$template = 'admin_send_test_mail';	    	
	    	$variable = $emailEntry['EmailMaster'];	    	
	    	if($emailLib->sendEmail($to,$subject,$variable,$template,'both')) {
	    		$this->Session->setFlash('Test mail has been sent successfully.', 'flash_good');
	    		$this->redirect(array('controller'=>'emailSetups', 'action'=>'index', 'admin'=>true));
	    	}
    	} else {
    		$this->Session->setFlash('Internal error occured, Please try again !!!', 'flash_bad');
    		$this->redirect(array('controller'=>'emailSetups', 'action'=>'index', 'admin'=>true));
    	}
    }

    
}