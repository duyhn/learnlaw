<?php
 class UserHelper extends HtmlHelper{
 	
 	function register(){
 		$register="<form action='/luatvnam/users/register' method='POST' id='registration_form'>";
 		$register.="<fieldset><label for='register_name'>Họ tên:</label>";
 		$register.="<input type='text' name='hoten' id='register_name' /></br>";
 		$register.="<label for='register_uername'>tên dang nh?p:</label>";
 		$register.="<input type='text' name='username' id='register_uername' /></br>";
 		$register.="<label for='register_email'>email:</label>";
 		$register.="<input type='text' name='email' id='register_email' /></br>";
 		$register.="<label for='register_password'>password:</label>";
 		$register.="<input type='password' name='password' id='register_password' /></br>";
 		$register.="<label for='register_password'>role:</label>";
 		$register.="<input type='text' name='idRole' id='register_idRole' /></br>";
 		$register.="<label for='register_password_confirmation'>password confirmation:</label>";
 		$register.="<input type='password' name='register_password_confirmation' id='register_password_confirmation' /></br>";
 		$register.="<input type='submit' value='Register' name='ok'/>";
 		$register.="</fieldset></form>";
 		return $register;
 	}
 	//
 	function create_adminmenu($username){
 	
 		$menu="<ul class='nav'><li class='trangchu'>".$this->link('Trang chủ',array('controller' => '','action' => '','full_base' => true)
 		)."</li><li class='gioithieu'>";
 		$menu.=$this->link('Quản lý người dùng',array('controller' => '','action' => '','full_base' => true));
 		$menu.="<li>".$this->link('Quản lý tài liệu',array('controller' => '','action' => '','full_base' => true))."</li>";
 		$menu.="<li>".$this->link('Quản lý thi',array('controller' => '','action' => '','full_base' => true))."</li></ul>";
 			$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'users','action' => 'logout','full_base' => true))."</li><";
 			$menu.="<span class='titlelog'>Xin chào: ".$username." </span>";
 		return $menu;
 	}
 }
?>