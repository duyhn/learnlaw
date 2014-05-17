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
                    <div class="content1">
                   <div class="title">Biểu mẫu đặt câu hỏi</div>
                	<div class="content">
                	
                    <?php 
                    if(isset($message)){
                    	?><script> alert(<?php echo $message; ?>);</script>;<?php
                    }
                    echo $this->User->create_formConsultings($typeconsulting,$idTypeconsulting);?>
                	</div>
                </div>
                
                <div class="content1">
                   <div class="title">Các câu hỏi nổi bật</div>
                	<div class="content">
                    
                    	<?php 
                    	
                    	
                    	$conlustings=(isset($Consultings)?$Consultings:null);
                    	echo $this->User->create_listConsultings($conlustings);
                    	//$this->Common->getRss("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=9BB9ECE7-A84C-4671-A699-2EC8D1F7FE9D",7);
                    	//print_r($this->Common->getCauhoi("http://tuvan.tinmoi.vn/rss/hoi-dap-phap-luat.rss"));?>

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
        