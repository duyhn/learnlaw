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
		$this->render("/users/login");
	}  //---------- Logout 
    function logout(){ 
        $this->Session->delete($this->sessionUsername,$this->User->getUserName());
    } 
    function register(){
    	$this->Session->delete($this->sessionUsername,$this->User->getUserName());
    }
	
	
}