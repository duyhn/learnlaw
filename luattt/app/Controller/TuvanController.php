<?php

include_once('..\View\Helper\simple_html_dom.php');
class TuvanController extends AppController {
	var $name="Tuvan";
	public $uses = array('Typeconsulting','Consulting','Resultconsulting');
	public function index($idTypeconsulting=null,$page=null,$end=null){
		$idtype=$this->Typeconsulting->find('first');
		$idTypeconsulting=((isset($idTypeconsulting)&&$idTypeconsulting!=null)?$idTypeconsulting:$idtype['Typeconsulting']['id']);

		$this->populateForm($idTypeconsulting=null,$page=null,$end=null);
	}
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index','createConsultings','getRssTuvan','detail','formConsulting'));
	}
	public function createConsultings($begin=null,$end=null) {

		$data=$this->request->data;

		if($this->Session->read($this->sessionUsername)!=null)
			$data['auther']=$this->Session->read($this->sessionUsername);
		else
			$data['auther']="guest";

		$this->Consulting->saveAll($data);
		$this->set("msg","'Câu hỏi của bạn đã được gởi đi!'");
		$this->populateForm($data['typeconsulting_id'],$begin,$end);
		$this->render('formConsulting');
	}
	public function populateForm($idTypeconsulting=null,$page=null,$end=null){
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$this->set("typeconsulting",$this->Typeconsulting->find("all"));
		$this->set("idTypeconsulting",1);
		$result=$this->Resultconsulting->find("all",array('order'=>array('Resultconsulting.result_date DESC'),'limit' => 7));
		$this->set("resultNews",$result);
		$resultFeat=$this->Resultconsulting->find("all",array('order'=>array('Resultconsulting.view DESC'),'limit' => 7));
		$this->set("resultFeat",$result);
		
// 		$Consultings=$this->Consulting->find("all",array('order'=>array('Consulting.consulting_date DESC'),'limit' => 5, 'offset'=>($page-1)*$this->numberRecord));
// 		$this->set("Consultings",$Consultings);
// 		$consultingn=$this->Consulting->find("all",array('conditions' => array('Consulting.typeconsulting_id' => $idTypeconsulting),'limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord));
// 		$this->set("consultingn",$consultingn);
// 		
// 		$typeconsulting=$this->Typeconsulting->find('all');
// 		$this->set("typeconsulting",$typeconsulting);
// 		$this->set("idTypeconsulting",$idTypeconsulting);
		$numberrecord=$this->Consulting->find('count',array('conditions' => array('Consulting.typeconsulting_id' => $idTypeconsulting)));
		$this->pagination($page, $numberrecord, $end);
	}
	//
	public function detail($idconsul=null) {
		if(!isset($idconsul)|| $idconsul==null){
			$this->render('index');
		}
		$consulting=$this->Consulting->find("first",array('conditions' => array('Consulting.id' => $idconsul)));
		$this->set("consulting",$consulting);
		$this->set("conlustings",$this->Consulting->find('all',array('conditions' => array('Consulting.typeconsulting_id'=>$consulting['Consulting']['typeconsulting_id'], 'Consulting.id !='=>$idconsul ),'limit'=>5)));
		$this->populateForm($consulting['Consulting']['typeconsulting_id'],null,null);
	}
	
	//
	public function getRssTuvan(){
		try {
			$urlrss="http://tuvan.tinmoi.vn/rss/hoi-dap-phap-luat.rss";
			$dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom
			$dom->load($urlrss)    ;//muon lay rss tu trang nao thi ban khai bao day
			$items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items
			$dom1=new DOMDocument('1.0','utf-8');
			$i=0;
			
			foreach($items as $item)//lap
			{
				// 				$i++;
				// 				if($i==5)
					// 					break;
				$consul=array();

				$titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles
				$title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles

				$descriptions=$item->getElementsByTagName('description');
				$des=$descriptions->item(0);
				$links=$item->getElementsByTagName('link');
				$link=$links->item(0);
				//load tin tuc
				//$html = new simple_html_dom();
				$html=file_get_html($link->nodeValue);
				$element = $html->find("h1");
				$spanNgay=$html->find("span");

				//$data.="<tr><td>".$element[0]->innertext."<td><td>".$spanNgay[0]->outertext."</td></tr>";
				$divMota=$html->find("div.one_answer");
				if(isset($divMota)&& count($divMota)>0){
					//luu csdl
					$consul['typeconsulting_id']=1;
					$consul['title']=$element[0]->innertext;
					$consul['contents']=$spanNgay[0]->innertext;
					$consul['auther']="admin";
					$chekarr=$this->Consulting->find("first",array('conditions' => array('Consulting.title' => $consul['title'])));

					if (!isset($chekarr) || $chekarr==null) {
						$this->Consulting->saveAll($consul);
						$con=$this->Consulting->find("first",array('conditions' => array('Consulting.title' => $consul['title'])));
						$resultcon=array();
						$resultcon['user_id']=1;
						$resultcon['consulting_id']=$con['Consulting']['id'];
						$resultcon['title']=$consul['title'];
						$resultcon['contents']=$divMota[0]->outertext;
						$this->Resultconsulting->saveAll($resultcon);
					}
				}


				//
				//$content="<div>".$divMota[0]->outertext."".$divcontent[0]->outertext."</div>";
				//lu vao csdl
				//$datas=$tbltt->query("SELECT * FROM consultings WHERE title='".$element[0]->innertext."'");
				//if(count($datas)==0){
				//$tbltt->query("insert into consultings(typeconsulting_id,title,content,auther) values(1,'".$element[0]->innertext."','".$spanNgay[0]->outertext."','guest')");
				//$datas=$tbltt->query("SELECT * FROM consultings WHERE title='".$element[0]->innertext."'");
				//$tbltt->query("insert into resultconsultings(consulting_id,title,content,user_id) values(".$datas['consultings']['id'].",'".$element[0]->innertext."','".$divMota[0]->outertext."',1)");
				//}
			}		
		} catch (Exception $e) {
			echo "error".$e;
		}
		$this->render('index');
	}
	public function formConsulting(){
		
		$this->populateForm(null,null,null);
	}
}
?>