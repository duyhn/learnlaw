<?php
class Typeconsulting extends AppModel{
	var $name="Typeconsulting";
	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
			'Consulting' => array(
					'className' => 'Consulting',
					'foreignKey' => 'typeconsulting_id',
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