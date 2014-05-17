<?php
class TuvanController extends AppController {
	var $name="Tuvan";
	public $uses = array('Typeconsulting','Consulting');
	public function index($idTypeconsulting=null){
		if(isset($idTypeconsulting)){
			$Consultings=$this->Typeconsulting->find("all",array('conditions' => array('Typeconsulting.id' => $idTypeconsulting)));
			$this->set("Consultings",$Consultings);
			$this->set("test",$this->Typeconsulting->find('all'));
			$this->set("idTypeconsulting",$idTypeconsulting);
		}
		$this->populateForm();
	}
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index','createConsultings'));
	}
	public function createConsultings() {
		$data=$this->request->data;
		$this->Consulting->saveAll($data);
		$this->set("message","Câu hỏi của bạn đã được gởi đi!");
		$this->populateForm();
		$this->render('index');
	}
	public function populateForm(){
		$typeconsulting=$this->Typeconsulting->find('all');
		$this->set("typeconsulting",$typeconsulting);
	}
}
?>