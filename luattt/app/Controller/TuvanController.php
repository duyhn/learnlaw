<?php
class TuvanController extends AppController {
	var $name="Tuvan";
	public $uses = array('Typeconsulting','Consulting');
	public function index($idTypeconsulting=null,$page=null,$end=null){
		$idtype=$this->Typeconsulting->find('first');
		$idTypeconsulting=((isset($idTypeconsulting)&&$idTypeconsulting!=null)?$idTypeconsulting:$idtype['Typeconsulting']['id']);
		
		$this->populateForm($idTypeconsulting=null,$page=null,$end=null);
	}
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index','createConsultings'));
	}
	public function createConsultings($begin=null,$end=null) {
		
		$data=$this->request->data;
		
		if($this->Session->read($this->sessionUsername)!=null)
			$data['auther']=$this->Session->read($this->sessionUsername);
		else 
			$data['auther']="guest";
		
		$this->Consulting->saveAll($data);
		$this->set("message","Câu hỏi của bạn đã được gởi đi!");
		$this->populateForm($data['typeconsulting_id'],$begin,$end);
		$this->render('index');
	}
	public function populateForm($idTypeconsulting=null,$page=null,$end=null){
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$Consultings=$this->Consulting->find("all",array('order'=>array('Consulting.consulting_date DESC'),'limit' => 5, 'offset'=>0));
		$this->set("Consultings",$Consultings);
		$consultingn=$this->Consulting->find("all",array('conditions' => array('Consulting.typeconsulting_id' => $idTypeconsulting),'limit' => $this->numberRecord, 'offset'=>$page-1));
		$this->set("consultingn",$consultingn);
		$numberrecord=$this->Consulting->find('count',array('conditions' => array('Consulting.typeconsulting_id' => $idTypeconsulting)));
		$typeconsulting=$this->Typeconsulting->find('all');
		$this->set("typeconsulting",$typeconsulting);
		$this->set("idTypeconsulting",$idTypeconsulting);
		$this->pagination($page, $numberrecord, $end);
	}
}
?>