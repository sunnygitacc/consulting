<?php
App::uses('AppController', 'Controller');
/**
 * UserReportAbuses Controller
 *
 * @property UserReportAbus $UserReportAbus
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserReportAbusesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function report() {
            $this->autoRender = false;
            if($this->request->is('POST')){
                $post = $this->request->data;
                $status['success'] = TRUE;
                
                $this->UserReportAbus->create();
                $report = array(
                    'user_id' => $this->Auth->user('id'),
                    'item_id' => $post['post_id'],
                    'item_type' => $post['item_type'],
                    'date_reported' => date('Y-m-d H:i:s')
                );
                $this->UserReportAbus->set($report);
                if(!$this->UserReportAbus->save()){
                    $status['success'] = FALSE;
                    debug($this->UserReportAbus->validationErrors);
                }
                return json_encode($status);
            }
        }

}
