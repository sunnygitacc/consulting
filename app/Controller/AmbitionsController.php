<?php
App::uses('AppController', 'Controller');

/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 *
 */





class AmbitionsController extends AppController
{

	/**
	 * Components
	 *
	 * @var array 9900830181
	 */
	public $components = array('Paginator', 'Session', 'Notify', 'Access');

	public $uses = array('Post', 'User');


	public $paginate = array(
		'fields' => array('Post.id', 'Post.title', 'Post.description', 'Post.date_posted', 'Post.link'),
		'limit' => 3,
		'order' => array(
			'Post.id' => 'DESC'
		)
	);

	public function beforeFilter()
	{
		parent::beforeFilter();

		$this->setJsVar('wall_id', $this->Auth->user('id'));
		$this->setJsVar('wall_type', 1);
		$this->setJsVar('vertical_id', 1);

	}


	public function index()
	{
		$url = "http://localhost:8080/backend/userdata/1";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);

		$data= json_decode($result,true);

		curl_close($ch);
		$this->set('result', $data);

		debug($data);


		$permission = $this->Access->get_my_role($this->request->params);
		if (!in_array(1, $permission)) {

		}
		$this->set('permission', $permission);

		$this->layout = 'ambition';

		if ($this->request->is('POST')) {

			$form_data = $this->request->data['create-ambition-group'];
			$data = array(
				'name' => $form_data['title'],
				'description' => $form_data['title'],
				'sub_category_id' => $form_data['ambitions_subcategory_id'],
				'type' => 2,
				'status' => 1,
				'createdby_id' => $this->Auth->user('id'),
				'date_created' => date('Y-m-d H:i:s'),
			);

			$this->loadModel('Group');
			$this->Group->create();
			if ($this->Group->save($data)) {

				$group_id = $this->Group->getInsertId();

				$user_group_relations = array(
					'user_id' => $this->Auth->user('id'),
					'group_id' => $group_id,
					'role_id' => 2,
					'role_alias' => 'owner',
					'rolesetby_id' => $this->Auth->user('id'),
					'status' => 1,
					'invitedby_id' => $this->Auth->user('id'),
					'date_invited' => date('Y-m-d H:i:s'),
					'date_joined' => date('Y-m-d H:i:s'),
					'date_roleset' => date('Y-m-d H:i:s')
				);

				$this->loadModel('UserGroupRelation');
				$this->UserGroupRelation->create();
				if ($this->UserGroupRelation->save($user_group_relations)) {

				} else {

				}
				$users = explode(',', $form_data['invited']);
				foreach ($users as $oneuser) {
					$this->UserGroupRelation->create();
					$GroupMembers = array(
						'user_id' => $oneuser,
						'group_id' => $group_id,
						'role_id' => 3,
						'role_alias' => 'member',
						'rolesetby_id' => $this->Auth->user('id'),
						'status' => 5,
						'invitedby_id' => $this->Auth->user('id'),
						'date_invited' => date('Y-m-d H:i:s'),
						'date_roleset' => date('Y-m-d H:i:s')
					);
					if ($this->UserGroupRelation->save($GroupMembers)) {
						$id = $this->UserGroupRelation->getInsertId();

					} else {

					}
				}


			} else {

			}


		}


		$this->loadModel('User');
		$this->User->recursive = 0;
		$profile_user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
		//debug($profile_user);

		$avthar = '';
		if (!empty($profile_user['UserGroupProfilePic']['link'])) {
			$avthar = PROFILE_IMAGE_PATH_FINAL . $profile_user['UserGroupProfilePic']['link'] . '_sml.jpeg';

		}
		$this->set('avathar', $avthar);
		$this->setJsVar('profile_pic', $avthar);
		$this->setJsVar('name', $this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name'));
		$this->setJsVar('user_id', $this->Auth->user('id'));


		$Groups = $this->requestAction('user_group_relations/get_vertical_group_list/1');
		$Friends = $this->requestAction('user_friends/get_friends_id/' . $this->Auth->user('id'));
		debug($Friends);
		$mentor = $this->requestAction('user_mentor_followers/get_mentor_follower_id/' . $this->Auth->user('id'));
		$this->set('friends', $Friends);
		array_push($Friends, $this->Auth->user('id'));
		//debug($profile_user);
		$this->set('user', $profile_user);
		$this->Post->recursive = 1;
		$this->Paginator->settings = array('limit' => 3,
			'order' => array('Post.id' => 'desc'),
			'conditions' => array(
				'OR' => array(
					array('Post.Postto_id' => $Friends, 'Post.wall_type' => 1),
					array('Post.Postto_id' => $Groups, 'Post.wall_type' => 2),
					array('Post.Postto_id' => $mentor, 'Post.wall_type' => 1),
				),
				'AND' => array('Post.status' => 1, 'Post.vertical_id' => 1)

			)
		);

		$data = $this->paginate('Post');

		$this->set('posts', $data);
//pr($data);


		/*
         * Create new ambition group
         *
         */


		/*ambition category list start*/

		$this->loadModel('Category');
		$combobox = $this->Category->find('all', array(
			'conditions' => array('Category.vertical_id' => 1)));

		for ($i = 0; $i < count($combobox); $i++) {
			$ambition_categorys[$i]['label'] = $combobox[$i]['Category']['name'];
			$ambition_categorys[$i]['value'] = $combobox[$i]['Category']['id'];
		}
		if (count($combobox) > 0) {
			$this->setJsVar('group_categorys', $ambition_categorys);
		} else {
			$this->setJsVar('group_categorys', array());
		}

		$this->loadModel('SubCategory');
		$this->SubCategory->recursive = 0;
		$combobox = $this->SubCategory->find('all');

		for ($i = 0; $i < count($combobox); $i++) {
			$ambition_categorys[$i]['label'] = $combobox[$i]['SubCategory']['name'];
			$ambition_categorys[$i]['value'] = $combobox[$i]['SubCategory']['id'];
			$ambition_categorys[$i]['refer'] = $combobox[$i]['Category']['id'];
		}
		if (count($combobox) > 0) {
			$this->setJsVar('group_subcategorys', $ambition_categorys);
		} else {
			$this->setJsVar('group_subcategorys', array());
		}

		//get My groups
		$groups = $this->requestAction('groups/get_user_groups/' . $this->Auth->user('id'));

		$this->set('groups', $groups);


	}


	public function settings()
	{

		$permission = $this->Access->get_my_role($this->request->params);
		if (!in_array(1, $permission)) {
			// $this->redirect($this->referer());
		}
		$this->set('permission', $permission);

		$this->layout = 'ambition';


		$this->loadModel('User');
		$this->User->recursive = 0;
		$profile_user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));


		$avthar = '';
		if (!empty($profile_user['UserGroupProfilePic']['link'])) {
			$avthar = PROFILE_IMAGE_PATH_FINAL . $profile_user['UserGroupProfilePic']['link'] . '_sml.jpeg';

		}
		$this->set('avathar', $avthar);
		$this->setJsVar('profile_pic', $avthar);
		$this->setJsVar('name', $this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name'));
		$this->setJsVar('user_id', $this->Auth->user('id'));

		$this->set('user', $profile_user);

		//get My groups
		$groups = $this->requestAction('groups/get_user_groups/' . $this->Auth->user('id'));

		$this->set('groups', $groups);


		//get ambition following
		$this->loadModel('UserCategoryRelation');
		$this->UserCategoryRelation->recursive = 0;
		$relation = $this->UserCategoryRelation->find('all', array(
			'conditions' => array(
				'UserCategoryRelation.user_id' => $this->Auth->user('id'),
				'UserCategoryRelation.status' => 1,
				'Vertical.id' => 1,
			),
			'fields' => array(
				'SubCategory.name', 'SubCategory.id'
			)

		));

		$this->set('ambition_cate', $relation);

	}

	public function user_log()
	{

		$permission = $this->Access->get_my_role($this->request->params);
		if (!in_array(1, $permission)) {
			// $this->redirect($this->referer());
		}
		$this->set('permission', $permission);

		$this->layout = 'ambition';


		$this->loadModel('User');
		$this->User->recursive = 0;
		$profile_user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));


		$avthar = '';
		if (!empty($profile_user['UserGroupProfilePic']['link'])) {
			$avthar = PROFILE_IMAGE_PATH_FINAL . $profile_user['UserGroupProfilePic']['link'] . '_sml.jpeg';

		}
		$this->set('avathar', $avthar);
		$this->setJsVar('profile_pic', $avthar);
		$this->setJsVar('name', $this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name'));
		$this->setJsVar('user_id', $this->Auth->user('id'));

		$this->set('user', $profile_user);

		//get My groups
		$groups = $this->requestAction('groups/get_user_groups/' . $this->Auth->user('id'));

		$this->set('groups', $groups);

		//get user logs

		$this->loadModel('UserLog');

		$this->UserLog->recursive = 0;
		$this->Paginator->settings = array('limit' => 5,
			'order' => array('UserLog.id' => 'desc'),
			'conditions' => array(
				'UserLog.user_id' => $this->Auth->user('id')

			)

		);

		$data = $this->paginate('UserLog');

		$this->set('log', $data);

	}

	public function help()
	{

		$permission = $this->Access->get_my_role($this->request->params);
		if (!in_array(1, $permission)) {
			// $this->redirect($this->referer());
		}
		$this->set('permission', $permission);

		$this->layout = 'ambition';


		$this->loadModel('User');
		$this->User->recursive = 0;
		$profile_user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));


		$avthar = '';
		if (!empty($profile_user['UserGroupProfilePic']['link'])) {
			$avthar = PROFILE_IMAGE_PATH_FINAL . $profile_user['UserGroupProfilePic']['link'] . '_sml.jpeg';

		}
		$this->set('avathar', $avthar);
		$this->setJsVar('profile_pic', $avthar);
		$this->setJsVar('name', $this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name'));
		$this->setJsVar('user_id', $this->Auth->user('id'));

		$this->set('user', $profile_user);

		//get My groups
		$groups = $this->requestAction('groups/get_user_groups/' . $this->Auth->user('id'));

		$this->set('groups', $groups);

	}

}
