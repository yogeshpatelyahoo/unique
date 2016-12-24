<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'users', 'action' => 'login', 'admin'=>true));
	Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'dashboard'));
	Router::connect('/businessOwners/profile', array('controller' => 'businessOwners', 'action' => 'profileDetail'));
	Router::connect('/affiliate/*', array('controller' => 'affiliates', 'action' => 'index'));
        
/**
 * @added for SEO friendly urls
 */
        $routesUrl=Router::url();
   
        $aUri = explode('/', $routesUrl);
   	if(isset($aUri[2])){
		$bControllerDash = strpos($aUri[2], '-');
	   
		$bActionDash = isset($aUri[3]) && strpos($aUri[3], '-');
	     
		if ($bControllerDash || $bActionDash) {
		    $sController = ($bControllerDash) ? str_replace('-', '_', $aUri[2]) : $aUri[2];
		    
		    $sAction = ($bActionDash) ? Inflector::variable(str_replace('-', '_', $aUri[3])) : 'index';
		    Router::connect('/' . $aUri[2] . (isset($aUri[3]) ? '/' . $aUri[3] . '/*' : ''), array(
		        'controller' => $sController,
		        'action' => $sAction
		    ));
		}
	}

    Router::connect('/admin',array('controller'=>'users','action'=>'login','admin'=>true));
    if(!empty($aUri[2]) && ($aUri[2] == 'api')) {
    	$headersInformation = getallheaders();
        if(!isset($headersInformation['CONTROL'])) { echo json_encode(array('code'=>Configure::read('RESPONSE_ERROR'),'message' => 'control not set')); die;}
        if(!isset($headersInformation['METHOD'])) { echo json_encode(array('code'=>Configure::read('RESPONSE_ERROR'),'message' => 'method not set')); die;}
        Router::connect('/api', array('controller' => $headersInformation['CONTROL'], 'action' => $headersInformation['METHOD'],'api'=>true));
    }
     

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';

    Router::mapResources('plans');
    Router::parseExtensions();
