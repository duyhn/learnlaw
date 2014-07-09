<?php
$head=$this->Common->general_admin();
echo $this->Common->header_admin();
echo $this->Common->script("ckeditor/ckeditor.js");
echo $this->Common->script("testsOnline.js");
echo $this->Common->script("admin.js");
?>
</head>
<body>
<div id='wrapper1'><div id='header'><?php echo $head['header'];?></div><div class='cach'></div>
<div id='menu-nav1'> <?php echo $this->User->create_adminmenu($this->Session->read("Username")); ?> </div>
       <div class="clear"></div>
            <div class="clear"></div>
            <div id="main">
                 <div id="containad">
                	<?php echo $this->User->menudoc();?>
                    <div class="containrightad">
                    	<div class="tieude tenthongbao transHoa ">Quản lý Tư vấn </div>
                    	<div class="clear cach"></div>
                    	<?php 
		                    $consul=(isset($consul)?$consul:null);
		                   echo $this->User->create_formAdminConsultings($typeconsultings,null,$consul,"admin_manageConsulting");
		                    
	                    ?>
                    </div>
                    <div class="containrightad">
                    <div class="clear cach"></div>
                    <?php
                    echo $this->User->create_listConsulting($Consluting,"admin_manageConsulting","editConsulting",$page,$pageend);
                    ?>
                    </div>
                     <div class="clear"></div>
                    <div id="paging" class="right">
		                <?php 
		                echo $this->User->pagination("admin","admin_manageConsulting",$idtype,null,$page,$pagebgin,$pageend,$numberrecord);
		                ?>
                    </div>
                     <?php if(isset($msg)){
                    $css='<script type="text/javascript">
                    var txt = new String('.$msg.');
                     alert(txt);</script>';
                    	echo $css;
                    }
                    ?>
                    <iframe id="myFrame" style="display:none" ></iframe>
					<input type="button" value="Open PDF" onclick = "openPdf()"/>
                </div>
            </div>
            <div class="cach clear"></div>
           <div id='footer'><?php  
           		echo $head['footer'];
           		 ?></div>;
	</div></body></html>
        