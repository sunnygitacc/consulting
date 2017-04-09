<?php
App::uses('AppController', 'Controller');
/**
 * UserGroupFollowers Controller
 *
 * @property UserGroupFollower $UserGroupFollower
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserGroupFollowersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

}
