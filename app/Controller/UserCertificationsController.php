<?php
App::uses('AppController', 'Controller');
/**
 * UserCertifications Controller
 *
 * @property UserCertification $UserCertification
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserCertificationsController extends AppController {

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
                
                $years = $this->request->data['user_certifications']['date_certified']['year'];
                $from = $this->request->data['user_certifications']['date_certified']['year'].'-'.$this->request->data['user_certifications']['date_certified']['month'].'-01';
                $this->request->data['user_certifications']['user_id'] = $this->Auth->user('id');
                $this->request->data['user_certifications']['date_certified'] = $from;
                
                $this->UserCertification->create();
                if($this->UserCertification->save($this->request->data['user_certifications'])){
                   $id = $this->UserCertification->getInsertID();
                   $status['success'] = TRUE;
                   
                   $html= '<div class="edu-desc-row">'.
                            '<div class="edu-desc-row-inner">'.
                                '<div class="editPencil pencil editDummy" id="'.$id.'">&nbsp;</div>'.
                                '<div class="editPencil-remove trash" data="certi"  title="Delete" id="'.$id.'">&nbsp;</div>'.

                                '<h4>'.$this->request->data['user_certifications']['certification'].'</h4>'.
                                '<p>'.$this->request->data['user_certifications']['authority'].'</p>'.
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
                //pr($this->request->data);die();
                if($this->Auth->user('id') == $this->request->data['user_certifications']['user_id']) {

              
                    $this->request->data['user_certifications']['date_certified']['day']='01';
                    $years = $this->request->data['user_certifications']['date_certified']['year'];


                    $this->UserCertification->read(null, $this->request->data['user_certifications']['id']);
                    unset($this->request->data['user_certifications']['id']);
                    $this->UserCertification->set($this->request->data['user_certifications']);
                    if($this->UserCertification->save()){

                            $status = '<h4>'.$this->request->data['user_certifications']['certification'].'</h4>'.
                                      '<p>'.$this->request->data['user_certifications']['authority'].'</p>'.
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
                    if($this->UserCertification->delete($data['id'])){
                        $status['success'] = TRUE;
                        
                    }
                }
                return json_encode($status);
            }
        }
        

}
