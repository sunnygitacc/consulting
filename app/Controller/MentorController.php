<?php
App::uses('App\Controller\AppController', 'controller', 'User');


class MentorController extends AppController
{

	public $components = array('Session', 'Access', 'Curl', 'Page');
	public $uses = array('User');


	public function beforeFilter()
	{
		parent::beforeFilter();


		$this->setJsVar('user_id', $this->Auth->user('id'));

		$this->setJsVar('wall_type', 1);


	}




	public function profile()
	{
		//debug($_SESSION);
		$this->layout = 'mentor';
		$this->set('user_id', $this->Auth->id);
		$this->setJsVar('wall_id', $this->request->params['id']);
		$this->Page->setPageVariable($this->request->params['id'], $this->Auth->user("id"), 0, 5);
		$id = $this->request->params['id'];


		$url1 = "/getMentorPost/" . $id . "/1";
		$posts = $this->Curl->fetchCurl($url1);
		$this->set('userPosts', $posts);

		$url1 = "/getUserFriends/" . $id;
		$json_array = $this->Curl->fetchCurl($url1);
		$this->set('userFriends', $json_array);

		$url1 = "/userDetails/" .$id;
		$json_array = $this->Curl->fetchCurl($url1);
		$this->set('user', $json_array);

		$url1 = "/getUserMentors/" . $id;
		$mentors = $this->Curl->fetchCurl($url1);
		//  debug($mentors);
		$this->set('menti', $mentors);

		$following = FALSE;
		$user_id = $this->Auth->user("id");
		$url1 = "/getUserMentors/" . $this->Auth->user("id");
		$i_follows = $this->Curl->fetchCurl($url1);

		if (in_array($user_id, $i_follows)) {
			$following = true;
		}
		if ($this->Auth->user('id') == $user_id) {
			$following = '';
		}
		$this->set('is_following', $following);




		$following = FALSE;


		$url1 = "/getMentorFollowersId/" . $this->request->params['id'];
		$i_follows = $this->Curl->fetchCurl($url1);





        $user_id = $this->Auth->user('id');


		if (in_array($user_id, $i_follows)) {
			$following = true;
		}

		$this->set('is_following', $following);

	}
	public function about() {
		$this->layout = 'mentort2';
		$this->set('user_id', $this->Auth->id);

		$id = $this->request->params['id'];
		$url1 = "/userDetails/" .$id;
		$json_array = $this->Curl->fetchCurl($url1);
		$this->set('user', $json_array);

		$url1 = "/getUserMentors/" . $id;
		$mentors = $this->Curl->fetchCurl($url1);
		//  debug($mentors);
		$this->set('menti', $mentors);
	}







}
