<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CitiesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('get_city_list','add');
        }
        
        public function get_city_list($id,$name) {
            
                $this->autoRender = FALSE;
                $this->City->recursive = -1;
                $state = $this->City->find('all',array(
                            'conditions' => array('state_id' => $id , 'name like ' => '%'.$name.'%'),
                            'fields' => array('id','name')
                        ));
                
                $states = array();
            for ($i = 0; $i < count($state); $i++) {
                $states[$i]['label'] = $state[$i]['City']['name'];
                $states[$i]['value'] = $state[$i]['City']['id'];
            }
                
                return json_encode($states);
        }
        
        
        public function add() {
            
            $this->autoRender = FALSE; 
            if($this->request->is('POST')){
                $data = $this->request->data;
                
                $status['success'] = false;
                $this->City->set($data);
                if($this->City->save()){
                    $id = $this->City->getID();
                    $status['id'] = $id;
                    $status['success'] = true;
                }
                return json_encode($status);
            }
        }

}
