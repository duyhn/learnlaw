<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();
echo $this->Common->script("ckeditor/ckeditor.js");


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
		                   echo $this->User->create_formAdminConsultings($typeconsultings,null,$consul,"admin_manageConsulted");  
	                    ?>
                    </div>
                    <div class="containrightad">
                    <div class="clear cach"></div>
                    <?php
                   
                    echo $this->User->create_listConsulting($consulted,"manageConsulted","editConsulting",$page,$pageend);
                    ?>
                    <div class="clear"></div>
                    <div id="paging" class="right">
		                <?php 
		                echo $this->User->pagination("admin","admin__manageConsulted",$idtype,null,$page,$pagebgin,$pageend,$numberrecord);
		                ?>
                    </div>
                    <?php if(isset($msg)){
                    $css='<script type="text/javascript">
                    var txt = new String('.$msg.');
                     alert(txt);</script>';
                    	echo $css;
                    }
                    ?>
                </div>
            </div>
            <div class="cach clear"></div>
           <div id='footer'><?php  
           		echo $head['footer'];
           		 ?></div>;
	</div></body></html>
        