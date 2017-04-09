<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property Postby $Postby
 * @property Postto $Postto
 * @property PostType $PostType
 * @property PostUserComment $PostUserComment
 * @property UserPostView $UserPostView
 * @property PostUserLike $PostUserLike
 */
class Post extends AppModel {

 public $actsAs = array(
        'Search.Searchable'
    );

    public $filterArgs = array(
        'search' => array(
            'type' => 'like',
            'field' => 'title',
            
            
        ),
        'email' => array(
            'type' => 'like',
            'field' => 'email'
        ),
        'active' => array(
            'type' => 'status'
        )
    );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'postby_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'postto_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'wall_type' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_private' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'post_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_posted' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_updated' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_deleted' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Postby' => array(
			'className' => 'User',
			'foreignKey' => 'postby_id',
			'conditions' => '',
			'fields' => array('Postby.first_name','Postby.last_name','Postby.id'),
			'order' => ''
		),
		'PosttoUser' => array(
			'className' => 'User',
			'foreignKey' => 'postto_id',
			'conditions' => array('wall_type' => 1),
			'fields' => array('PosttoUser.first_name','PosttoUser.last_name'),
			'order' => ''
		),
		'PosttoGroup' => array(
			'className' => 'Group',
			'foreignKey' => 'postto_id',
			'conditions' => array('wall_type' => 2),
			'fields' => array('PosttoGroup.name'),
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PostUserComment' => array(
			'className' => 'PostUserComment',
			'foreignKey' => 'post_id',
			'dependent' => false,
			'conditions' => array('PostUserComment.status' => 1),
			'fields' => array('PostUserComment.comment', 'PostUserComment.user_id', 'PostUserComment.id'),
			'order' => 'PostUserComment.id ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'UserPostView' => array(
			'className' => 'UserPostView',
			'foreignKey' => 'post_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => array('UserPostView.user_id'),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PostUserLike' => array(
			'className' => 'PostUserLike',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => array('PostUserLike.item_type' => 1, 'PostUserLike.status' => 1),
			'fields' => array('PostUserLike.user_id','PostUserLike.id'),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
