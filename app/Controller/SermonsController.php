<?php
App::uses('AppController', 'Controller');
/**
 * Sermons Controller
 *
 * @property Sermon $Sermon
 * @property PaginatorComponent $Paginator
 */
class SermonsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
	}
	
	public function recent() {
		$response = htmlspecialchars($this->Sermon->recent());
		$this->set(compact('response'));	
	}
	
	public function search() {
		if ($this->request->is('post')) {
			$response = htmlspecialchars($this->Sermon->search("Jesus"));
			$this->Session->setFlash("posted1", 'flash_success');		
			//echo htmlspecialchars($response);
			
			$this->set(compact('response'));
		}
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Session->setFlash("posted", 'flash_success');	
		}
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('index');
		//$this->Auth->allow('view');
	}
}
