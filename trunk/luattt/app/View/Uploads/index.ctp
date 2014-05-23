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
		<div class="content2">
		<div class="tieude tenthongbao float">Tài Liệu</div>
		
		<table cellspacing="0" class="sizetb clear">
			<thead class="tbtailieu">
				<tr>
					<th class="tdstt">STT</th>
					<th>Loại tài liệu</th>
				</tr>
			<thead>
			<?php 
			$i=0;
			foreach ($files as $file): 
				$class="even";
				if(($i%2)!=0){
					$class="odd";
				}
			?>
				<tr id="trupload" class="<?php echo $class ?>">
					<td><?php echo $file['Tblloaitailieu']['idloai']; ?></td>
					<td><?php 
					$td=$file['Tblloaitailieu']['tenloai'];
					echo $this->Html->link($td,array('controller' => 'Uploads','action' => 'view',$file['Tblloaitailieu']['idloai']))?>
					</td>
		
				</tr>
			<?php $i++; 
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
