<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();

?>
<div id='bttop'>BACK TO TOP</div>
</head>
<body>
<div id='wrapper'>
<div id='header'><?php echo $head['header'];?></div>
<div class='cach'></div>
<div id='menu-nav'><?php echo $this->Common->create_menu($this->Session->read("Username")); ?>
</div>
<div class="clear"></div>
<div id="banner-main">
<div class="div-images"><?php echo $this->Common->slideImage(); ?></div>
<?php echo $this->Common->createTopRight()?></div>
<div class="clear"></div>
<div id="main">
	<div id="sidebar-right"><?php echo $this->Common->create_right(); ?></div>
	<div class="content1">
		<div class="content">
		<div class="title">Tài Liệu > Thể loại tài liệu</div>
		
		<table cellspacing="0" class="sizetb clear">			
			<?php 
			$i=0;
			//print_r($files[0]);
			foreach ($files as $file): 
				
			?>
				<tr>
					<td><span class="ictick"></span><?php 
					$td=$file['Tblloaitailieu']['tenloai'];
					echo $this->Html->link($td,array('controller' => 'Uploads','action' => 'view',$file['Tblloaitailieu']['idloai']))?>
					<span>(<?php echo $file[0]['countfile'] ?>)</span>
					</td>
		
				</tr>
			<?php
			endforeach; ?>
		</table>
	
		</div>
	</div>
<div class="clear"></div>
</div>
<div id='footer'><?php  
$data=$this->Common->general();
echo $data['footer'];
?></div>
</div>

</body>
</html>
