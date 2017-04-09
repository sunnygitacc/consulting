<?php
App::uses('AppController', 'Controller');
/**
 * UserAwards Controller
 *
 * @property UserAward $UserAward
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserAwardsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function add() {
            $this->autoRender = FALSE;
            //$this->layout = 'ajax';
            
            if($this->request->is('ajax')){
                $status['success'] = FALSE;
                
                $years = $this->request->data['user_awards']['date_awarded']['year'];
                $from = $this->request->data['user_awards']['date_awarded']['year'].'-'.$this->request->data['user_awards']['date_awarded']['month'].'-01';
                $this->request->data['user_awards']['user_id'] = $this->Auth->user('id');
                $this->request->data['user_awards']['date_awarded'] = $from;
                
                $this->UserAward->create();
                if($this->UserAward->save($this->request->data['user_awards'])){
                   $id = $this->UserAward->getInsertID();
                   $status['success'] = TRUE;
                   
                   $html= '<div class="edu-desc-row">'.
                            '<div class="edu-desc-row-inner">'.
                                '<div class="editPencil pencil editDummy" id="'.$id.'">&nbsp;</div>'.
                                '<div class="editPencil-remove trash" data="award"  title="Delete" id="'.$id.'">&nbsp;</div>'.


                                '<h4>'.$this->request->data['user_awards']['award'].'</h4>'.
                                '<p>'.$this->request->data['user_awards']['authority'].'</p>'.
                                '<p>'.$years.'</p>'.
                            '</div>'.
                            '</div>';
                   $status['html']= $html;
                   return $html;
                }
                return FALSE;
                
                
            }
        }
        
        
        
        public function edit() {
            $this->autoRender = FALSE;
            
            if($this->request->is('ajax')){
                //pr($this->request->data);
                if($this->Auth->user('id') == $this->request->data['user_awards']['user_id']) {

              
                    $this->request->data['user_awards']['date_awarded']['day']='01';
                    $years = $this->request->data['user_awards']['date_awarded']['year'];


                    $this->UserAward->read(null, $this->request->data['user_awards']['id']);
                    unset($this->request->data['user_awards']['id']);
                    $this->UserAward->set($this->request->data['user_awards']);
                    if($this->UserAward->save()){

                            $status = '<h4>'.$this->request->data['user_awards']['award'].'</h4>'.
                                      '<p>'.$this->request->data['user_awards']['authority'].'</p>'.
                                      '<p>'.$years.'</p>';
                            return $status;
                    }
            
                }    
               
            }
            
        }
        
        
        public function delete() {
            
            $this->autoRender = FALSE;
            if($this->request->is('POST')){

                $data = $this->request->data;
                $status['success'] = FALSE;
                $status['id'] = $data['id'];
                if($data['user_id'] == $this->Auth->user('id')){
                    if($this->UserAward->delete($data['id'])){
                        $status['success'] = TRUE;
                        
                    }
                }
                return json_encode($status);
            }
        }
        

}
