<?php
class TestsController extends AppController{
	var $name="Tests";
	var $sessioncrtime="time";
	var $time=1800;
	public $uses = array('Method','Test','Question','Result');
	function index(){
		$this->set("data",$this->Test->getAllTypesQuestion());

		/*if(!$this->Session->read($this->sessionUsername)){
			echo "<script type='text/javascript'>alert('báº¡n chÆ°a Ä‘Äƒng nháº­p!')</script>";
		header("Location: {$_SERVER['HTTP_REFERER']}");
		}*/
	}
	function testOnline($id=null,$page=null){
		$id=isset($id)?$id:null;
		$page=isset($page)?$page:null;
		if(isset($this->request->data)&& count($this->request->data)>0){
			print_r($this->request->data);
			//$page=$this->request->data['page'];
			//$id=$this->request->data['qsid'];
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
				array_push($arr,array($item,"chekmethod"=>null));
			}
			$this->Session->write("test",$arr);
				
		}

		$arr=$this->Session->read("test");
		$data1=array();
		for ($i=(($page-1)*10);$i<$page*10;$i++){
			if(!empty($arr[$i]))
				array_push($data1,$arr[$i]);
		}
		//$this->set("method",$this->Method->find("all", array('conditions' => array('Method.id' => 1))));
		$this->set("data",$data1);
		$this->set("time",$timesr);
		$this->set("page",$page);
		$this->set("qsid",$id);

	}
	function submittest(){
		if($this->Session->read("test")){
			$data=$this->request->data;
			$this->submitform($data);
			$data=$this->Session->read("test");
			$this->Session->write("result",$data);
			$arr=array();
			for ($i=0;$i<10;$i++){
				if(!empty($data[$i]))
					array_push($arr,$data[$i]);
			}
			$this->set("data",$arr);
			$corect=0;
			foreach ($data as $item){
				if(isset($item["chekmethod"]) && $item["chekmethod"]!=null){
					$method=$this->Method->find("all", array('conditions' => array('Method.id' => $item["chekmethod"])));
					if(isset($method) && $method[0]['Method']['corect']){
						$corect++;
					}
				}
					
			}
			
			$core=round((10/30)*$corect,2);
			$this->set("core",round((10/30)*$corect,2));
			$this->set("numbercorect",$corect);
			$this->Session->delete($this->sessioncrtime);
			$qs=array();
			foreach ($data as $item){
				array_push($qs,$item[0]['Question']['id']."-".$item['chekmethod']);
			}
			$result=join(",",$qs);
			$test=array();
			$test['question']=$result;
			$time=date("YmdHis", time());
			$test['testdate']=$time;
			$this->Test->save($test);
			$test=$this->Test->find("first",array('conditions'=>array('Test.question'=>$result,'Test.testdate'=>$time)));
			$result=array();
			$result['user_id']=$this->Session->read($this->sessionUserid);
			$result['test_id']=$test['Test']['id'];
			$result['results']=$core;
			$this->Result->saveAll($result);
			$this->Session->delete("test");
		}
		else{
			$this->viewResult(1);
			//$this->set("data",$this->Test->getAllTypesQuestion());
			//$this->render("viewResult");
		}
			
	}
	function submitform($data){

		foreach ($data as $item){
			if(isset($item) && $item!=null){
				$st=split("-",$item);
				if(count($st>1))
					$this->findIdQuestion($st[0],$st[1]);
			}
		}
	}
	function findIdQuestion($idqs,$anser){

		if($this->Session->read("test")){
			$data=$this->Session->read("test");
				
			$i=0;
			foreach($data as $item){
				if($idqs==$item[0]['Question']['id'])
					$data[$i]['chekmethod']=$anser;
				$i++;
			}
			$this->Session->write('test',$data);
		}
	}

	function createQuestion($id){
		$data=$this->Question->find("all",array('conditions' => array('Question.id_type' => $id)));
		$arr=array();
		$result=array();
		$i=0;
		while ($i<20){
			$rd=rand ( 0 , count($data)-1);
			if($this->checkexistArray($arr, $rd)){
				array_push($arr,$rd);
				$i++;
			}
			/*if(array_search($rd,$arr)==null ){
				array_push($arr,$rd);
				$i++;
			}*/
		}
		foreach ($arr as $item){
			array_push($result,$data[$item]);
		}
		return $result;
	}
	public function confirmTest($id=null,$page=null) {
		$this->set("idtypequestion",$id);
		$this->set("page",$page);
	}
	public function viewResult($page=null){
		$arr=$this->Session->read("result");
		$data1=array();
		for ($i=(($page-1)*10);$i<$page*10;$i++){
			if(!empty($arr[$i]))
				array_push($data1,$arr[$i]);
		}
		$this->set("data",$data1);
		$this->set("page",$page);
		$this->render("submittest");
		
	}
	public function checkexistArray($arr,$int){
		if(isset($arr)&& count($arr)>0){
			foreach ($arr as $item){
				if($item==$int)
					return false;
			}
		}
		return true;
	} 
}
?>
