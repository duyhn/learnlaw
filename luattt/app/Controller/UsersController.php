<?php
class UsersController extends AppController{
	var $name="Users";
	//var $_sessionUsername  = "Username";
	function  index(){
		$this->set('title_for_layout', 'Learn laws');
	}
	//login
	//--------- Login
	function login(){
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
	
	
}