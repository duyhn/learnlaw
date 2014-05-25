<?php
class AdminController extends  AppController{
	var $name="Admin";

	public $uses = array('User','Role','Question','Typequestion','Method','Typeconsulting','Consulting','Resultconsulting','Tbltintuc','Tbltheloai','Upload','Tblloaitailieu','Forum','Topic','Post');

	public function index() {
		$data=$this->User->find('all');
		$this->set("data",$data);
	}
	//manage User
	function admin_managedUser($iduser=null,$page=null,$end=null){
		$this->populateEditForm($iduser,$page,$end);
	}
	function admin_formUpdateUser($iduser){

		$this->populateEditForm($iduser);
		$user=$this->User->find('first', array('conditions' => array('User.user_id' => $iduser)));
		$this->set('user',$user);
		$this->render('admin_managedUser');
	}
	public function admin_updateusser() {
		$this->populateEditForm();
		$this->User->updateAll(array('User.hoten' =>"'".$this->request->data('hoten')."'",
				'User.username'=>"'".$this->request->data('username')."'",'User.email'=>"'".$this->request->data('email')."'",'User.idRole'=>$this->request->data('idRole')),
				 array('User.user_id' => 1));
		$this->render('admin_managedUser');
	}
	public function admin_createuser() {
		if($this->request->is('post')){
		//	$this->request->data['password']='123';
			$this->request->data['password'] = Security::hash($this->request->data['password'],NULL,TRUE);	
			$this->User->save($this->request->data);
		}
		/*$this->request->data['password']='123';
		$this->set("form",$this->request->data);*/
		$this->populateEditForm();
		$this->render('admin_managedUser');
	}
	
	public function admin_deleUser($iduser) {
		if($this->request->is('get')){
			$this->User->deleteAll(array('User.user_id'=>$iduser));
		}
		$this->populateEditForm();
		$this->render('admin_managedUser');
	}
	
	public function populateEditForm($iduser=NULL,$page=null,$end=null){
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$idtype=(($iduser==null || !isset($iduser))?1:$iduser);
		
		$this->set("data",$this->User->find('all',array('conditions'=>array('User.user_id'=>$iduser), 'limit' => $this->numberRecord, 'offset'=>$page-1)));
		$numberrecord=$this->User->find('count',array('conditions'=>array('User.user_id'=>$iduser)));
		if($iduser==1 || $iduser==null){
			$this->set("data",$this->User->find('all',array('limit' => $this->numberRecord, 'offset'=>$page-1)));
			$numberrecord=$this->User->find('count');
		}
		//$numberrecord=(round($numberrecord/$this->numberRecord)>0?($numberrecord%$this->numberRecord>0? round($numberrecord/$this->numberRecord)+1:round($numberrecord/$this->numberRecord)):1);
		
		$data=$this->User->find('all');
		$role=$this->Role->find('all');
		$this->set("data",$data);
		$this->set('role',$role);
		$this->set("iduser",$iduser);
		$this->pagination($page, $numberrecord,$end);
	}

	//end manage user
	public function admin_manageTest($idtype=null,$page=null,$end=null) {
		$this->populateEditFormQuesion($idtype,$page,$end);
	}
	public function admin_manageQuestion($idtype=null,$page=null,$end=null) {
		
		
		$this->populateEditFormQuesion($idtype,$page,$end);
	}
	
	//manage Question
	public function admin_createQuestion() {
		$data=$this->request->data;
		
		$this->Question->save($data);
		$question=$this->Question->find("first",array('conditions' => array('Question.id_type' => $data['id_type'],'Question.title' => $data['title'])));
		if(isset($question))
			$idquestion=$question['Question']['id'];
		if($idquestion!=null && isset($idquestion)){
			$methods=$data['content'];
			$corect=$data['corect'];
			$i=0;
			foreach ($methods as $item){
				$method=array('question_id'=>$idquestion,'content'=>$item,'corect'=>$corect[$i]);
				$this->Method->saveAll($method);
				$i++;
				$method=null;
			}
			
		}
		//array_push($quetion,$data
		$this->populateEditFormQuesion();
		$this->render('admin_manageQuestion');
	}
	
	public function admin_editQuestion($id) {
		$this->set("question",$this->Question->find('first',array('conditions' => array('Question.id' => $id))));
		$this->set("method",$this->Method->find('all',array('conditions' => array('Method.question_id' => $id))));
		$this->populateEditFormQuesion();
		$this->render('admin_manageQuestion');
	}
	public function admin_updateQuestion($idqs) {
		$data=$this->request->data;
		
		$this->Question->updateAll(array('Question.title' =>"'".$data['title']."'",
				'Question.id_type'=>$this->request->data('id_type')),array('Question.id' => $idqs));
		
		
			$methods=$data['content'];
			$corect=$data['corect'];
			$idmethods=$data['idmethod'];
			$i=0;
			foreach ($methods as $item){
				$method=array('question_id'=>$idqs,'content'=>"'".$item."'",'corect'=>$corect[$i]);
				$this->Method->updateAll($method,array('id'=>$idmethods[$i]));
				$i++;
				$method=null;
			}
			
		//array_push($quetion,$data
		$this->populateEditFormQuesion();
		$this->render('admin_manageQuestion');
		
	}
	public function admin_deleteQuestion($idqs) {
		if($this->request->is('get')){
			$this->Method->deleteAll(array('Method.question_id'=>$idqs));
			$this->Question->deleteAll(array('Question.id'=>$idqs));
		}
		$this->populateEditFormQuesion();
		$this->render('admin_manageQuestion');
	}
	public function admin_deleteMethod($id,$idqs) {
		if($this->request->is('get')){
			$this->Method->deleteAll(array('Method.id'=>$id));
		}
		$this->admin_editQuestion($idqs);
	}
	public function populateEditFormQuesion($idtype=NULL,$page=null,$end=null){
		
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$idtype=(($idtype==null || !isset($idtype))?1:$idtype);
		
		$this->set("data",$this->Question->find('all',array('conditions'=>array('Question.id_type'=>$idtype), 'limit' => $this->numberRecord, 'offset'=>$page-1)));
		$numberrecord=$this->Question->find('count',array('conditions'=>array('Question.id_type'=>$idtype)));
		if($idtype==1 || $idtype==null){
			$this->set("data",$this->Question->find('all',array('limit' => $this->numberRecord, 'offset'=>$page-1)));
			$numberrecord=$this->Question->find('count');
		}
		
		
		
		$this->set("idtype",$idtype);
		$this->set("type",$this->Typequestion->find('all'));
		$this->pagination($page, $numberrecord,$end);
	}

	//end manage Question
	//manage Consulting
	public function admin_manageConsulting($idtype=NULL,$page=null,$end=null) {
		$this->populateEditFormConsulting($idtype,$page,$end);
	}
	public function getConsulted($idTypeconsulting){
		$data=$this->Typeconsulting->find('all',array('conditions' => array('Typeconsulting.id' => $idTypeconsulting)));
		$results=array();
		$consulting=$data[0]['Consulting'];
		foreach ($consulting as $item){
			$result=$this->Consulting->find('all',array('conditions' => array('Consulting.id' => $item['id'])));
			$boolean=0;//chÆ°a tráº£ lá»�i
			if(count($result[0]['Resultconsulting']>0) && $result[0]['Resultconsulting']!=null){
				$boolean=1;
			}
			array_push($results,array('consulting'=>$result,'anser'=>$boolean));
		}
		return $results;
	}
	public function admin_AnserConsulting($id) {
		
		$this->set("consul",$this->Consulting->find('all',array('conditions' => array('Consulting.id' => $id))));
		$this->populateEditFormConsulting();
		$this->render('admin_manageConsulting');
	}
	public function admin_createResultconsultings() {
		$this->request->data['user_id']=$this->Session->read($this->sessionUserid);
		$this->Resultconsulting->save($this->request->data);
		$this->populateEditFormConsulting();
		$this->render('admin_manageConsulting');
	}
	public function populateEditFormConsulting($idtype=null,$page=null,$end=null){
		$idcon=$this->Typeconsulting->find('first');
		$idtype=((isset($idtype) && $idtype!=null)?$idtype:$idcon['Typeconsulting']['id']);
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$this->set("idtype",$idtype);
		$this->set("typeconsultings",$this->Typeconsulting->find("all"));
		$data=$this->getConsulted($idtype);
		$numberrecord=count($data);
		$this->set("consultings",$data);
		$this->pagination($page, $numberrecord, $end);
		
	}
	//end manage Consulting
	//begin manage news
	public function admin_manageNews($idtype=null,$page=null,$end=null) {
		$this->populateformNotice($idtype,$page,$end);
	}
	public function admin_createNews() {
		$this->request->data['tacgia']=$this->Session->read($this->sessionUserid);
		$this->request->data['ngaythang']=date("Y/m/d");
		$this->Tbltintuc->save($this->request->data);
		$this->populateformNotice();
		$this->render('admin_manageNews');
	}

	public function populateformNotice($idtype=null,$page=null,$end=null){
		$page=(isset($page)&&$page!=null?$page:1);
		$end=(isset($end)&&$end!=null?$end:$this->numberpage);
		$idtype=(isset($idtype)&& $idtype!=null?$idtype:6);
		$typeNews=$this->Tbltintuc->find('all',array('conditions' => array('Tbltintuc.id_theloai' => $idtype),'limit' => $this->numberRecord, 'offset'=>$page-1));
		$listNews=$this->Tbltintuc->find("all",array('conditions' => array('Tbltintuc.id_theloai' => $idtype)));
		$numberrecord=count($listNews);
		$this->set("ListtypeNew",$this->Tbltheloai->find("all"));
		$this->set("typeNews",$typeNews);
		$this->set("idtype",$idtype);
		$this->pagination($page, $numberrecord,$end);
	}
	public function admin_editNews($idnews,$page=null,$end=null) {
		$news=$this->Tbltintuc->find("first",array('conditions' => array('Tbltintuc.id_tintuc' => $idnews)));
		$this->populateformNotice($news['Tbltintuc']['id_theloai'],$page,$end);
		$this->set("News",$news);
		$this->render('admin_manageNews');
	}
	public function admin_deleteNews($idnews,$page=null,$end=null) {
		$news=$this->Tbltintuc->find("first",array('conditions' => array('Tbltintuc.id_tintuc' => $idnews)));
		$this->Tbltintuc->deleteAll(array('Tbltintuc.id_tintuc'=>$idnews));
		$this->populateformNotice($news['Tbltintuc']['id_theloai'],$page,$end);
		$this->render('admin_manageNews');
	}
	public function admin_updateNews() {
		$data=$this->request->data;
		$news=$this->Tbltintuc->find("first",array('conditions' => array('Tbltintuc.id_tintuc' => $data['id_tintuc'])));
		$this->Tbltintuc->updateAll(array('Tbltintuc.tieude' =>"'".$data['tieude']."'",
				'Tbltintuc.noidung'=>"'".$this->request->data('noidung')."'",'Tbltintuc.id_theloai' =>$data['id_theloai']),array('Tbltintuc.id_tintuc' =>$data['id_tintuc']));
		$this->populateformNotice($news['Tbltintuc']['id_theloai'],$data['page'],$data['end']);
		$this->render('admin_manageNews');
	}
	//end manage News
	
	/* Quan ly upload tai lieu
	 * 17-5-2014
	 * */
	function admin_manageUpload1($idloai=null){		
        $tblloaitailieu = $this->Upload->Tblloaitailieu->read(null,$idloai);
        $this->set('tblloaitailieu',$tblloaitailieu);
		$files = $this->Tblloaitailieu->find("all");
		$this->set("files",$files);
	}

	public function admin_manageUpload($idloai=null,$page=null,$end=null) {	
		$tbloai=$this->Tblloaitailieu->find('first',array('order' => array('tblloaitailieu.idloai DESC')));
		$idloai=((isset($idloai)&& $idloai!=null)?$idloai:$tbloai['Tblloaitailieu']['idloai']);
		$this->populateEditFormUpload($idloai,$page,$end);
		
		if($this->request->is('post')){
			$destination = realpath('../../app/webroot/img/uploads/') . '/';
			$size = $_FILES['file']['size'];
			$type = $_FILES['file']['type'];
			$name = $_FILES['file']['name'];
			$path = realpath('../../app/webroot/img/uploads/')."\\".$_FILES['file']['name'];
			$date = date("YmdHis", time());
			$modified = date("YmdHis", time());
			$idloai =$_POST['idloai'];
			$tmp_name = $_FILES['file']['tmp_name'];
			// $date = date("YmdHis", time());
			if($size>(1024*10)){
			 	if (!file_exists($path)) {
                   move_uploaded_file($tmp_name,$destination.$name);
				$this->Upload->query("INSERT INTO uploads(name, path, type, size, date, modified,idloai) VALUES('".$name."', '".$destination."', '".$type."',".$size.",".$date.",".$modified.",".$idloai.")");
                } else {
                    /* File ton tai */
                    //$msg = '<div class="thongbao">File ' . $name . ' đã tồn tại!</div>';
                    $this->set("msg","<div class='thongbao'>File ' . $name . ' đã tồn tại!</div>");
                  //  echo $msg;
                }			
			}
			else{
			//	$msg = '<div class="thongbao">Kích thước file ' . $name . ' quá quy định!</div>';
				$this->set("msg","<div class='thongbao'>Kích thước file ' . $name . ' quá quy định!</div>");
			//	echo $msg;
			}
		}
	}
	public function populateEditFormUpload($idloai=NULL,$page=null,$end=null){
		
		$this->set("typefile",$this->Tblloaitailieu->find('all'));
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$idtype=(($idloai==null || !isset($idloai))?1:$idloai);
		
		$files=$this->Upload->find('all',array('conditions'=>array('Upload.idloai'=>$idloai), 'limit' => $this->numberRecord, 'offset'=>$page-1));
		$this->set("files",$files);
		$this->set("idloai",$idloai);
		$numberrecord=$this->Upload->find('count',array('conditions'=>array('Upload.idloai'=>$idloai)));
		$this->pagination($page, $numberrecord,$end);
	}
	//manager forum
	public function admin_manageForum($page=null,$end=null) {
		$this->populateForum($page,$end);
	}
	public function populateForum($page=null,$end){
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$forum=$this->Forum->find('all',array('limit' => $this->numberRecord, 'offset'=>$page-1));
		$this->set("forums",$forum);
		$numberrecord=$this->Forum->find('count');
		$this->pagination($page, $numberrecord,$end);
	}
	public function admin_editForum($idforum=null,$page=null,$end=null) {
		$forum=$this->Forum->find("first",array('conditions'=>array('Forum.id'=>$idforum)));
		$this->set("forum",$forum);
		$this->populateForum($page,$end);
		$this->render('admin_manageForum');
	}
	public function admin_updateForum() {
		$data=$this->request->data;
		$this->Forum->updateAll(array('Forum.name' =>"'".$data['name']."'",'Forum.decription'=>"'".$data['decription']."'"),array('Forum.id' =>$data['id']));
		$this->populateForum($data['page'],$data['end']);
		$this->render('admin_manageForum');
	}
	public function admin_deleteForum($idforum=null,$page=null,$end=null) {
		$this->Forum->deleteAll(array('Forum.id'=>$idforum));
		$this->populateForum($page,$end);
		$this->render('admin_manageForum');
	}
	public function admin_createForum() {
		$data=$this->request->data;
		$this->Forum->save($data);
		$this->populateForum($data['page'],$data['end']);
		$this->render('admin_manageForum');
	}
	public function admin_manageToppic($idforum=null,$page=null,$end=null) {
		$forum=$this->Forum->find("first");
		$idforum=isset($idforum)?$idforum:$forum['Forum']['id'];
		$this->populateTopic($idforum,$page,$end);
	}
	public function populateTopic($idforum=null,$page=null,$end=null){
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$Topics=$this->Topic->find('all',array('conditions'=>array('Topic.forum_id'=>$idforum),'limit' => $this->numberRecord, 'offset'=>$page-1));
		$this->set("Topics",$Topics);
		$numberrecord=$this->Topic->find('count',array('conditions'=>array('Topic.forum_id'=>$idforum)));
		$this->set("forums",$this->Forum->find("all"));
		$this->set("idforum",$idforum);
		$this->pagination($page, $numberrecord,$end);
	}
	public function admin_editTopic($idtopic=null,$idforum=null,$page=null,$end=null) {
		$topic=$this->Topic->find("first",array('conditions'=>array('Topic.id'=>$idtopic)));
		$this->set("Topic",$topic);
		$this->populateTopic($idforum,$page,$end);
		$this->render('admin_manageToppic');
	}
	public function admin_updateTopic($page=null,$end=null) {
		$data=$this->request->data;
		$this->Topic->updateAll(array('Topic.name' =>"'".$data['name']."'",'Topic.content'=>"'".$data['content']."'",'forum_id'=>$data['forum_id'],'user_id'=>$this->Session->read($this->sessionUserid)),array('Topic.id' =>$data['id']));
		$this->populateTopic($data['forum_id'],$page,$end);
		$this->render('admin_manageToppic');
	}
	public function admin_deleteTopic($idtopic,$page=null,$end=null) {
		$topic=$this->Topic->find('first',array('conditions'=>array('Topic.id'=>$idtopic)));
		$this->Topic->deleteAll(array('Topic.id'=>$idtopic));
		$this->populateTopic($topic['Topic']['forum_id'],$page,$end);
		$this->render('admin_manageToppic');
	}
	//manger comment
	public function admin_manageComment($idforum=null,$idTopic=null,$idpost=null,$page=null,$end=null) {
		if(isset($idpost) && $idpost!=null){
			$this->set("post",$this->Post->find('first',array('conditions'=>array('Post.id'=>$idpost))));
		}
		$this->populateComment($idforum,$idTopic,$page,$end);
	}
public function populateComment($idforum=null,$idTopic=null,$page=null,$end=null){
		$forums=$this->Forum->find("first");
		$idforum=isset($idforum)?$idforum:$forums['Forum']['id'];
		$this->set('idforum',$idforum);
		$topics=$this->Topic->find('all',array('conditions'=>array('Topic.forum_id'=>$idforum)));
		$idTopic=isset($idTopic)?$idTopic:$topics[0]['Topic']['id'];
		$this->set("idtopic",$idTopic);
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$Potss=$this->Post->find('all',array('conditions'=>array('Post.topic_id'=>$idTopic),'limit' => $this->numberRecord, 'offset'=>$page-1));
		$this->set("Posts",$Potss);
		$numberrecord=$this->Post->find('count',array('conditions'=>array('Post.topic_id'=>$idTopic)));
		$this->set("forums",$this->Forum->find("all"));
		$this->set("topics",$topics);
		
		$this->pagination($page, $numberrecord,$end);
	} 
	public function admin_createPost() {
		$data=$this->request->data;
		$data['user_id']=$this->Session->read($this->sessionUserid);
		$this->Post->saveAll($data);
		$this->populateComment($data['forum_id'],$data['topic_id'],$data['page'],$data['end']);
		$this->render('admin_manageComment');
	}
	public function admin_editPost($idpost,$page=null,$end=null) {
		$post=$this->Post->find('first',array('conditions'=>array('Post.id'=>$idpost)));
		$this->set("post",$post);
		
		$this->populateComment($post['Post']['forum_id'],$post['Post']['topic_id'],$page,$end);
		$this->render('admin_manageComment');
	}
	public function admin_updatePost() {
		$data=$this->request->data;
		$this->Post->updateAll(array('Post.content' =>"'".$data['content']."'",'Post.forum_id'=>"'".$data['forum_id']."'",'Post.topic_id'=>"'".$data['topic_id']."'"),array('Post.id' =>$data['id']));
		$this->populateComment($data['forum_id'],$data['topic_id'],$data['page'],$data['end']);
		$this->render('admin_manageComment');
	}
	public function admin_deletePost($idpost,$page=null,$end=null) {
		$post=$this->Post->find("first",array('conditions'=>array('Post.id'=>$idpost)));
		$this->Post->deleteAll(array('Post.id'=>$idpost));
		$this->populateComment($post['Post']['forum_id'],$post['Post']['topic_id'],$page,$end);
		$this->render('admin_manageComment');
	}


}
?>