<?php
/**
 * Journal Fixture
 */
class JournalFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '仕訳が発生した日'),
		'usage_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '用途。usagesテーブル'),
		'deposit' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '入金'),
		'payment' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '出金'),
		'balance' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '残高'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'created' => '2016-09-14 07:25:27',
			'modified' => '2016-09-14 07:25:27',
			'date' => '2016-09-14 07:25:27',
			'usage_id' => 1,
			'deposit' => 1,
			'payment' => 1,
			'balance' => 1
		),
	);

}
