<?php
App::uses('AppController', 'Controller');
/**
 * States Controller
 *
 * @property State $State
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class StatesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('get_state_list','add');
        }

                public function get_state_list($id,$name)
        {

                $this->autoRender = FALSE;
                $this->State->recursive = -1;
                $state = $this->State->find('all',array(
                            'conditions' => array('country_id' => $id , 'name like ' => '%'.$name.'%'),
                            'fields' => array('id','name')
                        ));
                
                $states = array();
            for ($i = 0; $i < count($state); $i++) {
                $states[$i]['label'] = $state[$i]['State']['name'];
                $states[$i]['value'] = $state[$i]['State']['id'];
            }
                
                return json_encode($states);
            
        }
        
        public function add() {
            
            $this->autoRender = FALSE; 
            if($this->request->is('POST')){
                $data = $this->request->data;
                
                $status['success'] = false;
                $this->State->set($data);
                if($this->State->save()){
                    $id = $this->State->getID();
                    $status['id'] = $id;
                    $status['success'] = true;
                }
                return json_encode($status);
            }
        }

}
