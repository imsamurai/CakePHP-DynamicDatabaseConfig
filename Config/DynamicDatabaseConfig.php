<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 30.07.2013
 * Time: 19:10:40
 */

/**
 * Base class for database config
 * 
 * @package DynamicDatabaseConfig
 * @subpackage Config
 */
abstract class DynamicDatabaseConfig {

	/**
	 * If true will apply naming schema after initialize
	 */
	const APPLY_NAMING_SCHEMA = false;

	/**
	 * Init config properties
	 */
	public function __construct() {
		$this->_initialize();
		if (static::APPLY_NAMING_SCHEMA) {
			$this->_applyNamingSchema();
		}
	}

	/**
	 * Init config properties from methods
	 */
	protected function _initialize() {
		foreach ($this->_getMakersNames() as $configMakerName) {
			$this->{$configMakerName} = $this->{$configMakerName}();
		}
	}

	/**
	 * Rename configs. Can be used for change default configs
	 * to public/test configs dependings on method _renameConfig
	 */
	protected function _applyNamingSchema() {
		foreach ($this->_getConfigsNames() as $configName) {
			$configNameNew = $this->_renameConfig($configName);
			if ($configNameNew != $configName) {
				$this->$configNameNew = $this->$configName;
			}
		}
	}

	/**
	 * Try to rename config accordingly to your rules.
	 * Called when static::APPLY_NAMING_SCHEMA == true.
	 * If returned value not equals to $configName config property with
	 * returned name will be erased with config from $configName
	 *
	 * @param string $configName
	 * @return string
	 */
	protected function _renameConfig($configName) {
		return $configName;
	}

	/**
	 * Return list of config makers - public methods with configs
	 *
	 * @return array Makers names
	 */
	protected function _getMakersNames() {
		$makers = array();
		$ReflectionClass = new ReflectionClass($this);
		foreach ($ReflectionClass->getMethods(ReflectionMethod::IS_PUBLIC) as $ReflectionMethod) {
			$configMakerName = $ReflectionMethod->getName();
			if (strpos($configMakerName, '_') === 0) {
				continue;
			}

			$makers[] = $configMakerName;
		}

		return $makers;
	}

	/**
	 * Returns list of all config names
	 *
	 * @return array
	 */
	protected function _getConfigsNames() {
		return array_keys(get_object_vars($this));
	}

}