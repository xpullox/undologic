<?php
App::uses('AppController', 'Controller');
/**
 * Datas Controller
 *
 */
class DatasController extends AppController {

	////////////////////////////////////////////////// ADMIN BASIC FUNCTIONS */
	var $modelUsed = 'Data';
	var $columns = array(
		'id', 'name', 'data', 'created', 'modified'
	);

	function beforeFilter() {
		parent::beforeFilter();
		$this->set('columns', $this->columns);
		$this->set('model', $this->modelUsed);
	}

	var $searchFields = array(
		'name'
	);

	private function connectedTables() {
		//add other tables here which are connected eg if this belongs to users
		$modelUsed = $this->modelUsed;
		$users = $this->$modelUsed->User->find('list');
		$this->set('users', $users);
	}

	function admin_index() {
		$model = $this->modelUsed;

		if (!empty($this->request->data)) {
			$search = $this->request->data[ $model ][ 'search' ];
			$this->paginate = array(
				'conditions' => $this->setupSearch($this->searchFields, $model, $search)
			);
		} else {
			//by default we need a limit to init the pagination
			$this->paginate = array(
				'limit' => 5
			);
		}

		//$this->connectedTables();

		$records = $this->paginate();
		$this->set('records', $records);
	}
	function setupSearch($arrayFields, $model, $searchTerm) {
		$search = array();
		$search[ 'OR' ] = array();
		foreach ($arrayFields as $each) {
			$search[ 'OR' ][ ] = array($model . '.' . $each . ' LIKE' => '%' . $searchTerm . '%');
		}
		return $search;
	}

	function admin_view($id = NULL) {

		$model = $this->modelUsed;
		$record = $this->$model->read(NULL, $id);
		$this->set('record', $record);
	}

	function admin_edit($id = FALSE) {

		$model = $this->modelUsed;

		if (!empty($this->request->data)) {

			if ($this->$model->save($this->request->data)) {
				$this->Session->setFlash(__('Saved', TRUE));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('could not be saved', TRUE));
			}
		} elseif ($id == 'new') {

		} else {
			$this->request->data = $this->$model->read(NULL, $id);
		}

		//$this->connectedTables();

	}
	function admin_delete($id = NULL) {
		$model = $this->modelUsed;
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', TRUE));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->$model->delete($id)) {
			$this->Session->setFlash(__('deleted', TRUE));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('NOT deleted', TRUE));
		$this->redirect($this->referer());
	}

	////////////////////////////////////////////// END ADMIN BASIC FUNCTIONS */

}
