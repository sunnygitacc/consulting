<?php
App::uses('AppController', 'Controller');
/**
 * GroupGroupConnects Controller
 *
 * @property GroupGroupConnect $GroupGroupConnect
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GroupGroupConnectsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        
        public function add_group() {
            
            $status['success'] = FALSE;
            $this->autoRender = false;
            if($this->request->is('POST')){
                
                $this->request->data['requestby_user_id'] = $this->Auth->user('id');
                $this->request->data['actionby_user_id'] = $this->Auth->user('id');
                $this->request->data['date_requested'] = date('Y-m-d H:i:s');

                $result = $this->GroupGroupConnect->find('first', array(
                           'conditions' => array(
                               'GroupGroupConnect.group_id_from' => $this->request->data['group_id_from'],
                               'GroupGroupConnect.group_id_to' => $this->request->data['group_id_to']
                            ) 
                        ));
                if($result)
                $this->GroupGroupConnect->create();
                $this->GroupGroupConnect->set($this->request->data);
                if($this->GroupGroupConnect->save()){
                    $status['success'] = TRUE;
                    $status['id'] = $this->request->data['group_id_to'];
                }
                
            }
            
            return json_encode($status);
            
        }
        
        
        public function get_connected_groupid($group_id = 0)
        {
            $gro = array();
            $this->autoRender = FALSE;
            $Glist =   $this->GroupGroupConnect->find('all',array(

                        'conditions' => array(
                            'GroupGroupConnect.group_id_from' => $group_id,
                            'GroupGroupConnect.request_status' => 1
                        ),
                        'fields' => array('GroupGroupConnect.group_id_to')
                    ));
            
            foreach($Glist as $gl){
                $gro[] = $gl['GroupGroupConnect']['group_id_to'];
            }
            
            $Glist1 =   $this->GroupGroupConnect->find('all',array(

                        'conditions' => array(
                            'GroupGroupConnect.group_id_to' => $group_id,
                            'GroupGroupConnect.request_status' => 1
                        ),
                        'fields' => array('GroupGroupConnect.group_id_from')
                    ));
            
            foreach($Glist1 as $gl){
                $gro[] = $gl['GroupGroupConnect']['group_id_from'];
            }
            
            return $gro;
        }

}
