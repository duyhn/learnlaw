<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$head=$this->Common->general();
echo $this->Common->create_heaeder();
echo $this->Common->script(array("user.js"));
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
                <div class="containrightus">
                <div class="tieude tenthongbao transHoa ">Thông tin cá nhân của thành viên <?php	echo $data['User']['username'];?> </div>
                	<div class="contain_pro">
	                	<div class="containregis">
		                	<div class="label">Họ tên:</div>
							<div class="input">	<?php	echo $data['User']['hoten'];?> </div>
						</div>
	                	<div class="containregis">
		                	<div class="label">Tên truy cập:</div>
							<div class="input">	<?php	echo $data['User']['username'];?> </div>
						</div>
						<div class="containregis">
		                	<div class="label">Email:</div>
							<div class="input">	<?php	echo $data['User']['email'];?> </div>
						</div>
						<div class="containregis">
		                	<div class="label">Ngày đăng ký:</div>
							<div class="input">	<?php	echo $data['User']['created'];?> </div>
						</div>
						<div class="containregis">
		                	<div class="label">Ngày thay đổi thông tin:</div>
							<div class="input">	<?php	echo $data['User']['modified'];?> </div>
						</div>
					</div>
					
					<div class="contain_pro_changepass" id="changepass">
						<div class="tieude tenthongbao transHoa ">Thay đổi mật khẩu </div>
						<form action="/luatvnam/users/changepass/<?php echo $this->Session->read("Userid");?>" method="POST" id="fupdatePass" name="Pass">
		                	<div class="containregis">
			                	<div class="label">Nhập mật khẩu cũ:</div>
								<div class="input"><input type='password' name='oldpass' id='passOld' /></div>
							</div>
		                	<div class="containregis">
			                	<div class="label">Nhập mật khẩu mới:</div>
								<div class="input"><input type='password' name='newpass' id='passNew' /></div>
							</div>
							<div class="containregis">
			                	<div class="label">Xác nhận mật khẩu:</div>
								<div class="input"><input type='password' name='pass' id='passConfirm' /></div>
							</div>
							<div class='left clear cachbtn'>
								<input class='button2 sizebutton2' id='' type='submit' value='Lưu' name='btnChange'/>
								<input class='button2' id='' type='reset' value='Nhập lại'/>
							</div></form>
					</div>
				</div>
            </div>
            <div class="clear cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer']
           		 ?></div>
	</div></body></html>
        