<?php

/**
 * User Model
 *
 * PHP version 5
 *
 * @category Model
 * @version  1.0
 * @author Laxmi Saini
 */
App::uses('AppModel', 'Model');

class Company extends AppModel 
{
    

	/**
	 * Model validations
	 *
	 * @access Public
	 *
	 */
	public $validate = array (
		'email_id' => array (
    		'required' => array (
    			'rule' => 'notEmpty',
    			'message' => 'This field is required'
    		),
            'email' => array (
                'rule' => 'email',
                'message' => 'Please enter valid email address'
            )
		),
		'fname' => array(
				'required' => array(
					'rule' => 'notEmpty',
					'message' => 'This field is required'
			),
		),
		'lname' => array(
				'required' => array(
						'rule' => 'notEmpty',
						'message' => 'This field is required'
				)
		)
	);
	
	public $hasOne = array(
			'Category' => array(
					'className' => 'ProfessionCategory',
					'fields'	=> 'id,name',
					'foreignKey' => false,
					'conditions' => array('Category.id = Company.category_id'),
			),);
	
    
}
