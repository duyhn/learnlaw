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
		<ul id="titleli">
	          <li class="textTop">
	            <?php echo $this->Html->link(__('Tài liệu'),'/Uploads/')?>
	          </li>
	          <li class="active">
	           <?php echo $tblloaitailieu['Tblloaitailieu']['tenloai'];?>
	          </li>
	        </ul>
		
		<table cellspacing="0" class="sizetb">
			<thead class="tbtailieu">
				<tr>
					<th <th class="tdstt">STT</th>
					<th>Tên</th>
					<th>Lượt tải</th>
					<th></th>
				</tr>
			<thead>
			
			<?php 
			$i=0;
			foreach ($datas as $data): 
			$class="even";
			if(($i%2)!=0){
				$class="odd";
			}
			?>			
			<tr id="trupload" class="<?php echo $class ?>">
				<td><?php echo $data['Upload']['id']; ?></td>
				<td><?php echo $data['Upload']['name']; ?></td>
				<td class="td1"><?php echo $data['Upload']['dem']; ?></td>
				<td class="td1"><?php echo $this->Html->link('Tải về',array('controller' => 'Uploads','action' => 'download','full_base' => true,$data['Upload']['id']));?></td>
			</tr>
			<?php $i++; endforeach; ?>
		</table>
	<div id="paging" class="right">
 <?php 
		echo $this->User->pagination("Uploads","view",$idloai,$page,$pagebgin,$pageend,$numberrecord);
		?>
 </div>
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
