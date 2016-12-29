<?php

/**
 * This is UsersController used for user activities
 * 
 */
App::uses('Email', 'Lib');
class CompaniesController extends AppController 
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
    public $uses = array('Candidate', 'ProfessionCategory', 'Company');
    
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
        $this->set('includePageJs',$this->includePageJs);
        $this->Auth->allow('admin_downloadResume');
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
    		$order=array('created'=>'desc');
    	}
    	
    	if ($search != '') {
    		$condition = array('Company.name LIKE' => '%' . $search . '%');
    	} else {
    		$condition = array();
    	}
    	$this->Paginator->settings = array(
    			'conditions' => $condition,
    			'order' => $order,
    			'limit' =>$perpage
    	);
    	$companies = $this->Paginator->paginate('Company');
    	$this->set(compact('companies'));
    	if ($this->request->is('ajax')) {
    		$this->layout = false;
    		$this->set('perpage', $perpage);
    		$this->set('search', $search);
    		$this->render('admin_company_ajax_list');
    	}
    }
  
    
	 public function admin_addCompany()
	 {
	 	$categories = $this->ProfessionCategory->find('list');
	 	$this->set(compact('categories'));
	 	if ($this->request->is('post')) {
	 		$this->request->data['Company']['technologies'] = serialize(explode(',', $this->request->data['Company']['technologies']));
	 		$this->request->data['Company']['category_id'] = $this->Encryption->decode($this->request->data['Company']['category_id']);
	 		if($this->Company->save($this->request->data)) {
	 			$this->Session->setFlash(__('Company has been added successfully'), 'flash_good');
	 			$this->redirect(array('controller'=>'companies', 'action'=>'index'));
	 		}
	 	}
	 }
	 
	 public function admin_delete($candidateId = null)
	 {
	 	$this->autoRender = false;
	 	if ($this->request->is('ajax')) {
	 		$this->set('id', $this->request->data['id']);
	 		$this->set('action', 'delete');
	 		$this->set('info', 'Candidate');
	 		$this->set('popupData',$this->parsePopupVars('delete','Candidate'));
	 		$this->render('/Elements/activate_delete_popup', 'ajax');
	 	} else if ($this->request->is('post')) {
	 
	 		$candidateExists = $this->Candidate->findById($this->Encryption->decode($candidateId));
	 		if (!$candidateExists) {
	 			$this->Session->setFlash(__('Invalid Candidate'), 'flash_bad');
	 			$this->redirect(array('action' => 'index'));
	 		} else {
	 			$this->Candidate->delete($this->Encryption->decode($candidateId));
	 			$this->Session->setFlash(__('Candidate has been deleted successfully'), 'flash_good');
	 			$this->redirect(array('action' => 'index'));
	 		}
	 	}
	 }
	 
	 /**
	  * edit profession category
	  * @param string $categoryId category id
	  * @author Mystery Man
	  */
	 function admin_edit($companyId = null)
	 {
	 	$this->layout = 'admin';
	 	$categories = $this->ProfessionCategory->find('list');
	 	$this->set(compact('categories'));
	 	$this->includePageJs = array('admin_validation');
	 	$id = $this->Encryption->decode($companyId);
	 	$this->set('id', $companyId);
	 	if (!$this->Company->exists($id)) {
	 		$this->Session->setFlash(__('Invalid Company'), 'flash_bad');
	 		$this->redirect(array('controller' => 'companies', 'action' => 'index', 'admin' => true));
	 	}
	 	$companyData = $this->Company->findById($id);
	 	if ($this->request->is(array('post', 'put'))) {
	 		// Check if file is uploaded
	 		$this->request->data['Company']['id'] = $this->Encryption->decode($this->request->data['Company']['id']);
	 		$this->request->data['Company']['category_id'] = $this->Encryption->decode($this->request->data['Company']['category_id']);
	 		$this->request->data['Company']['technologies'] = serialize(explode(',', $this->request->data['Company']['technologies']));
 			if ($this->Company->save($this->request->data)) {
 				$this->Session->setFlash(__('Company has been updated successfully.'), 'flash_good');
 				return $this->redirect(array('controller' => 'companies', 'action' => 'index', 'admin' => true));
 			} else {
 				$validationErr = $this->compileErrors('Company');
 				if ($validationErr != NULL) {
 					$this->Session->setFlash($validationErr,'flash_bad');
 				}
 			}
	 	}
	 	if (!$this->request->data) {
	 		$this->request->data = $companyData;
	 	}
	 	$this->set('includePageJs',$this->includePageJs);
	 }
	 
	 public function admin_view()
	 {
	 	$this->layout = false;
	 	if($this->request->is('ajax')) {
	 		$data = $this->Company->find('first',array('conditions'=>array('Company.id'=>$this->Encryption->decode($this->request->data['id']))));
	 		$this->set('company',$data);
	 		$this->render('admin_view');
	 	}
	 }
	 
}