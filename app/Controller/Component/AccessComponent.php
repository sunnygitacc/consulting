<?php
App::uses('Component', 'Controller');

class AccessComponent extends Component {



        public function __construct() {
            

            $this->UserLog = ClassRegistry::init('UserLog');
            $this->UserGroupRelation = ClassRegistry::init('UserGroupRelation');
            $this->RolePermissionRelation = ClassRegistry::init('RolePermissionRelation');
            $this->UserFriend = ClassRegistry::init('UserFriend');

            
        }
        
        public function get_my_role($url){

            switch ($url['controller']){
                case 'groups':
                case 'team':
                    $role = $this->group_pages($url);
                    break;
                
                case 'ambitions':
                case 'hobbies':
                case 'teams':
                    $role = 2;
                    break;
                
                case 'posts':
                    $role = 2;
                    break;
                
                case 'profiles':
                    $role = $this->get_visitor_role($url);
                    break;
                
                 case 'creativity':
                    $role = $this->get_visitor_role($url);
                    break;
                
                case 'mentor':
                    $role = $this->mentor_page($url);
                    break;
                default :
                    $role = 4;
            }
                                 
            $this->RolePermissionRelation->recursive = -1;
            $permissions =  $this->RolePermissionRelation->find('all',array(
                    'conditions' => array(
                        'RolePermissionRelation.role_id' => $role
                    )
                ));
            $per_array = array();
            foreach($permissions as $permission){
               $per_array[] =  $permission['RolePermissionRelation']['permission_id'];
            }
           
            return $per_array;
            
        }
        
        
        public function group_pages($url) {
            if($url['action'] == 'index'){
                //'groups/index'
                $group_id = $url['id'];
                $this->UserGroupRelation->recursive = -1;
                    $roles =  $this->UserGroupRelation->find('first', array(
                                'conditions' => array(
                                    'UserGroupRelation.user_id' => AuthComponent::user('id'),
                                    'UserGroupRelation.group_id' => $url['id'],
                                    'UserGroupRelation.status' => 1,
                                    ),
                                'order' => array('UserGroupRelation.role_id' => 'ASC')
                            ));
                if(isset($roles['UserGroupRelation']['role_id'])){
                    return $roles['UserGroupRelation']['role_id'];
                }
                return 4;

            }

            return 4;
        }
        
        
        public function get_visitor_role($url) {
            if($url['action'] == 'index'){
                $visitor_id = AuthComponent::user('id');
                if(isset($url['pass'][0])){
                  $visitor_id = $url['pass'][0];    
                }
                
                if(AuthComponent::user('id') == $visitor_id){
                    return 2;
                }
                $is_fnd =  $this->UserFriend->find('count',array(
                       'conditions' => array(
                           'OR' => array(
                               array('UserFriend.user_id_a' => $visitor_id ,'UserFriend.user_id_b' => AuthComponent::user('id') ),
                               array('UserFriend.user_id_b' => $visitor_id ,'UserFriend.user_id_a' => AuthComponent::user('id') )
                           ),
                           'AND' => array(
                               array('UserFriend.request_status' => 1 )
                           )
                       ) 
                    ));
                if($is_fnd > 0){
                    return 3;
                }
                return 4;
            }
        }
        
        public function mentor_page($url) {
            
            if($url['action'] == 'index'){
                if(isset($url['pass'][0])){
                    if($url['pass'][0] == AuthComponent::user('id')){
                        return 2;
                    }
                $followers = $this->requestAction('user_mentor_followers/get_mentor_follower_id/'.AuthComponent::user('id'));    
                    if(in_array($url['pass'][0],$followers)){
                        
                        return 3;
                    }
                    return 4;
                }
                return 2;
            }
            return 4;
        }
        
          
}