<?php
class Tblloaitailieu extends AppModel{
	var $name="Tblloaitailieu";
	private $tenloai;
	private $mota;
	public $primaryKey = 'idloai';
	
	/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'Upload' => array(
            'className' => 'Upload',
            'foreignKey' => 'idloai',
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
    
	function setTenloai($tenloai){
		$this->tenloai=$tenloai;
	}
	function getTenloai(){
		if(!isset($this->tenloai)){
			$this->tenloai="";
		}
		return $this->tenloai;
	}
	
	function setMota($mota){
		$this->mota=$mota;
	}
	function getMota(){
		if(!isset($this->mota)){
			$this->mota="";
		}
		return $this->mota;
	}
	
}
?>