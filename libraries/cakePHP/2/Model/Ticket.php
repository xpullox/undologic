<?php
App::uses('AppModel', 'Model');
/**
 * Ticket Model
 *
 * @property User $User
 */
class Ticket extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function generate($user_id) {
		$ticketHash = substr(Security::hash(microtime() * 12345), 0, 12);
		$res = $this->save(array(
			'hash' => $ticketHash, 'user_id' => $user_id
		));

		return $ticketHash;

	}

	function changePassword($hash, $password) {
		if ($this->data = $this->find('first', array('conditions' => array('Ticket.hash' => $hash)))) {
			$this->data[ 'User' ][ 'password' ] = $password;

			//pr ($this->data);exit;
			//exit;
			if ($this->User->save($this->data)) {
				//let's clean up our ticket
				if ($this->delete($this->data[ 'Ticket' ][ 'id' ])) {
					return TRUE;
				}
			}
		} else {
			return FALSE;
		}
	}

	function cleanUp() {
		$date = date('Y-m-d H:i:s', strtotime("-1 hours"));
		//pr ($date);
		//let's cleaned up the expired rows
		$found = $this->find('all', array(
			'conditions' => array('Ticket.created <' => $date)
		));
		//pr ($found);exit;
		foreach ($found as $each) {
			$this->delete($each[ 'Ticket' ][ 'id' ]);
		}
	}
}
