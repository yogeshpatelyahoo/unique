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

class Candidate extends AppModel 
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
    		'unique' => array (
	    		'rule' => 'isUnique',
        		'required' => 'create',
	    		'message' => 'User email already exists.'
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
	
    
}
