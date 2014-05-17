<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();
//$this->Common->getRss("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=60BA73DF-77BC-4E2B-A006-82B37A1C39C6",5);
?>
<div id='bttop'>BACK TO TOP</div></head>
<body>
<div id='wrapper'><div id='header'><?php echo $head['header'];?></div><div class='cach'></div>
<div id='menu-nav'> <?php echo $this->Common->create_menu($this->Session->read("Username")); ?> </div>

            <div id="main">
            	<div class="menu_profile">
            	<?php echo $this->User->menudocUser();?>
            	</div>
                <div class="containrightus">cvcv</div>
            </div>
            <div class="clear cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>;
	</div></body></html>
        