<?php
class GioithieuController extends AppController
{
	function  index(){
		$this->set('title_for_layout', 'Giới thiệu');
		$this->set("content","Welcome");
	
	}
}
?>