<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 06.08.2013
 * Time: 17:32:49
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */

/**
 * Include databases
 */
require_once dirname(__FILE__) . DS . 'databases.php';


/**
 * DynamicDatabaseConfigTest
 * 
 * @package DynamicDatabaseConfigTest
 * @subpackage Config
 */
class DynamicDatabaseConfigTest extends CakeTestCase {

	/**
	 * Test construct
	 */
	public function testConstruct() {
		$DB = new DynamicDatabaseConfigTest1();
		$dbProperties = (array)$DB;
		$this->assertCount(4, $dbProperties);
		$this->assertSame($DB->testChildDBName1(), $DB->testChildDBName1);
		$this->assertSame($DB->testDBName2(), $DB->testDBName2);
		$this->assertSame($DB->test_db_name1(), $DB->test_db_name1);
		$this->assertSame($DB->static_db_config_name, array(
			'database' => 'static_db_config_name',
		));
	}

	/**
	 * Test applying naming schema
	 */
	public function testApplyNamingSchema() {
		$DB = new DynamicDatabaseConfigTest2();
		$dbProperties = (array)$DB;
		$this->assertCount(3, $dbProperties);
		$this->assertNotSame($DB->dbConfig1(), $DB->dbConfig1);
		$this->assertSame($DB->dbConfig1Public(), $DB->dbConfig1Public);
		$this->assertSame($DB->dbConfig1Public(), $DB->dbConfig1);
		$this->assertSame($DB->dbConfig1Test(), $DB->dbConfig1Test);
	}

}
