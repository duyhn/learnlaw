<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
//van ban chinh sach
//$this->Common->getRss("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=60BA73DF-77BC-4E2B-A006-82B37A1C39C6",5);
echo $this->Common->create_heaeder();
$gerne=$this->Common->general();
?>
<div id='bttop'>BACK TO TOP</div></head>
<body>

<div id='wrapper'><div id='header'><?php echo $gerne['header'] ?></div><div class='cach'></div>
<div id='menu-nav'><?php echo $this->Common->create_menu($this->Session->read('Username'));?></div>
       <div class="clear"></div>
            <div id="banner-main">
                <div class="div-images" >
                    <?php echo $this->Common->slideImage(); ?>
                </div>
                <?php echo $this->Common->createTopRight()?>
            </div>
            <div class="clear"></div>
            <div id="main">           
                <div id="sidebar-right">               
                <?php echo $this->Common->create_right(); ?>                    
                </div>
                <div class="content1">
                 <div class="title">Đề Thi</div>
                    <div class="content2">
                    <?php
                    	$html="<form>";
                    	$page=$this->Common->params['pass'][1];
                    	$qsid=$this->Common->params['pass'][0];
                    	$i=($page-1)*10+1;
                    	if(isset($data)){
                    		foreach($data as $item){
                    		$html.="<p><strong>Câu ".$i." </strong>".$item['question']['questions']['title']."</p>";
                    		$methods=$item['method'];
                    		$char='A';
                    		foreach($methods as $method){
                    			$html.=$char.") <input type='radio' name='".$item['question']['questions']['id']."' value=''>".$method['methods']['content']."<br>";
                    			$char++;
                    		}
                    		$i++;
                    		}
                    	}

                    	$html.="<div id='paging' class='right'>
                    	<a  class='button' onclick='sumitform(".$qsid.",".($page>1?($page-1):1).")' >Trước</a>
                    	<a onclick='sumitform(".$qsid.",1)' >1</a>
                    	<a onclick='sumitform(".$qsid.",2)' >2</a>
                    	<a onclick='sumitform(".$qsid.",3)' >3</a>
                    	<a  class='button' onclick='sumitform(".$qsid.",".($page<3?($page+1):3).")' >Sau</a> </div>";

						
                    	$html.="<div class='left clear cachbt' style='margin:20px 0 20px 260px;'><span class='button2 sizebutton2'>".$this->Common->link("Nộp bài", array('controller' => 'tests','action'=> 'testOnline', $qsid,3), array( 'class' => 'button'))."</span></div>";
                    	$html.="</form>";
                    	//print_r($data);
                    	echo $html;
                    ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>;
	</div></body></html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           