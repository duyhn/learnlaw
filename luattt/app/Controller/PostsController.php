<?php
App::uses('AppController', 'Controller');
 
class PostsController extends AppController {
 
    public function add($topicId=null) {
        if ($this->request->is('post')) {
        	$data=$this->Session->read("Userid");
        	
            $this->request->data['Post']['user_id'] =$data;
             
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Post has been created'));
                $this->redirect(array('controller'=>'topics','action'=>'view',$this->request->data['Post']['topic_id']));
            }
             
        } else {
            if (!$this->Post->Topic->exists($topicId)) {
                throw new NotFoundException(__('Invalid topic'));
            }
             
            $this->Post->Topic->recursive = -1;
            $topic = $this->Post->Topic->read(null,$topicId);
             
            $this->Post->Forum->recursive = -1;
            $forum = $this->Post->Forum->read(null,$topic['Topic']['forum_id']);
             
            $this->set('topic',$topic);
            $this->set('forum',$forum);
        }
    }
    public function update($idpost) {
    	
    	$this->Post->updateAll(array('Post.content'=>"'".$this->request->data['Post']['content']."'",'Post.modified'=>date("YmdHis", time())),array('Post.id'=>$idpost));
    	$this->redirect(array('controller'=>'topics','action'=>'view',$this->request->data['Post']['topic_id']));
    }
    public function delete($idpost) {
    	$msg="Xóa không thành công!";
    	$post=$this->Post->find('first',array('conditions'=>array('Post.id'=>$idpost)));
    	$idtopic=$post['Post']['topic_id'];
    	$this->Post->deleteAll(array('Post.id'=>$idpost));
    	if($this->Post->find('count',array('conditions'=>array('Post.id'=>$idpost)))==0){
    		$msg="Xóa tha`nh công!";
    	}
    	$this->set("msg",$msg);
    	$this->redirect(array('controller'=>'topics','action'=>'view',$idtopic));
    }
     
}
