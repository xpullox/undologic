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

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
    class AppModel extends Model {
        var $actsAs = array('Containable');
        function __construct($id = false, $table = null, $ds = null) {


//            $location = '';
//            if (isset($_SERVER['HTTP_HOST'])) {
//                if (in_array($_SERVER['HTTP_HOST'], Configure::read('liveServer'))) {
//                    $location = 'LIVE';
//                } else {
//                    $location = 'LOCAL';
//                }
//            } else {
//                //command line
//                $location = 'LIVE';
//            }
//
//            //add to the bootstrap
//            //Configure::write('localServer', array('localhost'));
//            //Configure::write('liveServer', array('www.domain.com','domain.com'));
//            if (!Configure::read('liveServer')) die('add live and local server to bootstrap: app_model.php');
//
//            if ($location == 'LIVE') {
//                $this->useDbConfig = 'live';
//            } else {
//                $this->useDbConfig = 'local';
//            }

			$this->useDbConfig = 'default';

            Configure::write('DbConfig', $this->useDbConfig);
            parent::__construct($id, $table, $ds);
        }


        public function convertJsonString($str) {
			$data = trim($str);
			$data = json_decode($data, true);
			return $data;
		}
		public function jsonResponse($array, $status = 200, $message = "") {
        	$array = array(
        		'status' => $status,
				'message' => $message,
					'version' => 1
			) + $array;
        	return json_encode($array);
		}
		public function errorCodes($error_code) {

        	$messages = array(
        		404 => 'Not found, was it created ?',
				400 => 'Bad request, check how you formatted the request and try again'
			);
        	$error_code = floor($error_code);

        	if (isset($messages[$error_code])){
        		$message = $messages[$error_code];
			} else {
        		$message = "unknown";
			}
        	return $this->jsonResponse(array(), $error_code, $message);

		}
        public function writeToLog($filename, $message, $newLine = true) {
            if ($newLine) {
                $message = "\n".date('Ymd-His').' > '.$message;
            } else {
                $message = ' > '.$message;
            }
            file_put_contents(APP.'tmp/logs/'.$filename, $message, FILE_APPEND);
        }

		public function jsonCreateSelect($array) {

			$select = array();
			foreach ($array as $k => $v) {
				$select[] = array('key' => $k, 'value' => $v);
			};
			return $select;


		}
    }
