<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 06.08.2013
 * Time: 17:34:31
 */
App::uses('DynamicDatabaseConfig', 'DynamicDatabaseConfig.Config');

class DynamicDatabaseConfigTest1 extends DynamicDatabaseConfig {

	public $static_db_config_name = array(
		'database' => 'static_db_config_name',
	);

	public function test_db_name1() {
		return array(
			'database' => 'test_db_name1'
		);
	}

	public function testDBName2() {
		return array(
			'database' => 'test_db_name2',
		);
	}

	public function testChildDBName1() {
		return array('port' => 'port1') + $this->testDBName2();
	}

	public function _notDB1Method1() {
		return false;
	}

	protected function notDB1Method2() {
		return false;
	}

	protected function _notDB1Method3() {
		return false;
	}

	private function _notDB1Method4() {
		return false;
	}

	protected function __notDB1Method5() {
		return false;
	}

	public function __construct() {
		parent::__construct();
	}

}

class DynamicDatabaseConfigTest2 extends DynamicDatabaseConfig {

	const APPLY_NAMING_SCHEMA = true;

	public function dbConfig1() {
		return array(
			'database' => 'dbConfig1'
		);
	}

	public function dbConfig1Public() {
		return array(
			'database' => 'dbConfig1Public'
		);
	}

	public function dbConfig1Test() {
		return array(
			'database' => 'dbConfig1Test'
		);
	}

	protected function _renameConfig($configName) {
		$postfix = 'Public';
		return preg_replace('/(.*)' . $postfix . '$/', '\1', parent::_renameConfig($configName));
	}

}