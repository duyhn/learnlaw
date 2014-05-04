 <?php 
class SearchsController extends AppController {
    
    var $uses = array();
    var $components= array("Google");
    var $name = "Searchs";
    
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
}

?> 