<?php
 //echo $this->Session->flash('auth');
 $data=$this->Session->read('Userid');
 //print_r($this->Session->read('Userid'));
  
	 print_r ($data[0]['Users']['user_id']);
 // print_r ($em[0]);
//foreach($data as $item)
/*  $output.= $data[0]['Users']['username'];
  $output.= $data[0]['Users']['email'];
  $output.= $data[0]['Users']['hoten'];
  $output.= $data[0]['Users']['created'];
  $output.= $data[0]['Users']['modified'];
  echo $output;*/
?>