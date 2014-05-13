<?php

class ForumsController extends AppController {
 
 //   public $components = array('Paginator','Auth');

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

        $this->Paginator->settings['contain'] = array('Topic', 'Post'=>array('User','Topic'));
        $this->set('forums', $this->Paginator->paginate());
        
        $tb=new User();
        $data= $tb->find('count');
        $this->set('data',$data);
         //$frusers = $this->Forum->User->find('lisst');
        $this->set('countForum',$this->Forum->find('count')) ;
		$this->set('countTopic',$this->Forum->Topic->find('count')) ;
		$this->set('countPost',$this->Forum->Post->find('count')) ;
    }
 
}