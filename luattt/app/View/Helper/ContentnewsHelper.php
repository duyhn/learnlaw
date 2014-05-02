<?php
class ContentnewsHelper extends FormHelper{
	
	function hienthinoidung($idtloai){
		$nd= new TbltintucModel();
		$out="";
		$data=$nd->query( "SELECT tieude,id_tintuc,ngaythang, solanxem,id_theloai FROM tbltintucs where id_theloai=".$idtloai." ORDER BY ngaythang LIMIT 0,6");
        foreach ($data as $item) {
            $id_tintuc= $item['tbltintucs']['id_tintuc'];
            $tieude= $item['tbltintucs']['tieude'];
            $date= $item['tbltintucs']['ngaythang'];
            $d = getdate(strtotime($date));
            $ngay= $d['mday'].'/'.$d['mon'].'/'.$d['year'];
            $solanxem= $item['tbltintucs']['solanxem'];
            $out.="<div class='blockcontent-body resize'>";
            $out.="<ul class='nav'><li>";
            $out.="<a href=''>$tieude</a><span style='padding:10px;'>($ngay)</span><p style=''>(số lần xem: $solanxem)</p>";
            $out.="</ul></li></div>";
        }
        return $out;
	}
	
}
?>


