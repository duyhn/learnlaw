<?php
	class Role extends AppModel{
	var $name="Role";
	private $rolename;
	public $primaryKey = 'idRole';
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