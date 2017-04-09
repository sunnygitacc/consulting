<?php
App::uses('AppController', 'Controller');
/**
 * UserWorks Controller
 *
 * @property UserWork $UserWork
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserWorksController extends AppController {

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
                

                if($this->Auth->user('id') == $this->request->data['user_work']['user_id']) {
                    $years = $this->request->data['user_work']['date_from']['year'].' - '.$this->request->data['user_work']['date_to']['year'];
                    $from = $this->request->data['user_work']['date_from']['year'].'-'.$this->request->data['user_work']['date_from']['month'].'-01';
                    $to = $this->request->data['user_work']['date_to']['year'].'-'.$this->request->data['user_work']['date_to']['month'].'-01';
                    $this->request->data['user_work']['user_id'] = $this->Auth->user('id');
                    $this->request->data['user_work']['date_from']=$from;
                    $this->request->data['user_work']['date_to']= $to;


                    $this->UserWork->create();
                    if($this->UserWork->save($this->request->data['user_work'])){
                       $id = $this->UserWork->getInsertID();
                       $status['success'] = TRUE;

                       $html= '<div class="edu-desc-row">'.
                                '<div class="edu-desc-row-inner">'.
                                    '<div class="editPencil pencil editDummy" id="'.$id.'">&nbsp;</div>'.
                                    '<div class="editPencil-remove trash" data="work"  title="Delete" id="'.$id.'">&nbsp;</div>'.


                                    '<h4>'.$this->request->data['user_work']['jobtitle'].'</h4>'.
                                    '<p>'.$this->request->data['user_work']['company']. ' )</p>'.
                                    '<p>'.$years.'</p>'.
                                '</div>'.
                                '</div>';
                       $status['html']= $html;
                       return $html;
                    }
                    return FALSE;
                
                
            }
            }
        }
        
        
        public function edit() {
            $this->autoRender = FALSE;
            
            if($this->request->is('ajax')){
                if($this->Auth->user('id') == $this->request->data['user_work']['user_id']) {

              
                    $this->request->data['user_work']['date_from']['day']='01';
                    $this->request->data['user_work']['date_to']['day']='01';
                    $years = $this->request->data['user_work']['date_from']['year'].' - '.$this->request->data['user_work']['date_to']['year'];


                    $this->UserWork->read(null, $this->request->data['user_work']['id']);
                    unset($this->request->data['user_work']['id']);
                    $this->UserWork->set($this->request->data['user_work']);
                    if($this->UserWork->save()){



                            $status = '<h4>'.$this->request->data['user_work']['jobtitle'].'</h4>'.
                                    '<p>'.$this->request->data['user_work']['company'].'</p>'.
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
                    if($this->UserWork->delete($data['id'])){
                        $status['success'] = TRUE;
                        
                    }
                }
                return json_encode($status);
            }
        }
        
        
}
