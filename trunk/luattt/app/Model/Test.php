<?php

class Test extends AppModel{
	var $name="Test";
	function getAllTypesQuestion(){
		$data=$this->query("SELECT * FROM typequestions");
		
		return $data;
	}
	function getAllQuestions($id){
		$data=$this->query("SELECT * FROM questions WHERE id_type=".$id);
		return $data;
	}
	function getAllMethods($id){
		$data=$this->query("SELECT * FROM methods WHERE question_id=".$id);
		return $data;
	}
	function getMethods($id){
		$data=$this->query("SELECT * FROM methods WHERE id=".$id);
		return $data;
	}
}
?>