<?php
class TestsController extends AppController{
	var $name="Tests";
	var $sessioncrtime="time";
	var $time=1800;
	public $uses = array('Method','Test');
	function index(){
		$this->set("data",$this->Test->getAllTypesQuestion());

		/*if(!$this->Session->read($this->sessionUsername)){
			echo "<script type='text/javascript'>alert('báº¡n chÆ°a Ä‘Äƒng nháº­p!')</script>";
		header("Location: {$_SERVER['HTTP_REFERER']}");
		}*/
	}
	function testOnline($id=null,$page=null){
		if(isset($this->request->data)){
			$this->submitform($this->request->data);
		}
		$nowtime=time();
		if(!$this->Session->read($this->sessioncrtime)){
			$this->Session->write($this->sessioncrtime,time());
		}
		$timesr=$this->time-($nowtime-$this->Session->read($this->sessioncrtime));
		
		$arr=array();
		if(!$this->Session->read("test")){
			$data=$this->createQuestion($id);
		
			foreach ($data as $item){
				$method=$this->Test->getAllMethods($item['questions']['id']);
				array_push($arr,array("question"=>$item,"method"=>$method,"chekmethod"=>null));
			}
			$this->Session->write("test",$arr);
		}
		
		$arr=$this->Session->read("test");
		$data1=array();
		for ($i=(($page-1)*10);$i<$page*10;$i++){
			if(!empty($arr[$i]))
				array_push($data1,$arr[$i]);
		}
		$this->set("method",$this->Method->find("all", array('conditions' => array('Method.id' => 1))));
		$this->set("data",$data1);
		$this->set("time",$timesr);
		
	}
	function submittest(){
		if($this->Session->read("test")){
		$data=$this->request->data;
		
		$this->submitform($data);
		$data=$this->Session->read("test");
		$corect=0;
		foreach ($data as $item){
			if(isset($item["chekmethod"]) && $item["chekmethod"]!=null){
				$method=$this->Method->find("all", array('conditions' => array('Method.id' => $item["chekmethod"])));
				if(isset($method) && $method[0]['Method']['corect']){
					$corect++;
				}
			}
			
		}
		$this->set("core",round((10/30)*$corect,2));
		$this->set("numbercorect",$corect);
		$this->Session->delete($this->sessioncrtime);
		$this->Session->delete("test");
		}
		else{
			$this->set("data",$this->Test->getAllTypesQuestion());
			$this->render("index");
		}
			
	}
	function submitform($data){
		
		foreach ($data as $item){
			if(isset($item) && $item!=null){
				$st=split("-",$item);
				$this->findIdQuestion($st[0],$st[1]);
			}
		}
	}
	function findIdQuestion($idqs,$anser){
		if($this->Session->read("test")){
			$data=$this->Session->read("test");
			$i=0;
			foreach($data as $item){
				if($idqs==$item['question']['questions']['id'])
					$data[$i]['chekmethod']=$anser;
				$i++;
			}
			$this->Session->write('test',$data);
		}
	}
	
	function createQuestion($id){
		$data=$this->Test->getAllQuestions($id);
		$arr=array();
		$result=array();
		$i=0;
		while ($i<20){
			$rd=rand ( 0 , count($data)-1);
			if(array_search($rd,$arr)==null ){
				array_push($arr,$rd);
				$i++;
			}
		}
		foreach ($arr as $item){
			array_push($result,$data[$item]);
		}
		return $result;
	}
}
?>
