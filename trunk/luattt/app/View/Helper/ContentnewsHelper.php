<?php
class ContentnewsHelper extends HtmlHelper{
	function hienthinoidung($idtloai){
		$nd= new CommonModel();
		//$idtloai=1;//xemlai
		$out="";
		$data=$nd->query( "SELECT tieude,id_tintuc,ngaythang, solanxem,id_theloai FROM tbltintucs WHERE id_theloai=".$idtloai." ORDER BY ngaythang DESC LIMIT 0,3");
		foreach ($data as $item) {
			$id_tintuc= $item['tbltintucs']['id_tintuc'];
			$tieude= $item['tbltintucs']['tieude'];
			$date= $item['tbltintucs']['ngaythang'];
			$d = getdate(strtotime($date));
			$ngay= $d['mday'].'/'.$d['mon'].'/'.$d['year'];
			$solanxem= $item['tbltintucs']['solanxem'];
			$out.="<div class='blockcontent-body'>";
			$out.="<ul><li>";
			$tt=$item['tbltintucs']['tieude'];
			$out.=$this->link($tt,array('controller' => 'Tbltintucs','action' => 'view',$item['tbltintucs']['id_tintuc']))."<p><span class='bitsmall'>($ngay)</span><span class='bitsmall'>($solanxem lần xem)</span></p>";
			$out.="</ul></li></div>";
			 
		}
		$out.=$this->tinlienquan($idtloai,$data);
		return $out;
	}
	function tinlienquan($idtloai,$datatin=null,$idtin=null){
		$where=" ";
		if(isset($idtin)){
			$where=" AND id_tintuc<>".$idtin;
		}
		$datatin=(isset($datatin)?$datatin:null);
		$nd= new CommonModel();
		$output ='<div class="clear more left">';
		$output .='<div class="tinthem left"><div class="left iconleft"></div>MORE</div>';
		$data=$nd->query("SELECT tieude,id_tintuc,ngaythang, solanxem,id_theloai FROM tbltintucs WHERE id_theloai=".$idtloai." ".$where."  ORDER BY ngaythang DESC LIMIT 0,5");
		foreach ($data as $item) {
			if(!$this->checkDisplay($item, $datatin)){
				$id_tintuc= $item['tbltintucs']['id_tintuc'];
				$tieude= $item['tbltintucs']['tieude'];
				$date= $item['tbltintucs']['ngaythang'];
				$d = getdate(strtotime($date));
				$ngay= $d['mday'].'/'.$d['mon'].'/'.$d['year'];
				$solanxem= $item['tbltintucs']['solanxem'];
				$tt=$item['tbltintucs']['tieude'];
				$output .= '<div class="left"><span class="icontin"></span>' . $this->link($tt,array('controller' => 'Tbltintucs','action' => 'view',$item['tbltintucs']['id_tintuc']))."<p style='margin-left:10px;'><span class='bitsmall'>($ngay)</span><span class='bitsmall'>($solanxem lần xem)</span></p></div>";
			}
		}
		$output .='</div>';


		return $output;
	}
	public function checkDisplay($tin,$arrtin=null){
		if(!isset($arrtin)|| $arrtin==null){
			return false;
		}
		foreach ($arrtin as $item){
			if($tin['tbltintucs']['id_tintuc']==$item['tbltintucs']['id_tintuc'])
			return true;
		}
		return false;
	}
}
?>


