<?php
include_once('..\View\Helper\simple_html_dom.php');
class TbltintucsController extends AppController {
	public $name = "Tbltintucs";// ten cua Controller Tblloaitailieu
	public $helpers = array('Form','Paginator','Html','Common','Js');
	public $components = array('Session', 'RequestHandler','Paginator');
	public $paginate = array();
	public $uses = array('Tbltintuc');

	//var $uses = array('Tbltintuc');
	function beforeFilter()
	{
		$this->Auth->allow('view','getNewsInWeb1','getNewsInWeb2','getNewsChinhsach',"getnewsVTC");
	}
	function  index(){
		$Tbltintucs = $this->Tbltintuc->find('all');
		$this->set("Tbltintucs", $Tbltintucs);
		$this->set('title_for_layout', 'Learn laws');
	}
	function view($id)
	{
		//	$tb=new TbltintucModel();
		$data= $this->Tbltintuc->findTinbyId($id);
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
	//========================================
	function getRssPhobien($urlrss,$idloai){
		try {

			$dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom xml
			$dom->load("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=976539B6-94DB-48F3-9186-3F6F47C3DA1A")    ;//muon lay rss tu trang nao thi ban khai bao day
			$items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items
			$dom1=new DOMDocument('1.0','utf-8');

			//thu vien lay noi dung html

			foreach($items as $item)//lap
			{

				$titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles

				$title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles
					
				$descriptions=$item->getElementsByTagName('description');
				$des=$descriptions->item(0);
				$links=$item->getElementsByTagName('link');
				$link=$links->item(0);
				//load tin tuc
				//$html = new simple_html_dom();
				$html=file_get_html($link->nodeValue);
				//if(!empty($html) && is_object($html->find("p.des"))  && is_object($html->find("div.box-content-news-detail"))){
				$element = $html->find("h1");
				$p=$html->find("p.des");
				$image=$html->find("img");

				//$divMota=$html->find("div.mota");
				$divcontent=$html->find("div.box-content-news-detail");
				// 				echo "3";
				$content="<div>".$p[0]->outertext."".$divcontent[0]->outertext."</div>";
				//luu vao csdl

				$data=$this->Tbltintuc->find("all",array('conditions' => array('Tbltintuc.tieude' => $element[0]->innertext)));
				print_r(count($data));
				if(!isset($data) || count($data)==0){
					$news=array();
					$news['id_theloai']=$idloai;
					$news['ten_anh']="null";
					$news['tieude']=$element[0]->innertext;
					$news['noidung']=$content;
					$news['solanxem']=0;
					$news['hien_an']=0;
					$news['modified']=date('y/m/d h:i:s',time());
					$news['nguon']="Cổng thông tin Bộ Tư Pháp";
					$news['ngaythang']=date('y/m/d h:i:s',time());
					$this->Tbltintuc->saveAll($news);
				}

				//}
				//$html=null;
			}

		} catch (Exception $e) {
			//print_r($e);
			return ;
		}

	}
	//==================
	function getRss($urlrss,$idloai){
		try {

			$dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom
			$dom->load($urlrss);//muon lay rss tu trang nao thi ban khai bao day
			$items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items
			$dom1=new DOMDocument('1.0','utf-8');
			$i=0;


			foreach($items as $item)//lap
			{
				$titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles
				$title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles
					
				$descriptions=$item->getElementsByTagName('description');
				$des=$descriptions->item(0);
				$links=$item->getElementsByTagName('link');
				$link=$links->item(0);
				//load tin tuc
				//$html = new simple_html_dom();
				$html=file_get_html($link->nodeValue);
				//if(!empty($html) && is_object($html->find("h1")) && is_object($html->find("span.date")) && is_object($html->find("div.news-content"))){
				$element = $html->find("h1");
				$image=$html->find("img");
					
				$spanNgay=$html->find("span.date");
				$divMota=$html->find("div.mota");
				$divcontent=$html->find("div.news-content");
				$content="<div>".$divMota[0]->outertext."".$divcontent[0]->outertext."</div>";
				//luu vao csdl

				$data=$this->Tbltintuc->find("all",array('conditions' => array('Tbltintuc.tieude' => $element[0]->innertext)));
				//$data=$tbltt->query("SELECT id_tintuc,tieude FROM tbltintucs WHERE tieude='".$element[0]->innertext."'");

				if(!isset($data) || count($data)==0){
				 $news=array();
				 
				 $news['tieude']=$element[0]->innertext;
				 $news['ten_anh']=null;
				 $news['noidung']=$content;
				 $news['solanxem']=0;
				 $news['hien_an']=0;
				 $news['modified']=date('y/m/d h:i:s',time());
				 $news['nguon']="Cổng thông tin Bộ Tư Pháp";
				 $news['ngaythang']=date('y/m/d h:i:s',time());
				 $this->Tbltintuc->saveAll($news);
						
				 $news=null;
			}
					
				//}
				$html=null;
			}
		} catch (Exception $e) {
			print_r($e);
			//return;
		}

	}
	public function getnewsVTC(){
		try {

			$dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom
			$dom->load("http://vtc.vn/RssCate.aspx");//muon lay rss tu trang nao thi ban khai bao day
			$items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items
			$dom1=new DOMDocument('1.0','utf-8');

			foreach($items as $item)//lap
			{
				$titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles
				$title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles
					
				$descriptions=$item->getElementsByTagName('description');
				$des=$descriptions->item(0);
				//echo $des->nodeValue;
				$links=$item->getElementsByTagName('link');
				$link=$links->item(0);
				//load tin tuc

				$html=file_get_html($link->nodeValue);

				$titles = $html->find("h1.title");
				$images=$html->find("img");
				$divMota=$html->getElementById("pageContent",0);


				$content="<div>".$divMota->outertext."</div>";
				//luu vao csdl

				$data=$this->Tbltintuc->find("all",array('conditions' => array('Tbltintuc.tieude' => $titles[0]->innertext)));
				//$data=$tbltt->query("SELECT id_tintuc,tieude FROM tbltintucs WHERE tieude='".$element[0]->innertext."'");

				if(!isset($data) || count($data)==0){
					$news=array();
					$news['id_theloai']=7;
					$news['tieude']=$titles->innertext;
					$news['ten_anh']="null";
					$news['noidung']=$content;
					$news['nguon']="VTCNEWS";
					$news['ngaythang']=date('y/m/d h:i:s',time());
					$this->Tbltintuc->saveAll($news);
					$news=null;
				}

				//}
				$html=null;
			}
		} catch (Exception $e) {
			//print_r($e);
			return;
		}


	}
	//==============
	function getNewsInWeb1(){
		$this->getRssPhobien("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=976539B6-94DB-48F3-9186-3F6F47C3DA1A",8);
		//$this->getRssPhobien(,8);
		//$this->render('index');
		// 		$readrss = new ReadrssController("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=976539B6-94DB-48F3-9186-3F6F47C3DA1A",8);
		// 		$readrss->start();
		$this->render('index');
	}
	function getNewsInWeb2(){
		$this->getRss("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=9BB9ECE7-A84C-4671-A699-2EC8D1F7FE9D",7);
		$this->render('index');
		// 		$readrss = new ReadrssController("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=9BB9ECE7-A84C-4671-A699-2EC8D1F7FE9D",7);
		// 		$readrss->start();
		//$this->render('index');
	}
	function getNewsChinhsach(){
		$this->getRss("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=9BB9ECE7-A84C-4671-A699-2EC8D1F7FE9D",5);
		//$readrss->start();
		$this->render('index');

	}
}