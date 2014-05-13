<?php
class TestsController extends AppController{
	var $name="Tests";

	function index(){
		$this->set("data",$this->Test->getAllTypesQuestion());

		/*if(!$this->Session->read($this->sessionUsername)){
			echo "<script type='text/javascript'>alert('bạn chưa đăng nhập!')</script>";
		header("Location: {$_SERVER['HTTP_REFERER']}");
		}*/
	}
	function testOnline($id,$page){
		$data=$this->Test->getAllQuestions($id);
		$arr=array();
		if(!$this->Session->read("test")){
			foreach ($data as $item){
					
				$method=$this->Test->getAllMethods($item['questions']['id']);
				array_push($arr,array("question"=>$item,"method"=>$method));
			}
			$this->Session->write("test",$arr);
		}

		$arr=$this->Session->read("test");
		$data1=array();
		for ($i=(($page-1)*10);$i<$page*10;$i++){
			if(!empty($arr[$i]))
				array_push($data1,$arr[$i]);
		}

		$this->set("data",$data1);
	}
}
?>
<!-- <div id="bp_count_down_div"></div> 
<script language="JavaScript"> 
var bp_date_target = new Date("December 25, 2014 00:00:00"); 
var bp_date_now = new Date(); 
var bp_count_down_complete_message = "Chúc Giáng Sinh Vui Vẻ"; 
if (bp_date_now >= bp_date_target) {
	document.getElementById("bp_count_down_div").innerHTML = bp_count_down_complete_message; 
	} 
	else { 
		bp_time_difference = Math.floor(((bp_date_target - bp_date_now).valueOf()) / 1000); 
		display_time_difference(bp_time_difference); 
		} 
		function display_time_difference(bp_time_difference) { 
			if (bp_time_difference <= 0) {
				 document.getElementById("bp_count_down_div").innerHTML = bp_count_down_complete_message; 
				 return; 
				 } 
			 bp_count_down_message = bp_format_seconds(bp_time_difference, 86400, 100000) + " Ngày " + bp_format_seconds(bp_time_difference, 3600, 24) + " Giờ " + bp_format_seconds(bp_time_difference, 60, 60) + " Phút " + bp_format_seconds(bp_time_difference, 1, 60) + " Giây là tới Giáng Sinh"; 
			 document.getElementById("bp_count_down_div").innerHTML = bp_count_down_message;
			 setTimeout("display_time_difference(" + (bp_time_difference - 1) + ")", 1000); 
			 } 
		 function bp_format_seconds(secs, num1, num2) { num = ((Math.floor(secs / num1)) % num2).toString(); if (num.length < 2) s = "0" + num; return "" + num + ""; } </script>
-->