<?php
App::import("Model", "Tbltintuc");
class TbltintucsController extends AppController{
		public $name = "Tbltintucs";// ten cua Controller Tblloaitailieu
	public $helpers = array('Form','Paginator','Html','Common','Js');
	public $components = array('Session', 'RequestHandler','Paginator');
	public $paginate = array();
	public $uses = array('Tbltintuc');

	//var $uses = array('Tbltintuc');
	function beforeFilter()
	{
		$this->Auth->allow('view');
	}
	function  index(){
		$Tbltintucs = $this->Tbltintuc->find('all');
		$this->set("Tbltintucs", $Tbltintucs);
		$this->set('title_for_layout', 'Learn laws');
	}
	function view($id)
        {
        	$tb=new TbltintucModel();
          	$data= $tb->findTinbyId($id);
          	$this->set('data', $data);  
        }

    function edit($id = null)
    {
      if(empty($this->data))
          {
            if($id)
            {
              $Tbltintuc = $this->Tbltintuc->read(null, $id);
              $this->data = $Tbltintuc;
            } 
          }
          else
          {
             if($this->Tbltintuc->save($this->data))
             {
               $this->redirect('templates');
             }
          }      
    }
    
    function delete($id)
    {
      $this->Tbltintuc->del($id);
          $this->redirect('templates');            
    }
	//nhan request tu form va chuyen d lieu lai cho result()
	function search()
	{
		// the page we will redirect to
		$url['action'] = 'result';
		// build a URL will all the search elements in it
		// the resulting URL will be
		// example.com/cake/posts/index/Search.keywords:mykeyword/Search.tag_id:3
		foreach ($this->data as $k=>$v){
			foreach ($v as $kk=>$vv){
				$url[$k.'.'.$kk]=$vv;
			}
		}
		// redirect the user to the url
		$this->redirect($url, null, true);
	}
	//hien thi form search va hien thi phan trang
	function result(){
		$conditions = array();
		$data = array();
		if(!empty($this->passedArgs)){
			//Fillter title
			if(isset($this->passedArgs['Tbltintuc.tieude'])) {
				$tieude=$this->passedArgs['Tbltintuc.tieude'];
				$conditions[] = array(
						'Tbltintuc.tieude LIKE' => "%$tieude%",
				);
				$data['Tbltintuc']['tieude'] = $tieude;
				/*$this->Tblloaitailieu->tieude=$this->passedArgs['Tblloaitailieu.tieude'];
				 $conditions[] = array(
				 		'Tblloaitailieu.tieude LIKE' => "%$this->Tblloaitailieu->tieude %",
				 );
				$data['Tblloaitailieu']['tieude'] = $this->Tblloaitailieu->tieude;*/
			}
			//Fillter noidung
			if(isset($this->passedArgs['Tbltintuc.noidung'])) {
				$keywords = $this->passedArgs['Tbltintuc.noidung'];
				$conditions[] = array(
						"OR" => array(
								'Tbltintuc.noidung LIKE' => "%$keywords%"
						)
				);
				$data['Tbltintuc']['noidung'] = $keywords;
			}

			//Limit and Order By
			$this->paginate= array(
					'limit' => 4,
					'order' => array('tieude' => 'desc'),
			);
			$this->data = $data;//giu lai gia tri tim kiem tren form tim kiem
			$this->set("posts",$this->paginate("Tbltintuc",$conditions));
		}
	}
	//
	function add() {
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash('Your data has been saved.');
				//$this->redirect(array('action' => 'index'));
			}
		}
	}
	
}