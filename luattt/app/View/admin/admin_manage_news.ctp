<?php
$head=$this->Common->general_admin();
echo $this->Common->header_admin();
echo $this->Common->script("ckeditor/ckeditor.js");
echo $this->Common->script("admin.js");
?>
</head>
<body>
<div id='wrapper1'><div id='header'><?php echo $head['header'];?></div><div class='cach'></div>
<div id='menu-nav1'> <?php echo $this->User->create_adminmenu($this->Session->read("Username")); ?> </div>       
            <div id="main">
				<div id="containad"><?php echo $this->User->menudoc();?>
				<div class="containrightad">
					<div class="tieude tenthongbao transHoa">Quản lý tin tức</div>
					<div class="clear cach"></div>
                    <?php    
                    	         
	                   $News=(isset($News)?$News:null);
	             
	                   $ListtypeNew=(isset($ListtypeNew)?$ListtypeNew:null);
	                
	                   $page=(isset($page)?$page:null);
	                   $end=(isset($end)?$end:null);
	                   	echo $this->User->create_FormNews($News,$idtype,$ListtypeNew,$page,$end);
	                   	echo $this->User->createListNews($typeNews); 
   
                    ?>
                    <div class="clear"></div>
                    <div id="paging" class="right">
		                <?php 
		                echo $this->User->pagination("admin","manageNews",$idtype,$News,$page,$pagebgin,$pageend,$numberrecord);
		                ?>
                	</div>
                </div>
            </div>
            <div class="clear cach"></div>
           <div id='footer'><?php  
           		echo $head['footer'];
           		 ?></div>
</div></body></html>
        