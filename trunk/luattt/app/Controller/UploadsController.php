<?php

class UploadsController extends AppController {

	var $name = 'Uploads';
	var $helpers = array('Html', 'Form');
	public $uses=array('Upload','Tblloaitailieu');

	public function beforeFilter() {
        $this->Auth->allow('index','view');
    }
	
	function index($idloai=null){		
        $tblloaitailieu = $this->Upload->Tblloaitailieu->read(null,$idloai);
        $this->set('tblloaitailieu',$tblloaitailieu);
		$files = $this->Tblloaitailieu->find("all");
		$this->set("files",$files);
	}
	function admin_index($idloai=null){		
        $tblloaitailieu = $this->Upload->Tblloaitailieu->read(null,$idloai);
        $this->set('tblloaitailieu',$tblloaitailieu);
		$files = $this->Tblloaitailieu->find("all");
		$this->set("files",$files);
	}
	function view($id=null,$page=null,$end=null){
		$tblloaitailieu = $this->Upload->Tblloaitailieu->read(null,$id);
        $this->set('tblloaitailieu',$tblloaitailieu);
		
		$this->populateEditfileUpload($id,$page,$end); 
	}
	
	function upload(){
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

	function download($idUpload){
		
		$Upload=$this->Upload->find("first",array('conditions' => array('Upload.id' => $idUpload)));
		$get_url = realpath('../../app/webroot/img/uploads/')."\\".$Upload['Upload']['name'];
		//$get_url=realpath("../../".$Upload['Upload']['path']."/").$Upload['Upload']['name'];
		if(!File_exists($get_url)){
			print $get_url;
			print "File's not exits"; exit();
		}
		$size = Filesize($get_url);
		header("Content-Type: application/save");
		header("Content-Length: $size");
		header("Content-Disposition: attachment; Filename=\"".$Upload['Upload']['name']."\"");
		header("Content-Transfer-Encoding: binary");
		if ($fh = fopen("$get_url", "rb")){
			fpassthru($fh);
			fclose($fh);
		} else {
			print ("Permission denied: ".$get_url); exit();
		}
		$this->Upload->updateAll(array('Upload.dem'=>'Upload.dem+1'),array('Upload.id'=>$idUpload));
		//$sql="select dem from uploads where  name='".$get_name."'";
		//$query=mysql_query($sql);
		//$row=mysql_fetch_array($query);
//		$dem=$row['dem'];
//		echo $dem;
//		$sql1="update uploads set dem='".($dem+1)."' where  name='".$get_name."'";
//		mysql_query($sql1);

		$this->render('index');
	}
	
	function update(){
		
	}
	function delete(){
		
	}
	function populateEditfileUpload($idloai=NULL,$page=null,$end=null){
		$this->set("typefile",$this->Tblloaitailieu->find('all'));
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$idtype=(($idloai==null || !isset($idloai))?1:$idloai);
		$data=$this->Upload->find('all',array('conditions'=>array('Upload.idloai'=>$idloai), 'limit' => $this->numberRecord, 'offset'=>$page-1));
		$this->set("datas",$data);
		$this->set("idloai",$idloai);
		$numberrecord=$this->Upload->find('count',array('conditions'=>array('Upload.idloai'=>$idloai)));
		$this->pagination($page, $numberrecord,$end);
	}
}
?>