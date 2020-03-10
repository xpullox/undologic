<?php
App::uses('AppController', 'Controller');
/**
 * Tickets Controller
 *
 * @property Ticket $Ticket
 * @property PaginatorComponent $Paginator
 */
class TicketsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	//allows the user to enter the code for the reset
	function setup() {
		if (!empty($this->data)) {
			$this->redirect(array(
				'action' => 'reset', $this->data[ 'key' ]
			));
		}

		$layouts = Configure::read('Tickets.UseVendorGridLayouts');
		if (!empty($layouts)) {
			$this->assignCompanyForDomain();

			$this->showCompanyLayout();
		}

	}

	function reset($hash = FALSE, $password = NULL) {

		$this->set('login', true);

		if (empty($hash))
			$this->redirect(array('action' => 'setup'));
		//let's cleanup the old rows
		$this->Ticket->cleanUp();
		//let's check the hash and see if we have a match
		if (!empty($this->request->data)) {
			if ($this->request->data[ 'password' ] == $this->request->data[ 'passwordVerify' ]) {
				//passwords are good let's run are change
				//pr ($this->request->data);exit;
				$password = $this->Auth->password($this->request->data[ 'password' ]);
				//$password = $this->request->data['password'];
				if ($this->Ticket->changePassword($this->request->data[ 'hash' ], $password)) {
					//let's try to login
					$this->Session->setFlash(__('Your password has been changed', TRUE));
					$this->redirect('/login');
					// exit;
				} else {
					$this->Session->setFlash(__('This ticket has expired or is not valid, please create a new one', TRUE));
					$this->redirect('/forgot');
				}
			} else {
				$this->Session->setFlash(__('passwords do not match', TRUE));
			}
		} else {
			//put into a hidden variable
			$this->request->data[ 'hash' ] = $hash;
		}




	}
}
