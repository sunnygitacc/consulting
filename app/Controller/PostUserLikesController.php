<?php
App::uses('AppController', 'Controller');
/**
 * PostUserLikes Controller
 *
 * @property PostUserLike $PostUserLike
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PostUserLikesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Log');
        
        public function add() {
            $this->autoRender = FALSE;
            if($this->request->is('ajax')){
                $status['post_id'] = $this->request->data['item_id'];
                $status['success'] = FALSE;
                
                $this->PostUserLike->recursive = -1;
                $like = $this->PostUserLike->find('first', array(
                   'conditions' => array('item_id' => $this->request->data['item_id'],'user_id' => $this->Auth->user('id') ,'item_type' => $this->request->data['item_type']) 
                    ));
                if(count($like)>0){
                    //update like
                    
                    $this->PostUserLike->id = $like['PostUserLike']['id'];
                    $this->PostUserLike->saveField('status', 1);
                    $this->Log->add($this->Auth->user('id'),5,$this->request->data['item_id'],$this->request->data['item_type'],'Post Likes');
                    $status['success'] = TRUE;
                }else{
                    //create like
                    $this->PostUserLike->create();
                    $like = array(
                        'user_id' => $this->Auth->user('id'),
                        'item_id' => $this->request->data['item_id'],
                        'item_type' => $this->request->data['item_type'],
                        'status' => 1,
                        'date_liked' => date('Y-m-d H:i:s')
                        );
                    $this->PostUserLike->set($like);
                    if($this->PostUserLike->save()){
                        $status['success'] = TRUE;
                        $this->Log->add($this->Auth->user('id'),5,$this->request->data['item_id'],$this->request->data['item_type'],'Post Likes');
                    }else{
                        
                    }
                    
                    
                }
            }
            
            $count = $this->PostUserLike->find('count', array(
                'conditions' => array('item_id' => $this->request->data['item_id'], 'item_type' => $this->request->data['item_type'],'status' => 1)
            ));
            $status['count'] = $count;
            
            return json_encode($status); 
        }
            

        public function remove() {
            $this->autoRender = FALSE;
            if($this->request->is('ajax')){
                $status['post_id'] = $this->request->data['item_id'];
                $status['success'] = FALSE;
                $this->PostUserLike->recursive = -1;
                $like = $this->PostUserLike->find('first', array(
                   'conditions' => array('item_id' => $this->request->data['item_id'],'user_id' => $this->Auth->user('id') , 'item_type' => $this->request->data['item_type']) 
            ));
                
                if(count($like)>0){
                    //update like
                    $this->PostUserLike->id = $like['PostUserLike']['id'];
                    $this->PostUserLike->saveField('status', 0);
                    $status['success'] = TRUE;
                }
            }

            $count = $this->PostUserLike->find('count', array(
                'conditions' => array('item_id' => $this->request->data['item_id'], 'item_type' => $this->request->data['item_type'],'status' => 1)
            ));
            $status['count'] = $count;
            
            
            return json_encode($status); 
        }
        
}
