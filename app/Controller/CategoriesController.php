<?php

/**
 * Controller for Professions Manager
 */
App::uses('Email', 'Lib');
class CategoriesController extends AppController 
{
    public $paginate = array(
        'order' => array('Profession.created' => 'desc')
    );
    public $components = array('Paginator','Common');
    public $includePageJs = '';
    public $uses = array('ProfessionCategory', 'User');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }
    /**
    * profession listing 
    * @author Laxmi saini
    */
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
    		$condition = array('ProfessionCategory.name LIKE' => '%' . $search . '%');
    	} else {
    		$condition = array();
    	}
    	$this->Paginator->settings = array(
    			'conditions' => $condition,
    			'order' => $order,
    			'limit' =>$perpage
    	);
    	$categoryList = $this->Paginator->paginate('ProfessionCategory');
    	$this->set(compact('categoryList'));
    	if ($this->request->is('ajax')) {
    		$this->layout = false;
    		$this->set('perpage', $perpage);
    		$this->set('search', $search);
    		$this->render('admin_category_ajax_list');
    	}
    }


    /**
    * add profession category
    * @author Mystery Man
    */
    public function admin_addCategory() 
    {
        $this->layout = 'admin';
        $this->includePageJs = array('admin_validation');
        if ($this->request->is('post')) {
            $this->request->data['ProfessionCategory']['name'] = trim($this->request->data['ProfessionCategory']['name']);
                $this->ProfessionCategory->create();
                if ($this->ProfessionCategory->save($this->request->data)) {
                    $this->Session->setFlash(__('Your category has been added successfully.'), 'flash_good');
                    $this->redirect(array('controller' => 'categories'));
                } else {
                    $validationErr = $this->compileErrors('ProfessionCategory');
                }
        }
        $this->set('includePageJs',$this->includePageJs);
    }

    /**
    * check category exists
    * @author Mystery Man
    */
    public function admin_checkCategoryExist($categoryId = null) 
    {
		$this->autoRender = false;
		$category = $this->request->data['ProfessionCategory']['name'];
        if (!empty($categoryId)) {
            $conditions = array('ProfessionCategory.name' => $category, 'ProfessionCategory.id !=' => $this->Encryption->decode($categoryId));
        } else {
            $conditions = array('ProfessionCategory.name' => $category);
        }
		$var  = $this->ProfessionCategory->find('first', array('conditions' => $conditions));
		if ($var) {
			echo 'false';
		} else {
			echo 'true';
		}
	}

    /**
    * edit profession category
    * @param string $categoryId category id
    * @author Mystery Man
    */
    function admin_categoryEdit($categoryId = null) 
    {
        $this->layout = 'admin';
        $this->includePageJs = array('admin_validation');
        $id = $this->Encryption->decode($categoryId);
        $this->set('id', $categoryId);
        if (!$this->ProfessionCategory->exists($id)) {
            $this->Session->setFlash(__('Invalid category'), 'flash_bad');
            $this->redirect(array('controller' => 'categories', 'action' => 'index', 'admin' => true));
        }
        $categoryData = $this->ProfessionCategory->findById($id);
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['ProfessionCategory']['name'] = trim($this->request->data['ProfessionCategory']['name']);
            $this->request->data['ProfessionCategory']['id'] = $this->Encryption->decode($this->request->data['ProfessionCategory']['id']);
            $category = $this->ProfessionCategory->findByName($this->request->data['ProfessionCategory']['name']);
            if (!empty($category) && $category['ProfessionCategory']['id'] != $categoryId) {
                $this->Session->setFlash(__('Category already exists.'), 'flash_bad');
            } else {
                if ($this->ProfessionCategory->save($this->request->data)) {
                    $this->Session->setFlash(__('Your category has been updated successfully.'), 'flash_good');
                    return $this->redirect(array('controller' => 'categories', 'action' => 'index', 'admin' => true));
                } else {
                    $validationErr = $this->compileErrors('ProfessionCategory');
                    if ($validationErr != NULL) {
                        $this->Session->setFlash($validationErr,'flash_bad');
                    }
                }
            }
        }
        if (!$this->request->data) {
            $this->request->data = $categoryData;
        }
        $this->set('includePageJs',$this->includePageJs);
    }
    
    public function admin_delete($categoryId = null)
    {
    	$this->autoRender = false;
    	if ($this->request->is('ajax')) {
    		$this->set('id', $this->request->data['id']);
    		$this->set('action', 'delete');
    		$this->set('info', 'Video');
    		$this->set('popupData',$this->parsePopupVars('delete','Category'));
    		$this->render('/Elements/activate_delete_popup', 'ajax');
    	} else if ($this->request->is('post')) {
    		
    		$categoryExists = $this->ProfessionCategory->findById($this->Encryption->decode($categoryId));
    		if (!$categoryExists) {
    			$this->Session->setFlash(__('Invalid Category'), 'flash_bad');
    			$this->redirect(array('action' => 'index'));
    		} else {
    			$this->ProfessionCategory->delete($this->Encryption->decode($categoryId));
    			$this->Session->setFlash(__('Category has been deleted successfully'), 'flash_good');
    			$this->redirect(array('action' => 'index'));
    		}
    	}
    }

}
