<?php
App::uses('Controller', 'Controller');
class LuatAppController extends AppController{
	var $helpers = array('Html', 'Form','Common');
	var $components=array('Acl');
}
?>