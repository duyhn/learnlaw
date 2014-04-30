<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $layout = null; // biến layout
	var $helpers = array("Html","Common","Gioithieu","Session");
	//var $component = array("Session");
	var $_sessionUsername  = "Username";
	function beforeFilter()
	{
		/*Security::setHash("md5");
		$this->Auth->userModel = 'User';
		$this->Auth->fields = array('username' => 'username', 'password' => 'password');
		//$this->Auth->loginAction = array('admin' => false,'controller' => 'users','action' => 'index');
		$this->Auth->loginRedirect = array('admin' =>true,'controller' => 'users', 'action' => 'add');
		$this->Auth->loginError = 'Username / password combination.  Please try again';
		$this->Auth->authorize = 'controller';
		$this->set("admin",$this->_isAdmin());
		$this->set("logged_in",$this->_isLogin());
		$this->set("users_userid",$this->_usersUserID());
		$this->set("users_username",$this->_usersUsername());*/
	
		// Cấu hình layout
		$this->_configLayout();
	}
	
	// Hàm chọn layout thích hợp
	function _configLayout(){
		//echo $this->params['controller'];
		 $tem=$this->params['controller'];
		if(isset($this->params['controller'])){
			switch ($tem){
				case "templates" :
					$this->layout="template";
					break;
				case "gioithieu" :
					$this->layout="gioithieu";
					break;
				default:
					$this->layout="default";
			}
		}
		else{
			$this->layout  = "default";
			echo "vbbb";
		}
	
	}
	//
	function getTintuc($theloai){
		echo "welcome";
	}


	//--------- Login
	function login(){
		$error="";// thong bao loi
		if($this->Session->read($this->_sessionUsername))
		$this->redirect("view");

		if(isset($_POST['ok'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			if($this->User->checkLogin($username,$password)){
				$this->Session->write($this->_sessionUsername,$username);
				$this->redirect("view");
			}else{
				$error = "Username or Password wrong";
			}
		}
		$this->set("error",$error);
		$this->render("/Layouts/login");
	}
	//---------- Logout
	function logout(){
		$this->Session->delete($this->_sessionUsername);
		$this->redirect("login");
	}
}
