<?php
class TblloaitailieusController extends AppController{
	public $name = "Tblloaitailieus";// ten cua Controller Tblloaitailieu
    public $helpers = array('Form','Paginator','Html','Common','Js');
    public $components = array('Session', 'RequestHandler','Paginator');
    public $paginate = array();
    public $uses = array('Tblloaitailieu');
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
            if(isset($this->passedArgs['Tblloaitailieu.tenloai'])) {
            	$tenloai=$this->passedArgs['Tblloaitailieu.tenloai'];
                $conditions[] = array(
                    'Tblloaitailieu.tenloai LIKE' => "%$tenloai%",
                );
                $data['Tblloaitailieu']['tenloai'] = $tenloai;
                /*$this->Tblloaitailieu->tenloai=$this->passedArgs['Tblloaitailieu.tenloai'];
                $conditions[] = array(
                    'Tblloaitailieu.tenloai LIKE' => "%$this->Tblloaitailieu->tenloai %",
                );
                $data['Tblloaitailieu']['tenloai'] = $this->Tblloaitailieu->tenloai;*/
            }
            //Fillter description
     /*       if(isset($this->passedArgs['Tblloaitailieu.mota'])) {
                $keywords = $this->passedArgs['Tblloaitailieu.mota'];
                $conditions[] = array(
                    "OR" => array(
                                'Tblloaitailieu.mota LIKE' => "%$keywords%"
                             // ,  'Tblloaitailieu.isbn LIKE' => "%$keywords%" 
                            )
                );
                $data['Tblloaitailieu']['mota'] = $keywords; 
            }
      */      
            //Limit and Order By

            $this->paginate= array(
                'limit' => 3,
                'order' => array('tenloai' => 'desc'),
            );
        
            $this->data = $data;//giu lai gia tri tim kiem tren form tim kiem
            $this->set("posts",$this->paginate("Tblloaitailieu",$conditions));
        }
    }
}
?>