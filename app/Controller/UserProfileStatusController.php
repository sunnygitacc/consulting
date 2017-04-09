<?php
App::uses('AppController', 'Controller');
/**
 * UserPostViews Controller
 *
 * @property UserPostView $UserPostView
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserProfileStatusController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        
        public function add_status() {
            $this->autoRender = FALSE;
            if($this->request->is('POST')){
                
                $data = $this->request->data;
                if($data['user_id'] == $this->Auth->user('id'))
                
                $status = $this->UserProfileStatus->find('first',array(
                            'conditions' => array(
                                'UserProfileStatus.user_id' => $data['user_id']
                            ),
                        ));
                if($status){
                    //update

                    
                    $this->UserProfileStatus->id = $status['UserProfileStatus']['id'];
                    $this->UserProfileStatus->set('status',$data['status']);
                    if($this->UserProfileStatus->save()){
                        $success['success'] = TRUE;
                        return json_encode($success);
                    }
                        $success['success'] = FALSE;
                        return json_encode($success);
                }else{
                    //create

                    $this->UserProfileStatus->create();
                    $this->UserProfileStatus->set($data);
                    if($this->UserProfileStatus->save()){
                        $success['success'] = TRUE;
                        return json_encode($success);
                    }
                    debug($this->UserProfileStatus->validationErrors);
                    $success['success'] = FALSE;
                    return json_encode($success);
                }
                 
                    $success['success'] = FALSE;
                    return json_encode($success);
            }
            
            
        }

}
