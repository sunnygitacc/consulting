<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $components = array(
         'Session',
         'Auth' => array(
             'loginRedirect' => array(
                 'controller' => 'posts',
                 'action' => 'index'
             ),
             'logoutRedirect' => array(
                 'controller' => 'pages',
                 'action' => 'display',
                 'home'
             ),
             'authenticate' => array(
                 'Form' => array(
                     'passwordHasher' => 'Blowfish',
                     'fields' => array('username' => 'email')
                 )
             )
         )
     );

     public function beforeFilter() {
         $this->Auth->allow('index', 'view');
         
         
     }
     
    public function replaceURLWithHTMLLinks($text) {

        $atext = preg_replace("@((https?://)?([-\w]+\.[-\w\.]+)\w(:\d+)?(/([-\w/_\.\,]*(\?\S+)?)?)*)@", "<a target='_blank' href='$1'>$1</a>", $text);
        // echo $atext;
        return $atext;
    }
    
    var $_jsVars = array();

    public function setJsVar($name, $value)
    {
        $this->_jsVars[$name] = $value;
    }
    public function beforeRender()
    {
        // Set the jsVars array which holds the variables to be used in js
        $this->set('jsVars', $this->_jsVars);
    } 
    

    
    
}
