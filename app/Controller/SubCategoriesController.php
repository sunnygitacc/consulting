<?php
App::uses('AppController', 'Controller');
/**
 * SubCategories Controller
 *
 * @property SubCategory $SubCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SubCategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function get_subcategories (){

            $this->autoRender = false;
            if ($this->request->is('post')) {
                $this->SubCategory->recursive = -1;
                $query = $this->SubCategory->find('all', array(
                            'conditions' =>array('category_id' => $this->request->data['category_id']),
                            'fields' => array('id', 'name')
                ));
  
                $sub = array();
            for ($i = 0; $i < count($query); $i++) {
                $sub[$i]['name'] = $query[$i]['SubCategory']['name'];
                $sub[$i]['id'] = $query[$i]['SubCategory']['id'];
            }
                return json_encode($sub);
            }
        }

}
