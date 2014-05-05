<?php

class UsersController extends AppController{
	var $name="Users";
	var $_sessionUid = "Userid";

	function  index(){
		$this->set('title_for_layout', 'Learn laws');
		//$this->Auth->allow('profile');
	}
	//3-5

	public function profile($user_id = null) {
		 
		// return $this->User->find(all);
		// $tb=new User();
		// $sql="SELECT * FROM Users WHERE user_id=".$user_id;
		// $data= $tb->query($sql);
		//$this->set('data', $data);
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
		$this->Auth->allow(array('index', 'register'));
	}
	
	
	function login(){
		if ($this->request->is('post')) {
			if ($this->Auth->login($this->request->data)) {
				$this->Session->write($this->sessionUsername,$this->request->data['username']);
				$data=$this->User->find('all',array('conditions' => array('username' =>$this->Session->read($this->sessionUsername))));
				$this->Session->write($this->sessionUserid,$data[0]['User']['user_id']);
				$this->Session->write($this->sessionUserRole,$data[0]['User']['idRole']);
				if($data[0]['User']['idRole'] == 1){
					$this->set("data","fsdfsd");
					$this->Auth->loginRedirect = array('admin' =>true,'controller' => 'users', 'action' => 'index');
				}else{
					$this->Auth->loginRedirect = array('admin' =>false,'controller' => 'users', 'action' => 'index');

				}
				$this->set("data","aaaaaa");
				return $this->redirect($this->Auth->redirect());

			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
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

			$this->User->save($this->request->data);
			$this->render("index");
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

}