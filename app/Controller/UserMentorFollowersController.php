<?php
App::uses('AppController', 'Controller');
/**
 * UserMentorFollowers Controller
 *
 * @property UserMentorFollower $UserMentorFollower
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserMentorFollowersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public function index()
	{

		$this->setJsVar('wall_id', $this->request->params['id']);

		$param = $this->request->params;


		$this->Page->setPageVariable($this->request->params['id'], $this->Auth->user("id"), 0, 5);


		$id = $this->request->params['id'];

		$url1 = "/getMentorPost/" . $id . "/1";
		$posts = $this->Curl->fetchCurl($url1);

		$this->set('userPosts', $posts);

		$url1 = "/getUserFriends/" . $id;
		$json_array = $this->Curl->fetchCurl($url1);

		$this->set('userFriends', $json_array);


		$permission = $this->Access->get_my_role($this->request->params);
		if (!in_array(1, $permission)) {
			// $this->redirect($this->referer());
		}
		$this->set('permission', $permission);

		$this->layout = 'mentor';

		$select = 'index';
		if (isset($this->request->params['pass'][1])) {
			$select = $this->request->params['pass'][1];
		}
		$this->set('select', $select);
		$user_id = $this->Auth->user('id');
		if (isset($this->request->params['pass'][0])) {
			$user_id = $this->request->params['pass'][0];
		}
		$this->set('user_id', $user_id);

		$this->setJsVar('wall_id', $user_id);
		$this->setJsVar('wall_type', 1);
		$this->setJsVar('vertical_id', 1);


		//about user
		$this->loadModel('UserProfileStatus');
		$this->UserProfileStatus->recursive = -1;
		$status = $this->UserProfileStatus->find('first', array(
			'conditions' => array(
				'UserProfileStatus.user_id' => $user_id
			),
		));
		$title = '';
		if (isset($status['UserProfileStatus'])) {
			$title = $status['UserProfileStatus']['status'];
		}
		$this->set('profile_status', $title);

		//user ratings
		$this->loadModel('UserMentorRating');
		// $this->UserMentorRating->find('all')

		//check user follows mentor
		$following = FALSE;
		$i_follows = $this->requestAction('user_mentor_followers/get_mentor_follower_id/' . $this->Auth->user('id'));
		if (in_array($user_id, $i_follows)) {
			$following = true;
		}
		if ($this->Auth->user('id') == $user_id) {
			$following = '';
		}
		$this->set('is_following', $following);

		$this->User->recursive = 0;
		$user = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $user_id
			),
			'fields' => array(
				'first_name', 'last_name', 'id', 'UserGroupProfilePic.link'
			)
		));
		$this->set('user', $user);


		if ($select == 'index') {
			$id = $this->request->params['id'];

			$url1 = "/userDetails/" . $id;
			$json_array = $this->Curl->fetchCurl($url1);

			$this->set('user', $json_array);
			$this->loadModel('Post');
//                        $this->Post->recursive = 1;
//                        $this->Paginator->settings = array('limit' => 3,
//                               'order' => array('Post.id' => 'desc'),
//                               'conditions' => array(
//                                   'OR' => array(
//                                               array('Post.Postto_id' => $user_id ,'Post.wall_type' => 1)
//                                           ),
//                                   'AND' => array('Post.status' => 1, 'Post.vertical_id' => 1)
//
//                                )
//                            );

			$data = $this->paginate('Post');

			$this->set('posts', $data);
		}


		if ($select == 'about') {


		}
		if ($select == 'education') {
			$this->layout = 'mentort2';

			$this->loadModel('UserEducation');
			$this->UserEducation->recursive = -1;
			$education = $this->UserEducation->find('all', array(
				'conditions' => array('UserEducation.user_id' => $user_id)
			));
			$this->set('educations', $education);


		}
		if ($select == 'experience') {
			$this->layout = 'mentort2';

			$this->loadModel('UserWork');
			$this->UserWork->recursive = -1;
			$experience = $this->UserWork->find('all', array(
				'conditions' => array('UserWork.user_id' => $user_id),
				'order' => array('UserWork.date_from' => 'DESC')
			));
			$this->set('experience', $experience);

		}
		if ($select == 'award') {
			$this->layout = 'mentort2';

			$this->loadModel('UserAward');
			$this->UserAward->recursive = -1;
			$awards = $this->UserAward->find('all', array(
				'conditions' => array('UserAward.user_id' => $user_id),
				'order' => array('UserAward.date_awarded' => 'DESC')
			));
			$this->set('awards', $awards);


		}
		if ($select == 'certification') {
			$this->layout = 'mentort2';

			$this->loadModel('UserCertification');
			$this->UserCertification->recursive = -1;
			$awards = $this->UserCertification->find('all', array(
				'conditions' => array('UserCertification.user_id' => $user_id),
				'order' => array('UserCertification.date_certified' => 'DESC')
			));
			$this->set('certification', $awards);

		}
		if ($select == 'users') {
			$this->layout = 'mentort2';
			$menti = $this->requestAction('user_mentor_followers/get_mentor_followers/' . $user_id);

			$this->set('menti', $menti);
		}


	}

	public function remove() {
		$this->autoRender = FALSE;
		if($this->request->is('POST')){
			$status['success'] = TRUE;
			$user = $this->request->data;
			$tr = $this->UserMentorFollower->updateAll(
				array('UserMentorFollower.status' => $user['status']),
				array('UserMentorFollower.user_id' => $user['user_id'], 'UserMentorFollower.mentor_id' => $user['mentor_id'])
			);
			if($tr){
				$status['success'] = FALSE;
			}
			return json_encode($status);
		}

	}
}
