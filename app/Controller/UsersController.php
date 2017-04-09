<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {
public $paginate = array();  //create array for record page
public $components = array( 'Search.Prg', 'Paginator', 'Session', 'Cookie', 'Log', 'Notify');
public $presetVars = true;  // using the model configuration
public function search() {
       $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->User->parseCriteria($this->Prg->parsedParams());
        $this->set('users', $this->Paginator->paginate()); }
/**
 * Components
 *
 * @var array
 */
	

        

        public function beforeFilter() {
            parent::beforeFilter();
            // Allow users to register and logout.
            $this->Auth->allow('registration', 'logout');
            $this->loadModel('UserGroupProfilePic');
        }

        public function login(){
            $this->layout='registration';


            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $this->_setCookie($this->Auth->user('id'));
                        if ($this->Auth->login()) {
                            
                            if(!$this->Auth->user('status')){
                                return $this->redirect(['action' => 'select_ambition']);
                            }
                            
                            $this->Log->add($this->Auth->user('id'),1,$this->Auth->user('id'),1,'User Login');
                            
                            if ($this->Auth->user('is_mentor') == 0) {
                                $this->redirect(array(
                                    'controller' => 'ambitions',
                                    'action' => 'index'));
                            } else {
                                $this->redirect(array(
                                    'controller' => 'mentor',
                                    'action' => 'index'));
                            }
                        }

                    $this->redirect($this->Auth->redirect());
                } else {
                    $this->Session->setFlash(__('Invalid username or password, try again'));
                }
            }
             else
            {
                $user = $this->Auth->user();
                if (empty($user))
                {
                    $cookie = $this->Cookie->read('User');                             
                    if (!is_null($cookie)) 
                    {  
                        $this->Auth->login($this->Cookie->read('User'));
                    }
                }
                else
                {
                    $this->redirect($this->Auth->redirect());
                }
            }
            if ($this->Auth->loggedIn() || $this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());

            }

            $this->set('myValue', $this->Cookie->read('User'));

            $this->Session->write('wall_owner', $this->Auth->User('id'));
            $this->Session->write('wall_group', 0);
        }


        public function logout(){
            $this->Log->add($this->Auth->user('id'),2,$this->Auth->user('id'),1,'User Login');
            $this->Cookie->delete('User');   
            return $this->redirect($this->Auth->logout());

        }

        
        protected function _setCookie($id) {
            if (!$this->request->data('User.remember_me')) {
                $this->Cookie->delete('User');
                return false;
            }
            $data = array(
                'email' => $this->request->data('User.email'),
                'password' => $this->request->data('User.password'),
                'remember_me' => $this->request->data('User.remember_me'),

            );
            $this->Cookie->write('User', $data, true, '+2 week');
            return true;
        }
        
        
        public function registration() {

            $this->layout = 'registration';
            
            $this->loadModel('Countries');
            $data = $this->Countries->find('all', array('fields' => array('id', 'name')));
            
            for ($i = 0; $i < count($data); $i++) {
                $Countries[$i]['label'] = $data[$i]['Countries']['name'];
                $Countries[$i]['value'] = $data[$i]['Countries']['id'];
            }

            
            $this->set('countries',$Countries);
            
            $user = $this->User->find('first', array('conditions' => array( 'User.id' => $this->Auth->user())));
            $this->set('user', $user);
            
            if ($this->request->is('post')) {

                $this->request->data['User']['activated'] = 1;
                $this->request->data['User']['activated'] = 1;
                if ($this->User->save($this->request->data)) {
                    //debug($this->request->data);
                    
                    return $this->redirect(['action' => 'select_ambition']);
                }
                
            }
            
        }
        
        
        public function select_ambition(){

            $this->layout = 'registration';

            $this->loadModel('Categories');

            $query = $this->Categories->find('list', array(
                'fields' => array('Categories.id', 'Categories.name'),
                'conditions' => array('Categories.vertical_id' => 1)
            ));
            
            $this->set('ambitionCategories',$query);
            
            
            $query = $this->Categories->find('list', array(
                'fields' => array('Categories.id', 'Categories.name'),
                'conditions' => array('Categories.vertical_id' => 2)
            ));
            
            $this->set('hobbyCategories',$query);
            
            $this->loadModel('UserCategoryRelations');
                    if ($this->request->is('post')) {

                         $status = FALSE;
                        if(isset($this->request->data['ambitions'])){
                            $ids = explode(',', $this->request->data['ambitions']);


                            foreach($ids as $sc_id){
                                
                                $newData = array(
                                    'UserCategoryRelations' => array(
                                    'user_id' => $this->Auth->user('id'),
                                    'sub_category_id' => $sc_id ,
                                    'vertical_id' => 1,
                                    'is_mentor' => $this->Auth->user('is_mentor'),
                                    'status' => 1
                                    )
                                );
                               
                                
                                if($this->UserCategoryRelations->save($newData)){
                                  
                                   $status = TRUE;
                                }

                            }
                        }


                        if(isset($this->request->data['hobbies'])){
                            $ids = explode(',', $this->request->data['hobbies']);


                            foreach($ids as $sc_id){
                                
                                $newData = array(
                                    'UserCategoryRelation' => array(
                                    'user_id' => $this->Auth->user('id'),
                                    'sub_category_id' => $sc_id ,
                                    'vertical_id' => 2,
                                    'is_mentor' => $this->Auth->user('is_mentor'),
                                    'status' => 1
                                    )
                                );
                                
                                $this->UserCategoryRelations->save($newData);


                            }
                        }
                        
                        if($status){
                            
                            $this->User->id = $this->Auth->user('id');
                            $this->User->saveField('status',1);
                            
                        }
                        
                        
                        return $this->redirect(['action' => 'profile_photo']);
                    }


        }
        
        
        public function profile_photo() {
               $this->layout = 'registration';


                $this->loadModel('UserGroupProfilePics');
                $query = $this->UserGroupProfilePics->find('first', array(
                    'conditions' => array('wall_id' => $this->Auth->user('id'), 'wall_type' => 1, 'is_avatar' => 1 , 'is_active' => 1 ),
                    'fields' =>array('link')
                ) );


                $path = ''; 
                if(!empty($query)){
                     $path = $query['UserGroupProfilePics']; 
                     $this->set('avathar' , PROFILE_IMAGE_PATH_FINAL.$path['link'].'_mid.jpeg');
                }


               if($this->request->is('post')) {


                   // is file uploaded by http post
                   if (!empty($this->request->data['Post']['doc_file']['tmp_name']) && is_uploaded_file($this->request->data['Post']['doc_file']['tmp_name'])) {

                       $allowedExts = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/JPG", "image/JPEG");


                           $temp = explode(".", $this->request->data['Post']['doc_file']["name"]);

                           $extension = end($temp);

                           $file_type = $this->request->data['Post']['doc_file']["type"];

                           if(!in_array($file_type, $allowedExts)){

                               $this->Flash->success(__('The file type is not supported.'));
                               return $this->redirect(['action' => 'profile_photo']);
                           }
                           if($this->data['Post']['doc_file']["error"] > 0){
                               $this->Flash->success(__($this->data['doc_file']["error"]));
                               return $this->redirect(['action' => 'profile_photo']);
                           }

                           $file_name = 'Profile_uploaded_pic'.$this->Auth->user('id') . time() . '.' . $extension;

                           if (file_exists(PROFILE_IMAGE_PATH.'process/'.$file_name)){
                               $this->Flash->success(__('File already exits'));
                               return $this->redirect(['action' => 'profile_photo']);
                           }

                           $moved = move_uploaded_file($this->request->data['Post']['doc_file']["tmp_name"], PROFILE_IMAGE_PATH.'process/'.$file_name);
                           if(!$moved){
                               $this->Flash->success(__('File can\'t be moved'.PROFILE_IMAGE_PATH.'process/'.$file_name));
                               return $this->redirect(['action' => 'profile_photo']);
                           }

                           $pic_name = $this->crop_image($file_name, $this->request->data['Post']);
                           
                           //$this->requestAction('users/crop_image/'.$file_name.'/'.$this->request->data['Post']);
                           //$pic_name = $this->image_crop($file_name, $this->request->data['Post']);
                           $this->set('avathar' , PROFILE_IMAGE_PATH_FINAL.$pic_name.'_mid.jpeg');

                   }   

               }     

        }
        

        public function image_crop($filename, $dimensions) {


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
                            'wall_id' => $this->Auth->user('id'),
                            'wall_type' => 1,
                            'link' => $img_db_name,
                            'is_avatar' => 1,
                            'is_active' => 1
                        )
                    );
                    
                    if($this->UserGroupProfilePics->save($UserGroupProfilePics)) {
                        $id = $this->UserGroupProfilePics->getInsertID();
                        
                        $this->UserGroupProfilePics->updateAll(
                            array('UserGroupProfilePics.is_active' => 0),
                            array('id !=' => $id, 'wall_id' => $this->Auth->user('id') ,'wall_type' => 1 )
                        );
                    }
                    
                    return $img_db_name;



        }
        
        public function crop_image($filename,$co_ordin){
            
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
                            'wall_id' => $this->Auth->user('id'),
                            'wall_type' => 1,
                            'link' => $img_db_name,
                            'is_avatar' => 1,
                            'is_active' => 1
                        )
                    );
                    
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

        public function post_auther($user_id = null ) {

            $this->layout = 'ajax';
            $this->autoRender = TRUE;
            $this->User->recursive = -1;
            $user = $this->User->read(array('first_name','last_name'),$user_id);
            $user_det['name'] = $user['User']['first_name'].' '.$user['User']['last_name'];
            $this->UserGroupProfilePic->recursive = -1;
            $pic = $this->UserGroupProfilePic->find('first',array(
                'conditions' => array('wall_id' => $user_id ,'wall_type' => 1, 'is_avatar' => 1 , 'is_active' => 1 ),
                'fields' => array('link')
            ));



            $user_det['pic'] = '';
            if(!empty($pic)){

                $user_det['pic'] = PROFILE_IMAGE_PATH_FINAL.$pic['UserGroupProfilePic']['link'].'_sml.jpeg';
            }
            $this->set('auther' ,$user_det);

        }


        public function comment_auther($user_id = null,$comment = '',$id = null) {

            $this->layout = 'ajax';
            $this->autoRender = TRUE;
            $this->User->recursive = -1;
            $user = $this->User->read(array('first_name','last_name'),$user_id);
            $user_det['name'] = $user['User']['first_name'].' '.$user['User']['last_name'];
            $user_det['comment'] = $comment;
            $this->UserGroupProfilePic->recursive = -1;
            $pic = $this->UserGroupProfilePic->find('first',array(
                'conditions' => array('wall_id' => $user_id ,'wall_type' => 1, 'is_avatar' => 1 , 'is_active' => 1 ),
                'fields' => array('link')
            ));
            
            $user_det['pic'] = '';
            if(!empty($pic)){

                $user_det['pic'] = PROFILE_IMAGE_PATH_FINAL.$pic['UserGroupProfilePic']['link'].'_sml.jpeg';
            }
            //get like count
            $this->loadModel('PostUserLike');
            $count = $this->PostUserLike->find('all',array(
                       'conditions' => array(
                           'PostUserLike.item_id' => $id,
                           'PostUserLike.item_type' => 2,
                           'PostUserLike.status' => 2
                       ) 
                    ));
            $like_count = count($count);
            $like_span = 'thumbs-down';
            for($i= 0;$i < $like_count;$i++){
                if($count[$i]['PostUserLike']['user_id'] == $this->Auth->user('id')){
                    $like_span='thumbs-up';
                }
            }

            $user_det['ilike'] = $like_span;
            $user_det['count'] = $like_count;
            $this->set('cmt_auther' ,$user_det);

        }
        
        public function update_personal_details() {
            
            $this->autoRender = false;
            
            if($this->request->is('ajax')){
                if($this->request->data['user_id'] == $this->Auth->user('id')){
                    
                    $this->loadModel('City');
                    $this->City->recursive = -1;
                    $city_id = $this->City->find('first',array(
                        'conditions' => array('City.name' => $this->request->data['city'])
                    ));
                    $this->request->data['city'] = $city_id['City']['id'];

                    $this->User->read(null, $this->Auth->user('id'));
                    $this->User->set($this->request->data);
                    if(!$this->User->save()){
                        
                        debug($this->User->validationErrors);
                    }
                    debug($this->request->data);
                }

                
            }
            
        }
        
        public function get_user_picname($user_id = null ) {

            $this->autoRender = FALSE;

            $this->User->recursive = -1;
            $user = $this->User->read(array('first_name','last_name'),$user_id);
            $user_det['name'] = $user['User']['first_name'].' '.$user['User']['last_name'];
            $user_det['id'] = $user_id;
            $this->UserGroupProfilePic->recursive = -1;
            $pic = $this->UserGroupProfilePic->find('first',array(
                'conditions' => array('wall_id' => $user_id ,'wall_type' => 1, 'is_avatar' => 1 , 'is_active' => 1 ),
                'fields' => array('link')
            ));



            $user_det['pic'] = '';
            if(!empty($pic)){

                $user_det['pic'] = PROFILE_IMAGE_PATH_FINAL.$pic['UserGroupProfilePic']['link'].'_sml.jpeg';
            }
            return $user_det;

        }
        
        function mycrop($src, array $rect)
        {
            $dest = imagecreatetruecolor($rect['width'], $rect['height']);
            imagecopyresized(
                $dest,
                $src,
                0,
                0,
                $rect['x'],
                $rect['y'],
                $rect['width'],
                $rect['height'],
                $rect['width'],
                $rect['height']
            );

            return $dest;
        }
        
        
        public function notifications() {
        
            $this->layout = 'ajax';
            $note = $this->Notify->read($this->Auth->user('id'));
            $this->set('note',$note);
            //pr($note);
            
        //
        }
        
        
        public function all_notifications() {
        
             $this->loadModel('User');
             $this->User->recursive = 0;
             $profile_user = $this->User->find('first',array('conditions' => array('User.id' => $this->Auth->user('id') )));


             $avthar = ''; 
             if(!empty($profile_user['UserGroupProfilePic']['link'])){ 
                $avthar = PROFILE_IMAGE_PATH_FINAL.$profile_user['UserGroupProfilePic']['link'].'_sml.jpeg';

             }
            $this->set('avathar' , $avthar);
            $this->setJsVar('profile_pic', $avthar);
            $this->setJsVar('name', $this->Auth->user('first_name').' '.$this->Auth->user('last_name'));
            $this->setJsVar('user_id', $this->Auth->user('id'));
            $this->set('user',$profile_user);
            
            
            //get My groups 
            $groups = $this->requestAction('groups/get_user_groups/'.$this->Auth->user('id'));

            $this->set('groups',$groups);
            
            $this->layout = 'notification';
            $note = $this->Notify->read($this->Auth->user('id'));
            $this->set('note',$note);
            pr($note);
            
        //
        }
        
        
        public function live() {
            $this->autoRender = FALSE;
            if($this->request->is('POST')){
                $this->Log->add($this->Auth->user('id'),1,$this->Auth->user('id'),6,'User Active');
            }
        }
        
        
    
}
