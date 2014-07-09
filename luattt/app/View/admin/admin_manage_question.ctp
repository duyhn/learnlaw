<?php
$head=$this->Common->general_admin();
echo $this->Common->header_admin();
echo $this->Common->script("testsOnline.js");
echo $this->Common->script("admin.js");
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
	                    $question=(isset($question)&&$question!=null?$question:null);
	                    $idqs=(isset($question)&&$question!=null?$question['Question']['id']:0);
	                   	echo $this->User->create_formManageQuestion($type,$question,$method,$idtype,$page,$pageend);
	                   	
	                   	echo $this->User->create_listQuestion($data,$page,$pageend); 
                    ?>
                    <?php if(isset($msg)){
                    $css='<script type="text/javascript">
                    var txt = new String('.$msg.');
                     alert(txt);</script>';
                    	echo $css;
                    }
                    ?>
                    <div class="clear"></div>
                    <div id="paging" class="right">
		                <?php  
		                echo $this->User->pagination('admin','admin_manageQuestion',$idtype,$idqs,$page,$pagebgin,$pageend,$numberrecord);
		                ?>
                	</div>
                </div>
            </div>
            <div class="cach clear"></div>
           <div id='footer'><?php  
           		echo $head['footer'];
           		 ?></div>
	</div></body></html>
        