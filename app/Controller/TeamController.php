<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TeamController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Access');
        public $uses = array('Group','User');


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
            $this->setJsVar('user_id', $this->Auth->user('id'));
        }

        public function index(){
            $permission = $this->Access->get_my_role($this->request->params);
             if(!in_array(1, $permission)){
               // $this->redirect($this->referer());
             }
            $this->set('permission',$permission);
            
            $this->layout = 'teamGroup';
            $group_id = $this->request->params['id'];
            
            $select = 'about';
            if(isset($this->request->params['pass'][0])){
                $select = $this->request->params['pass'][0];
            }
            $this->set('select',$select);
            $this_user['User']['id'] = $this->Auth->user('id');
            $this->set('user',$this_user);
            $g_ver = $this->requestAction('groups/get_vertical/'.$group_id);
            
            //user pic
             $profile_user = $this->User->find('first',array('conditions' => array('User.id' => $this->Auth->user('id') )));


             $avthar = ''; 
             if(!empty($profile_user['UserGroupProfilePic']['link'])){ 
                $avthar = PROFILE_IMAGE_PATH_FINAL.$profile_user['UserGroupProfilePic']['link'].'_sml.jpeg';

             }$this->set('avathar' , $avthar);
            $this->setJsVar('profile_pic', $avthar);
            
            
            
               if($this->request->is('post')) {

                   //debug($this->request->data);
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
                           //debug($file_name);die();
                           if (file_exists(PROFILE_IMAGE_PATH.'process/'.$file_name)){
                               $this->Flash->success(__('File already exits'));
                               return $this->redirect(['action' => 'profile_photo']);
                           }

                           $moved = move_uploaded_file($this->request->data['Group']['file']["tmp_name"], PROFILE_IMAGE_PATH.'process/'.$file_name);
                           if(!$moved){
                               $this->Flash->success(__('File can\'t be moved'.PROFILE_IMAGE_PATH.'process/'.$file_name));
                               return $this->redirect(['action' => 'profile_photo']);
                           }

                           $pic_name = $this->crop_image($file_name, $this->request->data['Group'],$group_id);
                           
                           //$this->requestAction('users/crop_image/'.$file_name.'/'.$this->request->data['Post']);
                           //$pic_name = $this->image_crop($file_name, $this->request->data['Post']);
                           $this->set('avathar' , PROFILE_IMAGE_PATH_FINAL.$pic_name.'_mid.jpeg');

                   }   

               } 
            
            // 
            //set js variables
            $this->setJsVar('wall_id', $group_id );
            $this->setJsVar('wall_type',2);
            $this->setJsVar('vertical_id',$g_ver);
            
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
                'conditions' => array('UserGroupProfilePic.wall_id' => $group_id ,'UserGroupProfilePic.wall_type' => 2,'UserGroupProfilePic.is_active' => 1 ),
                'fields' => array('UserGroupProfilePic.is_avatar','UserGroupProfilePic.link')
                        ));
            $avtar = '';
            $cover = '';
            if(count($UserGroupProfilePic)>0){
                foreach($UserGroupProfilePic as $pic){
                    
                    if($pic['UserGroupProfilePic']['is_avatar']==1){
                        //avatar
                        $avtar = $pic['UserGroupProfilePic']['link'];
                    }elseif ($pic['UserGroupProfilePic']['is_avatar'] == 2) {
                        $cover = $pic['UserGroupProfilePic']['link'];    
                    }
                    
                }   
            }
            
            $mygroup['Group']['cover'] = $cover;
            $mygroup['Group']['avatar'] = $avtar;
            
            $this->set('mygroup',$mygroup);
            
            $this->loadModel('GroupEvent');
            $this->GroupEvent->recursive = -1;
            $Event_count = $this->GroupEvent->find('count', array(
                       'conditions' => array(
                           'GroupEvent.group_id' => $group_id
                       )
                   ));

            $this->set('event_count',$Event_count);
            
            if($select == 'about'){
                
            //get group members
                $groupMembers = $this->requestAction('groups/get_group_members/'.$group_id);
                $this->set('group_members',$groupMembers);
                
            //get group members
                $groupInvitee = $this->requestAction('groups/get_invitee/'.$group_id);
                $this->set('group_invitee' ,$groupInvitee);

            //get connected groups

                $connectedGroups = $this->requestAction('groups/get_connected_groups/'.$group_id);
                $this->set('connectedGroups',$connectedGroups);
                
                $userFriends = $this->requestAction('user_friends/get_friend_list/'.$this->Auth->user('id') );
                foreach($userFriends as $i => $s_user){
                    $ambition_categorys[$i]['label'] = $s_user['User']['first_name'].' '.$s_user['User']['last_name'];
                    $ambition_categorys[$i]['value'] = $s_user['User']['id'];
                    $ambition_categorys[$i]['img'] = $s_user['UserGroupProfilePic']['link'];
                }
                $this->setJsVar('invitee',$ambition_categorys);
                $this->setJsVar('invitee_imgpath',PROFILE_IMAGE_PATH_FINAL);  
                
            }
            if($select == 'wall'){
                $this->loadModel('Post');
                
                $this->Paginator->settings = array('limit' => 3,
                       'order' => array('Post.id' => 'desc'),
                       'conditions' => array('Post.Postto_id' => $group_id ,'Post.wall_type' => 2,'Post.status' => 1
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
            if($select == 'roster'){
            //get group members
                $groupMembers = $this->requestAction('groups/get_group_members/'.$group_id);
                $this->set('group_members',$groupMembers);
                //debug($groupMembers);
                
            }
             if($select == 'schedules') {

                
             }


            
        }
        
        public function crop_image($filename,$co_ordin,$group_id){
            
            App::import('Component', 'Image');
            $MyImageCom = new ImageComponent();
            $imagename =  PROFILE_IMAGE_PATH.'process/'.$filename;

                $size = $this->image_size($filename,$co_ordin);
                $x0 = $size['x0'];
                $y0 = $size['y0'];
                $x1 = $size['x1'];
                $y1 = $size['y1'];
                
                $MyImageCom->prepare($imagename);
                $MyImageCom->crop($x0,$y0,$x1,$y1);//width,height,Red,Green,Blue
                $img_db_name = 'Avathar_' .$this->Auth->user('id') .time();
                $MyImageCom->save(PROFILE_IMAGE_PATH.'process/'.$img_db_name."_s.jpeg");
                $saved = PROFILE_IMAGE_PATH.'process/'.$img_db_name."_s.jpeg";
                //mid size
                $thumb_w_mid = PROFILE_IMAGE_MEDIUM;
                $thumb_h_mid = PROFILE_IMAGE_MEDIUM;

                //sml size
                $thumb_w_sml = PROFILE_IMAGE_SMALL;
                $thumb_h_sml = PROFILE_IMAGE_SMALL;
                
                
                $MyImageCom->prepare($saved);
                $MyImageCom->resize($thumb_w_mid,$thumb_h_mid);//width,height,Red,Green,Blue
                $pic_name_mid = $img_db_name. '_mid.jpeg';
                $MyImageCom->save(PROFILE_IMAGE_PATH.'user_pic/' .$pic_name_mid);
                
                $MyImageCom->prepare($saved);
                $MyImageCom->resize($thumb_w_sml,$thumb_h_sml);//width,height,Red,Green,Blue
                $pic_name_sml = $img_db_name. '_sml.jpeg';
                $MyImageCom->save(PROFILE_IMAGE_PATH.'user_pic/' .$pic_name_sml);
                
                if(file_exists(WWW_ROOT . $saved)){
                      unlink(WWW_ROOT . $saved);
                }
                if(file_exists(WWW_ROOT . $imagename)){
                      unlink(WWW_ROOT . $imagename);
                }
                    
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
                    //debug($UserGroupProfilePics);
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

        public function image_size($filename,$co_ordin) {
            $filepath = PROFILE_IMAGE_PATH.'process/'.$filename;
                //ratio adjust
            $ini_filename = WWW_ROOT .$filepath;

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
                

               $x0 = round($co_ordin['x']*$x_ratio);
               $x1 = round($co_ordin['x1']*$x_ratio);
               $y0 = round($co_ordin['y']*$y_ratio);
               $y1 = round($co_ordin['y1']*$y_ratio);
               
               return array(
                   'x0' => $x0,
                   'y0' => $y0,
                   'x1' => $x1,
                   'y1' => $y1,
                   );
            
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
        
}