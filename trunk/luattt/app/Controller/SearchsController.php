 <?php 
class SearchsController extends AppController {
    
   
    var $components= array("Google");
    var $name = "Searchs";
    public $uses = array('Tbltintuc','Consulting','Resultconsulting','upload');
    function index()
    {
        $start = (empty($this->params['url']['start']) ? 0 : $this->params['url']['start']);
        $term = $this->params['url']['term'];
        $search_results = array();
    
        
        
        
        //just send them back if the search is empty
        if(empty($term))
        {
            $this->redirect($this->referer());
        }
        else
        {
            $search_results = $this->Google->run_search($term, $start, false);
                        //debug($search_results) //uncomment to see return's structure
        }
        
        
        $this->set("search_results", $search_results);
        
        //$this->render("index");

    }
    function beforeFilter(){
    	parent::beforeFilter();
    	$this->Auth->allow(array('index','search'));
    }
    public function search(){
    	$data=array();
    	if($this->request->data){
    		$request=$this->request->data;
    		$tintuc=$this->Tbltintuc->find("all",array('conditions' => array('OR' =>array('Tbltintuc.tieude like '=>'%'.$request['info'].'%','Tbltintuc.noidung like'=>'%'.$request['info'].'%'))));
    		if(count($tintuc)>0){
    			foreach ($tintuc as $item){
    				array_push($data,array("title"=>$item['Tbltintuc']['tieude'],"decription"=>$item['Tbltintuc']['noidung'],"url"=>"luatvnam/Tbltintucs/view/".$item['Tbltintuc']['id_tintuc']));
    			}
    		}
    		$Resultconsulting=$this->Resultconsulting->find("all",array('conditions' => array('OR' =>array('Resultconsulting.title like '=>'%'.$request['info'].'%','Resultconsulting.contents like'=>'%'.$request['info'].'%'))));
    		if(count($Resultconsulting)>0){
    			foreach ($Resultconsulting as $item){
    				array_push($data,array("title"=>$item['Resultconsulting']['title'],"decription"=>$item['Resultconsulting']['contents'],"url"=>"luatvnam/Tuvan/detail/".$item['Resultconsulting']['consulting_id']));
    			}
    			
    		}
    	}
    	
    	$this->set("data",$data);
    }
}

?> 