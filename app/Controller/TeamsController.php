<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */

class TeamsController extends AppController {

/**
 * Components
 *
 * @var array 9900830181
 */
	public $components = array('Paginator', 'Session', 'Access');
        
        public $uses = array('Post');


        public $paginate = array(
            'fields' => array('Post.id', 'Post.title', 'Post.description', 'Post.date_posted', 'Post.link'),
            'limit' => 3,
            'order' => array(
                'Post.id' => 'DESC'
            )
        );
        
        public function beforeFilter() {
            parent::beforeFilter();
            
            $this->setJsVar('wall_id', $this->Auth->user('id'));
            $this->setJsVar('wall_type',1);
            $this->setJsVar('vertical_id',4);
            $this->setJsVar('user_id', $this->Auth->user('id'));
            
        }

        
        public function index(){
             $permission = $this->Access->get_my_role($this->request->params);
             if(!in_array(1, $permission)){
               // $this->redirect($this->referer());
             }
            $this->set('permission',$permission);
             $this->layout = 'teams';

             if($this->request->is('POST')){
 
                 $this->loadModel('SubCategory');

                 $this->SubCategory->recursive = -1;
                 if($this->request->data['create-ambition-group']['visibility'] == 'pub'){
                    $this->SubCategory->recursive = -1;
                    $category = $this->SubCategory->find('first',array(
                                'conditions' => array(
                                    'SubCategory.name' => 'Public Team'
                                )
                            ));
                    $c_id = $category['SubCategory']['id'];
                     
                 }else{
                    
                    $category = $this->SubCategory->find('first',array(
                                'conditions' => array(
                                    'SubCategory.name' => 'Private Team'
                                )
                            ));
                            debug($category);
                    $c_id = $category['SubCategory']['id'];
                     
                 }
                 $form_data = $this->request->data['create-ambition-group'];
                 $data = array(
                     'name' => $form_data['title'],
                     'description' => $form_data['title'],
                     'sub_category_id' => $c_id,
                     'type' => 2,
                     'status' => 1,
                     'createdby_id' => $this->Auth->user('id'),
                     'date_created' => date('Y-m-d H:i:s'),
                 );
                 //debug($this->request->data);die();
                 $this->loadModel('Group');
                 $this->Group->create();
                 if($this->Group->save($data)){
                     
                    $group_id = $this->Group->getInsertId();

                    $user_group_relations = array(
                        'user_id' => $this->Auth->user('id'),
                        'group_id' => $group_id,
                        'role_id' => 2,
                        'role_alias' => 'owner',
                        'rolesetby_id' => $this->Auth->user('id'),
                        'status' => 1,
                        'invitedby_id' => $this->Auth->user('id'),
                        'date_invited' => date('Y-m-d H:i:s'),
                        'date_joined' => date('Y-m-d H:i:s'),
                        'date_roleset' => date('Y-m-d H:i:s')
                    );
                    
                    $this->loadModel('UserGroupRelation');
                    $this->UserGroupRelation->create();
                    if($this->UserGroupRelation->save($user_group_relations)){
                        
                    }else{
                        //debug($this->UserGroupRelation->invalidFields());
                    }
                    
                    
                    $GroupMembers1 = array(
                     'user_id' => $this->request->data['create-ambition-group']['select_coach_id'],
                     'group_id' => $group_id,
                     'role_id' => 2,
                     'role_alias' => 'coach',
                     'rolesetby_id' =>$this->Auth->user('id') ,
                     'status' => 5,
                     'invitedby_id' => $this->Auth->user('id'),
                     'date_invited' => date('Y-m-d H:i:s'),
                     'date_roleset' => date('Y-m-d H:i:s')
                        );
                    $this->UserGroupRelation->create();
                    if(!$this->UserGroupRelation->save($GroupMembers1)){
                        //debug($this->UserGroupRelation->invalidFields());
                    }

                    
                    $GroupMembers2 = array(
                     'user_id' => $this->request->data['create-ambition-group']['select_captain_id'],
                     'group_id' => $group_id,
                     'role_id' => 2,
                     'role_alias' => 'captain',
                     'rolesetby_id' => $this->Auth->user('id'),
                     'status' => 5,
                     'invitedby_id' => $this->Auth->user('id'),
                     'date_invited' => date('Y-m-d H:i:s'),
                     'date_roleset' => date('Y-m-d H:i:s')
                        );
                    $this->UserGroupRelation->create();
                    $this->UserGroupRelation->save($GroupMembers2);

                    $users = explode(',',$form_data['invited']);
                    
                    $members = array($this->request->data['create-ambition-group']['select_coach_id'], $this->request->data['create-ambition-group']['select_captain_id']);
                    foreach($users as $oneuser){
                        if(in_array($oneuser, $members)){
                            continue;
                        }
                        
                        $this->UserGroupRelation->create();
                        $GroupMembers = array(
                         'user_id' => $oneuser,
                         'group_id' => $group_id,
                         'role_id' => 1,
                         'role_alias' => 'member',
                         'rolesetby_id' => $this->Auth->user('id'),
                         'status' => 5,
                         'invitedby_id' => $this->Auth->user('id'),
                         'date_invited' => date('Y-m-d H:i:s'),
                         'date_roleset' => date('Y-m-d H:i:s')
                            );
                        if($this->UserGroupRelation->save($GroupMembers)){
                            $id = $this->UserGroupRelation->getInsertId();
                            
                        }else{
                            
                        }
                    }
                    
                    
                 }else{
                     
                 }
                 

                 
             }
             
             
             $this->loadModel('User');$this->User->recursive=-1;
             $profile_user = $this->User->find('first',array('conditions' => array('User.id' => $this->Auth->user('id') )));
             //debug($profile_user);
             $Groups = $this->requestAction('user_group_relations/get_vertical_group_list/4');

             $Friends = $this->requestAction('user_friends/get_friends_id/'.$this->Auth->user('id'));
             //debug($Friends);
             $this->set('friends',$Friends);
             array_push($Friends, $this->Auth->user('id'));
             $this->set('user',$profile_user);
             //pr($profile_user);
             $this->Post->recursive = 1;
             $this->Paginator->settings = array('limit' => 3,
                    'order' => array('Post.id' => 'desc'),
                    'conditions' => array(
                        'OR' => array(
                                    array('Post.Postto_id' => $Friends ,'Post.wall_type' => 1),
                                    array('Post.Postto_id' => $Groups ,'Post.wall_type' => 2)
                                ),
                        'AND' => array('Post.status' => 1,'Post.vertical_id' => 4)
          
                    )
                );

             $data = $this->paginate('Post');
             
             $this->set('posts',$data);
//pr($data);
             $this->loadModel('UserGroupProfilePics');

             $query = $this->UserGroupProfilePics->find('first', array(
                    'conditions' => array( 'wall_id' => $this->Auth->user('id'), 'wall_type' => 1, 'is_avatar' => 1, 'is_active' => 1)
             ) );

             $avthar = ''; 
             if(!empty($query)){
                $path = $query['UserGroupProfilePics']; 
                $avthar = PROFILE_IMAGE_PATH_FINAL.$path['link'].'_sml.jpeg';

             }$this->set('avathar' , $avthar);
            $this->setJsVar('profile_pic', $avthar);
            $this->setJsVar('name', $this->Auth->user('first_name').' '.$this->Auth->user('last_name'));


            /*
             * Create new ambition group
             * 
             */

            
        /*ambition category list start*/
        
            $this->loadModel('Category');
            $combobox = $this->Category->find('all', array(
                'conditions' => array( 'Category.vertical_id' => 1 )));

            for ($i = 0; $i < count($combobox); $i++) {
                $ambition_categorys[$i]['label'] = $combobox[$i]['Category']['name'];
                $ambition_categorys[$i]['value'] = $combobox[$i]['Category']['id'];
            }
            if(count($combobox)>0){
            $this->setJsVar('group_categorys',$ambition_categorys );
            }else{
             $this->setJsVar('group_categorys',array());
            }
            
            $this->loadModel('SubCategory');
            $this->SubCategory->recursive = 0;
            $combobox = $this->SubCategory->find('all');

            for ($i = 0; $i < count($combobox); $i++) {
                $ambition_categorys[$i]['label'] = $combobox[$i]['SubCategory']['name'];
                $ambition_categorys[$i]['value'] = $combobox[$i]['SubCategory']['id'];
                $ambition_categorys[$i]['refer'] = $combobox[$i]['Category']['id'];
            }            
            if(count($combobox)>0){
            $this->setJsVar('group_subcategorys',$ambition_categorys );}else{
             $this->setJsVar('group_subcategorys',array());   
            }
            
            //get My groups 
            $groups = $this->requestAction('groups/get_user_groups/'.$this->Auth->user('id'));

            $this->set('groups',$groups);
            //debug($groups);
            //get friends list for auto comple..
            foreach($Friends as $i => $F){
                $thisfriend = $this->requestAction('users/get_user_picname/'.$F);
                $myarray['label'] = $thisfriend['name'];
                $myarray['value'] = $thisfriend['id'];
                $coach[] = $myarray;

            }
            
            if(count($coach)>0){
                $this->setJsVar('GroupAdmin',$coach );
            }else{
                $this->setJsVar('GroupAdmin',array() );
            }
            
         }

}