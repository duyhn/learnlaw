<?php
$head=$this->Common->general_admin();
echo $this->Common->header_admin();
echo $this->Common->script("filesupload.js");
?>
</head>
<body>
<div id='wrapper1'>
<div id='header'><?php echo $head['header'];?></div>
<div id='menu-nav1'><?php echo $this->User->create_adminmenu($this->Session->read("Username")); ?>
</div>
<div id="main">
<div id="containad"><?php echo $this->User->menudoc();?>
<div class="containrightad">
<div class="tieude tenthongbao float">Upload Tài Liệu</div>
<?php if(isset($msg))
		echo $msg;
?>
<form name="Upload" class="clear left"
	action="<?php echo $this->Html->url('/admin/admin/manageUpload'); ?>"
	method="post" enctype="multipart/form-data">

<fieldset class="size1"><legend> Thông tin tài liệu </legend>
<div class='formcon'>
<div class='label' style="margin-right: 5px;">Chọn thể loại tài liệu</div>
<div class='input'><select name='idloai' id='idloai' style='height: 25px;width: 200px;' onchange='changeIdfile()'>
<?php foreach ($typefile as $item){
	$selected="";
	if($item['Tblloaitailieu']['idloai']==$idloai)
		$selected="selected";
	?>
	<option value="<?php echo $item['Tblloaitailieu']['idloai'] ?>" <?php echo $selected; ?> ><?php echo $item['Tblloaitailieu']['tenloai'] ?></option>
	<?php }?>
</select></div>
</div>
<div class="left clear" ><input style="margin:5px 0 5px 130px" type="file" name="file" id="textfield" /> <?php //echo $this->Form->file('file');?>
</div>
<div class="containdiv"><label class="label clear">Tên tài liệu </label><input type="text" name="title" id="title" /></div>
<div class="containdiv"><label class="label clear">Mô tả </label><textarea name="mota" id="mota" ></textarea></div>
</fieldset>
<div class='left clear cachbtleft cachbt'>
 <input type='submit' id='submitup' class='button2' value='Upload' name='add' />
  <input type='reset' class='button2' value='Nhập lại' name='' />
 </div>
</form>

<table cellspacing="0" class="clear sizeAd">
	<thead class="tbtailieu">
		<tr>
				<th class="tdstt">STT</th> 
				<th>Tên tài liệu</th>
				<th>Kích thước</th> 
				<th>Mô tả</th> 
				<th>Ngày đăng</th>
				<th>Cập nhật</th> 
				<th class="sizeAction" colspan=2>Tác vụ</th>
		
		</tr>
		<thead>

		<?php
		$i=0;
		foreach ($files as $data):
		$i++;
		$class="even";
		if(($i%2)!=0){
			$class="odd";
		}
		?>
			<tr id="" class="<?php echo $class ?>">
				<td><?php echo $i; ?></td>
				<td><?php echo $data['Upload']['title']; ?></td>
				<td><?php echo $data['Upload']['size']; ?></td>
				<td><?php echo $data['Upload']['mota']; ?></td>
				<td><?php echo $this->User->inngay($data['Upload']['date']); ?></td>
				<td><?php echo $this->User->inngay($data['Upload']['modified']); ?></td>
			
				<td ><?php echo $this->Html->link('',array('controller' => 'admin','action' => 'admin_updateUpload','full_base' => true,$data['Upload']['id']),array('class'=>'icedit','title'=>'sửa'));?></td>
				<td><?php echo $this->Html->link('',array('controller' => 'admin','action' => 'admin_deleteUpload','full_base' => true,$data['Upload']['id']),array('class'=>'icdelete','title'=>'xóa'));?></td>
			</tr>
			<?php endforeach; ?>

		</table>
  		<div class="clear"></div>

                    <div id="paging" class="right">
                    <?php 
                    echo $this->User->pagination("admin","manageUpload",$idloai,null,$page,$pagebgin,$pageend,$numberrecord);
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
?></div>

</div>
</body>
</html>
