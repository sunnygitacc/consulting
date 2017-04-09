<?php
App::uses('Component', 'Controller');

class LogComponent extends Component {



        public function __construct() {
            
            $this->UserLog = ClassRegistry::init('UserLog');

        }
        
        public function add($user_id,$action_id,$wall_id,$wall_type,$extras) {
            
            $ip = $this->getRealIpAddr();
            $log = array(
                'user_id' => $user_id,
                'action_id' => $action_id,
                'wall_id' => $wall_id,
                'wall_type' => $wall_type,
                'extras' => $extras,
                'ip_address' => $ip,
                'date_viewed' => date('Y-m-d H:i:s')
            );
            
            $this->UserLog->create();
            $this->UserLog->save($log);

        }
        
        function getRealIpAddr()
            {
                if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
                {
                  $ip=$_SERVER['HTTP_CLIENT_IP'];
                }
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
                {
                  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                else
                {
                  $ip=$_SERVER['REMOTE_ADDR'];
                }
                return $ip;
            }
}