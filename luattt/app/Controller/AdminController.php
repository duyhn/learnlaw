<?php
class AdminController extends  AppController{
	var $name="Admin";
	public $uses = array('User','Role','Question','Typequestion','Method');

	public function index() {
		$data=$this->User->find('all');
		$this->set("data",$data);
	}
	function admin_managedUser(){
		$this->populateEditForm();
	}
	function admin_formUpdateUser($iduser){

		$this->populateEditForm();
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
			$this->request->data['password']='123';
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
	
	public function populateEditForm(){
		$data=$this->User->find('all');
		$role=$this->Role->find('all');
		$this->set("data",$data);
		$this->set('role',$role);
	}
	//
	public function admin_manageTest() {
		
	}
	public function admin_manageQuestion($idtype=null) {
		
		
		$this->populateEditFormQuesion($idtype);
	}
	//
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
	public function populateEditFormQuesion($idtype=NULL){
		$this->set("data",$this->Question->find('all',array('conditions'=>array('Question.id_type'=>$idtype))));
		if($idtype==1 || $idtype==null){
			$this->set("data",$this->Question->find('all'));
		}
		$this->set("idtype",$idtype);
		$this->set("type",$this->Typequestion->find('all'));
	}
	//
	
	
}
?>