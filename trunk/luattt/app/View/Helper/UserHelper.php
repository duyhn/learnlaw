<?php
 class UserHelper extends HtmlHelper{
 	
 	function register(){
 		$register="<form action='/luattt/users/register' method='POST' id='registration_form'>";
 		$register.="<fieldset><label for='register_name'>H? tên:</label>";
 		$register.="<input type='text' name='hoten' id='register_name' /></br>";
 		$register.="<label for='register_uername'>tên dang nh?p:</label>";
 		$register.="<input type='text' name='username' id='register_uername' /></br>";
 		$register.="<label for='register_email'>email:</label>";
 		$register.="<input type='text' name='email' id='register_email' /></br>";
 		$register.="<label for='register_password'>password:</label>";
 		$register.="<input type='password' name='pass' id='register_password' /></br>";
 		$register.="<label for='register_password_confirmation'>password confirmation:</label>";
 		$register.="<input type='password' name='register_password_confirmation' id='register_password_confirmation' /></br>";
 		$register.="<input type='submit' value='Register' name='ok'/>";
 		$register.="</fieldset></form>";
 		return $register;
 	}
 }
?>