<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

	var $modelUsed = 'User';

	function login() {
		//pr($this->Auth->password('acs333')); exit;


		$this->set('login', true);

		if ($this->request->is('post')) {


			$token = $this->User->tryLogin(
				$this->request->data['User']['email'],
				$this->request->data['User']['password']
			);
			if (!$token) {
				$this->Session->setFlash('User/pass not correct');
			} else {
				$this->Session->write('token', $token);
				$this->redirect(
					array(
						'admin' => true,
						'controller' => 'Datas',
						'action' => 'index'
					)
				);
			}


		} else {
			// before login /register. create random number for human check



		}
	}


	function home() {

	}

}
