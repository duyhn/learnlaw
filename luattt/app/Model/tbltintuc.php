<?php
class TbltintucModel extends AppModel{
	var $name="Tbltintuc";
	private $tieude;
	private $noidung;
	private $tacgia;
	private $ngaythang;
	private $id_theloai;
	private $ten_anh;
	private $hien_an;
	private $duyet;
	private $solanxem;	
	
	function setTieude($tieude){
		$this->tieude=$tieude;
	}
	function getTieude(){
		if(!isset($this->tieude)){
			$this->tieude="";
		}
		return $this->tieude;
	}
	
	function setNoidung($noidung){
		$this->noidung=$noidung;
	}
	function getNoidung(){
		if(!isset($this->noidung)){
			$this->noidung="";
		}
		return $this->noidung;
	}
	
	function setTacgia($tacgia){
		$this->tacgia=$tacgia;
	}
	function getTacgia(){
		if(!isset($this->tacgia)){
			$this->tacgia="";
		}
		return $this->tacgia;
	}
	
	function setNgaythang($ngaythang){
		$this->ngaythang=$ngaythang;
	}
	function getNgaythang(){
		if(!isset($this->ngaythang)){
			$this->ngaythang="";
		}
		return $this->ngaythang;
	}
	
	function setIdtheloai($id_theloai){
		$this->id_theloai=$id_theloai;
	}
	function getIdtheloai(){
		if(!isset($this->id_theloai)){
			$this->id_theloai="";
		}
		return $this->id_theloai;
	}
	
	function setTen_anh($ten_anh){
		$this->ten_anh=$ten_anh;
	}
	function getTen_anh(){
		if(!isset($this->ten_anh)){
			$this->ten_anh="";
		}
		return $this->ten_anh;
	}
	
	function setHienan($hien_an){
		$this->hien_an=$hien_an;
	}
	function getHienan(){
		if(!isset($this->hien_an)){
			$this->hien_an="";
		}
		return $this->hien_an;
	}
	
	function setDuyet($duyet){
		$this->duyet=$duyet;
	}
	function getDuyet(){
		if(!isset($this->duyet)){
			$this->duyet="";
		}
		return $this->duyet;
	}
	
	function setSolanxem($solanxem){
		$this->solanxem=$solanxem;
	}
	function getSolanxem(){
		if(!isset($this->solanxem)){
			$this->solanxem="";
		}
		return $this->solanxem;
	}
}
?>