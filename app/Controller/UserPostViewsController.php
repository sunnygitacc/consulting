<?php
App::uses('AppController', 'Controller','CreativityController','PostsController');
/**
 * UserPostViews Controller
 *
 * @property UserPostView $UserPostView
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserPostViewsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Log');

       
        public function add() {
            
        $this->layout = null;
        $this->autoRender = false;
        $ip = $this->Log->getRealIpAddr();
         $this->UserPostView->recursive = -1;

    $user = $this->Auth->User();
    $userid = $user['id'];
    $view_count= $this->UserPostView->find('count',array(
           'conditions'=> array(
               'UserPostView.ip_address' => $ip,
               'UserPostView.user_id' => $userid,
               'UserPostView.post_id' => $this->request->params['pass'][0]
            )
        ));


     
    if ($view_count <= 0) {
    
        $this->UserPostView->create();
                        $data = array(
                            'user_id' => $this->Auth->user('id'),
                            'post_id' => $this->request->params['pass'][0],
                            'ip_address'=> $ip,
                            'date_viewed'=> $this->request->data['date_viewed'] = date('Y-m-d H:i:s')
                                );
                               
                                 $this->UserPostView->save($data);
    }
}

}
