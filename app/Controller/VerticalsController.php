<?php
App::uses('AppController', 'Controller');
/**
 * Verticals Controller
 *
 * @property Vertical $Vertical
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class VerticalsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

}
