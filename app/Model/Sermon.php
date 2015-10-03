<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');

class Sermon extends AppModel {
    public $useTable = false; 
    
    public function search($q) {    
		$session = curl_init();

		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_FOLLOWLOCATION, true);

		$url = "http://razuna.nimothy.com/rest/v1/sermons/search?q=".$q;
		
		curl_setopt($session, CURLOPT_URL, $url);

		$response = curl_exec($session);

		$xml = simplexml_load_string($response);
			
    	return $response;
    }
    
    public function recent() {    
		$session = curl_init();

		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_FOLLOWLOCATION, true);

		$url = "http://razuna.nimothy.com/rest/v1/sermons/recent";
		
		curl_setopt($session, CURLOPT_URL, $url);

		$response = curl_exec($session);

		$xml = simplexml_load_string($response);
			
    	return $response;
    }
}
