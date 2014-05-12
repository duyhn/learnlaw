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
		$menu.=$this->link('Quản lý người dùng',array('controller' => 'admin','action' => 'managedUser'));
		$menu.="<li>".$this->link('Quản lý tài liệu',array('controller' => '','action' => '','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý thi',array('controller' => 'admin','action' => 'manageTest','full_base' => true))."</li>";
		$menu.="<li>".$this->link('Quản lý câu hỏi',array('controller' => 'admin','action' => 'manageQuestion','full_base' => true))."</li></ul>";

		$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'users','action' => 'logout','full_base' => true))."</li><";
		$menu.="<span class='titlelog'>Xin chào: ".$username." </span>";
		return $menu;
	}
	//
	function create_formManageUser($role,$user){
		$name="";
		$email="";
		$roleid=0;
		$usname="";
		$action="/luatvnam/admin/admin/createuser";
		if(isset($user) && $user!=null){
			$name=$user['User']['hoten'];
			$email=$user['User']['email'];
			$roleid=$user['User']['idRole'];
			$usname=$user['User']['username'];
			$action="/luatvnam/admin/admin/updateusser";;
		}
		$register="<table><form action='".$action."' method='POST' id='registration_form' name='User'>";
		$register.="<tr><td><fieldset><label for='register_name'>Họ tên:</label></td>";
		$register.="<td><input type='text' name='hoten' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Tên đăng nhập:</label></td>";
		$register.="<td><input type='text' name='username' value='".$usname."' id='register_uername' /></td>";
		$register.="<tr><Td><label for='register_email'>email:</label></td>";
		$register.="<td><input type='text' name='email' value='".$email."' id='register_email' /></td></tr>";
		$register.="<tr><td><label for='register_role'>Quyền:</label></td>";
		$register.="<td><select name='idRole'>";
		foreach ($role as $item){
			$selected="";
			if($item['Role']['idRole']==$roleid){
				$selected="selected";
			}
			$register.="<option value=".$item['Role']['idRole']." ".$selected.">".$item['Role']['rolename']."</option>";
		}
		$register.="</select><td>";
		$register.="<tr><td><label for='register_active'>Trạng thái:</label></td>";
		$register.="<td><input type='checkbox' name='ative' id='register_active' /></td></tr>";
		$register.="<tr><td><input type='submit' value='Lưu' name='ok'/>";
		$register.="<input type='button' value='Tìm kiếm' name='search'/></td></tr>";
		$register.="</fieldset></form></table>";
		return $register;
	}
	function create_listUer($data){
		$register="<table><thead><tr><th>stt</th><th>Họ và tên</th><th>Tên đăng nhập</th><th>Email</th><th>tác vụ</th></tr></thead><tbody>";
		$i=1;
		foreach ($data as $item){
			$register.="<tr><td>".$i."</td><td>".$item['User']['hoten']."</td><td>".$item['User']['username']."</td><td>";
			$register.=$item['User']['email']."</td>";
			$register.="<td>".$this->link('Xem',array('controller' => '','action' => '','full_base' => true)).$this->link('Sửa',array('controller' => 'admin','action' => 'formUpdateUser','full_base' => true,$item['User']['user_id']));
			$register.=$this->link('Xóa',array('controller' => 'admin','action' => 'deleUser','full_base' => true,$item['User']['user_id']))."</td></tr>";
		}
		$register.="</tbody></table";
			
		return $register;
	}

	function create_listQuestion($data){
		$register="<table><thead><tr><th>stt</th><th>Câu hỏi</th><th>tác vụ</th></tr></thead><tbody>";
		$i=1;

		foreach ($data as $item){
			$register.="<tr><td>".$i."</td><td>".$item['Question']['title']."</td>";
			$register.="<td>".$this->link('Xem',array('controller' => '','action' => '','full_base' => true)).$this->link('Sửa',array('controller' => 'admin','action' => 'editQuestion','full_base' => true,$item['Question']['id']));
			$register.=$this->link('Xóa',array('controller' => 'admin','action' => 'deleteQuestion','full_base' => true,$item['Question']['id']))."</td></tr>";
			$i++;
		}
		$register.="<tr><td></td><td>".$this->link('Tạo mới',array('controller' => 'admin','action' => 'manageQuestion','full_base' => true))."</td></tr></tbody></table";
			
		return $register;
	}

	function create_formManageQuestion($type,$question,$method,$idtype=null){
		$tile="";

		$action="/luatvnam/admin/admin/createQuestion";
		if(isset($question) && $question!=null){
			$tile=$question['Question']['title'];
			$action="/luatvnam/admin/admin/updateQuestion/".$question['Question']['id'];
		}
		$register="<form action='".$action."' method='POST' id='formQuestion' name='Question'>";
		$register.="<table id='tbform'><tr><td><label for='register_name'>Thể loại</label></td>";
		$register.="<td><select name='id_type' id='idtype' onchange='changeidtypeQuestion()'>";
		foreach ($type as $item){
			$selected="";
			if($item['Typequestion']['id']==$idtype){
				$selected="selected";
			}
			$register.="<option value=".$item['Typequestion']['id']." " . $selected.">".$item['Typequestion']['title']."</option>";
		}
		$register.="</select><td></tr>";
		$register.="<tr><td><fieldset><label for='register_name'>Nội dung câu hỏi:</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='title' id='register_title' >".$tile."</textarea><td></tr>";

		if($method!=null && isset($method)){
			$register.="<tr><td>Các Phương án trả lời</td><tr>";
			$i=1;
			foreach ($method as $item){
				$register.="<tr><td>Phương án ".$i.": ".$this->link('Xóa',array('controller' => 'admin','action' => 'deleteMethod','full_base' => true,$item['Method']['id'],$question['Question']['id']))."</td></tr>";
				$i++;
				$register.="<input type=hidden name='idmethod[]' value=".$item['Method']['id'].">";
				$register.="<tr><td><fieldset><label for='register_name'>Nội dung câu trả lời:</label></td>";
				$register.="<td><textarea rows='4' cols='50' name='content[]' >".$item['Method']['content']."</textarea><td></tr>";
				$register.="<tr><td><fieldset><label for='register_name'>Đúng/sai:</label></td><td><select name='corect[]'>";
				$selected0="";
				$selected1="";
				if($item['Method']['corect']==0){
					$selected0="selected";
				}
				if($item['Method']['corect']==1){
					$selected1="selected";
				}
				$register.="<option value=0 ".$selected0.">sai</option>";
				$register.="<option value=1 ".$selected1.">Đúng</option>";
			}
			$register.="</select><td></tr></table>";
		}
		$register.="<table><tr><td><a onclick='addmethod()'>Thêm phương án trả lời</a></td></tr>";
		$register.="<tr><td><input type='submit' value='Lưu' name='ok'/>";
		$register.="<input type='button' value='Tìm kiếm' name='search'/></td></tr>";
		$register.="</fieldset></table></form>";
		return $register;
	}

}
?>