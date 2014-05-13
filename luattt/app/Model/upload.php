<?php
class Upload extends AppModel{
	var $name="Upload";
	private $nameIm;
	private $path;
	private $type;
	private $size;
	private $date;
	private $idloai;
	private $dem;

	/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'Tblloaitailieu' => array(
            'className' => 'Tblloaitailieu',
            'foreignKey' => 'idloai',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
	function setNameIm($nameIm){
		$this->nameIm=$nameIm;
	}
	function getNameIm(){
		if(!isset($this->nameIm)){
			$this->nameIm="";
		}
		return $this->nameIm;
	}
	
	function setPath($path){
		$this->path=$path;
	}
	function getPath(){
		if(!isset($this->path)){
			$this->path="";
		}
		return $this->path;
	}
	
	function setType($type){
		$this->type=$type;
	}
	function getType(){
		if(!isset($this->type)){
			$this->type="";
		}
		return $this->type;
	}
	
	function setSize($size){
		$this->size=$size;
	}
	function getSize(){
		if(!isset($this->size)){
			$this->size="";
		}
		return $this->size;
	}
	
	function setDate($date){
		$this->date=$date;
	}
	function getDate(){
		if(!isset($this->date)){
			$this->date="";
		}
		return $this->date;
	}
	
	function setIdloai($idloai){
		$this->idloai=$idloai;
	}
	function getIdloai(){
		if(!isset($this->idloai)){
			$this->idloai="";
		}
		return $this->idloai;
	}
	
	function setDem($dem){
		$this->dem=$dem;
	}
	function getDem(){
		if(!isset($this->dem)){
			$this->dem="";
		}
		return $this->dem;
	}
	
	function findbyIdLoaiTL($id){
	    $kq = "SELECT * FROM uploads WHERE idloai='" . $id . "'";
		$data = $this->query($kq);		
		//$this->set("data",$data); //gan gia tri vao bien data de hien thi gia tri tuong ung
		return $data;
	}
}
?>