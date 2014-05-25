<?php
class Consulting extends AppModel{
	var $name="Consulting";
	public $hasMany = array(
			'Resultconsulting' => array(
					'className' => 'Resultconsulting',
					'foreignKey' => 'consulting_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			),
	);
}
?>