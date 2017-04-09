<?php
App::uses('AppController', 'Controller');
/**
 * UserMentorRatings Controller
 *
 * @property UserMentorRating $UserMentorRating
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserMentorRatingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function rate(){
            $this->autoRender = FALSE;
            if($this->request->is('POST')){
                $data = $this->request->data; 
                $this->UserMentorRating->recursive = -1;
                $rate = $this->UserMentorRating->find('first',array(
                    'conditions' =>array(
                        'UserMentorRating.user_id' => $data['user_id'],
                        'UserMentorRating.mentor_id' => $data['mentor_id']
                    ),
                ));
                
                $status['success'] = FALSE;
                if($rate){
                $id = $rate['UserMentorRating']['id'];
                
                $this->UserMentorRating->id = $id;
                $this->UserMentorRating->set('rating',$data['rating']);
                if($this->UserMentorRating->save()){
                    $status['success'] = TRUE;
                    $status['rate'] = $data['rating'];
                }
                
                }else{
                    $data['date_rated'] = date('Y-m-d H:i:s');
                    $this->UserMentorRating->create();
                    if($this->UserMentorRating->save($data)){
                        $status['success'] = TRUE;
                        $status['rate'] = $data['rating'];
                    }
                    
                }
                
                return json_encode($status);
                
                
            }
        }

}
