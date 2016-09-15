<?php
App::uses('AppModel', 'Model');
/**
 * Journal Model
 *
 * @property Usage $Usage
 */
class Journal extends AppModel {

    /*さっきのgetLastBalance()を改良して、引数に日付をもらえるようにする。
    引数で指定された日付より古い仕訳を探す。*/
    public function getPreviousBalance($date){
        $dateString = $date['year'] . '-'. $date['month'] . '-'. $date['day'] . ' ' . $date['hour'] . ':' . $date['min'];
        $previous = $this->find('first', array(
            /*その日よりも古いものを検索*/
            'conditions' => array('date < ' => $dateString),
            'order' => array('date' => 'desc')
        ));
        $this->log('getPreviousBalance:' . $previous['Journal'], 'debug');
        return $previous['Journal']['balance'];
    }

    public function updateNewBalance($date){
        /*引数の日付より新しい仕訳をすべて獲得し、古い順に並べたうえで、$newJournalsに入れる*/
        $newJournals = $this->find('all', array(
            'conditions' => array('date >= ' => $date),
                'order' => array('date' => 'asc')
            ));
       if(count($newJournals) == 0){
           /*結果がゼロであれば何もせずにreturn*/
           $this->log('not need to update;', 'debug');
           return false;
       }
       for($i=1; $i<count($newJournals); $i++){
           /*日付が古い順にそれぞれ、残高を計算し、連想配列を書き換える*/
           $journal = $newJournals[$i]['Journal'];
           $balance = $newJournals[$i-1]['Journal']['balance']
               +$journal['deposit']
               -$journal['payment'];
           $newJournals[$i]['Journal']['balance'] = $balance;
        }
        /*すべてDBに保存。saveAll()を使うときは、$newJournals配列のデータ形式を正しく維持すること。*/
        $result = $this->saveAll($newJournals);
        return $result;
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




