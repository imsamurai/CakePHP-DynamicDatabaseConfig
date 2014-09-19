<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 06.08.2013
 * Time: 17:34:31
 */

App::uses('DynamicDatabaseConfig', 'DynamicDatabaseConfig.Config');

//@codingStandardsIgnoreStart
/**
 * DynamicDatabaseConfigTest1
 * 
 * @package DynamicDatabaseConfigTest
 * @subpackage Config
 */
class DynamicDatabaseConfigTest1 extends DynamicDatabaseConfig {

	/**
	 * $static_db_config_name
	 * 
	 * @var array 
	 */
	public $static_db_config_name = array(
		'database' => 'static_db_config_name',
	);

	/**
	 * test_db_name1
	 * 
	 * @return array
	 */
	public function test_db_name1() {
		return array(
			'database' => 'test_db_name1'
		);
	}

	/**
	 * testDBName2
	 * 
	 * @return array
	 */
	public function testDBName2() {
		return array(
			'database' => 'test_db_name2',
		);
	}

	/**
	 * testChildDBName1
	 * 
	 * @return array
	 */
	public function testChildDBName1() {
		return array('port' => 'port1') + $this->testDBName2();
	}

	/**
	 * _notDB1Method1
	 * 
	 * @return bool
	 */
	public function _notDB1Method1() {
		return false;
	}

	/**
	 * notDB1Method2
	 * 
	 * @return bool
	 */
	protected function notDB1Method2() {
		return false;
	}

	/**
	 * _notDB1Method3
	 * 
	 * @return bool
	 */
	protected function _notDB1Method3() {
		return false;
	}

	/**
	 * _notDB1Method4
	 * 
	 * @return bool
	 */
	private function _notDB1Method4() {
		return false;
	}

	/**
	 * __notDB1Method5
	 * 
	 * @return bool
	 */
	protected function __notDB1Method5() {
		return false;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

}

/**
 * DynamicDatabaseConfigTest2
 * 
 * @package DynamicDatabaseConfigTest
 * @subpackage Config
 */
class DynamicDatabaseConfigTest2 extends DynamicDatabaseConfig {

	/**
	 * Constants
	 */
	const APPLY_NAMING_SCHEMA = true;

	/**
	 * dbConfig1
	 * 
	 * @return array
	 */
	public function dbConfig1() {
		return array(
			'database' => 'dbConfig1'
		);
	}

	/**
	 * dbConfig1Public
	 * 
	 * @return array
	 */
	public function dbConfig1Public() {
		return array(
			'database' => 'dbConfig1Public'
		);
	}

	/**
	 * dbConfig1Test
	 * 
	 * @return array
	 */
	public function dbConfig1Test() {
		return array(
			'database' => 'dbConfig1Test'
		);
	}

	/**
	 * {@inheritdoc}
	 * 
	 * @param string $configName
	 * @return string
	 */
	protected function _renameConfig($configName) {
		$postfix = 'Public';
		return preg_replace('/(.*)' . $postfix . '$/', '\1', parent::_renameConfig($configName));
	}

}

//@codingStandardsIgnoreEnd