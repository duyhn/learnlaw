<?php
class TuvanController extends AppController {
	var $name="Tuvan";
	public function index(){
		
	}
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index'));
	}
}
?>