<?php
App::uses('AppController', 'Controller');
/**
 * UserEducations Controller
 *
 * @property UserEducation $UserEducation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserEducationsController extends AppController {

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
                
                $years = $this->request->data['user_educations']['date_from']['year'].' - '.$this->request->data['user_educations']['date_to']['year'];
                $from = $this->request->data['user_educations']['date_from']['year'].'-'.$this->request->data['user_educations']['date_from']['month'].'-01';
                $to = $this->request->data['user_educations']['date_to']['year'].'-'.$this->request->data['user_educations']['date_to']['month'].'-01';
                $this->request->data['user_educations']['user_id'] = $this->Auth->user('id');
                $this->request->data['user_educations']['date_from']=$from;
                $this->request->data['user_educations']['date_to']= $to;

                
                $this->UserEducation->create();
                if($this->UserEducation->save($this->request->data['user_educations'])){
                   $id = $this->UserEducation->getInsertID();
                   $status['success'] = TRUE;
                   
                   $html= '<div class="edu-desc-row">'.
                            '<div class="edu-desc-row-inner">'.
                                '<div class="editPencil pencil editDummy" id="'.$id.'">&nbsp;</div>'.
                                '<div class="editPencil-remove trash" data="edu"  title="Delete" id="'.$id.'">&nbsp;</div>'.
                           


                                '<h4>'.$this->request->data['user_educations']['education'].'</h4>'.
                                '<p>'.$this->request->data['user_educations']['institute'].' ('. 
                                $this->request->data['user_educations']['university']. ' )</p>'.
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
                $this->request->data['user_education']['date_from']['day']='01';
                $this->request->data['user_education']['date_to']['day']='01';
                $years = $this->request->data['user_education']['date_from']['year'].' - '.$this->request->data['user_education']['date_to']['year'];
                
                
                $this->UserEducation->read(null, $this->request->data['user_education']['id']);
                unset($this->request->data['user_education']['id']);
                $this->UserEducation->set($this->request->data['user_education']);
                if($this->UserEducation->save()){
                     
                     
                     
                        $status = '<h4>'.$this->request->data['user_education']['education'].'</h4>'.
                                '<p>'.$this->request->data['user_education']['institute'].' ('. 
                                $this->request->data['user_education']['university']. ' )</p>'.
                                '<p>'.$years.'</p>';
                         return $status;
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
                    if($this->UserEducation->delete($data['id'])){
                        $status['success'] = TRUE;
                        
                    }
                }
                return json_encode($status);
            }
        }

}
