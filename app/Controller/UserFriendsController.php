<?php
App::uses('AppController', 'Controller');
/**
 * UserFriends Controller
 *
 * @property UserFriend $UserFriend
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserFriendsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        
        public function get_friends_id($user_id= 0) {
            $this->autoRender = False;
            if($user_id==0){$user_id = $this->Auth->user('id');}
            $Friend = $this->UserFriend->find('all',array(
            'conditions'=>array(
                'OR'=>array(array('UserFriend.user_id_a' =>$this->Auth->User('id')),
                     array('UserFriend.user_id_b' => $user_id)),
                'AND'=>array(array('UserFriend.request_status'=> 1,))
                ),
            'order'=>array('UserFriend.id'=>'ASC'),
            'fields'=>array('UserFriend.user_id_a','UserFriend.user_id_b')
            ));
            
            $this->set('friends',$Friend);
            $fri_id = array();
            foreach($Friend as $friendid)
            {
                
                $fri_id[]=$friendid['UserFriend']['user_id_a'];
                $fri_id[]=$friendid['UserFriend']['user_id_b'];
                
            }
            $unic = array_unique($fri_id);
            $index = array_search($this->Auth->user('id'),$unic);
            unset($unic[$index]);
            return ($unic);
   
        }
        
        
        public function edit_friend() {
            $this->autoRender = FALSE;
            if($this->request->is('POST')){
                $data = $this->request->data;
                if(isset($data['id'])){
                    //update /delete entry
                    if($data['request_status'] == '' ){
                        //delete
                        $this->UserFriend->delete($data['id']);
                        $re_status['id'] = 1;
                        $re_status['data_id'] = 0;
                        $re_status['word'] = 'Add Friend';
                    }else{
                        //update
                        
                        $this->UserFriend->id = $data['id'];
                        $this->UserFriend->set('request_status', (int) $data['request_status']);
                        $this->UserFriend->save();

                        $re_status['id'] = '';
                        $re_status['data_id'] = $data['id'];
                        $re_status['word'] = 'Remove Friend';
                            

                    }
                }else{
                        $this->UserFriend->create();
                        $data['date_requested'] = date('Y-m-d H:i:s');
                        $this->UserFriend->save($data);
                        
                        $re_status['data_id'] = $this->UserFriend->getInsertID();
                        $re_status['id'] = null;
                        $re_status['word'] = 'Cancel Friend Request';
                    
                }
            }
            
            return json_encode($re_status);
        }
        
        
        
        public function get_friend_list($user_id){
            

            $users = $this->get_friends_id($user_id);
            $this->loadModel('User');
            $friends = array();
            foreach($users as $user){
                
                $this->User->recursive = 0;
                $friend = $this->User->find('first',array(
                            'conditions' => array(
                                'User.id' => $user
                            )
                        ));
                $friends[] = $friend;
                
            }
            return $friends;
        }

}
