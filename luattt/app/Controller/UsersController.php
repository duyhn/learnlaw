<?php
class UsersController extends LuatAppController{
	var $name="Users";
	//var $_sessionUsername  = "Username";
	function  index(){
		$this->set('title_for_layout', 'Learn Law User');
		$this->set("content","Welcome");
		
	}
	/*function view(){
		if(!$this->Session->read($this->_sessionUsername)) // đọc Session xem có tồn tại không
			$this->redirect("login");
		else
			$this->render("/demos/users/index"); // load 1 file view index.ctp trong thư mục “views/demos/users”/
	}
	 */
}