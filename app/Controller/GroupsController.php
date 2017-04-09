<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GroupsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Access');
        
        public $uses = array('UserGroupProfilePic','Group');


        public $paginate = array(
            'fields' => array('Post.id', 'Post.title', 'Post.description', 'Post.date_posted', 'Post.link'),
            'limit' => 3,
            'order' => array(
                'Post.id' => 'DESC'
            )
        );
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->setJsVar('wall_type',2);
            $this->setJsVar('vertical_id',1);
 
        }

        public function index() {
            
            $permission = $this->Access->get_my_role($this->request->params);
             if(!in_array(1, $permission)){
               // $this->redirect($this->referer());
             }
            $this->set('permission',$permission);
            
            $this->layout = 'looged_in_ui_template';
            $group_id =$this->request->params['id'];
            
            $select = 'about';
            if(isset($this->request->params['pass'][0])){
                $select = $this->request->params['pass'][0];
            }
            $this->set('select',$select);
            $this_user['User']['id'] = $this->Auth->user('id');
            $this->set('user',$this_user);

            $this->loadModel('User');
            //user pic
             $profile_user = $this->User->find('first',array('conditions' => array('User.id' => $this->Auth->user('id') )));
             
             
             $this->UserGroupProfilePic->recursive = -1;
             $cover_pic = $this->UserGroupProfilePic->find('first',array(
                        'conditions' => array(
                            'UserGroupProfilePic.wall_type' => 2,
                            'UserGroupProfilePic.wall_id' => $group_id,
                            'UserGroupProfilePic.is_avatar' => 0,
                            'UserGroupProfilePic.is_active' => 1,
                        ),
                        'fields' => array(
                            'UserGroupProfilePic.link'
                        )
                    ));
             
             
             $avthar = ''; 
             if(!empty($cover_pic['UserGroupProfilePic']['link'])){ 
                $avthar = PROFILE_IMAGE_PATH_FINAL.$cover_pic['UserGroupProfilePic']['link'].'_sml.jpeg';

             }$this->set('avathar' , $avthar);
            $this->setJsVar('profile_pic', $avthar);
            
            
             

            $g_ver = $this->get_vertical($group_id);
            
            //check user is a member of group
            $this->loadModel('UserGroupRelation');
            $this->UserGroupRelation->recursive = 0;
            $group_members = $this->UserGroupRelation->find('all',array(
            'fields' => array('UserGroupRelation.role_alias','User.first_name','User.last_name','User.id'),
            'conditions' => array('UserGroupRelation.group_id' => $group_id, 'UserGroupRelation.status' => 1 )
             ));
            $GroupMember_id = array();
            foreach($group_members as $G_user){
                $GroupMember_id[] = $G_user['User']['id'];
            }

            if(in_array($this->Auth->user('id'), $GroupMember_id)){
               
            }
            
            if($this->request->is('post')) {

             //debug($this->request->data);die();
                // is file uploaded by http post
                if (!empty($this->request->data['Group']['file']['tmp_name']) && is_uploaded_file($this->request->data['Group']['file']['tmp_name'])) {

                    $allowedExts = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/JPG", "image/JPEG");


                        $temp = explode(".", $this->request->data['Group']['file']["name"]);

                        $extension = end($temp);

                        $file_type = $this->request->data['Group']['file']["type"];

                        if(!in_array($file_type, $allowedExts)){

                            $this->Flash->success(__('The file type is not supported.'));
                            return $this->redirect(['action' => 'profile_photo']);
                        }
                        if($this->data['Group']['file']["error"] > 0){
                            $this->Flash->success(__($this->data['file']["error"]));
                            return $this->redirect(['action' => 'profile_photo']);
                        }

                        $file_name = 'Profile_uploaded_pic'.$this->Auth->user('id') . time() . '.' . $extension;

                        if (file_exists(PROFILE_IMAGE_PATH.'process/'.$file_name)){
                            $this->Flash->success(__('File already exits'));
                            return $this->redirect(['action' => 'profile_photo']);
                        }

                        $moved = move_uploaded_file($this->request->data['Group']['file']["tmp_name"], PROFILE_IMAGE_PATH.'process/'.$file_name);
                        if(!$moved){
                            $this->Flash->success(__('File can\'t be moved'.PROFILE_IMAGE_PATH.'process/'.$file_name));
                            return $this->redirect(['action' => 'profile_photo']);
                        }
                        //debug($file_name);
                        //debug($this->request->data['Group']);
                        $pic_name = $this->image_crop($file_name, $this->request->data['Group'],$group_id);

                        $this->set('avathar' , PROFILE_IMAGE_PATH_FINAL.$pic_name.'_mid.jpeg');

                }   
                
                
                //add/ update cover pic
                   
                   if(isset($this->request->data['coverpic']['file']['name']) && !empty($this->request->data['coverpic']['file']['name'])){
                       
                       $exte = str_replace(' ', '_', $this->request->data['coverpic']['file']['name']);
                       $ext = pathinfo($this->request->data['coverpic']['file']['name'], PATHINFO_EXTENSION);
                       $picname = 'cover_pic'.$this->Auth->user('id').time();
                       $newFileName = GROUP_COVER_PIC.$picname;
                       $tmpname = $this->request->data['coverpic']['file']["tmp_name"];
                       $img_info = getimagesize($tmpname);
                            $width = $img_info[0];
                            $height = $img_info[1];
                            
                        switch ($img_info[2]) {
                          case IMAGETYPE_GIF  : $src = imagecreatefromgif($tmpname);  break;
                          case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($tmpname); break;
                          case IMAGETYPE_PNG  : $src = imagecreatefrompng($tmpname);  break;
                          default : die("Unknown filetype");
                        }

                        $tmp = imagecreatetruecolor($width, $height);
                        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
                        
                        if(imagejpeg($tmp, $newFileName.".jpg")){
                      
                           $this->UserGroupProfilePic->recursive = -1;
                            if($this->UserGroupProfilePic->find('first',array(
                                'conditions' => array(
                                    'UserGroupProfilePic.wall_type' => 2,
                                    'UserGroupProfilePic.wall_id' => $group_id,
                                    'UserGroupProfilePic.is_avatar' => 0,
                                    'UserGroupProfilePic.is_active' => 1,
                                        )
                            ))){
                                $this->UserGroupProfilePic->recursive = -1;
                            $this->UserGroupProfilePic->updateALL(array('UserGroupProfilePic.top' => '"'.$this->request->data['coverpic']['top'].'"',
                                            'UserGroupProfilePic.left' => '"'.$this->request->data['coverpic']['left'].'"',
                                            'UserGroupProfilePic.link' => '"'.$picname.'"'
                                            ),
                                            array(
                                    'UserGroupProfilePic.wall_type' => 2,
                                    'UserGroupProfilePic.wall_id' => $group_id,
                                    'UserGroupProfilePic.is_avatar' => 0,
                                    'UserGroupProfilePic.is_active' => 1,
                                    ));

                            }else{
                                
                                //debug($this->request->data);die();
                                $this->UserGroupProfilePic->create();
                                $GroupProfile= array('wall_id' => $group_id,
                                    'wall_type' => 2 ,
                                    'left' => $this->request->data['coverpic']['left'] ,
                                    'top' => $this->request->data['coverpic']['top'] ,
                                    'link' => $picname,
                                    'is_active' => 1
                                    );
                                //pr($GroupProfile);
                                $this->UserGroupProfilePic->save($GroupProfile);
                            }

  
                       }
                       
                   }elseif(isset($this->request->data['coverpic']['top'])){
                       //pr($this->request->data);
                       if($this->UserGroupProfilePic->updateALL(array('UserGroupProfilePic.top' => "'".$this->request->data['coverpic']['top']."'",
                                                    'UserGroupProfilePic.left' => "'".$this->request->data['coverpic']['left']."'",
                                                    ),
                                                    array(
                                                        'UserGroupProfilePic.wall_id' => $group_id,
                                                        'UserGroupProfilePic.wall_type' => 2,
                                                        'UserGroupProfilePic.is_avatar' => 0,
                                                        'UserGroupProfilePic.is_active' => 1
                                                            ))){
                         $response['success'] = TRUE;
                      }else{
                          
                      }
                    }
                

            } 
            //set js variables
            $this->setJsVar('wall_id', $group_id );
            $this->setJsVar('wall_type',2);
            $this->setJsVar('vertical_id',$g_ver);
            
            $this->setJsVar('user_id',$this->Auth->user('id'));
            
            $groups = $this->requestAction('groups/get_user_groups/'.$this->Auth->user('id'));
            $this->set('groups',$groups);
            
            
            //get group details
            $this->Group->recursive = -1;
            $mygroup = $this->Group->find('first',array(
               'conditions' => array(
                   'Group.id' => $group_id 
               ), 
               'fields' => array('Group.id','Group.name','Group.description')
            ));
            
            $this->loadModel('UserGroupProfilePic');
            $this->UserGroupProfilePic->recursive = -1;
            $UserGroupProfilePic = $this->UserGroupProfilePic->find('all', array(
                'conditions' => array('UserGroupProfilePic.wall_id' => $group_id ,'UserGroupProfilePic.is_active' => 1 ),
                'fields' => array('UserGroupProfilePic.is_avatar','UserGroupProfilePic.link','UserGroupProfilePic.left','UserGroupProfilePic.top')
                        ));
            $avtar = '';
            $cover = '';
            $top = '';
            $left = '';
            if(count($UserGroupProfilePic)>0){
                //debug($UserGroupProfilePic);
                foreach($UserGroupProfilePic as $pic){
                    
                    
                    
                    if($pic['UserGroupProfilePic']['is_avatar']==1){
                        //avatar
                        $avtar = $pic['UserGroupProfilePic']['link'];
                        
                        
                    }elseif ($pic['UserGroupProfilePic']['is_avatar'] == 0) {
                        $cover = $pic['UserGroupProfilePic']['link'];    
                        $top = $pic['UserGroupProfilePic']['top'];    
                        $left = $pic['UserGroupProfilePic']['left'];    
                    }
                    
            $mygroup['Group']['cover'] = $cover;
            $mygroup['Group']['top'] = $top;
            $mygroup['Group']['left'] = $left;
            $mygroup['Group']['avatar'] = $avtar;
            $mygroup['Group']['id'] = $group_id;
                    
                }   

            
            }
            

            
            $this->set('mygroup',$mygroup);

            if($select == 'about'){
                     
            //get group members
                $groupMembers = $this->get_group_members($group_id);
                $this->set('group_members',$groupMembers);
                
            //get group members
                $groupInvitee = $this->get_invitee($group_id);
                $this->set('group_invitee' ,$groupInvitee);

            //get connected groups

                $connectedGroups = $this->get_connected_groups($group_id);
                $this->set('connectedGroups',$connectedGroups);
                
                $myCont = $this->requestAction('groups/get_connected_groups/'.$group_id);

                
                $userFriends = $this->requestAction('user_friends/get_friend_list/'.$this->Auth->user('id') );
                foreach($userFriends as $i => $s_user){
                    $ambition_categorys[$i]['label'] = $s_user['User']['first_name'].' '.$s_user['User']['last_name'];
                    $ambition_categorys[$i]['value'] = $s_user['User']['id'];
                    $ambition_categorys[$i]['img'] = $s_user['UserGroupProfilePic']['link'];
                }
                                if(!isset($ambition_categorys)){
                    $ambition_categorys =array();
                }
                $this->setJsVar('invitee',$ambition_categorys);
                $this->setJsVar('invitee_imgpath',PROFILE_IMAGE_PATH_FINAL);
                
            }
            if($select == 'wall'){
                $this->loadModel('Post');
                $con_Groups = $this->requestAction('group_group_connects/get_connected_groupid/'.$group_id);
                array_push($con_Groups, $group_id);
                $this->Paginator->settings = array('limit' => 3,
                       'order' => array('Post.id' => 'desc'),
                       'conditions' => array('Post.Postto_id' => $con_Groups ,'Post.wall_type' => 2,'Post.status' => 1
                       )
                   );

                $data = $this->paginate('Post');

                $this->set('posts',$data);
                
                
            }
            
            if($select == 'media-images'){
                $this->set('select','media-images');
                $this->loadModel('Post');
                $this->Post->recursive = -1;
                $this->Paginator->settings = array('limit' => 2,
                       'order' => array('Post.id' => 'desc'),
                       'conditions' => array('Post.Postto_id' => $group_id ,'Post.wall_type' => 2,
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
                $this->Post->recursive = -1;
                $this->Paginator->settings = array('limit' => 2,
                       'order' => array('Post.id' => 'desc'),
                       'conditions' => array('Post.Postto_id' => $this->Auth->user('id') ,'Post.wall_type' => 1,
                       'Post.status' => 1, 'Post.post_type_id' => 3

                       ),
                       'fields' => array('Post.link')
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
                       'conditions' => array('Post.Postto_id' => $this->Auth->user('id') ,'Post.wall_type' => 1,
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
                       'conditions' => array('Post.Postto_id' => $this->Auth->user('id') ,'Post.wall_type' => 1,
                       'Post.status' => 1, 'Post.post_type_id' => 5

                       ),
                       'fields' => array('Post.link')
                   );

                $data = $this->paginate('Post');
                $this->set('audioArray',$data);
                
            }
            if($select == 'more'){
                
            }


            
        }

        

        public function get_user_groups($user_id){

            $this->loadModel('UserGroupRelation');
            
            $this->Group->recursive = 0;
            $groups = $this->Group->find('all', array(
                        'fields' => array('Category.vertical_id','Group.name','Group.id','UserGroupProfilePic.link'),
                        'conditions' => array('UserGroupRelation.status' => 1,'UserGroupRelation.user_id' => $user_id,'Group.status' => 1),
                        'joins' => array(
                                array(
                                'table' => 'categories',
                                'alias' => 'Category',
                                'type' => 'LEFT',
                                'conditions' => array(
                                    'SubCategory.category_id = Category.id'
                                ) ),
                                array(
                                'table' => 'user_group_relations',
                                'alias' => 'UserGroupRelation',
                                'type' => 'LEFT',
                                'conditions' => array(
                                    'Group.id = UserGroupRelation.group_id'
                                ) )
                        )
                    ));
            $gps[1] = array();
            $gps[2] = array();
            $gps[4] = array();
            $listed_groups = array(); 
            foreach($groups as $index => $group){
                
                if(!in_array($group['Group']['id'], $listed_groups)){
                    $listed_groups[] = $group['Group']['id'];
                    $gp ['name'] = $group['Group']['name'];
                    $gp ['id'] = $group['Group']['id'];
                    $gp ['link'] = $group['UserGroupProfilePic']['link'];
                    $gp ['visibility'] = $group['UserGroupProfilePic']['link'];
                    $gps[$group['Category']['vertical_id']][] = $gp;
                    
                }

                
            }
            
            return $gps;
        }
        
        
        public function get_group_members($group_id){
            
            $this->loadModel('UserGroupRelation');
            $this->UserGroupRelation->recursive = 0;
            $group_members = $this->UserGroupRelation->find('all',array(
                        'fields' => array('UserGroupRelation.role_alias','User.first_name','User.last_name','User.id'),
                        'conditions' => array('UserGroupRelation.group_id' => $group_id, 'UserGroupRelation.status' => 1 )
                    ));
            $groupUsers = array();
            if(count($group_members) > 0){
                foreach($group_members as $user){

                    $this->loadModel('UserGroupProfilePics');
                    $query = $this->UserGroupProfilePics->find('first', array(
                        'conditions' => array('wall_id' => $user['User']['id'], 'wall_type' => 1, 'is_avatar' => 1 , 'is_active' => 1 ),
                        'fields' =>array('link')
                    ) );


                    $path = ''; 
                    if(!empty($query)){
                       $path = $query['UserGroupProfilePics']['link']; 

                       $this->set('avathar' , PROFILE_IMAGE_PATH_FINAL.$path.'_mid.jpeg');
                    }
                    $newUser = array();
                    $newUser['user_id'] = $user['User']['id'];
                    $newUser['user_name'] = $user['User']['first_name'].' '.$user['User']['last_name'];
                    $newUser['role'] = $user['UserGroupRelation']['role_alias'];
                    $newUser['img'] = PROFILE_IMAGE_PATH_FINAL.$path.'_mid.jpeg';
                    $groupUsers[] = $newUser; 
                    
                }
            }
            return $groupUsers;
        }
        
        
        public function get_invitee($group_id) {
            
            $this->loadModel('UserGroupRelation');
            $group_members = $this->UserGroupRelation->find('all',array(
                        'fields' => array('UserGroupRelation.id','UserGroupRelation.role_alias','User.first_name','User.last_name','User.id'),
                        'conditions' => array('UserGroupRelation.group_id' => $group_id,'UserGroupRelation.status' => array(4,5))
                    ));
            $groupUsers = array();
            if(count($group_members) > 0){
                foreach($group_members as $user){

                    $this->loadModel('UserGroupProfilePics');
                    $query = $this->UserGroupProfilePics->find('first', array(
                        'conditions' => array('wall_id' => $user['User']['id'], 'wall_type' => 1, 'is_avatar' => 1 , 'is_active' => 1 ),
                        'fields' =>array('link')
                    ) );


                    $path = ''; 
                    if(!empty($query)){
                       $path = $query['UserGroupProfilePics']['link']; 

                       $this->set('avathar' , PROFILE_IMAGE_PATH_FINAL.$path.'_mid.jpeg');
                    }
                    $newUser = array();
                    $newUser['user_id'] = $user['User']['id'];
                    $newUser['user_name'] = $user['User']['first_name'].' '.$user['User']['last_name'];
                    $newUser['role'] = $user['UserGroupRelation']['role_alias'];
                    $newUser['id'] = $user['UserGroupRelation']['id'];
                    $newUser['img'] = PROFILE_IMAGE_PATH_FINAL.$path.'_mid.jpeg';
                    $groupUsers[] = $newUser; 
                    
                }
            }
            return $groupUsers;
        }
        
        public function get_connected_groups($group_id){
            
            $this->loadModel('GroupGroupConnect');
            
            $connectedgroup =  $this->GroupGroupConnect->find(
                            'all',array(
                                'fields' =>array('GroupGroupConnect.group_id_from','GroupGroupConnect.group_id_to'),
                                'conditions' => array('GroupGroupConnect.request_status' => 1,
                                    'OR' => array(
                                        array('GroupGroupConnect.group_id_from' => $group_id),
                                        array('GroupGroupConnect.group_id_to' => $group_id),
                                    )
                                    )
                            )
                            );
            $connected_groups = array();
            if(count($connectedgroup)){
                foreach($connectedgroup as $gconnect){
                    $connected_group_id = $gconnect['GroupGroupConnect']['group_id_from'];
                    if($gconnect['GroupGroupConnect']['group_id_from'] == $group_id){
                        $connected_group_id = $gconnect['GroupGroupConnect']['group_id_to'];
                    }
                    
//
//                    $groups = $this->Group->query("SELECT `Group`.`id`, `Group`.`name`, `user_group_profile_pics`.`link` "
//                            ."FROM `wizespeak`.`groups` AS `Group` LEFT JOIN `wizespeak`.`user_group_profile_pics` on "
//                            ."`Group`.`id` = `user_group_profile_pics`.`wall_id`  WHERE `Group`.`id` = 6 AND "
//                            ." user_group_profile_pics.wall_type = 2 LIMIT 1");
                    
                    $groups =  $this->Group->find('first',array(
                                'joins' => array(
                                    array(
                                        'table' => 'user_group_profile_pics',
                                        'alias' => 'UserGroupProfilePic',
                                        'type' => 'LEFT',
                                        'conditions' => array(
                                            'Group.id = UserGroupProfilePic.wall_id'
                                        ) )
                                ),
                                'conditions' => array('Group.id' => $group_id,'UserGroupProfilePic.wall_type' => 2),
                            ));
                    

                  $connected_groups[] = $groups;  
                    
                }
            }
            return $connected_groups;
        }

        public function update_group_field(){
            $this->autoRender = FALSE;
            if($this->request->is('ajax')){

                //check user permission
                $role_id = $this->requestAction("groups/get_group_role/".$this->request->data['user_id']."/".$this->request->data['id']);
                
                if($role_id == 2){
                //debug($this->request->data);
                $this->Group->id = $this->request->data['id'];
                $this->Group->saveField($this->request->data['field'], $this->request->data['title']);  
                    
                    
                }
                


            }
            
        }
        
        public function get_vertical($group_id){
            
//            $groups = $this->Group->query("SELECT `categories`.`vertical_id` "
//                    ."FROM `wizespeak`.`groups` LEFT JOIN `wizespeak`.`sub_categories` on "
//                    ."`groups`.`sub_category_id` = `sub_categories`.`id`  "
//                    ."JOIN categories on "
//                    ."`categories`.`id` = `sub_categories`.`category_id`  "
//                    . "WHERE `groups`.`id` = $group_id  limit 0,1");
  
            $this->Group->recursive = 0;
            $catego =   $this->Group->find('first',array(
                        'joins' => array(

                            array(
                                'table' => 'categories',
                                'alias' => 'Category',
                                'type' => 'LEFT',
                                'conditions' => array(
                                    'SubCategory.category_id = Category.id'
                                ) 
                                )
                        ),
                        'fields' => array('Category.vertical_id'),
                        'conditions' => array('Group.id' => $group_id)
                    ));

                    
                   
            $vid = $catego['Category']['vertical_id'];
            
            return $vid;
            
        }
        
        public function image_crop($filename, $dimensions,$group_id) {


               $filepath = PROFILE_IMAGE_PATH.'process/'.$filename;
               $file = WWW_ROOT .$filepath;
               $ini_filename = WWW_ROOT .$filepath;
               $ext = pathinfo($file, PATHINFO_EXTENSION);


               if ($ext == 'png' || $ext == 'PNG') {
                   $imgFormat = imagecreatefrompng($ini_filename);
               }
               if ($ext == 'jpeg' || $ext == 'JPEG' || $ext == 'JPG' || $ext == 'jpg') {
                   $imgFormat = imagecreatefromjpeg($ini_filename);
               }
               if ($ext == 'gif' || $ext == 'JIF') {
                   $imgFormat = imagecreatefromgif($ini_filename);
               }
               if ($ext == 'bmp' || $ext == 'BMP') {
                   $imgFormat = imagecreatefromwbmp($ini_filename);
               }


               $img_xy = getimagesize($ini_filename);


               $img_x = $img_xy[0];
               $img_y = $img_xy[1];

               //ratio change
               $x_ratio = 1;
               $y_ratio = 1;
               if (intval($img_x) > 600) {

                   $x_ratio = $img_x / 600;
               }
               if (intval($img_y) > 600) {

                   $y_ratio = $img_y / 600;
               }

               if ($x_ratio > $y_ratio) {

                   $y_ratio = $x_ratio;
               } else {

                   $x_ratio = $y_ratio;
               }

               $x = $dimensions['x'];
               $y = $dimensions['y'];
               $w = $dimensions['w'];
               $h = $dimensions['h'];


               //the minimum of xlength and ylength to crop.
               $crop_measure = min(60, 60); //image size needed -constant
               // Set the content type header - in this case image/jpeg
               //header('Content-Type: image/jpeg');

               $to_crop_array = array('x' => intval($x * $x_ratio), 'y' => intval($y * $y_ratio), 'width' => intval($w * $x_ratio), 'height' => intval($h * $y_ratio));

               $thumb_im = imagecrop($imgFormat, $to_crop_array);
               $this_user_pic = 'user_profile_crop' .$this->Auth->user('id') .time() . '.jpeg';
               imagejpeg($thumb_im, PROFILE_IMAGE_PATH.'process/' . $this_user_pic, 100);

               $original_img = imagecreatefromjpeg(PROFILE_IMAGE_PATH.'process/' . $this_user_pic);

               $original_info = getimagesize(PROFILE_IMAGE_PATH.'process/' . $this_user_pic);
               $original_w = $original_info[0];
               $original_h = $original_info[1];
               //mid size
               $thumb_w_mid = PROFILE_IMAGE_MEDIUM;
               $thumb_h_mid = PROFILE_IMAGE_MEDIUM;

               //sml size
               $thumb_w_sml = PROFILE_IMAGE_SMALL;
               $thumb_h_sml = PROFILE_IMAGE_SMALL;

               $thumb_img_mid = imagecreatetruecolor($thumb_w_mid, $thumb_h_mid);
               $thumb_img_sml = imagecreatetruecolor($thumb_w_sml, $thumb_h_sml);

               $img_db_name = 'Avathar_' .$this->Auth->user('id') .time();

               //med icon
               imagecopyresampled($thumb_img_mid, $original_img, 0, 0, 0, 0, $thumb_w_mid, $thumb_h_mid, $original_w, $original_h);
               $pic_name_mid = $img_db_name. '_mid.jpeg';
               imagejpeg($thumb_img_mid, PROFILE_IMAGE_PATH.'user_pic/' . $pic_name_mid);

               //small icon
               imagecopyresampled($thumb_img_sml, $original_img, 0, 0, 0, 0, $thumb_w_sml, $thumb_h_sml, $original_w, $original_h);
               $pic_name_mid = $img_db_name. '_sml.jpeg';
               imagejpeg($thumb_img_sml, PROFILE_IMAGE_PATH.'user_pic/' . $pic_name_mid);

               if(file_exists(WWW_ROOT . $filepath)){
                      unlink(WWW_ROOT . $filepath);
               }
               if(file_exists(WWW_ROOT . PROFILE_IMAGE_PATH.'process/' . $this_user_pic)){
                      unlink(WWW_ROOT . PROFILE_IMAGE_PATH.'process/' . $this_user_pic);
               }
               imagedestroy($thumb_img_mid);
               imagedestroy($thumb_img_sml);
               imagedestroy($original_img);


               /*
                * save to da $img_db_name
                */
                    $UserGroupProfilePics = array(
                        'UserGroupProfilePics' => array( 
                            'wall_id' => $group_id,
                            'wall_type' => 2,
                            'link' => $img_db_name,
                            'is_avatar' => 1,
                            'is_active' => 1
                        )
                    );
                    $this->loadModel('UserGroupProfilePics');
                    if($this->UserGroupProfilePics->save($UserGroupProfilePics)) {
                        $id = $this->UserGroupProfilePics->getInsertID();
                        
                        $this->UserGroupProfilePics->updateAll(
                            array('UserGroupProfilePics.is_active' => 0),
                            array('id !=' => $id, 'wall_id' => $this->Auth->user('id') ,'wall_type' => 1 )
                        );
                    }
                    
                    return $img_db_name;

           }
           
           
        public function searchGroup(){
            $this->autoRender=FALSE;
            if($this->request->isPost()){
                $gids = array();
                $groupjson = array();
                $myCont = $this->requestAction('groups/get_connected_groups/'.$this->request->data['groupId']);
                foreach($myCont as $cnts){
                    $gids[] = $cnts['Group']['id'];
                }
                
                $this->Group->recursive = 0;
                $groups = $this->Group->find('all',array(
                           'conditions' => array(
                               'AND' => array(
                                   'Group.id !=' =>  $gids,
                                   'Group.status' => 1,
                                   'Group.name LIKE' => '%'.$this->request->data['searchText'].'%'
                               )
                           ),
                           'fields' => array(
                               'Group.id','Group.name','Group.description','UserGroupProfilePic.link'
                           )

                        ));


                foreach($groups as $index => $g){
                    $auto = array(
                        'DisplayName' => $g['Group']['name'],
                        'PicLocation' => '/'.MY_APP.'/'.PROFILE_IMAGE_PATH_FINAL.$g['UserGroupProfilePic']['link'].'_sml.jpeg',
                        'Reputation' => ' reput',
                        'UserUniqueid' => $g['Group']['id'],
                    );
                $groupjson[]=$auto;  


                }


                echo json_encode($groupjson);

            }
        }
        
        
        public function get_group_role($user_id,$group_id) {
            
            if(!isset($user_id) || ($user_id==0)) {
                return 4;
            }
            if(!isset($group_id) || ($group_id==0)) {
                return 4;
            }
            $this->LoadModel('UserGroupRelation');
            $relation = $this->UserGroupRelation->find('first',array(
                        'conditions' => array(
                            'UserGroupRelation.user_id' => $user_id,
                            'UserGroupRelation.group_id' => $group_id
                        )
                    ));
            
            if(!$relation){
                return 4;
               
            }
            return $relation['UserGroupRelation']['role_id'];

        }
           
           
}