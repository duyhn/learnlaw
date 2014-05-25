<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();

?>
</head>
<body>
<div id='wrapper1'><div id='header'><?php echo $head['header'];?></div><div class='cach'></div>
<div id='menu-nav1'> <?php echo $this->User->create_adminmenu($this->Session->read("Username")); ?> </div>       
            <div id="main">
				<div id="containad"><?php echo $this->User->menudoc();?>
				<div class="containrightad">
					<div class="tieude tenthongbao transHoa">Quản lý chủ đề</div>
					<div class="clear cach"></div>
                    <?php    
                    	         
	                  
	                	$Topic=(isset($Topic)?$Topic:null);
	                	$title="Tạo mới chủ đề";
	                	if($Topic!=null){
	                		$title="Chỉnh sửa chủ đề";
	                	}
	                   $page=(isset($page)?$page:null);
	                   $end=(isset($end)?$end:null);
	                   ?>
	                   <div class="clear"></div>
	                   <div class="title"> <?php  echo $title; ?>  </div>
	                  <?php echo $this->User->create_form_Topic($idforum,$forums,$Topic,$page,$end);?>
	                  <div class="clear"></div>
	                   	<div class="title">Danh sách các chủ đề</div>
	                   	<?php 
	                   	echo $this->User->createListTopics($Topics,$page,$end); 
	                   	?>
   
                   
                    <div class="clear"></div>
                    <div id="paging" class="right">
		                <?php 
		                echo $this->User->pagination("admin","manageToppic",$idforum,$page,$pagebgin,$pageend,$numberrecord);
		                ?>
                	</div>
                </div>
            </div>
            <div class="clear cach"></div>
           <div id='footer'><?php  
           		echo $head['footer'];
           		 ?></div>
</div></body></html>
        