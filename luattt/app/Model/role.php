<?php
	class role extends AppModel{
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
	//
	public $hasMany = array(
			'User' => array(
					'className' => 'User',
					'foreignKey' => 'idRole',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			)
	);
}
?>