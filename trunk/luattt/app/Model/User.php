<?php
class User extends AppModel{
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
		$sql = "Select username,pass from users Where username='".$this->getUserName()."' AND pass ='".$this->getPassword()."'";
		$data=$this->query($sql);
		if(count($data)==0){
			return false;
		}
		return true;
	}
	//
	}
?>