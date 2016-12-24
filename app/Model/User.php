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

class User extends AppModel 
{
    /*public $belongsTo = array(
        'BusinessOwners' => array(
            'foreignKey' => false,
            'conditions' => array('User.id=BusinessOwners.user_id')
            ),
        'Groups' => array (
            'foreignKey' => false,
            'conditions' => array('BusinessOwners.group_id=Groups.id')
            ),
        'AvailableSlot' => array (
            'foreignKey' => false,
            'conditions' => array('BusinessOwners.group_id=AvailableSlot.type_id','AvailableSlot.type = "meetings"')
            ),
        'Subscription' => array (
            'foreignKey' => false,
            'conditions' => array('BusinessOwners.user_id=Subscription.user_id')
            )
        );
	
	public $hasOne = array(
        'BusinessOwner' => array(
            'className' => 'BusinessOwner',
        	'fields'	=> 'id,fname,lname,group_id',	
            'dependent' => true
        ),
        'Profession' => array(
			'className' => 'Profession',
			'foreignKey' => false,
			'conditions' => array('Profession.id = BusinessOwner.profession_id'),
			'fields' => array('Profession.profession_name')
			),
		'State' => array(
			'className' => 'State',
			'foreignKey' => false,
			'conditions' => array('State.state_subdivision_id = BusinessOwner.state_id'),
			'fields' => array('State.state_subdivision_name')
			),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => false,
			'conditions' => array('Country.country_iso_code_2 = BusinessOwner.country_id'),
			'fields' => array('Country.country_name')
			)
    );*/

	/**
	 * Model validations
	 *
	 * @access Public
	 *
	 */
	public $validate = array (
		'user_email' => array (
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
        'password' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'This field is required'
                ),
            'length' => array(
                'rule'      => array('between', 6, 20),
                'message'   => 'Password should be minimum 6 characters and maximum 20 characters long',
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
	
    /**
     * to encrypt password before save
     * @param array $options
     * @return boolean
     * @author Laxmi Saini
     */
    public function beforeSave($options = array()) 
    {
        if (isset($this->data['User']['new_password'])) {
            $this->data['User']['password'] = Security::hash($this->data['User']['new_password'], null, true);
        }
        return true;
    }

    /**
     * get users details by id
     * @param int $id user id
     * @return $data user data array
     * @author Mystery Man
     */
    public function userInfoById($id) 
    {
        $data  = $this->find('first',array('conditions'=>array('User.id' => $id)));
        return $data;
    }

    /**
     * get users details by id
     * @param int $id user id
     * @param array $fields the fields to be returned in result
     * @return $data user data array
     * @author Mystery Man
     */
    public function userInfo($id, $fields)
    {
        $data  = $this->find('first',array('conditions'=>array('User.id' => $id), 'fields' => $fields));
        return $data;
    }

    /**
     * get users is active or not
     * @param int $id user id
     * @return boolean
     * @author Mystery Man
     */
    public function checkUserIsActive($id)
    {
        $data  = $this->find('first',array('conditions'=>array('User.id' => $id, 'User.is_Active' => 1), 'fields' => array('User.id')));
        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * check new password and confirm password is same
     * @author Mystery Man
     */
    public function validate_passwords() {
        return $this->data[$this->alias]['new_password'] === $this->data[$this->alias]['confirm_password'];
    }
    
    /**
     * check email and confirm email are same
     * @author Mystery Man
     */
    public function validate_email() {
        return $this->data[$this->alias]['user_email'] === $this->data[$this->alias]['confirm_email_address'];
    }

}
