<?php
App::uses('AppController', 'Controller');
App::uses('Email', 'Lib');
class PagesController extends AppController 
{
    /**
     * callback function on filter
     * @author Mystery Man
     */
    function beforeFilter() 
    {
        parent::beforeFilter();
        $filterActions=array('aboutUs','contactUs','privacyPolicy','termsOfServices','faq');
        if(in_array($this->request->params['action'], $filterActions)) {
            if(count($this->request->params['pass'])>0) {
                $this->redirect(Router::url(array('controller'=>'pages','action'=>'404'),true));
            }
        }
        $this->Auth->allow('tour');
    }
    
    /**
     * This controller use a model
     * @var array
     */
    public $uses = array('Page');

    /**
    * @author Mystery Man
    */
    public function home()
    {
        $titleForLayout = "Unique : Home";
        $this->loadModel('Coupon');    	  	
        $this->set(compact('titleForLayout'));
        $checkAccessSession = $this->Session->read('AccessedBy');
        if (!empty($checkAccessSession)) {
            $this->redirect('foxhoprapplication://cancel');
        }
    }

    /**
    * Function used view about us page 
    * @author Mystery Man
    */
    public function aboutUs() 
    {
        $titleForLayout = "Unique : About Us";
        $this->set(compact('titleForLayout'));
        $aboutUsData = $this->Page->findByPageTitle('about-us');
        $this->set('aboutUs',$aboutUsData);
        $this->set("titleForLayout", $aboutUsData['Page']['meta_title']);
        $this->set("metaDescription", $aboutUsData['Page']['meta_desc']);
        $this->set("metaKeywords", $aboutUsData['Page']['meta_keywords']);
    }

    /**
    * Function used for contact us page 
    * @author Mystery Man
    */
    public function contactUs()
    {
        $titleForLayout = "Unique : Contact";
        $this->set(compact('titleForLayout'));
        if ($this->request->is('post')) {
            $userData = $this->request->data['Page'];
            $emailLib = new Email();
            $adminData = $this->User->find('first', array('conditions'=>array('User.user_type'=>'admin'), 'fields'=>array('User.username', 'User.user_email')));
            $to = $adminData['User']['user_email'];
            $subject = 'User Feedback';
            $template = 'userFeedback';
            $numEmployees = '';
            switch ( $userData['employeesNumber'] ) {
                case 1:$numEmployees = '1 - 50 employees';
                    break;
                case 2:$numEmployees = '51 - 100 employees';
                    break;
                case 3:$numEmployees = '101 - 500 employees';
                    break;
                case 4:$numEmployees = '501 - 1000 employees';
                    break;
                case 5:$numEmployees = '1001+ employees';
                    break;
            }
            $userData['employeesNumber'] = $numEmployees;
            $variable = array('formData'=>$userData, 'username'=>$adminData['User']['username']);
            $mailForm = $this->Functions->fetchEmailFrom(Configure::read('EMAIL_FROM.mail015'));
            if( $mailForm  && !empty($mailForm) ) {
            	$variable = array_merge($variable, $mailForm);
            }
            $success = $emailLib->sendEmail($to,$subject,$variable,$template,'both');
            if ($success) {
                $this->Session->setFlash('Your message has been submitted successfully', 'flash_good');
                $this->redirect(array('controller' => 'pages', 'action' => 'contact-us'));
            } else {
                $this->Session->setFlash(__('Some error, please try again.'), 'flash_bad');
            }
        }
    }

    /**
    * Function used for Privacy Policy page 
    * @author Mystery Man
    */
    public function privacyPolicy() 
    {
        $titleForLayout = "Unique : Privacy";
        $this->set(compact('titleForLayout'));
        $privacyPolicyData = $this->Page->findByPageTitle('privacy-policy');
        $this->set('privacyPolicy',$privacyPolicyData);	
        $this->set("titleForLayout", $privacyPolicyData['Page']['meta_title']);
        $this->set("metaDescription", $privacyPolicyData['Page']['meta_desc']);
        $this->set("metaKeywords", $privacyPolicyData['Page']['meta_keywords']);
    }

    /**
    * Function used for Terms of services page 
    * @author Mystery Man
    */
    public function termsOfServices() 
    {
        $titleForLayout = "Unique : Terms Of Use";
        $this->set(compact('titleForLayout'));
        $termsOfServicesData = $this->Page->findByPageTitle('terms-and-conditions');
        $this->set('termsOfServices',$termsOfServicesData);	
        $this->set("metaDescription", $termsOfServicesData['Page']['meta_desc']);
        $this->set("metaKeywords", $termsOfServicesData['Page']['meta_keywords']);
    }

    /**
    * Function used for careers page 
    * @author Mystery Man
    */
    /*public function careers() 
    {

    }*/

    /**
    * Function used for Partner page 
    * @author Mystery Man
    */
    /*public function partners() 
    {

    }*/

    /**
    * Function used for Faq page
    * @author Mystery Man
    */
    public function faq() 
    {	
        $this->loadModel('Faqcategorie');
        $titleForLayout = "Unique : FAQ";
        $this->Faqcategorie->bindModel(array('hasMany'=>array('Faq'=>array('className'=>'Faq','foreignKey'=>'category_id'))));
        $faqdata = $this->Faqcategorie->find('all');
        $this->set(compact('faqdata', 'titleForLayout'));
    }

    /**
    * Function used for View Faq Detail page 
    * @param string $faqTitle faq slug
    * @author Mystery Man
    */
    public function faqView($faqTitle = NULL) 
    {
        $titleForLayout = "Unique : FAQ";
        $referer = $this->referer();
        $this->set(compact('titleForLayout', 'referer'));
        $this->loadModel('Faq');
        $data = $this->Faq->findBySlug($faqTitle);
        if(!$data) {
                $this->redirect(array('action' => 'faq'));
        }
        $this->set('faqData',$data);		
    }

    /**
    * function to ajax search faq list
    * @param string $keywords search keywords
    * @author Mystery Man
    * @return json encoded $jsonValue
    */
    public function faqSearch($keyword = null)
    {
        $titleForLayout = "Unique : FAQ";
        $this->set(compact('titleForLayout'));
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $count = 0;
            $this->loadModel('Faq');
            if (!empty($this->request->data['query'])) {
                $query = $this->request->data['query'];
                $data = $this->Faq->find('all', array('conditions' => array("Faq.question LIKE" => "%" . $query . "%")));
                if (!empty($data)) {
                    foreach ($data as $result) {
                        $allVal[$count]['encodeName'] = urlencode($result['Faq']['id']);
                        $allVal[$count]['faqName'] = urlencode($result['Faq']['slug']);
                        $allVal[$count]['name'] = $result['Faq']['question'];
                        $count++;
                    }
                    $jsonValue = array('data' => 'true', 'response' => $allVal);
                } else {
                    $jsonValue = array('data' => 'false', 'response' => '0');
                }
            } else {
                $jsonValue = array('data' => 'false', 'response' => NULL);
            }
            return json_encode($jsonValue);
        } else if ($this->request->is('post')) {
            $categoryData = $this->Faqcategorie->findById($this->Encryption->decode($catId));
            if (!$categoryData) {
                $this->Session->setFlash(__('Invalid Category'), 'flash_bad');
                $this->redirect(array('action' => 'category', 'admin' => true));
            } else {
                $this->Faqcategorie->delete($this->Encryption->decode($catId));
                $this->Session->setFlash(__('Category deleted successfully'), 'flash_good');
                $this->redirect(array('action' => 'category', 'admin' => true));
            }
        }
    }	
    
    /**
     * Function used for Tour page
     * @author Mystery Man
     */
    public function tour()
    {
        $titleForLayout = "Unique : Website Tour";
        $this->set(compact('titleForLayout'));
    }
}
