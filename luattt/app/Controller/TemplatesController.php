<?php
class TemplatesController extends AppController{
	//var $layout = "template";
	//var $helpers = array();
 	public function beforeFilter() {
        $this->Auth->allow('index','view');
    }
	
	function  index(){
		$this->set('title_for_layout', 'Learn laws');
		$this->set("content","Welcome");
		//$dt=$this->Tbltintuc->find("all");
		$this->set("data","");
		
	}
	/*function content(){
		
	}*/
	
}
?>