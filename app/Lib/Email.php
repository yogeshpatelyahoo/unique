<?php 
App::uses('CakeEmail', 'Network/Email');
class Email 
{
   public function sendEmail($to=NULL,$subject=NULL,$data=NULL,$template=NULL,$format='text',$cc=NULL,$bcc=NULL) {
    $Email = new CakeEmail();
    if(!empty($data) && !empty($data['email_from']) && !empty($data['from_name'])) {
    	$sentFrom = array($data['email_from'] => $data['from_name']);
    } else {
    	$sentFrom = array(Configure::read('Email_From_Email') => Configure::read('Email_From_Name'));
    }
    $Email->from($sentFrom);
    $Email->config(Configure::read('TRANSPORT'));
    $Email->template($template);
    if($to!=NULL){
    	$Email->to($to);
    }
    if($cc!=NULL){
    	$Email->cc($cc);
    }
    if($bcc!=NULL){
    	$Email->bcc($bcc);
    }
    $Email->subject($subject);
    $Email->viewVars($data);
    $Email->emailFormat($format);
    if(isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] == '10.10.11.243' || $_SERVER['HTTP_HOST'] == 'localhost')){
	    if($Email->send()) {
	    	return true;
	    } else {
	    	return false;
	    }
    } else {
    	return false;
    }
   }
}
?>
