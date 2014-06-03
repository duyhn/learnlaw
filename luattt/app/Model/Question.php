<?php
class Question extends AppModel{
	var $name="Question";
	public $hasMany = array(
			'Method' => array(
					'className' => 'Method',
					'foreignKey' => 'question_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			)
			);
}
?>