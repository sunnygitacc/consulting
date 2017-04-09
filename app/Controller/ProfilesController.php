<?php
App::uses('AppController', 'Controller', 'Post');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProfilesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Access');
        public $name = 'profile';
        public $uses = array('User');


        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->deny(); //fro user defined controllers
            
            $this->setJsVar('wall_id', $this->Auth->user('id'));
            $this->setJsVar('wall_type',1);
            $this->setJsVar('vertical_id',1);
            $this->setJsVar('user_id', $this->Auth->user('id'));
            
            
        }

        public function index() {
            
            $permission = $this->Access->get_my_role($this->request->params);
             if(!in_array(1, $permission)){
               // $this->redirect($this->referer());
             }
            $this->set('permission',$permission);

            $this->layout = 'looged_in_ui_template';
            $select = 'index';
            if(isset($this->request->params['pass'][1])){
                $select = $this->request->params['pass'][1];
            }
            $user_id = $this->Auth->user('id');
            if(isset($this->request->params['pass'][0])){
                $user_id = $this->request->params['pass'][0];
            }
            $edit = FALSE;
            if($user_id == $this->Auth->user('id')){
                
                $edit = TRUE;
            }
            $this->set('p_edit',$edit);
            
            
            $this->setJsVar('wall_id', $user_id);
            $this->setJsVar('wall_type',1);
            $this->setJsVar('vertical_id',1);

            $this->set('select',$select);
            $this->User->recursive = -1;
            $profile_user = $this->User->find('first',array('conditions' => array('id' => $user_id )));
            $this->set('user',$profile_user);

            $this->loadModel('UserGroupProfilePics');
             $query = $this->UserGroupProfilePics->find('first', array(
                    'conditions' => array( 'wall_id' => $user_id, 'wall_type' => 1, 'is_avatar' => 1, 'is_active' => 1)
             ) );
             
             $status = $this->friend_status($user_id);
             $this->set('friend_status',$status);
             $avthar1 = ''; 
             $avthar2 = ''; 
             if(!empty($query)){
                $path = $query['UserGroupProfilePics']; 
                $avthar1 = PROFILE_IMAGE_PATH_FINAL.$path['link'].'_sml.jpeg';
                $avthar2 = PROFILE_IMAGE_PATH_FINAL.$path['link'].'_mid.jpeg';

             }$this->set('avathar_sml' , $avthar1); 
             $this->set('avathar_mid' , $avthar2); 
            //get My groups 
            $groups = $this->requestAction('groups/get_user_groups/'.$user_id);

            $this->set('groups',$groups);
            
            //about user
            $this->loadModel('UserProfileStatus');
            $this->UserProfileStatus->recursive = -1;
            $status = $this->UserProfileStatus->find('first',array(
                   'conditions' => array(
                       'UserProfileStatus.user_id' => $user_id
                   ), 
                ));
            $title = '';
            if(isset($status['UserProfileStatus'])){
                $title =  $status['UserProfileStatus']['status'];
            }
           $this->set('profile_status',$title);
            
            //index page
            if($select == 'index'){
                $this->loadModel('City');
                $this->City->recursive = -1;
                $city = $this->City->find('first',array(
                    'conditions' => array('City.id' => $profile_user['User']['city'])
                )); 
                $this->set('city',$city['City']['name']);
                
                //educational details\
                $this->loadModel('UserEducation');
                $this->UserEducation->recursive = -1;
                $education = $this->UserEducation->find('all',array(
                    'conditions' => array('UserEducation.user_id' => $user_id)
                ));
                $this->set('educations',$education);
                

            }
            if($select == 'my_wall'){
                
                $Friends = $user_id;
                $Groups = array();
                $this->loadModel('Post');
                $this->Post->recursive = 1;
                $this->Paginator->settings = array('limit' => 6,
                       'order' => array('Post.id' => 'desc'),
                       'conditions' => array(
                           'OR' => array(
                                       array('Post.Postto_id' => $Friends ,'Post.wall_type' => 1),
                                       array('Post.Postto_id' => $Groups ,'Post.wall_type' => 2),
                                   ),
                           'AND' => array('Post.status' => 1)

                       )
                   );

                $data = $this->paginate('Post');
                $this->set('posts',$data);
 
                
            }
            if($select == 'friends'){
                $Friends = $this->requestAction('user_friends/get_friends_id/'.$user_id);
                
                $this->loadModel('UserGroupProfilePics');
                $user = array();
                foreach ($Friends as $friend){
                    
                    $this->User->recursive = -1;
                    $profile_user = $this->User->find('first',array('conditions' => array('id' => $friend ),
                        'fields' => array('User.id','User.first_name','User.last_name')
                        ));
                    
                    //$this->set('user',$profile_user);

                     $query = $this->UserGroupProfilePics->find('first', array(
                            'conditions' => array( 'wall_id' => $user_id, 'wall_type' => 1, 'is_avatar' => 1, 'is_active' => 1)
                     ) );
                     $pic = 'img/userReg.jpg';
                    if(isset($query['UserGroupProfilePics']['link'])){
                        $pic = PROFILE_IMAGE_PATH_FINAL.$query['UserGroupProfilePics']['link'].'_mid.jpeg';
                    }

                    $profile_user['User']['avatar'] = $pic;
                    
                    $user[] = $profile_user;
                    
                }
                $this->set('Friends',$user);
                
            }
            if($select == 'mentors'){
                
                $userMentors = $this->requestAction('user_mentor_followers/get_mentor_followers/'.$user_id);
                $this->set('menters',$userMentors);
            }
            if($select == 'media' || $select == 'media-images'){
                $this->set('select','media-images');
                $this->loadModel('Post');
                $this->Post->recursive = -1;
                $this->Paginator->settings = array('limit' => 2,
                       'order' => array('Post.id' => 'desc'),
                       'conditions' => array('Post.Postto_id' => $user_id ,'Post.wall_type' => 1,
                       'Post.status' => 1, 'Post.post_type_id' => 2

                       ),
                       'fields' => array('Post.link')
                   );

                $data = $this->paginate('Post');
                $this->set('imageArray',$data);
                
            }
            if($select == 'media-videos'){
                $this->set('select','media-videos');
                $this->loadModel('Post');
                $this->Post->recursive = 0;
                $this->Paginator->settings = array('limit' => 2,
                       'order' => array('Post.id' => 'desc'),
                       'conditions' => array('Post.Postto_id' => $user_id ,'Post.wall_type' => 1,
                       'Post.status' => 1, 'Post.post_type_id' => 3

                       ),
                       'fields' => array('Post.link','Post.title','Postby.first_name','Postby.last_name')
                   );

                $data = $this->paginate('Post');
                $this->set('videoArray',$data);
                
            }
            if($select == 'media-documents'){
                $this->set('select','media-documents');
                $this->loadModel('Post');
                $this->Post->recursive = -1;
                $this->Paginator->settings = array('limit' => 2,
                       'order' => array('Post.id' => 'desc'),
                       'conditions' => array('Post.Postto_id' => $user_id ,'Post.wall_type' => 1,
                       'Post.status' => 1, 'Post.post_type_id' => 4

                       ),
                       'fields' => array('Post.link')
                   );

                $data = $this->paginate('Post');
                $this->set('docArray',$data);
                
            }
            if($select == 'media-audio'){
                $this->set('select','media-audio');
                $this->loadModel('Post');
                $this->Post->recursive = -1;
                $this->Paginator->settings = array('limit' => 2,
                       'order' => array('Post.id' => 'desc'),
                       'conditions' => array('Post.Postto_id' => $user_id ,'Post.wall_type' => 1,
                       'Post.status' => 1, 'Post.post_type_id' => 5

                       ),
                       'fields' => array('Post.link')
                   );

                $data = $this->paginate('Post');
                $this->set('audioArray',$data);
                
            }

            
             


         

        }
        
        public function my_wall() {
            $this->layout = 'looged_in_ui_template';
            $this->set('select','my_wall');
        }
        
        public function friend_status($user_id) {
            $status = array();
            if($user_id != $this->Auth->user('id')){
                
                $this->loadModel('UserFriend');
                $friend = $this->UserFriend->find('first',array(
                            'conditions' => array(
                                'OR' => array(
                                    array('UserFriend.user_id_a' => $user_id ,'UserFriend.user_id_b' => $this->Auth->user('id') ),
                                    array('UserFriend.user_id_b' => $user_id ,'UserFriend.user_id_a' => $this->Auth->user('id') )
                                )
                            )
                        ));
                
                        $status['id'] = 0;
                        $status['word'] = 'Add Friend';
                        $status['status'] = 0;
                        
                if(isset($friend['UserFriend'])){
                    if($friend['UserFriend']['request_status'] == 0){
                        
                        if($friend['UserFriend']['user_id_a']== $this->Auth->user('id')){
                        //waiting for approvel of other
                            $status['id'] = $friend['UserFriend']['id'];
                            $status['word'] = 'Cancel Friend Requested';
                            $status['status'] = '';
                        }else{
                        //waiting for approvel of me
                            $status['id'] = $friend['UserFriend']['id'];
                            $status['word'] = 'Accept Friend Requested'; 
                            $status['status'] = 1;
                        }
                    }
                    if($friend['UserFriend']['request_status'] == 2){
                        
                            $status['id'] = $friend['UserFriend']['id'];
                            $status['word'] = 'Add Friend';
                            $status['status'] = 0;
          
                    } 
                    if($friend['UserFriend']['request_status'] == 1){
                        
                            $status['id'] = $friend['UserFriend']['id'];
                            $status['word'] = 'Remove Friend';
                            $status['status'] = '';
          
                    }

                }
               
                 return $status;       
                
            }
            
            
        }
}