<?php
App::uses('AppController', 'Controller');
/**
 * Permissions Controller
 *
 * @property Permission $Permission
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PermissionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

}
