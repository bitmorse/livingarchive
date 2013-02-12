<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	var $components = array('Session', 'Cookie', 'Auth', 'CurlHTTP');
	var $helpers = array('String');


	function uploadFile($folder, $file) {
		
			// list of permitted file types, this is only images but documents can be added
			$permitted = array('image/gif' => '.gif','image/jpeg' => '.jpg','image/png' => '.png');
		
			// assume filetype is false
			$typeOK = false;

			// check filetype is ok
			foreach($permitted as $type => $ending) {
				if($type == $file['type']) {
					$typeOK = true;
					$ending = $ending;
					break;
				}
			}
			
			// if file type ok upload the file
			if($typeOK) {
				move_uploaded_file($file['tmp_name'], WWW_ROOT.$folder.md5($file['name'].time()).$ending);
				return md5($file['name'].time()).$ending;
			}else{
				return false;
			}
	}

}
