<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();
echo $this->Common->script("tuvanonline.js");
?>
<div id='bttop'>BACK TO TOP</div></head>
<body>
<div id='wrapper'><div id='header'><?php echo $head['header'];?></div><div class='cach'></div>
<div id='menu-nav'> <?php echo $this->Common->create_menu($this->Session->read("Username")); ?> </div>
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
                <div class="title">CÁC CÂU HỎI MỚI NHẤT</div>
                <div class="content2">
                 <?php
                 	echo $this->User->create_listConsultings($resultNews);
                 	
                 ?>
                   <div class="clear"></div>
                 </div>
                   <div class="title">CÁC CÂU HỎI NỔI BẬT</div>
                	<div class="content2">
                    	<?php 
                    	
                    	echo $this->User->create_listConsultings($resultFeat);
                    	//print_r(split("\/","http://localhost/luatvnam/Tuvan"));
                    	?>
                		

                	</div>
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
        