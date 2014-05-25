<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();
echo $this->Common->script(array("forum.js"));
?>
</head>
<body>
<div id='wrapper1'><div id='header'><?php echo $head['header'];?></div><div class='cach'></div>
<div id='menu-nav1'> <?php echo $this->User->create_adminmenu($this->Session->read("Username")); ?> </div>       
            <div id="main">
				<div id="containad"><?php echo $this->User->menudoc();?>
				<div class="containrightad">
					<div class="tieude tenthongbao transHoa">Quản lý bình luận</div>
					<div class="clear cach"></div>
                    <?php    
	                	$Topic=(isset($Topic)?$Topic:null);
	                	$post=isset($post)?$post:null;
	                	$title="Tạo mới bình luận";
	                	if($Topic!=null){
	                		$title="Chỉnh sửa bình luận";
	                	}
	                   $page=(isset($page)?$page:null);
	                   $end=(isset($end)?$end:null);
	                   ?>
	                   <div class="clear"></div>
	                   <div class="title"> <?php  echo $title; ?>  </div>
	                  <?php echo $this->User->create_form_post($forums,$idforum,$topics,$idtopic,$post,$page,$pagebgin);?>
	                  <div class="clear"></div>
	                   	<div class="title">Danh sách các chủ đề</div>
	                   	<?php 
	                   	echo $this->User->createListPosts($Posts,$page,$end); 
	                   	?>
                    <div class="clear"></div>
                    <div id="paging" class="right">
		                <?php 
		                echo $this->User->pagination("admin","manageComment",$idtopic,$page,$pagebgin,$pageend,$numberrecord);
		                ?>
                	</div>
                </div>
            </div>
            <div class="clear cach"></div>
           <div id='footer'><?php  
           		echo $head['footer'];
           		 ?></div>
</div></body></html>
        