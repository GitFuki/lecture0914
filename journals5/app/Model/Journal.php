<?php
App::uses('AppModel', 'Model');
/**
 * Journal Model
 *
 * @property Usage $Usage
 */
class Journal extends AppModel {

    /*$this(JournalModel)のレコードを日付が新しい順に並べ、その最初のレコードにおける、balanceカラムのデータを返す*/
    public function getLastBalance(){
        $lastCreated = $this->find('first', array(
            'order' => array('date' => 'desc')
        ));
        $this->log($lastCreated, 'debug');
        /*$this->log('getLastBalance:' . $lastCreated['Journal']['balance'], 'debug');*/
        return $lastCreated['Journal']['balance'];
    }

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'usage_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Usage' => array(
			'className' => 'Usage',
			'foreignKey' => 'usage_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}




