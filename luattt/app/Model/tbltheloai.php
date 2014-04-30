<?php
class Tbltheloai extends LuatAppModel{
	var $name="Tbltheloai";
	private $tentheloai;
	
	function setTentheloai($tentheloai){
		$this->tentheloai=$tentheloai;
	}
	function getTentheloai(){
		if(!isset($this->tentheloai)){
			$this->tentheloai="";
		}
		return $this->tentheloai;
	}
	
}
?>