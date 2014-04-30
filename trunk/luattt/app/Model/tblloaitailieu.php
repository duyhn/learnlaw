<?php
class Tblloaitailieu extends LuatAppModel{
	var $name="Tblloaitailieu";
	private $tenloai;
	
	function setTenloai($tenloai){
		$this->tenloai=$tenloai;
	}
	function getTenloai(){
		if(!isset($this->tenloai)){
			$this->tenloai="";
		}
		return $this->tenloai;
	}
	
}
?>