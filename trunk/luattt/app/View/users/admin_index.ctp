<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();

?>
<div id='bttop'>BACK TO TOP</div></head>
<body>
<div id='wrapper1'><div id='header'><?php echo $head['header'];?></div>
<div id='menu-nav1'> <?php echo $this->User->create_adminmenu($this->Session->read("Username")); ?> </div>     
            <div id="main">
                <div id="containad">
                	<?php echo $this->User->menudoc();?>
                    <div class="containrightad">
                    sfd
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>
	</div></body></html>
        