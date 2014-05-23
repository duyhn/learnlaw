<?php

class TopicsController extends AppController {
 
   // public $components = array('Paginator');
    	// var $paginate = array(); 
    public $uses = array('Post','Topic');
    public   $numberRecord=10;
    	 
    public function beforeFilter() {
        $this->Auth->allow('index','view');
    }
     
    public function index($forumId=null,$page=null,$end=null) {
        if (!$this->Topic->Forum->exists($forumId)) {
            throw new NotFoundException(__('Invalid forum'));
        }
        $forum = $this->Topic->Forum->read(null,$forumId);
        $this->set('forum',$forum);
      /*   
       $this->Paginator->settings['contain'] = array('User','Post'=>array('User'));
        $this->set('topics', $this->Paginator->paginate());*/
        $this->populateTopic($forumId,$page,$end);

    }
     
    public function add() {
        $forums = $this->Topic->Forum->find('list');
         
        if ($this->request->is('post')) {
        	$data=$this->Session->read("Userid");
            $this->request->data['Topic']['user_id'] = $data;
            if ($this->Topic->save($this->request->data)) {
                $this->Session->setFlash(__('Chủ đề đã được tạo'));
                $this->redirect('/forums/');
            }
        }
         
        $this->set('forums',$forums);
    }
 
    public function view($id,$page=null,$end=null) {
        if (!$this->Topic->exists($id)) {
            throw new NotFoundException(__('Invalid topic'));
        }
         $page=(isset($page)?$page:1);
        $topic = $this->Topic->read(null,$id);
        $forum = $this->Topic->Forum->read(null,$topic['Topic']['forum_id']);
        /*$this->Paginator->settings['Post']['conditions'] = array('Post.topic_id'=>$topic['Topic']['id']);
        $this->Paginator->settings['Post']['contain'] = array('User');
        $this->Paginator->settings['Post']['order'] = array('Post.id'=>'DESC');*/
         
        $this->set('topics', $this->Paginator->paginate('Post'));
        
        $this->set('topic', $topic);
        $this->set('forum', $forum);
        //$this->set('posts', $this->Paginator->paginate('Post'));
        $post=$this->Post->find("all",array('conditions'=>array('Post.topic_id'=>$id), 'limit' => $this->numberRecord, 'offset'=>$page-1));
        $this->set('posts',$post);
        $numberrecord=count($topic['Post']);
        $this->pagination($page, $numberrecord, $end);
    }
    //
    //Phan trang
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
    //
    //public 
    public function populateTopic($forumId,$page=null,$end=null){
    
    	$page=(($page==null || !isset($page))?1:$page);
    	$end=(($end==null)||!isset($end)?$this->numberpage:$end);
    	//$forumId=(($idtype==null || !isset($idtype))?1:$idtype);
    	$topics=$this->Topic->find('all',array('conditions'=>array('Topic.forum_id'=>$forumId), 'limit' => $this->numberRecord, 'offset'=>$page-1));
    	$this->set("topics",$topics);
    	$numberrecord=count($topics);
    	
    	
    	$this->pagination($page, $numberrecord,$end);
    
    }
 
}