<?php

APP::uses('Conponent','Controller');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NotifyComponent extends Component {
    
    public function __construct() {
        
        $this->User = ClassRegistry::init('User');
        $this->UserLog = ClassRegistry::init('UserLog');
        $this->Post = ClassRegistry::init('Post');
        $this->UserFriend = ClassRegistry::init('UserFriend');
    }
    
    
    public function read($user_id) {
    
        //get last logout time
        $this->UserLog->recursive = -1;
        $last_logout = $this->UserLog->find('first', array(
                    'conditions' => array(
                        'UserLog.user_id' => $user_id,
                        'UserLog.action_id != ' => 1,
                    ),
                    'order' => array('UserLog.id' => 'DESC')
                ));
        $last_login = date('Y-m-d H:i:s');
        
        if(isset($last_logout['UserLog']['date_viewed'])){
           $last_login = $last_logout['UserLog']['date_viewed']; 
        }
        
        $last_logstr = strtotime($last_login); 
        $pTime = time();
        $timeDiffer = $pTime - $last_logstr;

        $aDay = 60*60*24;
        if($aDay > $timeDiffer){
            $last_login = date('Y-m-d H:i:s',strtotime("-1 days"));
        }

        //post table 
        $Groups = $this->requestAction('user_group_relations/get_vertical_group_list/1');
        $Friends = $this->requestAction('user_friends/get_friends_id/'.$user_id);
        $mentor = $this->requestAction('user_mentor_followers/get_mentor_follower_id/'.$user_id);
        array_push($Friends, $user_id);
        $newpost = $this->Post->find('all',array(
                            'conditions' => array(
                                'OR' => array(
                                            array('Post.Postto_id' => $Friends ,'Post.wall_type' => 1),
                                            array('Post.Postto_id' => $Groups ,'Post.wall_type' => 2),
                                            array('Post.Postto_id' => $mentor ,'Post.wall_type' => 1),
                                        ),
                                'AND' => array('Post.status' => 1,'Post.date_posted >' => $last_login)

                            )
                ));
        $notify = array();
        if(count($newpost)> 0){
            foreach($newpost as $post){
                $subject = $post['Postby']['first_name'].' '.$post['Postby']['last_name'];
                $link = $post['Postby']['id'];
                $done = 'posted on your wall';
                $link = 'profiles/'.$post['Post']['id'].'/my_wall';
                if($post['Post']['wall_type']== 2 ){
                    $group_name = $post['PosttoGroup']['name']; 
                    $done = 'posted on '.$group_name.' group';
                    $link = 'groups/'.$post['Post']['id'].'/wall';
                }
                
                $date = $post['Post']['date_posted'];
                $note =array(
                    'subject' => $subject,
                    'text' => $done,
                    'link' => $link,
                    'date' => $date,
                );
                $vertical = $post['Post']['vertical_id'];
                $notify[$vertical][] = $note;
            }
        }
        
        //friend requests
        $friendRequest = $this->UserFriend->find('all', array(
                    'conditions' => array(
                        'UserFriend.user_id_b' => $user_id,
                        'UserFriend.date_requested > ' => $last_login,
                    ),
                ) );


            foreach($friendRequest as $friend){
                
                $FriendId = $friend['UserFriend']['user_id_b'];
                $this->User->recursive = -1;
                $user = $this->User->find('first',array(
                            'conditions' => array('User.id' => $friend['UserFriend']['user_id_a'])
                        ));
                
                $note =array(
                    'subject' => $user['User']['first_name'].' '.$user['User']['last_name'],
                    'text' => 'Requeted for friendship',
                    'link' => 'profiles/'.$user['User']['id'],
                    'date' => $friend['UserFriend']['date_requested'],
                );
                $notify['request'][] = $note;
                
            }
            
        //group request    
        $users = $this->requestAction('user_group_relations/get_my_own_group/'.$user_id);
       
        return $notify;
    }
    
    public function hi() {
        echo 'sdfsf dfgdsg sgf sag';
    }
    
}

