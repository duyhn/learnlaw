<?php
class User extends LuatAppModel{
	var $name="User";
	private $userName;
	private $password;
	
	function setUserName($username){
		$this->userName=$username;
	}
	function getUserName(){
		if(!isset($this->userName)){
			$this->userName="";
		}
		return $this->userName;
	}
	function setPassword($pass){
		$this->password=$pass;
	}
	function getPassword(){
		if(!isset($this->password)){
			$this->password="";
		}
		return $this->password;
	}
	//
	function checkLogin(){
		$sql = "Select username,pass from users Where username='$this->userName' AND pass ='$this->password'";
		$this->query($sql);
		if($this->getNumRows()==0){
			return false;
		}
		return true;
	}
}
?>