<?php
App::uses('AppController', 'Controller');
/**
 * UserLogs Controller
 *
 * @property UserLog $UserLog
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserLogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function add() {
            
            $this->autoRender = FALSE;
            
        }

}
