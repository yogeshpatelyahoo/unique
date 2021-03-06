<?php

/**
 * This is UsersController used for user activities
 * 
 */
App::uses('Email', 'Lib');
class AssignmentsController extends AppController 
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
    public $uses = array('Candidate', 'ProfessionCategory', 'Company', 'Assignment');
    
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
    		$order=array('modified'=>'desc');
    	}
    	
    	if ($search != '') {
    		$condition = array('CONCAT(Candidate.fname," ",Candidate.lname) LIKE' => '%' . $search . '%',
    				'Company.name LIKE' => '%' . $search . '%',
    		);
    	} else {
    		$condition = array();
    	}
    	$this->Paginator->settings = array(
    			'conditions' => $condition,
    			'order' => $order,
    			'limit' =>$perpage
    	);
    	$assignments = $this->Paginator->paginate('Assignment');
    	$this->set(compact('assignments'));
    	if ($this->request->is('ajax')) {
    		$this->layout = false;
    		$this->set('perpage', $perpage);
    		$this->set('search', $search);
    		$this->render('admin_assign_ajax_list');
    	}
    }
  
    
	 public function admin_add()
	 {
	 	$this->Candidate->virtualFields = array('cname'=>'CONCAT(fname," ",lname )');
	 	$categories = $this->ProfessionCategory->find('list');
	 	$companies = $this->Company->find('list');
	 	$candidates = $this->Candidate->find('list', array('fields'=>array('id', 'cname')));
	 	$this->set(compact('categories','companies','candidates'));
	 	if ($this->request->is('post')) {
	 		$data = array();
	 		$company_id = $this->Encryption->decode($this->request->data['Assignment']['company_id']);
	 		$category_id = $this->Encryption->decode($this->request->data['Assignment']['category_id']);
	 		foreach ($this->request->data['Assignment']['candidates'] as $candidate) {
	 			$data[] = array('company_id'=>$company_id, 'category_id'=>$category_id, 'candidate_id'=>$this->Encryption->decode($candidate));
	 		}
	 		//pr($data);exit();
	 		//$data = array('Assignment'=>$data);
	 		if( $this->Assignment->saveAll($data) ) {
	 			$this->redirect(array('controller'=>'assignments', 'action'=>'index'));
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
	 function admin_edit($candidateId = null)
	 {
	 	$this->layout = 'admin';
	 	$categories = $this->ProfessionCategory->find('list');
	 	$this->set(compact('categories'));
	 	$this->includePageJs = array('admin_validation');
	 	$id = $this->Encryption->decode($candidateId);
	 	$this->set('id', $candidateId);
	 	if (!$this->Candidate->exists($id)) {
	 		$this->Session->setFlash(__('Invalid candidate'), 'flash_bad');
	 		$this->redirect(array('controller' => 'candidates', 'action' => 'index', 'admin' => true));
	 	}
	 	$candidateData = $this->Candidate->findById($id);
	 	if ($this->request->is(array('post', 'put'))) {
	 		// Check if file is uploaded
	 		$error = false;
	 		//pr($this->request->data['Candidate']['resume_file']);exit;
	 		if ( !empty($this->request->data['Candidate']['resume_file']) && $this->request->data['Candidate']['resume_file']['size'] > 0 ) {
	 			
	 			$file = $this->request->data['Candidate']['resume_file'];
	 			$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
	 			$arr_ext = Configure::read('ALLOWED_EXT');
		 		if ($file['size'] > Configure::read('MAX_SIZE') || empty($file)) {
		 			$error = true;
		 			$this->Session->setFlash(__('Resume file size should be maximum of 10 MB'), 'flash_bad');
		 		} elseif(!in_array($ext, $arr_ext)) {
		 			$error = true;
		 			$this->Session->setFlash(__('Invalid Extension'), 'flash_bad');		 			
		 		} else {
		 			$resumeName = strtotime(date('h:i:s')).'_'.$file['name'];
		 			$filepath = WWW_ROOT . 'uploads/resumes/' . $resumeName;
	 				move_uploaded_file($file['tmp_name'], $filepath);
	 				$this->request->data['Candidate']['resume_file'] = $resumeName ;
		 		}
	 		} else {
	 			unset($this->request->data['Candidate']['resume_file']);
	 		}
	 		
	 		if(!$error) {	 			
	 			unset($this->Candidate->validate['email_id']);
	 			$this->request->data['Candidate']['id'] = $this->Encryption->decode($this->request->data['Candidate']['id']);
	 			$this->request->data['Candidate']['category_id'] = $this->Encryption->decode($this->request->data['Candidate']['category_id']);
	 			if ($this->Candidate->save($this->request->data)) {
	 				$this->Session->setFlash(__('Candidate has been updated successfully.'), 'flash_good');
	 				return $this->redirect(array('controller' => 'candidates', 'action' => 'index', 'admin' => true));
	 			} else {
	 				$validationErr = $this->compileErrors('Candidate');
	 				if ($validationErr != NULL) {
	 					$this->Session->setFlash($validationErr,'flash_bad');
	 				}
	 			}
	 		}
	 		
	 	}
	 	if (!$this->request->data) {
	 		$this->request->data = $candidateData;
	 	}
	 	$this->set('includePageJs',$this->includePageJs);
	 }
	 
	 public function admin_downloadResume($id = NULL)
	 {
	 	if(!$id) {
	 		return $this->redirect($this->referer());
	 	}
	 	//$this->autoRender = false;
	 	$file = $this->Candidate->findById($this->Encryption->decode($id), array('fields'=>'resume_file'));
	 	$filename = substr($file['Candidate']['resume_file'], strpos($file['Candidate']['resume_file'], '_')+1);
	 	$path = 'uploads/resumes/'.$file['Candidate']['resume_file'];
	 	
	 	$this->response->file($path, array(
	 			'download' => true,
	 			'name' => $filename,
	 	));
	 	return $this->response;
	 }
}
    
   
