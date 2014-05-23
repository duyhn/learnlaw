<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();
echo $this->Common->script("testsOnline.js");

?>
</head>
<body>
<div id='wrapper1'><div id='header'><?php echo $head['header'];?></div><div class='cach'></div>
<div id='menu-nav1'> <?php echo $this->User->create_adminmenu($this->Session->read("Username")); ?> </div>
            <div id="main">
				<div id="containad"><?php echo $this->User->menudoc();?>
				<div class="containrightad">
					<div class="tieude tenthongbao transHoa">Quản lý câu hỏi</div>
					<div class="clear cach"></div>
                    <?php                  
	                    $method=(isset($method)?$method:null);
	                    $question=(isset($question)?$question:null);
	                   	echo $this->User->create_formManageQuestion($type,$question,$method,$idtype);
	                   	echo $this->User->create_listQuestion($data); 
   
                    ?>
                    <div class="clear"></div>
                    <div id="paging" class="right">
		                <?php echo   $this->Common->link('Trước',array('controller' => 'admin','action' => 'admin_manageQuestion','full_base' => true,$idtype,($page>1?$page-1:1),$pageend),array('class'=>'button' ));
		                ?>
		                <?php	if($pagebgin>1)
		                		echo "...";
		                	for($i=$pagebgin;$i<=$pageend;$i++){
		                		$class="";
		                		if($page==$i){
		                			$class="curent";
		                		}
		                		echo $this->Common->link($i,array('controller' => 'admin','action' => 'admin_manageQuestion','full_base' => true,$idtype,$i,$pageend),array('class'=>$class));
		                	}
		                	if($pageend<$numberrecord)
		                		echo "...";
		                	if($page<$numberrecord){
		                 		echo $this->Common->link('Sau',array('controller' => 'admin','action' => 'admin_manageQuestion','full_base' => true,$idtype,($page<$numberrecord?$page+1:$numberrecord),$pageend),array('class'=>'button' ));
		                 	}
		                ?>
                	</div>
                </div>
            </div>
            <div class="cach clear"></div>
           <div id='footer'><?php  
           		echo $head['footer'];
           		 ?></div>
	</div></body></html>
        