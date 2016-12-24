<?php

/**
 * This is UsersController used for user activities
 * 
 */
App::uses('Email', 'Lib');
App::uses('GeoIpLocation', 'GeoIp.Model');
class UsersController extends AppController 
{
    public $includePageJs='';
    public $breezSessionData = '';
    
    /**
     * Components
     *
     * @var array
     * @access public
     */
    public $components = array('Paginator','Common');
    
    /**
     * Models used by the Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('User');
    
    /**
     * callback function
     * @author Mystery Man
     */
    public function beforeFilter() 
    {
        parent::beforeFilter();
        
        // Auth Settings
        //$scope = array('User.is_active' => '1');
           
        $this->Auth->authenticate = array(
        		AuthComponent::ALL => array('userModel' => 'User'),
        		'Form' => array('fields' => array('username' => 'user_email'))
        );
        $this->Auth->allow('signUp','getStateCity','professionalInfo','payment','checkCoupon','activateAccount','resetPassword','forgotpassword','api_login','api_forgotPassword', 'checkUserExist', 'doFacebookLogin', 'doLinkedInLogin', 'linkedInCallback', 'signUpStep2');
        $this->set('includePageJs',$this->includePageJs);
    }
	
    public function admin_index()
    {
    	if (!$this->request->is('ajax')) {
    		$this->Session->delete('direction');
    		$this->Session->delete('sort');
    	}
    	$this->layout = 'admin';
    	$perpage = $this->Functions->get_param('perpage', Configure::read('PER_PAGE'), true);
    	$page = $this->Functions->get_param('page', Configure::read('PAGE_NO'), false);
    	$counter = (($page - 1) * $perpage) + 1;
    	$this->set('counter', $counter);
    	 
    	$search = $this->Functions->get_param('search');
    	$this->Functions->set_param('direction');
    	$this->Functions->set_param('sort');
    	if ($this->Session->read('sort') != '') {
    		$order = array($this->Session->read('sort') => $this->Session->read('direction'));
    	}else{
    		$order=array('modified'=>'desc');
    	}
    	
    	if ($search != '') {
    		$condition = array('CONCAT(User.fname," ",User.lname) LIKE' => '%' . $search . '%');
    	} else {
    		$condition = array();
    	}
    	$this->Paginator->settings = array(
    			'conditions' => $condition,
    			'order' => $order,
    			'limit' =>$perpage
    	);
    	$users = $this->Paginator->paginate('User');
    	$this->set(compact('users'));
    	if ($this->request->is('ajax')) {
    		$this->layout = false;
    		$this->set('perpage', $perpage);
    		$this->set('search', $search);
    		$this->render('admin_user_ajax_list');
    	}
    }
    /**
    * Admin login
    * @author Laxmi Saini
    */
    public function admin_login() 
    {
        $checkUserSession = $this->Session->read('Auth.Front.user_type');
        if (!empty($checkUserSession) && ($checkUserSession == 'businessOwner')) {
            $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => false));
        }
        $this->layout = "login";
        $this->includePageJs = array('admin_validation');
        if ($this->Session->read('Auth.User.user_type') == 'admin') {
            $this->redirect(array('controller' => 'categories', 'action' => 'index', 'admin' => true));
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect(array('controller' => 'categories', 'action' => 'index', 'admin' => true));
            } else {
                $this->Session->setFlash(__('Please enter correct e-mail/password'), 'flash_bad');
                $this->Session->setFlash('error', 'default', array(), 'error');
                return $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));
            }
        }
        $this->set('includePageJs', $this->includePageJs);
    }

    /**
    * admin logout
    * @author Laxmi Saini
    */
    public function admin_logout()
    {
        if ($this->Auth->logout()) {
            $this->redirect(array('controller'=>'users','action' => 'login','admin'=>true));
        }
    }
    
    /**
    * function is used to send a forgot password request
    * @author Mystery Man
    */
    public function admin_forgotPassword() 
    {
        $this->layout = "login";
        $this->includePageJs = array('admin_validation');
        if ($this->request->is('post')) {
            $user = $this->User->find('first', array('conditions' => array('user_email' => $this->request->data['User']['email'])));
            if (!empty($user)) {
                $userEmail = $this->Encryption->encode($user['User']['user_email']);
                $time = $this->Encryption->encode(date("Y-m-d H:i:s"));
                $this->User->id = $user['User']['id'];
                $this->User->saveField('pass_reset_hash', $time);
                $url = Configure::read('SITE_URL') . 'admin/users/resetPassword/' . $userEmail . '/' . $time;                
                $emailLib = new Email();
                $to = $user['User']['user_email'];
                $subject = 'Your Foxhopr password reset request';
                $template = 'reset_forgot_password';
                $variable = array('name' => $user['User']['username'],'url'=>$url);
                $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail008'));
                if( $mailForm  && !empty($mailForm) ) {
                	$variable = array_merge($variable, $mailForm);
                }
                $success = $emailLib->sendEmail($to,$subject,$variable,$template,'both');

                if ($success) {
                    $this->Session->setFlash(__('Please check your inbox or spam folder to access the reset password link'), 'flash_good');
                    $this->redirect(array('controller' => 'users', 'action' => 'forgotPassword', 'admin' => true));
                } else {
                    $this->Session->setFlash(__('Some error, please try again.'), 'flash_bad');
                }
            } else {
                $this->Session->setFlash(__('This e-mail does not match our records, please enter correct e-mail.'), 'flash_bad');
                $this->redirect(array('controller' => 'users', 'action' => 'forgotPassword', 'admin' => true));
            }
        }
        $this->set('includePageJs',$this->includePageJs);
    }

    /**
     * password reset
     * @param string $userEmail user email
     * @param string $time time
     * @author by Mystery Man
     */
    public function admin_resetPassword($userEmail = null,$time = null) 
    {  
        $this->layout = "login";
        $this->includePageJs=array('admin_validation');
        $this->set('includePageJs',$this->includePageJs);
        $userEmailDecode = preg_replace('/[^(\x20-\x7F)]*/','', $this->Encryption->decode($userEmail));
        $timeDecode = preg_replace('/[^(\x20-\x7F)]*/','', $this->Encryption->decode($time));
        $userInfo = $this->User->find('first',array('conditions'=>array('user_email'=>$userEmailDecode,'pass_reset_hash'=>$time)));
        if(empty($userInfo)){
            $this->Session->setFlash(__('The link seems to be expired. Please use the latest password reset link or try again.'),'flash_bad');
            $this->redirect(array('controller' => 'users', 'action' => 'forgotPassword', 'admin' => true));
        } else {
            $timediff =  round((strtotime(date("Y-m-d H:i:s")) - strtotime($timeDecode))/(60*60));           
            if($timediff > 24){
                $this->Session->setFlash(__('The link seems to be expired. Please use the latest password reset link or try again'),'flash_bad');
                $this->redirect(array('controller' => 'users', 'action' => 'forgotPassword', 'admin' => true));
            }
            else{
                $this->set('useremail',$userEmailDecode);
            }
        }
        if($this->request->is('post')){
            $this->User->id = $userInfo['User']['id'];
            if($this->User->saveField('password',$this->Auth->password($this->request->data['User']['password']))){                
                $emailLib = new Email();
                $to = $userInfo['User']['user_email'];
                $subject = 'Your Foxhopr password reset successfully';
                $template = 'reset_password';
                $params = array('name' => $userInfo['User']['username']);
                $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail008'));
                if( $mailForm  && !empty($mailForm) ) {
                	$params = array_merge($params, $mailForm);
                }
                $success = $emailLib->sendEmail($to,$subject,$params,$template,'both');
                if($success){
                    $this->Session->setFlash(__("Your password has been changed successfully."),"flash_good");
                    $this->User->id = $userInfo['User']['id'];
                    $this->User->saveField('pass_reset_hash',NULL);
                    $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true)); 
                }else{
                    $this->Session->setFlash(__("Your password has been changed successfully. Email has not sent successfully."),"flash_bad");
                    $this->User->id = $userInfo['User']['id'];
                    $this->User->saveField('pass_reset_hash',NULL);
                    $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));                    
                }                
            }else{
                $this->Session->setFlash(__("Your password has not been changed, please try again."),"flash_bad");
            }
        }
    }

    /**
     * Reset password for admin user
     * @author Mystery Man
     */
    function admin_changePassword() 
    {
        $this->layout = 'admin';
        $this->set('title_for_layout','Unique: Change Password');
        if ($this->request->is('post')) {
            $user = $this->User->findById($this->Encryption->decode($this->Auth->User('id')));
            if (!$user) {
                $this->Session->setFlash(__("Unknown error.  Please try again"),"flash_bad");
                return $this->redirect(array('action' => 'changePassword'));
            }
            if ($this->request->data['User']['new_password'] != $this->request->data['User']['cpassword']) {
                $this->Session->setFlash(__("New password and confirm password should have same value"),"flash_bad");
                return $this->redirect(array('action' => 'changePassword'));
            }
            if ($this->request->data['User']['current_password'] == $this->request->data['User']['new_password']) {
                $this->Session->setFlash(__("Current and New password cannot be same."),"flash_bad");
                return $this->redirect(array('action' => 'changePassword'));
            }
            $currentHash = $user['User']['password'];
            $checkHash = Security::hash($this->request->data['User']['current_password'], null, true);
            if ($currentHash != $checkHash) {
                $this->Session->setFlash(__("Current password is incorrect"),"flash_bad");
                return $this->redirect(array('action' => 'changePassword'));
            }
            
            //$user['User']['confirm_password'] = $this->request->data['User']['cpassword'];
            $newHash = Security::hash($this->request->data['User']['new_password'], null, true);
            $user['User']['password'] = $newHash;
            $user['User']['id'] = $this->Encryption->decode($user['User']['id']);
            unset($this->User->validate['user_email']);
            unset($this->User->validate['password']['length']);
            if ($this->User->save($user)) {
                $this->Session->setFlash(__("Your password has been updated successfully"),"flash_good");
                $this->Session->write('Auth', $this->User->read(null, $user['User']['id']));
                return $this->redirect(array('controller' => 'professions', 'action' => 'index', 'admin' => true));
            } else {
                $this->Session->setFlash(__("Password updation failed.  Please try again"),"flash_bad");
            }
            
        }
    }

    
    /**
     * function is used to reset password
     * @author Jitendra
     * @param string $userID encrypted user id
     * @param string $time time
     */
    public function resetPassword($userID=null,$time=null)
    {
    	if ($this->request->is('post')) {
    		$uid = $this->Encryption->decode($this->request->data['User']['uid']);
    		$user = $this->User->find('first', array('conditions' => array('User.id' =>$uid)));    		
    		if (!empty($user)) {
    			$this->User->id = $uid;
    			$newPassword = $this->Auth->password($this->request->data['User']['password']);
    			//Update user password in adobe connect 
            	$changeInfo = $this->Adobeconnect->adobeUpdatePassword($user,$newPassword);
            	if($changeInfo['status']['@attributes']['code'] == 'ok'){
		    		if($this->User->saveField('password',$newPassword)){
						 //Update Wordpress Password if user is registered on blog
					    require_once(ROOT.DS.'/blog/wp-blog-header.php');
					    $wpUser = get_user_by ( 'email', $user['User']['user_email'] );
					    if(!empty($wpUser)) {
					        wp_set_password( $this->request->data['User']['password'], $wpUser->ID );
					    }
						$emailLib = new Email();
		                $to = $user['User']['user_email'];
		                $subject = 'Your Foxhopr password reset successfully';
		                $template = 'reset_password';
		                $format = "both";
		                $user_name = $user['BusinessOwner']['fname']." ".$user['BusinessOwner']['lname'];
		                $params = array('name' => $user_name);
		                $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail008'));
		                if( $mailForm  && !empty($mailForm) ) {
		                	$params = array_merge($params, $mailForm);
		                }
		                $success = $emailLib->sendEmail($to,$subject,$params,$template,$format);
		                if($success){
		                    $this->Session->setFlash(__("Your password has been changed successfully."),"Front/flash_good");	                    
		                    $this->User->saveField('pass_reset_hash',NULL);
		                    $this->redirect(array('controller' => 'users', 'action' => 'login')); 
		                }else{
		                    $this->Session->setFlash(__("Your password has been changed successfully. Email has not sent successfully."),"Front/flash_bad");	                   
		                    $this->User->saveField('pass_reset_hash',NULL);
		                    $this->redirect(array('controller' => 'users', 'action' => 'login'));                    
		                }                
		            }else{
		            	//Update old password to adobe if found some error while updating new password in DB
                    	$oldPassword = $user['User']['password'];
                    	$user['User']['password'] = $newPassword;
                    	$this->Adobeconnect->adobeUpdatePassword($user,$oldPassword);
		                $this->Session->setFlash(__("Your password has not been changed, please try again."),"Front/flash_bad");
		            }
                } else {
                	$this->Session->setFlash(__("Your password has not been changed, please try again."),"Front/flash_bad");
                }    			
    		} else {
    			$this->Session->setFlash(__('This is an invalid user.'), 'Front/flash_bad');
    			$this->redirect(array('controller' => 'users', 'action' => 'forgot-password'));
    		}
    	}else{
    		if($userID==null){
    			$this->Session->setFlash(__('This is an invalid link.'), 'Front/flash_bad');
    			$this->redirect(array('controller' => 'users', 'action' => 'forgot-password'));
    			exit;
    		}
    		$uid = $this->Encryption->decode($userID);
    		$islatestlink = $this->User->find('count', array('conditions' => array('User.id' =>$uid,'User.pass_reset_hash' =>$time)));
    		$time = $this->Encryption->decode($time);
    		$timediff =  round((strtotime(date("Y-m-d H:i:s")) - strtotime($time))/(60*60));
    		if($timediff > 24 || $islatestlink==0){
    			$this->Session->setFlash(__('The link seems to be expired. Please use the latest password reset link or try again.'),'Front/flash_bad');
    			$this->redirect(array('controller' => 'users', 'action' => 'forgot-password'));
    		}
    		else{
    			$this->set('userid',$userID);
    	    	$this->set('time',$time);
    		}
    		$this->set('userid',$userID);
    		$this->set('time',$time);
    	}
    }
    
    /**
     * function is used to send a reset password link
     * @author Jitendra
     */
    public function forgotpassword()
    {
        $this->set('titleForLayout', 'Unique: Forgot Password');
    	if ($this->request->is('post')) {
    		$user = $this->User->find('first', array('conditions' => array('user_email' => $this->request->data['User']['email'])));
    		if (!empty($user)) {
    			$userid = $user['User']['id'];
    			$time = $this->Encryption->encode(date("Y-m-d H:i:s"));
    			$this->User->id = $this->Encryption->decode($userid);
    			$this->User->saveField('pass_reset_hash', $time);
    			$url = Configure::read('SITE_URL') . 'users/reset-password/' . $userid . '/' . $time;
    
    			$emailLib = new Email();
    			$to = $user['User']['user_email'];
    			$subject = 'Your Foxhopr password reset request';
    			$template = 'reset_forgot_password';
    			$user_name = $user['BusinessOwner']['fname']." ".$user['BusinessOwner']['lname'];
    			$variable = array('name' => $user_name,'url'=>$url);
    			$mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail008'));
    			if( $mailForm  && !empty($mailForm) ) {
    				$variable = array_merge($variable, $mailForm);
    			}
    			$success = $emailLib->sendEmail($to,$subject,$variable,$template,'both');
    
    			if ($success) {
    				$this->Session->setFlash(__('Please check your inbox to access the reset password link'), 'Front/flash_good');
    				$this->redirect(array('controller' => 'users', 'action' => 'forgot-password'));
    			} else {
    				$this->Session->setFlash(__('Email not sent, please try again.'), 'Front/flash_bad');
    			}
    		} else {
    			$this->Session->setFlash(__('The email entered does not match our database.'), 'Front/flash_bad');
    			$this->Session->setFlash('', 'Front/flash_bad','','error');
    			$this->redirect(array('controller' => 'users', 'action' => 'forgot-password'));
    		}
    	}
    }
    
 public function admin_addUser()
 {
 	if($this->request->is('POST')) {
 		if ($this->User->save($this->request->data)) {
 			$this->Session->setFlash(__('User added successfully.'), 'flash_good');
 			return $this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
 		} else {
 			$validationErr = $this->compileErrors('User');
 			if ($validationErr != NULL) {
 				$this->Session->setFlash($validationErr,'flash_bad');
 			}
 		}
 	}
 }
 
 public function admin_edit($userId = NULL)
 {
 	$this->layout = 'admin';
 	$this->includePageJs = array('admin_validation');
 	$id = $this->Encryption->decode($userId);
 	$this->set('id', $userId);
 	if (!$this->User->exists($id)) {
 		$this->Session->setFlash(__('Invalid user'), 'flash_bad');
 		$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
 	}
 	$userData = $this->User->findById($id);
 	if ($this->request->is(array('post', 'put'))) {
 		$this->request->data['User']['id'] = $this->Encryption->decode($this->request->data['User']['id']);
 		if(empty($this->request->data['User']['password'])) {
 			unset($this->User->validate['password']);
 		}
 		unset($this->User->validate['user_email']);
 		if($this->User->validates()) {
 			if(!empty($this->request->data['User']['password']))
 				$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
 				unset($this->request->data['User']['user_email']);
 			if ($this->User->save($this->request->data, false)) {
 				$this->Session->setFlash(__('User updated successfully.'), 'flash_good');
 				return $this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
 			}
 		} else {
 			$validationErr = $this->compileErrors('User');
 			if ($validationErr != NULL) {
 				$this->Session->setFlash($validationErr,'flash_bad');
 			}
 		}
 			
 	}
 	if (!$this->request->data) {
 		unset($userData['User']['password']);
 		$this->request->data = $userData;
 	}
 	$this->set('includePageJs',$this->includePageJs);
 	
 }
 
 public function admin_delete($userId = null)
 {
 	$this->autoRender = false;
 	if ($this->request->is('ajax')) {
 		$this->set('id', $this->request->data['id']);
 		$this->set('action', 'delete');
 		$this->set('info', 'Video');
 		$this->set('popupData',$this->parsePopupVars('delete','User'));
 		$this->render('/Elements/activate_delete_popup', 'ajax');
 	} else if ($this->request->is('post')) {
 
 		$userExists = $this->User->findById($this->Encryption->decode($userId));
 		if (!$userExists) {
 			$this->Session->setFlash(__('Invalid User'), 'flash_bad');
 			$this->redirect(array('action' => 'index'));
 		} else {
 			$this->User->delete($this->Encryption->decode($userId));
 			$this->Session->setFlash(__('User has been deleted successfully'), 'flash_good');
 			$this->redirect(array('action' => 'index'));
 		}
 	}
 }

}
    
   
