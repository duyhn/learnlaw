<?php
	class role extends LuatAppModel{
	var $name="Role";
	private $rolename;
	
	function setRolename($rolename){
		$this->rolename=$rolename;
	}
	function getRolename(){
		if(!isset($this->rolename)){
			$this->rolename="";
		}
		return $this->rolename;
	}
}
?>