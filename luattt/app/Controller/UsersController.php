<?php

class UsersController extends AppController{
	var $name="Users";
	var $_sessionUid = "Userid";
	public $uses = array('User','Forum','Topic','Post','Tests');

	function  index(){
		$this->set('title_for_layout', 'Học luật Việt Nam');
		if($this->Session->read($this->sessionUserid)==1){
			$this->Auth->loginRedirect = array('admin' =>true,'controller' => 'users', 'action' => 'index');
			return $this->redirect($this->Auth->redirect());
		}
	}
	//3-5

	public function profile($id=null) {
		$this->Auth->allow();	
		//$_sessionUid = "Userid";	 
		//return $this->User->find(all);
		$data=$this->User->find('first',array('conditions' => array('User.username' => $id)));
		$this->set("data",$data);
	}
	public function infoMember($id=null) {
		$this->Auth->allow();	
		//$_sessionUid = "Userid";	 
		//return $this->User->find(all);
		$data=$this->User->find('first',array('conditions' => array('User.user_id' => $id)));
		$this->set("data",$data);
	}
	 
	 
	function beforeFilter(){
		parent::beforeFilter();
		Security::setHash("md5");
		$this->Auth->userModel = 'User';
		$this->Auth->authorize = 'controller';
		$this->Auth->fields = array('username' => 'username', 'password' => 'password');

		//$this->Auth->loginAction = array('controller'=>'users','action'=>'index'); //action se chuyen toi sau khi access trang we
		//$this->Auth->loginRedirect = array('controller'=>'users','action'=>'profile');//action se chuyen den sau khi logi
		$this->Auth->logoutRedirect=array('admin' =>false,'controller'=>'users','action'=>'index');
		$this->Auth->loginError = 'Failed to login';//thong bao dang nhap bi lo
		$this->Auth->authError = 'Access denied'; //thong bao truy cap khong dung khu vuc
		$this->Auth->allow(array('index', 'register',"CheckUser"));
	}
	
	
	function login(){
		if ($this->request->is('post')) {
			$user=array();
			$user['User']['username']=$this->request->data['username'];
			$user['User']['password']=$this->data['password'];
			if ($this->Auth->login($user)) {
				$hash = Security::hash($this->data['password'],NULL,TRUE);
				$data=$this->User->find('first',array('conditions' => array('username' =>$this->request->data['username'],'password'=>$hash,'status'=>1)));
				if(isset($data)&&count($data)>0){
					$this->Session->write($this->sessionUsername,$data['User']['username']);
					$this->Session->write($this->sessionUserid,$data['User']['user_id']);
					$this->Session->write($this->sessionUserRole,$data['User']['idRole']);
					if($data['User']['idRole'] == 1){
						$this->Auth->loginRedirect = array('admin' =>true,'controller' => 'users', 'action' => 'index');
					}else{
						$this->Auth->loginRedirect = array('admin' =>false,'controller' => 'users', 'action' => 'index');
					
					}
					//xet dang nhap trong form login rieng
					if(isset($_POST['reforums'])){
						//					return $this->redirect(array('user' =>false,'controller' => 'Forums', 'action' => 'index'));
						//				}
						//				else
							//					return $this->redirect($this->Auth->redirect());
						if($data['User']['idRole'] == 1){
							$this->Auth->loginRedirect = array('admin' =>true,'controller' => 'users', 'action' => 'index');
						}else{
							$this->Auth->loginRedirect = array('admin' =>false,'controller' => 'Forums', 'action' => 'index');
					
						}
					}
			}
			else{
				$this->Auth->loginRedirect = array('admin' =>false,'controller' => 'users', 'action' => 'login');
				$this->Session->setFlash(__('Username or Password không chính xác, mời nhập lại!'));
			}
				
		}
		
		return $this->redirect($this->Auth->redirect());//chuyen huong trang
	}
	}
	
	function logout(){
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());//tu dong chuyen trang sau khi logout
	}
	//---------- Logout
	//
	function cheklogin(){
		if($this->Session->read($this->sessionUsername)){
			$this->set("data",$this->Session->read($this->sessionUsername));
			return true;
		}
		return false;
	}
	//
	function register(){
		if(isset($_POST['ok'])){
			$this->request->data['idRole']=2;
			$this->request->data['status']=1;
			$this->User->saveAll($this->request->data);
			$data=$this->User->find('first',array('conditions' => array('User.username' => $this->request->data['username'])));
			$this->set("data",$data);
			$this->render("thongbao");
			
		}
		else{
			$this->render("register");
			//$this->Session->delete($this->sessionUsername,$this->User->getUserName());
		}
		 
	}
	function _isAdmin(){
		$admin = FALSE;
		if($this->Session->read($this->sessionUserRole))
			$admin = TRUE;
		return $admin;
	}

	/**
	 * Kiem tra da login chua
	 */
	function _isLogin(){
		$login = FALSE;
		if($this->Auth->user()){
			$login = TRUE;
		}
		return $login;
	}

	/**
	 * Xac nhan userID
	 */
	function _usersUserID(){
		$users_userid = NULL;
		if($this->Auth->user())
			$users_userid =$this->Session->read($this->sessionUserId);
		return $users_userid;
	}

	/**
	 * Xac nhan username
	 */
	function _usersUsername(){
		$users_username = NULL;
		if($this->Auth->user())
			$users_username = $this->Auth->user("User.username");
		return $users_username;
	}

	/**
	 * Xac nhan co phai truy cap vao trang admin hay khong
	 */
	function isAuthorized() {
		if (isset($this->params['admin'])) {
			if ($this->Session->read($this->sessionUserRole) != 1) {
				$this->Auth->allow("index");
				$this->redirect("/users");
			}
		}
		return true;
	}

	//admin
	function admin_index(){
	
		$data = $this->User->find("all");
		$this->set("data",$data);
	}
	public function admin_logout() {
		$this->logout();
	}
	public function changepass($id) {
		$this->request->data['newpass'] = Security::hash($this->request->data['newpass'],NULL,TRUE);
		$this->User->updateAll(array('User.password' =>"'".$this->request->data('newpass')."'"),
				 array('User.user_id' => $id));
		$data=$this->User->find('first',array('conditions' => array('User.user_id' => $id)));
	$this->set("data",$data);
				 $this->render("profile");
	}
	public function CheckUser(){
		$this->Auth->allow();
		$name=$this->request->data['name'];
		$user=$this->User->find("first",array('conditions' => array('User.username' => $name)));
		$this->set("user",$user);
	}
	
	//
	public function managerTopic($idforum=null,$page=null,$end=null) {
		$this->populateTopics($idforum,$page,$end);
	}
	public function createTopic() {
		$this->Auth->allow();
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->request->data['user_id']=$this->Session->read($this->sessionUserid);
		$this->request->data['created']=date("YmdHis", time());
		$this->request->data['modified']=date("YmdHis", time());
		$this->Topic->saveAll($this->request->data);
		$this->populateTopics($this->request->data['forum_id'],null,null);
		$this->render("managerTopic");
	}
	public function populateTopics($idforum=null,$page=null,$end=null){
		$page=(isset($page)&&$page!=null?$page:1);
		$end=(isset($end)&&$end!=null?$end:$this->numberpage);
		$this->set("forums",$this->Forum->find('all'));
		$topics=$this->Topic->find('count',array('conditions' => array('Topic.user_id' => $this->Session->read($this->sessionUserid))));
		$this->set("topics",$this->Topic->find('all',array('conditions' => array('Topic.user_id' => $this->Session->read($this->sessionUserid)),'limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord)));
		$this->pagination($page,$topics, $end);
	}
	public function editTopic($idTopic,$page=null,$end=null) {
		$topic=$this->Topic->find("first",array('conditions' => array('Topic.id'=>$idTopic)));
		$this->set("Topic",$topic);
		$this->populateTopics($topic['Topic']['forum_id'],null,null);
		$this->render("managerTopic");
	}
	public function UpdateTopic($idtopic) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$topic=$this->Topic->find("first",array('conditions' => array('Topic.id'=>$idtopic)));
		$this->Topic->updateAll(array('modified'=>date("YmdHis", time()),'forum_id'=>$this->request->data['forum_id'],'name'=>"'".$this->request->data['name']."'",'content'=>"'".$this->request->data['content']."'"),array('Topic.id' =>$idtopic));
		$this->populateTopics($topic['Topic']['forum_id'],null,null);
		$this->render("managerTopic");
	}
	public function deleteTopic($idtopic,$page=null,$end=null) {
		$topic=$this->Topic->find("first",array('conditions' => array('Topic.id'=>$idtopic)));
		$this->Post->deleteAll(array('Post.topic_id'=>$idtopic));
		$msg="'Xóa không thành công!'";
		if($this->Post->find('count',array('conditions' => array('Post.topic_id'=>$idtopic)))==0){
			$this->Topic->deleteAll(array('Topic.id'=>$idtopic));
		}
		if($this->Topic->find('count',array('conditions' => array('Topic.id'=>$idtopic)))==0){
			$msg="'Xóa thành công!'";
		}
		$this->set("msg",$msg);
		$this->populateTopics($topic['Topic']['forum_id'],null,null);
		$this->render("managerTopic");
	}
	public function findTest($iduser){
		
		$this->set("data",$this->Tests->find("all",array('conditions'=>arr('Tests.'))));
	}
}