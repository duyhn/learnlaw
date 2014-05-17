<?php
class Tbltheloai extends AppModel{
	var $name="Tbltheloai";
	private $tentheloai;
	var $primaryKey="id_theloai";
	function setTentheloai($tentheloai){
		$this->tentheloai=$tentheloai;
	}
	function getTentheloai(){
		if(!isset($this->tentheloai)){
			$this->tentheloai="";
		}
		return $this->tentheloai;
	}
	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
			'Tbltintuc' => array(
					'className' => 'Tbltintuc',
					'foreignKey' => 'id_theloai',
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