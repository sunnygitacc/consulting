<?php
App::uses('AppController', 'Controller');
/**
 * Countries Controller
 *
 * @property Country $Country
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CountriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

}
