<?php
class Tbltintuc extends AppModel{
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
	var $primaryKey = 'id_tintuc';
	
	function setId($id_tintuc){
		$this->id_tintuc=$id_tintuc;
	}
	function getId(){
		if(!isset($this->id_tintuc)){
			$this->id_tintuc="";
		}
		return $this->id_tintuc;
	}
	
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
	///
	/*function detailNews(){
		$id=1;
		$nd= new TbltintucModel();
		$sql= "SELECT * FROM tbltintucs WHERE id_tintuc = {$id}";
		$data = $nd->query($sql);
		$output="";
		if(count($data>0))
		{
			$date = $data[0]['tbltintucs']['ngaythang'];
	        $d = getdate(strtotime($date));
	        $inngay = $d['mday'].'/'.$d['mon'].'/'.$d['year'];
	
	        $output .= '<div class="tieude tenthongbao float">' . $row["tieude"] . '</div>';
	        $output .= '<div style="font-size:11px;padding-top:23px;">' . $inngay .'<span style="padding:10px;">Author: '. $row['tacgia'] . '</span></div>
	                    <div class="clear"></div>';
	        $output .= '<div>' . $data[0]['tbltintucs']["noidung"] . '</div>';
	        $solanxem =  $data[0]['tbltintucs']['solanxem'];
	        $kq = "UPDATE tbltintucs SET solanxem='".($solanxem + 1)."' WHERE id_tintuc='" . $id . "'";
    	$query=$nd->query($kq);
		$output.="<div style='font-size:12px;float:right;padding:5px 30px 0 0;'>(" . $solanxem + 1 . " lần xem)</div>";
		}
	}
	//select
	function viewAllTin(){		
		//$sql = "SELECT * FROM tbltintucs";
		//$data = $this->Tbltintuc->query($sql);
		$data=$this->Tbltintuc->find("all");
        $this->set("data",$data); //gan gia tri vao bien data de hien thi gia tri tuong ung
	}
	*/
	function findTinbyId($id){
	    $kq = "UPDATE tbltintucs SET solanxem = solanxem +1 WHERE id_tintuc='" . $id . "'";
		$this->query($kq);
	    $sql= "SELECT * FROM tbltintucs WHERE id_tintuc = {$id}";
		$data = $this->query($sql);		
		//$this->set("data",$data); //gan gia tri vao bien data de hien thi gia tri tuong ung
		return $data;
	}
/*	//insert
	function insert($id){
        $sql = "INSERT  * FROM tbltintucs WHERE id_tintuc = {$id}";
		$data = $this->Tbltintuc->query($sql);
        $this->set("data",$data);
    } 
    //update
	function updateTin($id){
		$sql = "UPDATE tbltintucs SET solanxem=solanxem + 1 WHERE id_tintuc='" . $id . "'";
		$data = $this->Tbltintuc->query($sql);
		$this->set("data",$data);
	} */
	
	
}
?>