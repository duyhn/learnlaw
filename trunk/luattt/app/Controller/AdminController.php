<?php
class AdminController extends  AppController{
	var $name="Admin";
	public $uses = array('User','Role','Question','Typequestion','Method','Typeconsulting','Consulting','Resultconsulting','Tbltintuc','Tbltheloai');

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
		$numberrecord=(round($numberrecord/$this->numberRecord)>0?($numberrecord%$this->numberRecord>0? round($numberrecord/$this->numberRecord)+1:round($numberrecord/$this->numberRecord)):1);
		
		$data=$this->User->find('all');
		$role=$this->Role->find('all');
		$this->set("data",$data);
		$this->set('role',$role);
		$this->set("iduser",$iduser);
		$this->pagination($page, $numberrecord,$end);
	}
	//end manage user
	public function admin_manageTest() {
		
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
		$numberrecord=(round($numberrecord/$this->numberRecord)>0?($numberrecord%$this->numberRecord>0? round($numberrecord/$this->numberRecord)+1:round($numberrecord/$this->numberRecord)):1);
		
		
		$this->set("idtype",$idtype);
		$this->set("type",$this->Typequestion->find('all'));
		$this->pagination($page, $numberrecord,$end);
	}
	//Phan trang
	public function pagination($page,$numberrecord,$end){
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
	//end manage Question
	//manage Consulting
	public function admin_manageConsulting() {
		$this->populateEditFormConsulting();
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
	public function populateEditFormConsulting(){
		$this->set("typeconsultings",$this->Typeconsulting->find("all"));
		$this->set("consultings",$this->getConsulted(1));
	}
	//end manage Consulting
	//begin manage news
	public function admin_manageNews($idtype=NULL,$page=null,$end=null) {
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
		$typeNews=$this->Tbltheloai->find("all",array('conditions' => array('Tbltheloai.id_theloai' => $idtype)));
		$numberrecord=count($typeNews[0]);
		$this->set("ListtypeNew",$this->Tbltheloai->find("all"));
		$this->set("typeNews",$typeNews);
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
	function admin_manageUpload($idloai=null){		
        $tblloaitailieu = $this->Upload->Tblloaitailieu->read(null,$idloai);
        $this->set('tblloaitailieu',$tblloaitailieu);
		$files = $this->Tblloaitailieu->find("all");
		$this->set("files",$files);
	}
	function admin_upload(){
		$this->set("files",$this->Upload->find('all'));
		$this->set("typefile",$this->Tblloaitailieu->find('all'));
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
			if($size>(1024*5)){
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
}
?>