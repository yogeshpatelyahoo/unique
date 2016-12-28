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

class Assignment extends AppModel 
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
			'Company' => array(
					'className' => 'Company',
					'fields'	=> array('Company.name'),
					'foreignKey' => false,
					'conditions' => array('Assignment.company_id = Company.id'),
			),
			'Candidate' => array(
					'className' => 'Candidate',
					'foreignKey' => false,
					'conditions' => array('Assignment.candidate_id = Candidate.id'),
					'fields' => array('Candidate.fname','Candidate.lname')
			)
	);
	
    
}
