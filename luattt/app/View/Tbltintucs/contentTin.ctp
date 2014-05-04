<?php
			$date = $Tbltintuc[0]['ngaythang'];
	        $d = getdate(strtotime($date));
	        $inngay = $d['mday'].'/'.$d['mon'].'/'.$d['year'];
?>
<div class="tieude tenthongbao float"><?php $Tbltintuc[0]['tieude'] ?></div>';
<div style="font-size:11px;padding-top:23px;"><?php $inngay ?>
	<span style="padding:10px;">Author: <?php $Tbltintuc[0]['tacgia'] ?></span></div>
<div class="clear"></div>
<div><?php  $Tbltintuc[0]['noidung']  ?></div>
<div style='font-size:12px;float:right;padding:5px 30px 0 0;'>( <?php $Tbltintuc[0]["solanxem"] ?> " lần xem)</div>
