<?php
App::uses('AppController', 'Controller');
/**
 * PostTypes Controller
 *
 * @property PostType $PostType
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PostTypesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

}
