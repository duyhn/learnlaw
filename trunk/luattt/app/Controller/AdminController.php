<?php
class AdminController extends  AppController{
	var $name="Admin";

	public $uses = array('User','Role','Question','Typequestion','Method','Typeconsulting','Consulting','Resultconsulting','Tbltintuc','Tbltheloai','Upload','Tblloaitailieu','Forum','Topic','Post','Test','Result');

	public function index() {
		$data=$this->User->find('all');
		$this->set("data",$data);
	}
	//manage User
	function admin_managedUser($iduser=null,$page=null,$end=null){
		$this->populateEditForm($iduser,$page,$end);
	}
	function admin_formUpdateUser($iduser){

		$user=$this->User->find('first', array('conditions' => array('User.user_id' => $iduser)));
		$this->set('user',$user);
		$this->populateEditForm($iduser);
		$this->render('admin_managedUser');
	}
	public function admin_updateusser() {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		if(!isset($this->request->data['status'])){
			$this->request->data['status']=0;
		}
		$this->User->updateAll(array('User.hoten' =>"'".$this->request->data('hoten')."'",
				'User.username'=>"'".$this->request->data('username')."'",
				'User.email'=>"'".$this->request->data('email')."'",
				'User.idRole'=>$this->request->data('idRole'),
				'User.status'=>$this->request->data('status'),
				'User.modified'=>date("YmdHis", time())),

		array('User.user_id' => 1));
		$this->populateEditForm();
		$this->render('admin_managedUser');
	}
	public function admin_createuser() {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		if($this->request->is('post')){
			if(!isset($this->request->data['status'])){
				$this->request->data['status']=0;
			}
			$this->request->data['password'] = Security::hash('123',NULL,TRUE);
			$this->User->saveAll($this->request->data);
		}
		/*$this->request->data['password']='123';
		 $this->set("form",$this->request->data);*/
		$this->populateEditForm();
		$this->render('admin_managedUser');
	}

	public function admin_deleUser($iduser) {
		$this->Post->deleteAll(array('Post.user_id'=>$iduser));
		$this->Topic->deleteAll(array('Topic.user_id'=>$iduser));
		$this->Forum->deleteAll(array('Forum.user_id'=>$iduser));
		$data=$this->Result->find("all",array('conditions'=>array('Result.user_id'=>$iduser)));
		foreach ($data as $item){
			$this->Test->deleteAll(array('Test.id'=>$item['Result']['test_id']));
			$this->Result->deleteAll(array('Result.id'=>$item['Result']['id']));
		}
		$this->User->deleteAll(array('User.user_id'=>$iduser));
		$this->set("msg","'Xo´a tha`nh công!'");
		if(count($this->User->find("all",array('conditions'=>array('User.user_id'=>$iduser))))>0){
			$this->set("msg","'Xo´a không tha`nh công!'");
		}
		$this->populateEditForm();
		$this->render('admin_managedUser');
	}

	public function populateEditForm($iduser=NULL,$page=null,$end=null){
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$idtype=(($iduser==null || !isset($iduser))?1:$iduser);

		$this->set("data",$this->User->find('all',array( 'limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord)));
		$numberrecord=$this->User->find('count');

		$data=$this->User->find('all');
		$role=$this->Role->find('all');
		//$this->set("data",$data);
		$this->set('role',$role);
		$this->set("iduser",$iduser);
		$this->pagination($page, $numberrecord,$end);
	}

	//end manage user
	public function admin_manageTest($idtype=null,$page=null,$end=null) {
		$this->populateEditFormQuesion($idtype,$page,$end);
	}
	public function admin_manageQuestion($idtype=null,$quesion=null,$page=null,$end=null) {
		if(isset($quesion)&& $quesion!=0)
		$this->set("method",$this->Method->find('all',array('conditions' => array('Method.question_id' => $quesion))));

		$this->populateEditFormQuesion($idtype,$quesion,$page,$end);
	}

	//manage Question
	public function admin_createQuestion() {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
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
		$this->populateEditFormQuesion($data['id_type'],null,$data['page'],$data['end']);
		$this->render('admin_manageQuestion');
	}

	public function admin_editQuestion($id,$page=null,$end=null) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$question=$this->Question->find('first',array('conditions' => array('Question.id' => $id)));
		$this->set("question",$question);
		$this->set("method",$this->Method->find('all',array('conditions' => array('Method.question_id' => $id))));
		$this->populateEditFormQuesion($question['Question']['id_type'],$id,$page,$end);
		$this->render('admin_manageQuestion');
	}
	public function admin_updateQuestion($idqs) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
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
		$this->populateEditFormQuesion($data['id_type'],$idqs,$data['page'],$data['end']);
		$this->render('admin_manageQuestion');

	}
	public function admin_deleteQuestion($idtype,$idqs,$page=null,$end=null) {
		$this->Method->deleteAll(array('Method.question_id'=>$idqs));
		$this->Question->deleteAll(array('Question.id'=>$idqs));
		$this->set("msg","'Xo´a tha`nh công!'");
		$this->populateEditFormQuesion($idtype,$idqs,$page,$end);
		$this->render('admin_manageQuestion');
	}
	/*public function admin_deleteQuestion($idtype,$idqs,$page=null,$end=null) {
		$this->Method->deleteAll(array('Method.question_id'=>$idqs));
		$this->Question->deleteAll(array('Question.id'=>$idqs));
		$this->set("msg","'Xo´a tha`nh công!'");
		$this->populateEditFormQuesion($idtype,$idqs,$page,$end);
		$this->render('admin_manageQuestion');
	}*/
	
	public function admin_deleteMethod($id,$idqs,$page,$end) {
		if($this->request->is('get')){
			$this->Method->deleteAll(array('Method.id'=>$id));
		}

		$this->admin_editQuestion($idqs,$page,$end);
	}
	public function populateEditFormQuesion($idtype=NULL,$question=null,$page=null,$end=null){

		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$idtype=(($idtype==null || !isset($idtype))?1:$idtype);

		$this->set("data",$this->Question->find('all',array('conditions'=>array('Question.id_type'=>$idtype), 'limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord)));
		$numberrecord=$this->Question->find('count',array('conditions'=>array('Question.id_type'=>$idtype)));
		if($idtype==1 || $idtype==null){
			$this->set("data",$this->Question->find('all',array('limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord)));
			$numberrecord=$this->Question->find('count');
		}
		$this->set("question",$this->Question->find('first',array('conditions' => array('Question.id' => $question))));
		$this->set("idtype",$idtype);
		$this->set("type",$this->Typequestion->find('all'));
		$this->pagination($page, $numberrecord,$end);
	}

	//end manage Question

	//manage Tu van
	public function admin_manageConsulting($idtype=NULL,$page=null,$end=null) {

		$arrid=$this->Resultconsulting->find("all",array('fields'=>array('Resultconsulting.consulting_id')));
		$arr=array();
		foreach ($arrid as $item){
			array_push($arr,$item['Resultconsulting']['consulting_id']);
		}
		$data=$this->Consulting->find("all",array('conditions'=>array('NOT'=>array('id'=>$arr))));
		$this->set("Consluting",$data);
		$this->populateEditFormConsulting($idtype,$page,$end,count($data));
	}
	public function admin_manageConsulted($idtype=NULL,$page=null,$end=null){

		$data=$this->Resultconsulting->find("all");
		$this->populateEditFormConsulting($idtype,$page,$end,count($data));

	}
	public function admin_AnserConsulting($id) {

		$this->set("consul",$this->Consulting->find('first',array('conditions' => array('Consulting.id' => $id))));
		$this->populateEditFormConsulting();
		$this->render('admin_manageConsulting');
	}
	public function admin_editConsulting($id,$action,$page=null,$end=null){

		$consl=$this->Consulting->find('first',array('conditions' => array('Consulting.id' => $id)));
		$this->set("consul",$consl);
		$data=$this->Resultconsulting->find("all");
		if($action=="admin_manageConsulting"){
			$arrid=$this->Resultconsulting->find("all",array('fields'=>array('Resultconsulting.consulting_id')));
			$arr=array();
			foreach ($arrid as $item){
				array_push($arr,$item['Resultconsulting']['consulting_id']);
			}
			$data=$this->Consulting->find("all",array('conditions'=>array('NOT'=>array('id'=>$arr))));
			$this->set("Consluting",$data);
		}
		$this->populateEditFormConsulting($consl['Consulting']['typeconsulting_id'],$page,$end,count($data));
		$this->render($action);
	}
	public function admin_createResultconsultings($action) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->request->data['user_id']=$this->Session->read($this->sessionUserid);
		$conslu=$this->Consulting->find("all",array('conditions' => array('Consulting.title' => $this->request->data['title'])));
		if(count($conslu)==0){
			$con=array();
			$con['typeconsulting_id']=$this->request->data['typeconsulting_id'];
			$con['title']=$this->request->data['title'];
			$con['contents']=$this->request->data['concontents'];
			$con['auther']=$this->Session->read($this->sessionUsername);
			$this->Consulting->saveAll($con);
			$conslu=$this->Consulting->find("first",array('conditions' => array('Consulting.title' => $this->request->data['title'])));
			$this->request->data['consulting_id']=$conslu['Consulting']['id'];
		}
		$this->Resultconsulting->save($this->request->data);
		$data=$this->Resultconsulting->find("all");
		if($action=="admin_manageConsulting"){
			$arrid=$this->Resultconsulting->find("all",array('fields'=>array('Resultconsulting.consulting_id')));
			$arr=array();
			foreach ($arrid as $item){
				array_push($arr,$item['Resultconsulting']['consulting_id']);
			}
			$data=$this->Consulting->find("all",array('conditions'=>array('NOT'=>array('id'=>$arr))));
			$this->set("Consluting",$data);
		}
		$this->populateEditFormConsulting($this->request->data['typeconsulting_id'],null,null,count($data));
		$this->render($action);
	}
	public function admin_updateConsulted($action){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$data=$this->request->data;
		$this->Consulting->query("update consultings set title='".$data['title']."',
		 contents='".$data['concontents']."',
		 consulting_date=".date("YmdHis", time())." where id=".$data['consulting_id']);
		$this->Resultconsulting->query("update Resultconsultings set title='".$data['title']."', contents='".$data['contents']."',result_date=".date("YmdHis", time())." where consulting_id=".$data['consulting_id']);
		$data=$this->Resultconsulting->find("all");
		$this->populateEditFormConsulting($this->request->data['typeconsulting_id'],null,null,count($data));
		$this->render($action);
	}
	public function populateEditFormConsulting($idtype=null,$page=null,$end=null,$numberrecord=null){


		$idcon=$this->Typeconsulting->find('first');
		$idtype=((isset($idtype) && $idtype!=null)?$idtype:$idcon['Typeconsulting']['id']);
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$this->set("idtype",$idtype);
		$this->set("typeconsultings",$this->Typeconsulting->find("all"));

		$consulted=$this->Resultconsulting->find("all",array('limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord));
		$this->set("consulted",$consulted);

		$this->pagination($page, $numberrecord, $end);

	}
	public function admin_deleteConsulting($id,$page=null,$end=null){
		$conslu=$this->Consulting->find("first",array('conditions' => array('Consulting.id' => $id)));
		$this->Resultconsulting->deleteAll(array('Resultconsulting.consulting_id'=>$id));
		$this->Consulting->deleteAll(array('Consulting.id'=>$id));
		$this->set("msg","'Xo´a tha`nh công!'");
		$data=$this->Resultconsulting->find("all");
		if($this->request->data['view']=="admin_manageConsulting"){
			$arrid=$this->Resultconsulting->find("all",array('fields'=>array('Resultconsulting.consulting_id')));
			$arr=array();
			foreach ($arrid as $item){
				array_push($arr,$item['Resultconsulting']['consulting_id']);
			}
			$data=$this->Consulting->find("all",array('conditions'=>array('NOT'=>array('id'=>$arr))));
			$this->set("Consluting",$data);
		}
		$this->populateEditFormConsulting($conslu['Consulting']['typeconsulting_id'],$page,$end,count($data));
		$this->render($this->request->data['view']);
	}
	//end manage Consulting
	//begin manage news
	public function admin_manageNews($idtype=null,$page=null,$end=null) {
		$this->populateformNotice($idtype,$page,$end);
	}
	public function admin_createNews() {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->request->data['tacgia']=$this->Session->read($this->sessionUserid);
		$dir    = 'img/anhTintuc/anhmacdinh';
		$files = scandir($dir);
		$rd=rand (2 , count($files)-1);
		$filename="/img/anhTintuc/anhmacdinh/".$files[$rd];

		if(isset($_FILES['file'])){
			$filename= "/img/anhTintuc/".$_FILES['file']['name'];
				
		}
		$this->request->data['ten_anh']=$filename;
		$this->request->data['ngaythang']=date("Y/m/d");

		$this->Tbltintuc->save($this->request->data);
		if(isset($_FILES['file'])){
			$destination = realpath('../../app/webroot/img/anhTintuc/') . '/';
			$name = $_FILES['file']['name'];
			$path = realpath('../../app/webroot/img/anhTintuc/')."\\".$_FILES['file']['name'];
			$tmp_name = $_FILES['file']['tmp_name'];
			if (!file_exists($path)) {
				move_uploaded_file($tmp_name,$destination.$name);
			}
		}
		$this->populateformNotice();
		$this->render('admin_manageNews');
	}

	public function populateformNotice($idtype=null,$page=null,$end=null){
		$page=(isset($page)&&$page!=null?$page:1);
		$end=(isset($end)&&$end!=null?$end:$this->numberpage);
		$idtype=(isset($idtype)&& $idtype!=null?$idtype:6);
		$typeNews=$this->Tbltintuc->find('all',array('conditions' => array('Tbltintuc.id_theloai' => $idtype),'limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord));
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
		date_default_timezone_set('Asia/Ho_Chi_Minh');
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
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$tbloai=$this->Tblloaitailieu->find('first',array('order' => array('tblloaitailieu.idloai DESC')));
		$idloai=((isset($idloai)&& $idloai!=null)?$idloai:$tbloai['Tblloaitailieu']['idloai']);

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
			$title =$_POST['title'];
			$mota =$_POST['mota'];
			// $date = date("YmdHis", time());
			if($size<(1024*1000000)){
				if (!file_exists($path)) {
					$this->Upload->query(
					"INSERT INTO uploads(name, path, type, size, date, modified , idloai ,title, mota)
					 VALUES('".$name."',
					  '".$destination."', 
					  '".$type."',
					  ".$size.",
					  ".$date.",
					  ".$modified.",
					  ".$idloai.",
					  '".$title."',
					  '".$mota."'
					  )");
                	 move_uploaded_file($tmp_name,$destination.$name);
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
		$this->populateEditFormUpload($idloai,$page,$end);
	}
	public function populateEditFormUpload($idloai=NULL,$page=null,$end=null){

		$this->set("typefile",$this->Tblloaitailieu->find('all'));
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$idtype=(($idloai==null || !isset($idloai))?1:$idloai);

		$files=$this->Upload->find('all',array('conditions'=>array('Upload.idloai'=>$idloai), 'limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord));
		$this->set("files",$files);
		$this->set("idloai",$idloai);
		$numberrecord=$this->Upload->find('count',array('conditions'=>array('Upload.idloai'=>$idloai)));
		$this->pagination($page, $numberrecord,$end);
	}
	public function admin_deleteUpload($id=null,$page=null,$end=null) {
		$file=$this->Upload->find("first",array('conditions'=>array('Upload.id'=>$id)));
		$name = $file['Upload']['name'];
		$path =  realpath('../../app/webroot/img/uploads/')."\\".$name;
		if(unlink($path))
		{
			$this->Upload->deleteAll(array('Upload.id'=>$id));
		}
		$this->populateEditFormUpload($file['Upload']['idloai'],$page,$end);
		$this->redirect(array('controller'=>'admin','action'=>'manageUpload',$file['Upload']['idloai']));
	}
	public function admin_updateUpload($id=null,$page=null,$end=null) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		//$data=$this->request->data;
		$news=$this->Upload->find("first",array('conditions' => array('Upload.id' => $id)));
		$path =  realpath('../../app/webroot/img/uploads/')."\\".$news['Upload']['name'];
		unlink($path);
		$destination = realpath('../../app/webroot/img/uploads/') . '/';
		
		$size = $_FILES['file']['size'];
		$type = $_FILES['file']['type'];
		$name = $_FILES['file']['name'];
		$path = realpath('../../app/webroot/img/uploads/')."\\".$_FILES['file']['name'];
		$date = date("YmdHis", time());
		$modified = date("YmdHis", time());
		$idloai =$_POST['idloai'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$title =$_POST['title'];
		$mota =$_POST['mota'];
		// $date = date("YmdHis", time());
		if($size<(1024*1000000)){
			if (!file_exists($path)) {
				$this->Upload->query(
					"UPDATE uploads SET  name='".$name."., path='".$destination."', type='".$type."', size=".$size.", date=".$date.", modified=".$modified." , idloai=".$idloai." ,title='".$title."', mota='".$mota."'");
				move_uploaded_file($tmp_name,$destination.$name);
			} else {
				/* File ton tai */
				//$msg = '<div class="thongbao">File ' . $name . ' da~ t�`n ta?i!</div>';
				$this->set("msg","<div class='thongbao'>File ' . $name . ' da~ t�`n ta?i!</div>");
				//  echo $msg;
			}
		}
		else{
			//	$msg = '<div class="thongbao">K�ch thu?c file ' . $name . ' qu� quy d?nh!</div>';
			$this->set("msg","<div class='thongbao'>K�ch thu?c file ' . $name . ' qu� quy d?nh!</div>");
			//	echo $msg;
		}
		$this->Upload->updateAll(array('Tbltintuc.tieude' =>"'".$data['tieude']."'",
				'Tbltintuc.noidung'=>"'".$this->request->data('noidung')."'",'Tbltintuc.id_theloai' =>$data['id_theloai']),array('Tbltintuc.id_tintuc' =>$data['id_tintuc']));
		$this->populateEditFormUpload($news['Upload']['idloai'],$data['page'],$data['end']);
		$this->redirect(array('controller'=>'admin','action'=>'manageUpload',$file['Upload']['idloai'],$page,$end));
	}

	//manager forum
	public function admin_manageForum($page=null,$end=null) {
		$this->populateForum($page,$end);
	}
	public function populateForum($page=null,$end){
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$forum=$this->Forum->find('all',array('limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord));
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
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$data=$this->request->data;
		$this->Forum->updateAll(array('Forum.name' =>"'".$data['name']."'",
		'Forum.modified'=>date("YmdHis", time()),
		'Forum.decription'=>"'".$data['decription']."'"),
		array('Forum.id' =>$data['id']));
		$this->populateForum($data['page'],$data['end']);
		$this->render('admin_manageForum');
	}
	public function admin_deleteForum($idforum=null,$page=null,$end=null) {
		$this->Forum->deleteAll(array('Forum.id'=>$idforum));
		$this->populateForum($page,$end);
		$this->render('admin_manageForum');
	}
	public function admin_createForum() {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->request->data['user_id']=$this->Session->read($this->sessionUserid);
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
		$Topics=$this->Topic->find('all',array('conditions'=>array('Topic.forum_id'=>$idforum),'limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord));
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
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$data=$this->request->data;
		$this->Topic->updateAll(array('Topic.name' =>"'".$data['name']."'",
		'Topic.content'=>"'".$data['content']."'",
		'Topic.modified'=>date("YmdHis", time()),
		'forum_id'=>$data['forum_id'],
		'user_id'=>$this->Session->read($this->sessionUserid)),array('Topic.id' =>$data['id']));
		//$this->populateTopic($data['forum_id'],$page,$end);
		$this->redirect(array('controller'=>'admin','action'=>'manageToppic',$data['forum_id'],$page,$end));
		//$this->render('admin_manageToppic');
	}
	public function admin_deleteTopic($idtopic,$page=null,$end=null) {
		$topic=$this->Topic->find('first',array('conditions'=>array('Topic.id'=>$idtopic)));
		$this->Topic->deleteAll(array('Topic.id'=>$idtopic));
		$this->populateTopic($topic['Topic']['forum_id'],$page,$end);
		$this->render('admin_manageToppic');
	}
	public function admin_createTopic() {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->request->data['user_id']=$this->Session->read($this->sessionUserid);
		$this->request->data['created']=date("YmdHis", time());
		$this->request->data['modified']=date("YmdHis", time());
		$data=$this->request->data;
		$this->Topic->save($data);
		$this->redirect(array('controller'=>'admin','action'=>'manageToppic',$data['forum_id'],null,null));
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
		$Potss=$this->Post->find('all',array('conditions'=>array('Post.topic_id'=>$idTopic),'limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord));
		$this->set("Posts",$Potss);
		$numberrecord=$this->Post->find('count',array('conditions'=>array('Post.topic_id'=>$idTopic)));
		$this->set("forums",$this->Forum->find("all"));
		$this->set("topics",$topics);

		$this->pagination($page, $numberrecord,$end);
	}
	public function admin_createPost() {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
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
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$data=$this->request->data;
		$this->Post->updateAll(array('Post.content' =>"'".$data['content']."'",
		'Post.modified'=>date("YmdHis", time()),
		'Post.forum_id'=>"'".$data['forum_id']."'",
		'Post.topic_id'=>"'".$data['topic_id']."'"),
		array('Post.id' =>$data['id']));
		$this->populateComment($data['forum_id'],$data['topic_id'],$data['page'],$data['end']);
		$this->render('admin_manageComment');
	}
	public function admin_deletePost($idpost,$page=null,$end=null) {
		$post=$this->Post->find("first",array('conditions'=>array('Post.id'=>$idpost)));
		$this->Post->deleteAll(array('Post.id'=>$idpost));
		$this->populateComment($post['Post']['forum_id'],$post['Post']['topic_id'],$page,$end);
		$this->render('admin_manageComment');
	}
	//
	public function searchQuetion(){
		$data=$this->request->data;
		$result=$this->Question->find("all",array('conditions'=>array('Question.id'=>$data)));
		$this->set("result",$result);
	}
	//
	public function admin_DeleteMulti() {
		$arrid=$this->request->data['listId'];
		$model=$this->request->data['model'];
		switch ($model) {
			case "Question":
				foreach ($arrid as $item){
					$this->Method->deleteAll(array('Method.question_id'=>$item));
					$this->Question->deleteAll(array('Question.id'=>$item));
				}
				break;
			case "Consulting":
				foreach ($arrid as $item){
					$this->Resultconsulting->deleteAll(array('Resultconsulting.consulting_id'=>$item));
					$this->Consulting->deleteAll(array('Consulting.id'=>$item));
				}
				break;
			case "Tbltintuc":
				foreach ($arrid as $item){
					//$this->Resultconsulting->deleteAll(array('Resultconsulting.consulting_id'=>$item));
					$this->Tbltintuc->deleteAll(array('Tbltintuc.id_tintuc'=>$item));
				}
				break;
			case "User":
				foreach ($arrid as $item){
					$this->Post->deleteAll(array('Post.user_id'=>$item));
					$this->Topic->deleteAll(array('Topic.user_id'=>$item));
					$this->Forum->deleteAll(array('Forum.user_id'=>$item));
					$data=$this->Result->find("all",array('conditions'=>array('Result.user_id'=>$item)));
					foreach ($data as $id){
						$this->Test->deleteAll(array('Test.id'=>$id['Result']['test_id']));
						$this->Result->deleteAll(array('Result.id'=>$id['Result']['id']));
					}
					$this->User->deleteAll(array('User.user_id'=>$item));
				}
				break;

		}

	}
}
?>