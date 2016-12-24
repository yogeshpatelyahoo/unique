<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Email', 'Lib');
App::import('Vendor', 'mpdf/mpdf');
class TestsController extends AppController
{
    public $helpers = array('Js','Functions');
    public $components = array('Auth', 'Session', 'Encryption', 'Mail', 'Cookie', 'RequestHandler','Common','Businessowner','Functions','Groups','GroupGoals');
    public $uses = array('User', 'BusinessOwner','Subscription','Transaction','Goal','CreditCard','Group');
    public function beforeFilter()
    {
        parent::beforeFilter();        
        $this->Auth->allow('*');
        
        require_once (ROOT.DS.APP_DIR.DS.'Plugin/authorizedotnet/AuthorizeNet.php');
    }   
    
    public function paymentTest()
    {
    	$this->layout = false;
    	$METHOD_TO_USE = "AIM";
    	if($this->request->is('POST')) {
	    	if ($METHOD_TO_USE == "AIM") {
			    $transaction = new AuthorizeNetAIM;
			    $transaction->setSandbox(AUTHORIZENET_SANDBOX);
			    $exp_date=$this->request->data['exp_mnth']."/".$this->request->data['exp_yr'];
			    $transaction->setFields(
			        array(
			        'amount' => $this->request->data['x_amount'], 
			        'card_num' => $this->request->data['x_card_num'], 
			        'exp_date' => $exp_date,
			        )
			    );
			    $response = $transaction->authorizeAndCapture();
			    if ($response->approved) {
			        $this->Session->setFlash('Your transaction is successful, Transaction ID is '.$response->transaction_id, 'Front/flash_good');
			    } else {
			        $this->Session->setFlash('Your transaction Failed. ResponseReasonCode: '.$response->response_reason_code.', ResponseCode: '.$response->response_code.' ResponseText: '.$response->response_reason_text, 'Front/flash_good');
			    }
			} elseif (count($this->request->data)) {
			    $response = new AuthorizeNetSIM;
			    if ($response->isAuthorizeNet()) {
			        if ($response->approved) {
			            $txId = $response->transaction_id;
			            $this->Session->setFlash('Your transaction is successful, Transaction ID is '.$txId, 'Front/flash_good');
			        } else {
			        	$this->Session->setFlash('Your transaction Failed. ResponseReasonCode: '.$response->response_reason_code.', ResponseCode: '.$response->response_code.' ResponseText: '.$response->response_reason_text, 'Front/flash_good');
			        }			        
			    } else {
			        echo "MD5 Hash failed. Check to make sure your MD5 Setting matches the one in config.php";
			    }
			}
    	}
    }
        
}