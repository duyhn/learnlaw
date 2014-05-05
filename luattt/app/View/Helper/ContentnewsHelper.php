<?php
class ContentnewsHelper extends HtmlHelper{
	function hienthinoidung($idtloai){
		$nd= new CommonModel();
		//$idtloai=1;//xemlai
		$out="";
		$data=$nd->query( "SELECT tieude,id_tintuc,ngaythang, solanxem,id_theloai FROM tbltintucs where id_theloai=".$idtloai." ORDER BY ngaythang");
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
            $out.=$this->link($tt,array('controller' => 'Tbltintucs','action' => 'view',$item['tbltintucs']['id_tintuc']))."<span style='padding:10px;'>($ngay)</span><p style='padding:10px;'>(số lần xem: $solanxem)</p>";
            $out.="</ul></li></div>";
        }
        return $out;
	}
	
}
?>


