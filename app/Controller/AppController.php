<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeNumber', 'Utility');
App::uses('CakeTime', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller 
{
  /*public $paginate = array(
        'order' => array('Profession.created' => 'desc')
    );*/
    public $helpers = array('Js','Functions','Time');
    public $components = array('Auth', 'Session', 'Encryption', 'Cookie', 'RequestHandler','Common', 'Functions');
    public $uses = array('User','ProfessionCategory');
    public $isWebRequest = true;

    /**
     * To filter url request
     * @author Mystery Man
     */
    public function beforeFilter()
    {
        $headersInformation = getallheaders();
        // admin email        
        $this->set('AdminEmail', AdminEmail);
        //fetch the headers data
        $this->__getHeaderInformation();
        
        if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
        	$this->layout = 'admin';
        	AuthComponent::$sessionKey = 'Auth.User';
        	$this->isAdmin = TRUE;
        	Configure::write('isAdmin', TRUE);
        }

        $roleType = $this->Session->read('Auth.User.user_type');
        $this->set('common', $this->Common);

        $frontUserRole = $this->Session->read('Auth.Front.user_type');
        $isUserLogin = ($frontUserRole=="businessOwner") ? true : false;        
        $this->set(compact("isUserLogin"));

        $loginUserId = $this->Session->read('Auth.Front.id');
        $this->set(compact("loginUserId"));

        $messageCounter = 0;
        $eventCounter = 0;
		$referalCounter = 0;
        $this->set('leaderAlertMsg', 0);
        
        if ($this->request->is('ajax')) {
            $ajaxRinningUrl = parse_url($this->referer());
            $serverUrl = parse_url(Configure::read('SITE_URL'));
            if ($ajaxRinningUrl['host'] != $serverUrl['host']) {
                $result = array(
                    'response' =>  __('Unauthorize Access'),
                    'responsecode' => Configure::read('RESPONSE_ERROR'),
                    );
                echo json_encode($result);
                die;
            }
        }   
    }

    /**
     * Filter apply before render
     * @author Laxmi Saini
     */
    public function beforeRender() 
    {
        $this->response->disableCache();
        if ($this->name == 'CakeError') {
            $this->layout = 'error';
        }
        
    }

    /*
     * Function to get post data and convert it into json format.
     *@author Mystery Man
     */
    private function __getPostContent(){
        $data = file_get_contents("php://input");
        $this->jsonDecodedRequestedData = json_decode($data);
    }

    /*
     * Function to get header information.
     *@author Mystery Man
     */
    private function __getHeaderInformation()
    {
        $headersInformation = getallheaders();
        if (isset($headersInformation['UserId'])) {
            $this->loggedInUserId = $this->Encryption->decode($headersInformation['UserId']);
        }
        if (isset($headersInformation['groupId'])) {
            $this->loggedInUserGroupId = $headersInformation['groupId'];
        }
        if (!empty($headersInformation['DeviceToken']) && !empty($headersInformation['DeviceId']) && !empty($headersInformation['DeviceType'])) {
            $this->DeviceToken = $headersInformation['DeviceToken'];
            $this->DeviceId = $headersInformation['DeviceId'];
            $this->DeviceType = $headersInformation['DeviceType'];
        }
    }
    
    

    /**
     *Function for delete pop up on referrals, mesasge, contacts and group
     *@author Mystery Man
     */
    public function popupFunction()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->set('id', $this->request->data['id']);           
            $this->set('controller', $this->request->data['controller']);
            $this->set('action', $this->request->data['action']);
            $this->set('UID', $this->request->data['listPage']);
            if (in_array($this->request->data['action'],array('select-group','update-group'))) {
                $this->set('listPage', 'UID');
            } else {
                $this->set('listPage', $this->request->data['listPage']);
            }
            $this->set('perPage', 10);
            $this->render('/Elements/Front/action_popup', 'ajax');
        }
    }

    /**
     *Function for mass action pop up on referrals, mesasge, contacts, teams
     *@author Mystery Man
     */
    public function massActionFunction()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $this->set('formId', $this->request->data['formId']);
            $this->set('controller', $this->request->data['controller']);
            $this->set('action', $this->request->data['action']);
            $this->set('listPage', $this->request->data['listPage']);
            $this->render('/Elements/Front/mass_action_popup', 'ajax');
        }
    }


    /**
     * Function to setup Popup Variables.
     * @param string $action
     * @param string $info
     * @param string $data
     * @return array $response
     * @author Mystery Man
     * */
    public function parsePopupVars($action,$info='',$data='')
    {
        $response = array();
        $response['firstButtonLabel'] = 'Cancel';
        $response['headerMsg'] = 'Delete Confirmation';
        $response['secondButtonDisplay'] ='';
        switch ($action) {
            case "approve":
                $response['headerMsg'] = 'Approve Confirmation';
                $response['actionMessage'] = "Do you want to approve the ".$info."?";
                break;
        
            case "activate":
                $response['headerMsg'] = 'Activate Confirmation';
                $response['actionMessage'] = "Do you want to activate the ".$info."?";
                break;
        
            case "delete":
                $response['actionMessage'] = "Do you want to delete this ".$info."?";
                break;
        
            case "deleteCategory":
                $response['actionMessage'] = " The category may consists of FAQs. Do you want to delete the category?";
                break;
        
            case "status":
                $response['headerMsg'] = $data.' Confirmation';
                $response['actionMessage'] = "Do you want to ".$data." the ".$info."?";
                break;
            default:
                $response['headerMsg'] =" confirmation";
                $response['actionMessage'] = "Do you want to perform this action?";
        }
        return $response;
    }

    /**
     * Function to combine all Server side errors into list
     * @param string $model, Specifies name of the model
     * @return array $errors
     * @author Mystery Man
     */
    public function compileErrors($model)
    {
        $errors = NULL;
        if (!empty($this->$model->validationErrors)) {
            $errors = '<ul>';
            foreach ($this->$model->validationErrors as $key=>$err) {
                $errors.='<li>'.$err[0].'</li>';
            }
            $errors.='</ul>';            
        }
        return $errors;
    }

	
    
    /**
     * function used to return error message and code in API
     * @return string $errMsg
     * @author Mystery Man
     */
    public function errorMessageApi($errMsg)
    {
        $this->set(array(
            'code' => Configure::read('RESPONSE_ERROR'),
            'message' => !empty($errMsg) ? $errMsg : '',
            '_serialize' => array('code', 'message')
        ));
    }

   
}
