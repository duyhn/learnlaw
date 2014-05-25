
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
<div id='menu-nav'><?php echo $this->User->create_adminmenu($this->Session->read("Username")); ?>
</div>
<div id="main">
<div id="containad"><?php echo $this->User->menudoc();?>
<div class="containrightad">
<div class="tieude tenthongbao float">Upload Tài Liệu</div>

<form name="Upload" class="clear left"
	action="<?php echo $this->Html->url('/Uploads/upload'); ?>"
	method="post" enctype="multipart/form-data">

<fieldset class="size1"><legend> Chọn Tài liệu </legend>
<div class='formcon'>
<div class='label' style="margin-right: 5px;">Chọn thể loại tài liệu</div>
<div class='input'><select name='idloai' id='idloai' onchange=''>
<?php foreach ($typefile as $item){
	?>
	<option value="<?php echo $item['Tblloaitailieu']['idloai'] ?>"><?php echo $item['Tblloaitailieu']['tenloai'] ?></option>
	<?php }?>
</select></div>
</div>
<input type="file" name="file" id="textfield" /> <?php //echo $this->Form->file('file');?>

</fieldset>
<div class='left clear disbutton'><input type='submit' id='submitup'
	class='button2' value='Upload' name='add' /></div>
</form>

<table cellspacing="0" class="size1">
	<thead class="tbtailieu">
		<tr>
				<th class="tdstt">STT</th> <th>Tên tài liệu</th>
				<th>Loại tài liệu</th> <th>Kích thước</th> <th>Ngày đăng</th>
				<th>Ngày cập nhật</th> <th class="sizeAction" colspan=3>Tác vụ</th>
		
		</tr>
		<thead>

		<?php
		$i=0;
		foreach ($files as $data):
		$class="even";
		if(($i%2)!=0){
			$class="odd";
		}
		?>
			<tr id="trupload" class="<?php echo $class ?>">
				<td><?php echo $i; ?></td>
				<td><?php echo $data['Upload']['name']; ?></td>
				<td><?php echo $data['Tblloaitailieu']['tenloai']; ?></td>
				<td><?php echo $data['Upload']['size']; ?></td>
				<td><?php echo $data['Upload']['date']; ?></td>
				<td><?php echo $data['Upload']['modified']; ?></td>
				<td><?php echo $this->Html->link('Xem',array('controller' => 'Uploads','action' => 'viewtailieu','full_base' => true,$data['Upload']['id']));?></td>
				<td><?php echo $this->Html->link('Sửa',array('controller' => 'Uploads','action' => 'update','full_base' => true,$data['Upload']['id']));?></td>
				<td><?php echo $this->Html->link('Xóa',array('controller' => 'Uploads','action' => 'delete','full_base' => true,$data['Upload']['id']));?></td>
			</tr>
			<?php $i++; endforeach; ?>

</table>

</div>
</div>
</div>
<div class="clear"></div>
</div>
<div class="cach"></div>
<div id='footer'><?php  
$data=$this->Common->general();
echo $data['footer'];
?></div>

</div>
</body>
</html>
