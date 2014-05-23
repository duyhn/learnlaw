<?php
App::uses('AppModel', 'Model');
 
class Post extends AppModel {
	var $name="Post";
    public $validate = array(
        'topic_id' => array(
            'numeric' => array(
                'rule' => array('numeric')
            ),
        ),
        'forum_id' => array(
            'numeric' => array(
                'rule' => array('numeric')
            ),
        ),
        'content' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            ),
        ),
        'user_id' => array(
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
        'Topic' => array(
            'className' => 'Topic',
            'foreignKey' => 'topic_id',
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
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
