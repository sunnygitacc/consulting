<?php
App::uses('AppController', 'Controller');

/**
 * PostUserComments Controller
 *
 * @property PostUserComment $PostUserComment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PostUserCommentsController extends AppController
{

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Session', 'Log');

	public function add_comment()
	{

		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$status['success'] = FALSE;
			$comments = $this->replaceURLWithHTMLLinks($this->request->data['comment']);

			$descript_TWO = str_replace('\r\n', '<br>', $comments);
			$this->request->data['comment'] = $comments;
			$this->request->data['user_id'] = $this->Auth->user('id');
			$this->request->data['status'] = 1;
			$this->request->data['date_commented'] = date("Y-m-d H:i:s");

			$this->PostUserComment->create();
			if ($this->PostUserComment->save($this->request->data)) {
				$this->Log->add($this->Auth->user('id'), 4, $this->request->data['post_id'], '', 'User Post comment');
				$status['success'] = True;
				$status['comment_id'] = $this->PostUserComment->getInsertID();

			} else {
				debug($this->PostUserComment->validationErrors);
			}

			return json_encode($status);
		}
	}

	public function replaceURLWithHTMLLinks($text)
	{

		$atext = preg_replace("@((https?://)?([-\w]+\.[-\w\.]+)\w(:\d+)?(/([-\w/_\.\,]*(\?\S+)?)?)*)@", "<a target='_blank' href='$1'>$1</a>", $text);
		// echo $atext;

		$a = htmlentities($text);


		return $a;
	}

	public function get_more_comments()
	{

		$this->layout = 'ajax';
		if ($this->request->is('POST')) {
			$data = $this->request->data;
			$this->PostUserComment->recursive = -1;
			$cmts = $this->PostUserComment->find('all', array(
				'conditions' => array(
					'PostUserComment.post_id' => $data['post_id'],
					'PostUserComment.id < ' => $data['id']
				),
				'limit' => 4,
				'order' => 'PostUserComment.id DESC'
			));
			$this->set('cmt', $cmts);
		}
	}

	public function latest_cmt()
	{

		$this->layout = 'ajax';
		if ($this->request->is('POST')) {
			$data = $this->request->data;
			$this->PostUserComment->recursive = -1;
			$cmts = $this->PostUserComment->find('all', array(
				'conditions' => array(
					'PostUserComment.post_id' => $data['post_id'],
					'PostUserComment.id > ' => $data['id']
				),
				'limit' => 4,
				'order' => 'PostUserComment.id DESC'
			));
			$this->set('cmt', $cmts);
		}

	}

	public function comment($comment_id)
	{

		$this->autoRender = false;
		$this->PostUserComment->recursive = 1;
		$comment = $this->PostUserComment->find('first', array(
			'conditions' => array('PostUserComment.id' => $comment_id),
			'joins' => array(
				array(
					'table' => 'user_group_profile_pics',
					'alias' => 'UserPic',
					'type' => 'LEFT',
					'conditions' => array(
						'User.id = UserPic.wall_id',
						'UserPic.wall_id = 1 ',
						'UserPic.is_active = 1 ',
					))
			),
			'fields' => array(
				'PostUserComment.comment', 'User.first_name', 'User.last_name', 'UserPic.link'
			)
		));

		$user_det['pic'] = '';
		if (isset($comment['UserPic']['link'])) {
			$user_det['pic'] = PROFILE_IMAGE_PATH_FINAL . $comment['UserPic']['link'] . '_sml.jpeg';

		}
		$user_det['name'] = $comment['User']['first_name'] . ' ' . $comment['User']['last_name'];
		$user_det['comment'] = $comment['PostUserComment']['comment'];
		//get like count
		$this->loadModel('PostUserLike');
		$count = $this->PostUserLike->find('all', array(
			'conditions' => array(
				'PostUserLike.item_id' => $comment_id,
				'PostUserLike.item_type' => 2,
				'PostUserLike.status' => 2
			)
		));
		$like_count = count($count);
		$like_span = 'thumbs-down';
		for ($i = 0; $i < $like_count; $i++) {
			if ($count[$i]['PostUserLike']['user_id'] == $this->Auth->user('id')) {
				$like_span = 'thumbs-up';
			}
		}

		$user_det['ilike'] = $like_span;
		$user_det['count'] = $like_count;
		return $user_det;


	}

	//******************cre video comment******************//
	public function cre_comment()
	{

		$this->autoRender = false;
		if ($this->request->is('POST')) {
			$status['success'] = FALSE;
			$crecomments = $this->replaceURLWithHTMLLinks($this->request->data['comment']);
			str_replace('\r\n', '<br>', $crecomments);
			$comment = $this->request->data['comment'] = $crecomments;
			$user_id = $this->request->data['user_id'] = $this->Auth->user('id');
			$status = $this->request->data['status'] = 1;
			$date_commented = $this->request->data['date_commented'] = date("Y-m-d H:i:s");

			$data = array(
				'comment' => $comment,
				'user_id' => $user_id,
				'status' => $status,
				'date_commented' => $date_commented,
				'post_id' => $this->request->data['post_id'],
				'deletedby_id' => $user_id,
				'date_deleted' => $date_commented
			);


			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/backend/creComment');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
			curl_setopt($ch, CURLOPT_TIMEOUT, 120);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$result = curl_exec($ch);
			debug($result);
			curl_close($ch);


		}
	}

}
