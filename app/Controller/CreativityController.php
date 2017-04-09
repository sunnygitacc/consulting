<?php
App::uses('AppController', 'Controller','PostsController');
/**
 * UserCreativityPosts Controller
 *
 * @property UserCreativityPost $UserCreativityPost
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CreativityController extends AppController
{

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Session', 'Access', 'Log', 'Curl');
	public $uses = array('Post', 'Users', 'Post_types', 'UserPostView');


	public function index()
	{

		$id = $this->Auth->user('id');
		$this->layout = 'creativity';


		/****************per strt*************/
		$url1 = "/getCreativityPosts/" . $id . "/2";
		$json_array = $this->Curl->fetchCurl($url1);

		$this->set('Creativity_img', $json_array);


		/**********************video java******************/

		$url1 = "/getCreativityPosts/" . $id . "/3";
		$json_array = $this->Curl->fetchCurl($url1);

		$this->set('Creativity_vid', $json_array);


		/**********************doc java******************/

		$url1 = "/getCreativityPosts/" . $id . "/4";
		$json_array = $this->Curl->fetchCurl($url1);

		$this->set('Creativity_doc', $json_array);


		/**********************aud java******************/
		$url1 = "/getCreativityPosts/" . $id . "/5";
		$json_array = $this->Curl->fetchCurl($url1);

		$this->set('Creativity_aud', $json_array);


		/*********************per end**************/


		$combobox = $this->Post->find('all', array(
			'conditions' => array('AND' => array('Post.status' => '1', 'vertical_id' => '3'))));

		for ($i = 0; $i < count($combobox); $i++) {
			$CreativityTag[$i]['label'] = $combobox[$i]['Post']['keywords'];
			$CreativityTag[$i]['value'] = $combobox[$i]['Post']['id'];
		}

		if (count($combobox) > 0) {
			$this->set('tags', $CreativityTag);
			$this->setJsVar('creativitytag', $CreativityTag);
		} else {
			$this->set('tags', array());
			$this->setJsVar('creativitytag', array());
		}

	}

	public function view($id = null)
	{
		if (!$this->Posts->exists($id)) {
			throw new NotFoundException(__('Invalid user creativity post'));
		}
		$options = array('conditions' => array('Posts.' . $this->Posts->primaryKey => $id));
		$this->set('Posts', $this->Posts->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->Posts->create();
			if ($this->Posts->save($this->request->data)) {
				$this->Session->setFlash(__('The user creativity post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user creativity post could not be saved. Please, try again.'));
			}
		}
		$users = $this->Posts->postby_id->find('list');
		$this->set(compact('users'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null)
	{
		$this->Posts->id = $id;
		if (!$this->Posts->exists()) {
			throw new NotFoundException(__('Invalid user creativity post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Posts->delete()) {
			$this->Session->setFlash(__('The user creativity post has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user creativity post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function search()
	{
		$this->layout = 'creativity';


	}

	public function player()
	{

		$id1 = $this->Auth->user('id');

		$url1 = "/getCreativityPosts/" . $id1 . "/3";
		$json_array = $this->Curl->fetchCurl($url1);

		$this->set('Creativity_vid', $json_array);


		$id = $this->request->params['pass'][0];



		$url1 = "/creativityPlayer/" . $id . "/3";
		$json_array = $this->Curl->fetchCurl($url1);


		$this->layout = 'creativity';

		$this->set('Creativity_player', $json_array);


	}



 public function audio() {


	 $id1 = $this->Auth->user('id');

	 $url1 = "/getCreativityPosts/" . $id1 . "/5";
	 $json_array = $this->Curl->fetchCurl($url1);

	 $this->set('Creativity_aud', $json_array);


	 $id = $this->request->params['pass'][0];


	 $url1 = "/creativityPlayer/" . $id . "/5";
	 $json_array = $this->Curl->fetchCurl($url1);


	 $this->layout = 'creativity';


	 $this->set('audio', $json_array);


	 }





 public function music() {

	 $url = "http://localhost:8080/backend/cremusicData/";
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($ch, CURLOPT_URL, $url);
	 $result = curl_exec($ch);
	 $music = json_decode($result);
	 curl_close($ch);


	 $this->layout = 'creativity';

	 $musicimage = array();
	 $musicvideo = array();
	 $musicdoc = array();
	 $musicaud = array();

	 foreach ($music as $value) {

		 if ($value->post_type_id == 2) {

			 $musicimage[] = $value;
		 }
		 if ($value->post_type_id == 3) {

			 $musicvideo[] = $value;
		 }
		 if ($value->post_type_id == 4) {

			 $musicdoc[] = $value;
		 }
		 if ($value->post_type_id == 5) {

			 $musicaud[] = $value;
		 }


	 }


	 $this->set('Creativity_mi', $musicimage);
	 $this->set('Creativity_mv', $musicvideo);
	 $this->set('Creativity_md', $musicdoc);
	 $this->set('Creativity_ma', $musicaud);




 }
//*********************movies**********//
  public function movies() {
	  $this->layout = 'creativity';
	  $url = "http://localhost:8080/backend/creMovieData/";
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_URL, $url);
	  $result = curl_exec($ch);
	  $movie = json_decode($result);
	  curl_close($ch);

	  $this->layout = 'creativity';

	  $moimage = array();
	  $movideo = array();
	  $modoc = array();
	  $moaud = array();

	  foreach ($movie as $value) {

		  if ($value->post_type_id == 2) {

			  $moimage[] = $value;
		  }
		  if ($value->post_type_id == 3) {

			  $movideo[] = $value;
		  }
		  if ($value->post_type_id == 4) {

			  $modoc[] = $value;
		  }
		  if ($value->post_type_id == 5) {

			  $moaud[] = $value;
		  }


	  }


	  $this->set('Creativity_moi', $moimage);
	  $this->set('Creativity_mov', $movideo);
	  $this->set('Creativity_mod', $modoc);
	  $this->set('Creativity_moa', $moaud);


 }

	//*********************sport**********//
  public function sports() {
	  $this->layout = 'creativity';
	  $url = "http://localhost:8080/backend/creSportsData/";
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_URL, $url);
	  $result = curl_exec($ch);
	  $sports = json_decode($result);
	  curl_close($ch);

	  $this->layout = 'creativity';

	  $soimage = array();
	  $sovideo = array();
	  $sodoc = array();
	  $soaud = array();

	  foreach ($sports as $value) {

		  if ($value->post_type_id == 2) {

			  $soimage[] = $value;
		  }
		  if ($value->post_type_id == 3) {

			  $sovideo[] = $value;
		  }
		  if ($value->post_type_id == 4) {

			  $sodoc[] = $value;
		  }
		  if ($value->post_type_id == 5) {

			  $soaud[] = $value;
		  }
	  }

	  $this->set('Creativity_si', $soimage);
	  $this->set('Creativity_sv', $sovideo);
	  $this->set('Creativity_sd', $sodoc);
	  $this->set('Creativity_sa', $soaud);

 }
 //*********************nature**********//
  public function nature() {
	  $this->layout = 'creativity';
	  $url = "http://localhost:8080/backend/creNatureData/";
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_URL, $url);
	  $result = curl_exec($ch);
	  $nature = json_decode($result);
	  curl_close($ch);

	  $this->layout = 'creativity';

	  $naimage = array();
	  $navideo = array();
	  $nadoc = array();
	  $naaud = array();

	  foreach ($nature as $value) {

		  if ($value->post_type_id == 2) {

			  $niimage[] = $value;
		  }
		  if ($value->post_type_id == 3) {

			  $sovideo[] = $value;
		  }
		  if ($value->post_type_id == 4) {

			  $sodoc[] = $value;
		  }
		  if ($value->post_type_id == 5) {

			  $soaud[] = $value;
		  }
	  }

	  $this->set('Creativity_ni', $naimage);
	  $this->set('Creativity_nv', $navideo);
	  $this->set('Creativity_nd', $nadoc);
	  $this->set('Creativity_na', $naaud);


 }
 //*********************science**********//
  public function science() {
	  $this->layout = 'creativity';
	  $url = "http://localhost:8080/backend/creScienceData/";
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_URL, $url);
	  $result = curl_exec($ch);
	  $science = json_decode($result);
	  curl_close($ch);

	  $this->layout = 'creativity';

	  $scimage = array();
	  $scvideo = array();
	  $scdoc = array();
	  $scaud = array();

	  foreach ($science as $value) {

		  if ($value->post_type_id == 2) {

			  $scimage[] = $value;
		  }
		  if ($value->post_type_id == 3) {

			  $scvideo[] = $value;
		  }
		  if ($value->post_type_id == 4) {

			  $scdoc[] = $value;
		  }
		  if ($value->post_type_id == 5) {

			  $scaud[] = $value;
		  }
	  }

	  $this->set('Creativity_si', $scimage);
	  $this->set('Creativity_sv', $scvideo);
	  $this->set('Creativity_sd', $scdoc);
	  $this->set('Creativity_sa', $scaud);


 }
 //*********************comedy**********//
  public function comedy() {
	  $this->layout = 'creativity';
	  $url = "http://localhost:8080/backend/creComedyData/";
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_URL, $url);
	  $result = curl_exec($ch);
	  $science = json_decode($result);
	  curl_close($ch);

	  $this->layout = 'creativity';

	  $cimage = array();
	  $cvideo = array();
	  $cdoc = array();
	  $caud = array();

	  foreach ($science as $value) {

		  if ($value->post_type_id == 2) {

			  $scimage[] = $value;
		  }
		  if ($value->post_type_id == 3) {

			  $scvideo[] = $value;
		  }
		  if ($value->post_type_id == 4) {

			  $scdoc[] = $value;
		  }
		  if ($value->post_type_id == 5) {

			  $scaud[] = $value;
		  }
	  }

	  $this->set('Creativity_ci', $cimage);
	  $this->set('Creativity_cv', $cvideo);
	  $this->set('Creativity_cd', $cdoc);
	  $this->set('Creativity_ca', $caud);


 }
 //*********************tutorials**********//
  public function tutorials() {
	  $this->layout = 'creativity';
	  $url = "http://localhost:8080/backend/creTutData/";
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_URL, $url);
	  $result = curl_exec($ch);
	  $tutorials = json_decode($result);
	  curl_close($ch);

	  $this->layout = 'creativity';

	  $timage = array();
	  $tvideo = array();
	  $tdoc = array();
	  $taud = array();

	  foreach ($tutorials as $value) {

		  if ($value->post_type_id == 2) {

			  $timage[] = $value;
		  }
		  if ($value->post_type_id == 3) {

			  $tvideo[] = $value;
		  }
		  if ($value->post_type_id == 4) {

			  $tdoc[] = $value;
		  }
		  if ($value->post_type_id == 5) {

			  $taud[] = $value;
		  }
	  }

	  $this->set('Creativity_ti', $timage);
	  $this->set('Creativity_tv', $tvideo);
	  $this->set('Creativity_td', $tdoc);
	  $this->set('Creativity_ta', $taud);


 }

	//*********************animation**********//
  public function animation() {
	  $this->layout = 'creativity';
	  $url = "http://localhost:8080/backend/creAniData/";
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_URL, $url);
	  $result = curl_exec($ch);
	  $ani = json_decode($result);
	  curl_close($ch);

	  $this->layout = 'creativity';

	  $aimage = array();
	  $avideo = array();
	  $adoc = array();
	  $aaud = array();
	  foreach ($ani as $value) {

		  if ($value->post_type_id == 2) {

			  $aimage[] = $value;
		  }
		  if ($value->post_type_id == 3) {

			  $avideo[] = $value;
		  }
		  if ($value->post_type_id == 4) {

			  $adoc[] = $value;
		  }
		  if ($value->post_type_id == 5) {

			  $aaud[] = $value;
		  }
	  }

	  $this->set('Creativity_ai', $aimage);
	  $this->set('Creativity_av', $avideo);
	  $this->set('Creativity_ad', $adoc);
	  $this->set('Creativity_aa', $aaud);


 }

	public function edit()
	{
		$this->layout = 'creativity';
     $edit = $this->Post->find('all',array(
             'conditions'=>array('Post.status' => '1','Post.post_type_id' => '3','vertical_id'=>'3','Post.id'=>$this->request->params['pass'][0]),
            'limit' => 1,
            'order' => array('Post.id' => 'desc'),
            'recursive' => 1
        ));
        $this->set('Creativity_edit',$edit);

		$editd = $this->Post->find('all', array(
           'conditions'=>array('Post.status' => '1','vertical_id'=>'3','Post.id'=>$this->request->params['pass'][0]),'Post.postby_id'=>$this->Auth->user('id'),

			'recursive' => 1

		));

		$this->set('Creativity_sa', $editd);

		$cat = array(1 => 'Movies', 2 => 'Music', 3 => 'Sports', 4 => 'Nature', 5 => 'Science', 6 => 'Comedy', 7 => 'Tutorials', 8 => 'Animation');
		$this->set('Creativity_cat', $cat);

	}

//****************************most viewd*************************//
	public function mostviewed() {

		$this->layout = 'creativity';


		$url = "http://localhost:8080/backend/creativityimData/";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		$images = json_decode($result);
		curl_close($ch);
		$this->set('Creativity_mvi', $images);

		/**********************video java******************/

		$url = "http://localhost:8080/backend/creativityviData/";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		$vid = json_decode($result);
		curl_close($ch);
		$this->set('Creativity_mvv', $vid);

		/**********************doc java******************/

		$url = "http://localhost:8080/backend/creativitydocData/";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		$doc = json_decode($result);
		curl_close($ch);
		$this->set('Creativity_mvd', $doc);

		/**********************aud java******************/
		$url = "http://localhost:8080/backend/creativityAudioData/";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		$aud = json_decode($result);
		curl_close($ch);
		$this->set('Creativity_mva', $aud);


	}



}

