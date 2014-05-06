<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();

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
                    <div class="content">
                    <?php
						$date = $data[0]['tbltintucs']['ngaythang'];
	        			$d = getdate(strtotime($date));
	        			$inngay = $d['mday'].'/'.$d['mon'].'/'.$d['year'];
						?>
						<div class="tieude tenthongbao float"><?php echo $data[0]['tbltintucs']['tieude']; ?></div>
						<div class="date float"><?php echo $inngay ;?>
						<span class="author">Author: <?php echo $data[0]['tbltintucs']['tacgia'] ?></span></div>
						<div class="clear"></div>
						<div class='left'><?php  echo $data[0]['tbltintucs']['noidung']  ?></div>
						<div class='countview'>( <?php echo $data[0]['tbltintucs']["solanxem"] ?> lần xem)</div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>
	</div></body></html>