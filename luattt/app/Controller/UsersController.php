<?php

class UsersController extends AppController{
	var $name="Users";
	var $_sessionUid = "Userid";
	
	function  index(){
		$this->set('title_for_layout', 'Learn laws');
		$this->Auth->allow('profile');
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
    //$this->Auth->userModel = 'Nguoidung';   // Khai bao su dung model khac trong Auth, mac dinh la Use
        $this->Auth->loginAction = array('controller'=>'users','action'=>'login'); //action se chuyen toi sau khi access trang we
        $this->Auth->loginRedirect = array('controller'=>'users','action'=>'profile');//action se chuyen den sau khi logi
        $this->Auth->loginError = 'Failed to login';//thong bao dang nhap bi lo
        $this->Auth->authError = 'Access denied'; //thong bao truy cap khong dung khu vuc            
    }
     
function login(){
	//$tb=new User();
	   if ($this->request->is('post')) {
		if ($this->Auth->login($this->request->data)) {
		$this->Session->write($this->sessionUsername,$this->request->data['username']);
		$sql="SELECT * FROM Users WHERE username='".$this->Session->read($this->sessionUsername)."'";
    	$dt=$this->User->query($sql);
    	
    	$this->Session->write('Userid',$dt[0]);
		
		
		return $this->redirect($this->Auth->redirect());
		
		}
		$this->Session->setFlash(__('Invalid username or password, try again'));
	   }
}   
function logout(){
        $this->redirect($this->Auth->logout());//tu dong chuyen trang sau khi logout
}


	//login
	//--------- Login
	/*function login(){
		$error="";// thong bao loi
		if(isset($_POST['ok'])){
			$this->User->setUserName($_POST['username']);
			$this->User->setPassword($_POST['password']);
			if($this->User->checkLogin()){
				$this->Session->write($this->sessionUsername,$this->User->getUserName());
			}else{
				$error = "Username or Password wrong";
			}
		}
		header("Location: {$_SERVER['HTTP_REFERER']}");
    	exit;
		//$url=$_SERVER[ 'REQUEST_URI' ];
		//$this->render("index");
	}  //---------- Logout 
    function logout(){ 
        $this->Session->delete($this->sessionUsername,$this->User->getUserName());
        header("Location: {$_SERVER['HTTP_REFERER']}");
    	exit;
    } 
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
	
	*/
}