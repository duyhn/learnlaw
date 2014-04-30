<?php
/**
 * Datasource connection manager
 *
 * Provides an interface for loading and enumerating connections defined in app/Config/database.php
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Model
 * @since         CakePHP(tm) v 0.10.x.1402
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('DataSource', 'Model/Datasource');

/**
 * Manages loaded instances of DataSource objects
 *
 * Provides an interface for loading and enumerating connections defined in
 * app/Config/database.php
 *
 * @package       Cake.Model
*/
class ConnectionManager {

	/**
	 :  * Holds a loaded instance of the Connections object
	 35:  *
	 36:  * @var DATABASE_CONFIG
	 37:  */
	public static $config = null;

	/**
	 41:  * Holds instances DataSource objects
	 42:  *
	 43:  * @var array
	 44:  */
	protected static $_dataSources = array();

	/**
	 48:  * Contains a list of all file and class names used in Connection settings
	 49:  *
	 50:  * @var array
	51:  */
	protected static $_connectionsEnum = array();

	/**
	 55:  * Indicates if the init code for this class has already been executed
	 56:  *
	 57:  * @var boolean
	58:  */
	protected static $_init = false;

	/**
	 62:  * Loads connections configuration.
	 63:  *
	 64:  * @return void
	 65  */
	protected static function _init() {
		include_once APP . 'Config' . DS . 'database.php';
		if (class_exists('DATABASE_CONFIG')) {
			self::$config = new DATABASE_CONFIG();
		}
		self::$_init = true;
	}
		
	/**
	 75:  * Gets a reference to a DataSource object
	 76:  *
	 77:  * @param string $name The name of the DataSource, as defined in app/Config/database.php
	 78:  * @return DataSource Instance
	 79:  * @throws MissingDatasourceException
	 80:  */
	public static function getDataSource($name) {
		if (empty(self::$_init)) {
			self::_init();
		}
		if (!empty(self::$_dataSources[$name])) {
			return self::$_dataSources[$name];
		}

		if (empty(self::$_connectionsEnum[$name])) {
			self::_getConnectionObject($name);
		}
			
		self::loadDataSource($name);
		$conn = self::$_connectionsEnum[$name];
		$class = $conn['classname'];
			
		if (strpos(App::location($class), 'Datasource') === false) {
			throw new MissingDatasourceException(array(
					'class' => $class,
					'plugin' => null,
					'message' => 'Datasource is not found in Model/Datasource package.'
			));
		}
		self::$_dataSources[$name] = new $class(self::$config->{$name});
		self::$_dataSources[$name]->configKeyName = $name;

		return self::$_dataSources[$name];
	}

	/**
	 112:  * Gets the list of available DataSource connections
	 113:  * This will only return the datasources instantiated by this manager
	 114:  * It differs from enumConnectionObjects, since the latter will return all configured connections
	 115:  *
	 116:  * @return array List of available connections
	 117:  */
	public static function sourceList() {
		if (empty(self::$_init)) {
			self::_init();
		}
		return array_keys(self::$_dataSources);
	}

	/**
	 126:  * Gets a DataSource name from an object reference.
	 127:  *
	 128:  * @param DataSource $source DataSource object
	 129:  * @return string Datasource name, or null if source is not present
	 130:  *    in the ConnectionManager.
	 131:  */
	public static function getSourceName($source) {
		if (empty(self::$_init)) {
			self::_init();
		}
		foreach (self::$_dataSources as $name => $ds) {
			if ($ds === $source) {
				return $name;
			}
		}
		return null;
	}
		
	/**
	 145:  * Loads the DataSource class for the given connection name
	 146:  *
	 147:  * @param string|array $connName A string name of the connection, as defined in app/Config/database.php,
	 148:  *                        or an array containing the filename (without extension) and class name of the object,
	 149:  *                        to be found in app/Model/Datasource/ or lib/Cake/Model/Datasource/.
	 150:  * @return boolean True on success, null on failure or false if the class is already loaded
	 151:  * @throws MissingDatasourceException
	 152:  */
	public static function loadDataSource($connName) {
		if (empty(self::$_init)) {
			self::_init();
		}

		if (is_array($connName)) {
			$conn = $connName;
		} else {
			$conn = self::$_connectionsEnum[$connName];
		}

		if (class_exists($conn['classname'], false)) {
			return false;
		}
			
		$plugin = $package = null;
		if (!empty($conn['plugin'])) {
			$plugin = $conn['plugin'] . '.';
		}
		if (!empty($conn['package'])) {
			$package = '/' . $conn['package'];
		}
			
		App::uses($conn['classname'], $plugin . 'Model/Datasource' . $package);
		if (!class_exists($conn['classname'])) {
			throw new MissingDatasourceException(array(
					'class' => $conn['classname'],
					'plugin' => substr($plugin, 0, -1)
			));
		}
		return true;
	}

	/**
	 187:  * Return a list of connections
	 188:  *
	 189:  * @return array An associative array of elements where the key is the connection name
	 190:  *               (as defined in Connections), and the value is an array with keys 'filename' and 'classname'.
	 191:  */
	public static function enumConnectionObjects() {
		if (empty(self::$_init)) {
			self::_init();
		}
		return (array)self::$config;
	}

	/**
	 200:  * Dynamically creates a DataSource object at runtime, with the given name and settings
	 201:  *
	 202:  * @param string $name The DataSource name
	 203:  * @param array $config The DataSource configuration settings
	 204:  * @return DataSource A reference to the DataSource object, or null if creation failed
	 205:  */
	public static function create($name = '', $config = array()) {
		if (empty(self::$_init)) {
			self::_init();
		}

		if (empty($name) || empty($config) || array_key_exists($name, self::$_connectionsEnum)) {
			return null;
		}
		self::$config->{$name} = $config;
		self::$_connectionsEnum[$name] = self::_connectionData($config);
		$return = self::getDataSource($name);
		return $return;
	}
		
	/**
	 221:  * Removes a connection configuration at runtime given its name
	 222:  *
	 223:  * @param string $name the connection name as it was created
	 224:  * @return boolean success if connection was removed, false if it does not exist
	 225:  */
	public static function drop($name) {
		if (empty(self::$_init)) {
			self::_init();
		}
			
		if (!isset(self::$config->{$name})) {
			return false;
		}
		unset(self::$_connectionsEnum[$name], self::$_dataSources[$name], self::$config->{$name});
		return true;
	}

	/**
	 239:  * Gets a list of class and file names associated with the user-defined DataSource connections
	 240:  *
	 241:  * @param string $name Connection name
	 242:  * @return void
	 243:  * @throws MissingDatasourceConfigException
	 244:  */
	protected static function _getConnectionObject($name) {
		if (!empty(self::$config->{$name})) {
			self::$_connectionsEnum[$name] = self::_connectionData(self::$config->{$name});
		} else {
			throw new MissingDatasourceConfigException(array('config' => $name));
		}
	}
		
	/**
	 254:  * Returns the file, class name, and parent for the given driver.
	 255:  *
	 256:  * @param array $config Array with connection configuration. Key 'datasource' is required
	 257:  * @return array An indexed array with: filename, classname, plugin and parent
	 258:  */
	protected static function _connectionData($config) {
		$package = $classname = $plugin = null;

		list($plugin, $classname) = pluginSplit($config['datasource']);
		if (strpos($classname, '/') !== false) {
			$package = dirname($classname);
			$classname = basename($classname);
		}
		return compact('package', 'classname', 'plugin');
	}
		
}
?>