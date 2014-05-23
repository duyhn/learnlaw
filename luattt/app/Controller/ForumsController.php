<?php

class ForumsController extends AppController {

	//public $components = array('Paginator','Auth');
	public $uses = array('Forum','User');

	public function view_active() {
		$this->set('title_for_layout', 'View Active Users');
		$this->layout="forum";
	}
	public function beforeFilter() {
		if (!isset($this->Auth)) {
			echo "loi";
			die;
		}
		$this->Auth->allow();
	}
	 
	public function index() {

		//$this->Paginator->settings['contain'] = array('Topic', 'Post'=>array('User','Topic'));
		//$this->set('forums', $this->Paginator->paginate());

		//$tb=new User();
		$data= $this->User->find('count');
		$this->set('data',$data);
		//$frusers = $this->Forum->User->find('lisst');
		$this->set('countForum',$this->Forum->find('count')) ;
		$this->set('countTopic',$this->Forum->Topic->find('count')) ;
		$this->set('countPost',$this->Forum->Post->find('count')) ;
		$this->populateForum();
	}

	public function pagination($page,$numberrecord,$end){
		$numberrecord=(round($numberrecord/$this->numberRecord)>0?($numberrecord%$this->numberRecord>0? round($numberrecord/$this->numberRecord)+1:round($numberrecord/$this->numberRecord)):1);
		$end=($end<$numberrecord?$end:$numberrecord);
		$pageend=$page+$this->numberpageStep;
		$pageend=($pageend<=$end?($page-$this->numberpageStep>($end-$this->numberpage)?$end:($page-$this->numberpageStep>1?$end-$this->numberpageStep+1:$this->numberpage)):($pageend<$numberrecord?$pageend:$numberrecord));
		$pagebgin=$pageend-$this->numberpage+1;
		$pagebgin=($pagebgin>1?$pagebgin:1);
		$this->set("pageend",$pageend);
		$this->set("pagebgin",$pagebgin);
		$this->set("page",$page);
		$this->set("numberrecord",$numberrecord);

	}
	public function populateForum($page=null,$end=null){

		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		//$forumId=(($idtype==null || !isset($idtype))?1:$idtype);
		$forums=$this->Forum->find('all',array('limit' => $this->numberRecord, 'offset'=>$page-1));
		for($i=0;$i<count($forums);$i++){
			for($j=0;$j<count($forums[$i]['Post']);$j++){
				array_push($forums[$i]['Post'][$j],array($this->User->find("first",array('conditions'=>array('User.user_id'=>$forums[$i]['Post'][$j]['user_id'])))));
			}
		}
		$this->set("forums",$forums);
		$numberrecord=$this->Forum->find('count');
		$this->pagination($page, $numberrecord,$end);

	}

}