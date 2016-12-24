<?php

/**
 * Functions component for customised application functions
 */
App::uses('Component', 'Controller');

class FunctionsComponent extends Component {
    public $components = array('Session','Auth');
    public $_controller;
    /**
     * @param $string for origional string
     * @return encrypted string
     */
    public function startup(Controller $controller) {
        $this->_controller=$controller;
    }

    /**
     * @param $string for origional string
     * @return encrypted string
     */
    function encrypt($string) {
        $key = $this->pbkdf2($this->skey, $this->Auth->User('id'), 1000, 32);

        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result.=$char;
        }

        return base64_encode(base64_encode(base64_encode($result)));
    }

    /**
     * @param $string for encrypted string
     * @return original string after decryption
     */
    function decrypt($string) {

        $key = $this->pbkdf2($this->skey, $this->Auth->User('id'), 1000, 32);

        $result = '';
        $string = base64_decode(base64_decode(base64_decode($string)));

        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result.=$char;
        }

        return $result;
    }

    /** PBKDF2 Implementation (as described in RFC 2898);
     *
     *  @param string p password
     *  @param string s salt
     *  @param int c iteration count (use 1000 or higher)
     *  @param int kl derived key length
     *  @param string a hash algorithm
     *
     *  @return string derived key
     *  @example $cryptastic->pbkdf2($pass, $salt, 1000, 32);
     */
    public function pbkdf2($p, $s, $c, $kl, $a = 'sha256') {

        $hl = strlen(hash($a, null, true)); # Hash length
        $kb = ceil($kl / $hl);              # Key blocks to compute
        $dk = '';                           # Derived key
        # Create key
        for ($block = 1; $block <= $kb; $block ++) {

            # Initial hash for this block
            $ib = $b = hash_hmac($a, $s . pack('N', $block), $p, true);

            # Perform block iterations
            for ($i = 1; $i < $c; $i ++)

            # XOR each iterate
                $ib ^= ($b = hash_hmac($a, $b, $p, true));

            $dk .= $ib; # Append iterated block
        }

        # Return derived key of correct length
        return substr($dk, 0, $kl);
    }
    
    /**
     * function to get parameters for pagination
     * @param $param, $default
     * @author Mystery Man
     */
    function get_param($key, $default = '', $check_request = true, $model=NULL) {
        $params = $this->_controller->request->params;
        $request = $this->_controller->request;
        
        if ( isset($params['named'][$key]) ) {
            return $params['named'][$key];
        }
        
        if ( $check_request && isset($request->data[$key]) ) {
            if($key=="search"){
                return str_replace("%","\%",$request->data[$key]);
            }else{
                return $request->data[$key];
            }
        } elseif( $check_request && $model ) {
        	
        	if( isset($request->data[$model][$key]) && $request->data[$model][$key]!='') {
        		return $request->data[$model][$key];
        	}
        }
        
        return $default;
    }
    
    /**
     * function to get parameters for pagination
     * @param $param, $default
     * @author Mystery Man
     */
    function set_param($key) {
        $params = $this->_controller->request->params;
        if ( isset($params['named'][$key]) ) {
            $this->Session->write($key,$params['named'][$key]);
        }
    }
    
    /**
     *function used for fetching Email From field from Email Master Table
     *@params string $emailType
     *@author Mystery Man
     */
    
	function fetchEmailFrom ($emailType) {
		$model = ClassRegistry::init('EmailMaster');
		$data = $model->find('first', array('conditions'=>array('EmailMaster.email_type'=>$emailType), 'fields'=>array('EmailMaster.email_from,EmailMaster.from_name')));
		if(!empty($data)) {
			return $data['EmailMaster'];
		} else {
			return false;
		} 
	}
	
	function getPublicCoupon()
	{
		// Fetch Coupons
		$model = ClassRegistry::init('Coupon');
		$todayDate = Configure::read('CURRENT_DATE');
		$couponData = $model->find('first',array('conditions'=>array(
				'start_date <= ' => $todayDate,
				'expiry_date >= ' => $todayDate,
				'is_active' => 1,
				'coupon_type'=>'public',
				//'usage_limit != ' => 'used_count'
				)
			)
		);
		if(!empty($couponData) && $couponData['Coupon']['usage_limit'] == 0 && $couponData['Coupon']['used_count'] == 0){
			$couponData = $couponData;
		} elseif ( (!empty($couponData) && $couponData['Coupon']['used_count']  < $couponData['Coupon']['usage_limit'] ) || (!empty($couponData) && $couponData['Coupon']['usage_limit'] == 0)) {
			$couponData = $couponData;
		} elseif (!empty($couponData) && $couponData['Coupon']['used_count']  >= $couponData['Coupon']['usage_limit']) {
			$couponData = '';
		} else {
			$couponData = '';
		}
		return $couponData;
	}
}
