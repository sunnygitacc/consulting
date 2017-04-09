<?php
App::uses('AppController', 'Controller');
/**
 * GroupEvents Controller
 *
 * @property GroupEvent $GroupEvent
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GroupEventsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        
        
        public function get_events($group_id){
            
            //$this->layout = 'ajax';
            $this->autoRender = false;
            $this->GroupEvent->recursive = -1;
            $events =   $this->GroupEvent->find('all',array(
                            'conditions' => array(
                                'GroupEvent.group_id' => $group_id,
                                'GroupEvent.status' => 1
                            ),
                            'fields' => array(
                                'GroupEvent.id','GroupEvent.name as title','GroupEvent.event_start as start','GroupEvent.event_end as end','GroupEvent.color as textColor'
                            )
                        ));

            foreach($events as $index => $eve){
                
                $event[] = $eve['GroupEvent'];
            }
            echo json_encode($event);
            
            
            
        }
        
        
        
        public function add_events(){
            
            $this->autoRender = FALSE;
pr($this->request->data);
            if($this->request->is('post')){

                //check user permission
                $role_id = $this->requestAction("groups/get_group_role/".$this->request->data['user_id']."/".$this->request->data['group_id']);
                
                if($role_id == 2){
                    
                $title = $this->request->data['name'];
                $color = '#'.$this->request->data['color'];
                $start = (date('c',($this->request->data['event_start']/1000)));
                $end = (date('c',($this->request->data['event_end']/1000)));
                $allday='false';
                if(($this->request->data['event_end']-$this->request->data['event_start'])==86400000)
                {
                $allday='true';
                }
                $url = $this->request->data['url'];
                $event_id = $this->request->data['event_id'];
                $delete = $this->request->data['dele'];
                
                if($event_id ==''){
                    $event = array(
                    'group_id' => $this->request->data['group_id'],
                    'name' => $this->request->data['name'],
                    'color' => '#'.$this->request->data['color'],
                    'event_start' => date('c',($this->request->data['event_start']/1000)),
                    'event_end' => date('c',($this->request->data['event_end']/1000)),
                    'user_id' => $this->Auth->user('id'),
                    'status' => 1,
                    'url' => '',
                    );

                    
                    $this->GroupEvent->create();
                    if(!$this->GroupEvent->save($event)){
                        debug($this->GroupEvent->validationErrors); die();
                    }
                    
                }else{
                    $this->GroupEvent->id = $event_id;
                    $this->GroupEvent->set('name',$this->request->data['name']);
                    $this->GroupEvent->set('color',$this->request->data['color']);
                    $this->GroupEvent->save();
                    
                }
                if($delete == 1){
                    
                    $this->GroupEvent->delete($event_id);
//                    $this->GroupEvent->set('status','N');
//                    $this->GroupEvent->save();
                }
                           
                }

            }
        }
        
        
        public function get_this_events() {

            $this->autoRender = FALSE;

            if($this->request->is('post')){
                $this->GroupEvent->recursive = -1;
                $event = $this->GroupEvent->find('first',array(
                    'conditions' => array('GroupEvent.id' => $this->request->data['event_id'])
                ));

                return json_encode($event['GroupEvent']);
            }
        }

}
