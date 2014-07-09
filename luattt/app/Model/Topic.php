<?php
App::uses('AppModel', 'Model');
 
class Topic extends AppModel {
	var $name="Topic";
    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            ),
        ),
        'content' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            ),
        ),
        'forum_id' => array(
            'numeric' => array(
                'rule' => array('numeric')
            ),
        ),
    );
 
 
/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
    'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Forum' => array(
            'className' => 'Forum',
            'foreignKey' => 'forum_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
        
    );
 
/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'topic_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => 'Post.created DESC',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
 
}
