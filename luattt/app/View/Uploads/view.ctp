<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();
echo $this->Common->script(array("pdfobject.js,files.js"));
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
		<div class="title">
	           <?php echo $this->Html->link(__('Tài liệu'),'/Uploads/')?> >
	           <?php echo $tblloaitailieu['Tblloaitailieu']['tenloai'];?>

	    </div>
		
		<div class="download">
		
			<?php 
			foreach ($datas as $data): 
			
			?>			
			<div id="trType" style="padding-top:10px;">
			<div class="left" style="width:100%;">
				<div class="icbook"></div>
				<div class="left" id="titleFile"><?php echo $this->Html->link($data['Upload']['title'],array('controller' => 'Uploads','action' => 'download','full_base' => true,$data['Upload']['id']),array('class' => 'titleTailieu'));	?></div>			
			<?php	 
				$date = $data['Upload']['modified'];
				 $d = getdate(strtotime($date));
				$inngay = $d['mday'].'/'.$d['mon'].'/'.$d['year'] .' '. $d['hours'].':'.$d['minutes'].':' .$d['seconds'];		
				?>	
				<div class="left" style="margin-left:5px;font-size:12px;">(Ngày cập nhật: <?php echo $inngay; ?>)</div>
				<div class="right" style="font-size:12px;">Lượt tải: <?php echo $data['Upload']['dem']; ?></div>
				<div class="right"><?php echo $this->Html->link('',array('controller' => 'Uploads','action' => 'download','full_base' => true,$data['Upload']['id']),array('class'=>'icdownload','title'=>'download'));	?></div>
				
			</div>
			<div class="left clear">
				<strong>Mô tả: </strong><?php echo $data['Upload']['mota']; ?>
				<?php echo $this->Html->link('Xem',array('controller' => 'Uploads','action' => 'display','full_base' => true,$data['Upload']['id']));?>
			</div>
			</div>
			<?php endforeach; ?>
		</div>
	<div id="paging" class="right">
 <?php 
		echo $this->User->pagination("Uploads","view",$idloai,null,$page,$pagebgin,$pageend,$numberrecord);
		?>
 </div>
		</div>
		
	</div>
</object>
<div class="clear"></div>
 <div id="readpdf"></div>
</div>
<div id='footer'><?php  
$data=$this->Common->general();
echo $data['footer'];
?></div>
</div>

</body>
</html>
