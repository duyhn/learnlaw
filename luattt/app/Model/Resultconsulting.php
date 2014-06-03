<?php
class Resultconsulting extends AppModel{
	var $name="Resultconsulting";
	public $belongsTo = array(
			'Consulting' => array(
					'className' => 'Consulting',
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