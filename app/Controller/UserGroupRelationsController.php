<?php
App::uses('AppController', 'Controller');
/**
 * UserGroupRelations Controller
 *
 * @property UserGroupRelation $UserGroupRelation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserGroupRelationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function get_vertical_group_list ($vertical = 0){
            
            $this->autoRender = FALSE;

            $vertical= $this->UserGroupRelation->query("SELECT groups.* FROM user_group_relations "
                    . " JOIN groups  ON (user_group_relations.group_id = groups.id )"
                    . " JOIN sub_categories  ON (groups.sub_category_id = sub_categories.id )"
                    . " JOIN categories  ON (sub_categories.category_id = categories.id )  WHERE user_group_relations.user_id = "
                    . $this->Auth->user('id')
                    . " AND categories.vertical_id = $vertical");
            
            $group_list = array();
            for($i=0; $i < count($vertical); $i++){
                
                $group_list[] = $vertical[$i]['groups']['id'];
            }
            
            return (array_unique($group_list));
        }
        
        public function add() {
            $this->autoRender = false;
            if($this->request->is('POST')){
                $data = $this->request->data;
                $data['rolesetby_id'] = $this->Auth->user('id'); 
                $data['status'] = 5; 
                $data['invitedby_id'] = $this->Auth->user('id'); 
                $data['date_invited'] = date('Y-m-d H:i:s'); 
                
                $this->UserGroupRelation->recursive = -1;
                $old_mem = $this->UserGroupRelation->find('first',array(
                            'conditions' => array(
                                'UserGroupRelation.user_id' => $data['user_id'],
                                'UserGroupRelation.group_id' => $data['group_id'],
                                'UserGroupRelation.role_id' => $data['role_id']
                            )
                        ));
                $ret = array();
                
                if(isset($old_mem['UserGroupRelation'])){
                    if($old_mem['UserGroupRelation']['status'] == 2 || $old_mem['UserGroupRelation']['status'] == 3){
                        $this->UserGroupRelation->id =$old_mem['UserGroupRelation']['id'];
                        $this->UserGroupRelation->set('status',5);
                        $this->UserGroupRelation->save();
                        
                        $ret['div'] = $data['user_id'];
                        $ret['id'] = $old_mem['UserGroupRelation']['id'];
                        return json_encode($ret);
                    }
                    
                    
                    if($old_mem['UserGroupRelation']['status'] == 5){
                        $ret['div'] = $data['user_id'];
                        $ret['id'] = $old_mem['UserGroupRelation']['id'];
                        return json_encode($ret);
                    }
                }else{
                    $this->UserGroupRelation->create();
                    $this->UserGroupRelation->set($data);
                    if($this->UserGroupRelation->save()){

                        $id = $this->UserGroupRelation->getLastInsertId();
                        $ret['div'] = $data['user_id'];
                        $ret['id'] = $id;

                        }
                    }

                return json_encode($ret);
            }
            
            
        }
        
        public function remove() {
            
            $this->autoRender = false;
            
            if($this->request->is('POST')){

                $this->UserGroupRelation->id = $this->request->data['id'];
                $this->UserGroupRelation->set('status',3);
                $this->UserGroupRelation->save();
            }
        }
        
        public function get_my_own_group($user_id) {
            

            $users =  $this->UserGroupRelation->find('all',array(
                        'conditions' => array(
                            'UserGroupRelation.user_id' => $user_id,
                            'UserGroupRelation.role_id' => 2
                        ),
                        'fields' => array('UserGroupRelation.group_id')
                    ));
            
            $my_groups = array();
            foreach($users as $user){
                $my_groups[] = $user['UserGroupRelation']['group_id'];
            }
            
            return $my_groups;
        }
        
        
        public function groups_under_category($category) {
            
            $user_id = $this->Auth->user('id');
            
            $groups =  $this->UserGroupRelation->find('all',array(
                        'conditions' => array(
                            'UserGroupRelation.user_id' => $user_id,
                            'Group.sub_category_id' => $category
                        ),
   
                    ));
            
            return $groups;
            
            
        }

}