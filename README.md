DynamicDatabaseConfig Plugin
============================

CakePHP DynamicDatabaseConfig Plugin for more flexible handle datasource configs

## Installation

### Step 1: Clone or download to `Plugin/DynamicDatabaseConfig`

  cd my_cake_app/app git://github.com/imsamurai/CakePHP-DynamicDatabaseConfig.git Plugin/DynamicDatabaseConfig

or if you use git add as submodule:

	cd my_cake_app
	git submodule add "git://github.com/imsamurai/CakePHP-DynamicDatabaseConfig.git" "app/Plugin/DynamicDatabaseConfig"

then update submodules:

	git submodule init
	git submodule update

### Step 2: Extend your DATABASE_CONFIG

```
:: database.php ::

App::uses('DynamicDatabaseConfig', 'DynamicDatabaseConfig.Config');
class DATABASE_CONFIG extends DynamicDatabaseConfig {
	//class items
}
```

Then make configs that you want to be dynamically loaded (when class instance will be created)

```
:: database.php ::

App::uses('DynamicDatabaseConfig', 'DynamicDatabaseConfig.Config');
class DATABASE_CONFIG extends DynamicDatabaseConfig {
	//can't start with _ and must be public
	public defaultPublic() {
		return array(/* config data, like in property-config */);
	}
}

```

### Step 3: Load plugin

```
:: bootstrap.php ::
CakePlugin::load('DynamicDatabaseConfig');

```

#Usage

Once you add public methods in your DATABASE_CONFIG they will be automatically assigned to public property with same name.
Now you can easily make new configs based on part of existing configs. Your old property-based configs will work as usual,
unless you create method with same name.

#Advanced usage

There exist simple dynamic rename of configs.
Assume you want add default config, config for test and public enviroument. In your models used `default` config and you have
information about is this public or test, for ex. constant `IS_PUBLIC_INSTALLATION`. In this case you need to add 3 configs,
allow renaming and make renaming action:

```
:: database.php ::

App::uses('DynamicDatabaseConfig', 'DynamicDatabaseConfig.Config');
class DATABASE_CONFIG extends DynamicDatabaseConfig {

	//allow to rename configs
	const APPLY_NAMING_SCHEMA = true;

	//default config
	public default() {
		return array(/* config data, like in property-config */);
	}

	//public config
	public defaultPublic() {
		return array(/* config data, like in property-config */);
	}

	/local config
	public defaultLocal() {
		return array(/* config data, like in property-config */);
	}

	/* Method that will get each existing config name and try to rename it
	 * if $configName will not equals to returned value then
	 * config with returned value name will be erased with data from $configName
     *
	 * In case of current method if IS_PUBLIC_INSTALLATION is true
	 * `default` config gets data from `defaultPublic` otherwise from `defaultLocal`
	 */
	protected function _renameConfig($configName) {
		$postfix = IS_PUBLIC_INSTALLATION ? 'Public' : 'Local';
		return preg_replace('/(.*)' . $postfix . '$/', '\1', $configName);
	}
}
```

Thats all! If you have questions or any suggestions you welcome at [issues](https://github.com/imsamurai/CakePHP-DynamicDatabaseConfig/issues).