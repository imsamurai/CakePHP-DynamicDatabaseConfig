<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 30.10.2013
 * Time: 11:00:00
 */

/**
 * AllDynamicDatabaseConfigTest suite
 * 
 * @package DynamicDatabaseConfigTest
 * @subpackage Test
 */
class AllDynamicDatabaseConfigTest extends PHPUnit_Framework_TestSuite {

	/**
	 * Suite define the tests for this suite
	 *
	 * @return void
	 */
	public static function suite() {
		$suite = new CakeTestSuite('All DynamicDatabase Config Tests');

		$path = App::pluginPath('DynamicDatabaseConfig') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);
		return $suite;
	}

}
