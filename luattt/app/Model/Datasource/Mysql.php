<?php
/**
 3:  * MySQL layer for DBO
 4:  *
 5:  * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 6:  * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 7:  *
 8:  * Licensed under The MIT License
 9:  * For full copyright and license information, please see the LICENSE.txt
 10:  * Redistributions of files must retain the above copyright notice.
 11:  *
 12:  * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 13:  * @link          http://cakephp.org CakePHP(tm) Project
 14:  * @package       Cake.Model.Datasource.Database
 15:  * @since         CakePHP(tm) v 0.10.5.1790
 16:  * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 17:  */

App::uses('DboSource', 'Model/Datasource');

/**
 22:  * MySQL DBO driver object
 23:  *
 24:  * Provides connection and SQL generation for MySQL RDMS
 25:  *
 26:  * @package       Cake.Model.Datasource.Database
27:  */
class Mysql extends DboSource {

	/**
	 31:  * Datasource description
	 32:  *
	 33:  * @var string
	 34:  */
	public $description = "MySQL DBO Driver";

	/**
	 38:  * Base configuration settings for MySQL driver
	 39:  *
	 40:  * @var array
	 41:  */
	protected $_baseConfig = array(
			'persistent' => true,
			'host' => 'localhost',
			'login' => 'root',
			'password' => '',
			'database' => 'luatvn',
			'port' => '3306'
	);

	/**
	 52:  * Reference to the PDO object connection
	 53:  *
	 54:  * @var PDO $_connection
	55:  */
	protected $_connection = null;

	/**
	 59:  * Start quote
	 60:  *
	 61:  * @var string
	 62:  */
	public $startQuote = "`";

	/**
	 66:  * End quote
	 67:  *
	 68:  * @var string
	 69:  */
	public $endQuote = "`";

	/**
	 73:  * use alias for update and delete. Set to true if version >= 4.1
	 74:  *
	 75:  * @var boolean
	 76:  */
	protected $_useAlias = true;

	/**
	 80:  * List of engine specific additional field parameters used on table creating
	 81:  *
	 82:  * @var array
	 83:  */
	public $fieldParameters = array(
			'charset' => array('value' => 'CHARACTER SET', 'quote' => false, 'join' => ' ', 'column' => false, 'position' => 'beforeDefault'),
			'collate' => array('value' => 'COLLATE', 'quote' => false, 'join' => ' ', 'column' => 'Collation', 'position' => 'beforeDefault'),
			'comment' => array('value' => 'COMMENT', 'quote' => true, 'join' => ' ', 'column' => 'Comment', 'position' => 'afterDefault')
	);

	/**
	 91:  * List of table engine specific parameters used on table creating
	 92:  *
	 93:  * @var array
	94:  */
	public $tableParameters = array(
			'charset' => array('value' => 'DEFAULT CHARSET', 'quote' => false, 'join' => '=', 'column' => 'charset'),
			'collate' => array('value' => 'COLLATE', 'quote' => false, 'join' => '=', 'column' => 'Collation'),
			'engine' => array('value' => 'ENGINE', 'quote' => false, 'join' => '=', 'column' => 'Engine')
	);

	/**
	 102:  * MySQL column definition
	 103:  *
	 104:  * @var array
	105:  */
	public $columns = array(
			'primary_key' => array('name' => 'NOT NULL AUTO_INCREMENT'),
			'string' => array('name' => 'varchar', 'limit' => '255'),
			'text' => array('name' => 'text'),
			'biginteger' => array('name' => 'bigint', 'limit' => '20'),
			'integer' => array('name' => 'int', 'limit' => '11', 'formatter' => 'intval'),
			'float' => array('name' => 'float', 'formatter' => 'floatval'),
			'datetime' => array('name' => 'datetime', 'format' => 'Y-m-d H:i:s', 'formatter' => 'date'),
			'timestamp' => array('name' => 'timestamp', 'format' => 'Y-m-d H:i:s', 'formatter' => 'date'),
			'time' => array('name' => 'time', 'format' => 'H:i:s', 'formatter' => 'date'),
			'date' => array('name' => 'date', 'format' => 'Y-m-d', 'formatter' => 'date'),
			'binary' => array('name' => 'blob'),
			'boolean' => array('name' => 'tinyint', 'limit' => '1')
	);

	/**
	 122:  * Mapping of collation names to character set names
	 123:  *
	 124:  * @var array
	125:  */
	protected $_charsets = array();

	/**
	 129:  * Connects to the database using options in the given configuration array.
	 130:  *
	 131:  * MySQL supports a few additional options that other drivers do not:
	 132:  *
	 133:  * - `unix_socket` Set to the path of the MySQL sock file. Can be used in place
	 134:  *   of host + port.
	 135:  * - `ssl_key` SSL key file for connecting via SSL. Must be combined with `ssl_cert`.
	 136:  * - `ssl_cert` The SSL certificate to use when connecting via SSL. Must be
	 137:  *   combined with `ssl_key`.
	 138:  * - `ssl_ca` The certificate authority for SSL connections.
	 139:  *
	 140:  * @return boolean True if the database could be connected, else false
	 141:  * @throws MissingConnectionException
	142:  */
	public function connect() {
		$config = $this->config;
		$this->connected = false;

		$flags = array(
				PDO::ATTR_PERSISTENT => $config['persistent'],
				PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		if (!empty($config['encoding'])) {
			$flags[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES ' . $config['encoding'];
		}
		if (!empty($config['ssl_key']) && !empty($config['ssl_cert'])) {
			$flags[PDO::MYSQL_ATTR_SSL_KEY] = $config['ssl_key'];
			$flags[PDO::MYSQL_ATTR_SSL_CERT] = $config['ssl_cert'];
		}
		if (!empty($config['ssl_ca'])) {
			$flags[PDO::MYSQL_ATTR_SSL_CA] = $config['ssl_ca'];
		}
		if (empty($config['unix_socket'])) {
			$dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']}";
		} else {
			$dsn = "mysql:unix_socket={$config['unix_socket']};dbname={$config['database']}";
		}
			
		try {
			$this->_connection = new PDO(
					$dsn,
					$config['login'],
					$config['password'],
					$flags
			);
			$this->connected = true;
			if (!empty($config['settings'])) {
				foreach ($config['settings'] as $key => $value) {
					$this->_execute("SET $key=$value");
				}
			}
		} catch (PDOException $e) {
			throw new MissingConnectionException(array(
					'class' => get_class($this),
					'message' => $e->getMessage()
			));
		}
			
		$this->_charsets = array();
		$this->_useAlias = (bool)version_compare($this->getVersion(), "4.1", ">=");
			
		return $this->connected;
	}
		
	/**
	 196:  * Check whether the MySQL extension is installed/loaded
	 197:  *
	 198:  * @return boolean
	 199:  */
	public function enabled() {
		return in_array('mysql', PDO::getAvailableDrivers());
	}

	/**
	 205:  * Returns an array of sources (tables) in the database.
	 206:  *
	 207:  * @param mixed $data
	 208:  * @return array Array of table names in the database
	 209:  */
	public function listSources($data = null) {
		$cache = parent::listSources();
		if ($cache) {
			return $cache;
		}
		$result = $this->_execute('SHOW TABLES FROM ' . $this->name($this->config['database']));

		if (!$result) {
			$result->closeCursor();
			return array();
		}
		$tables = array();
			
		while ($line = $result->fetch(PDO::FETCH_NUM)) {
			$tables[] = $line[0];
		}

		$result->closeCursor();
		parent::listSources($tables);
		return $tables;
	}

	/**
	 233:  * Builds a map of the columns contained in a result
	 234:  *
	 235:  * @param PDOStatement $results
	 236:  * @return void
	 237:  */
	public function resultSet($results) {
		$this->map = array();
		$numFields = $results->columnCount();
		$index = 0;
			
		while ($numFields-- > 0) {
			$column = $results->getColumnMeta($index);
			if ($column['len'] === 1 && (empty($column['native_type']) || $column['native_type'] === 'TINY')) {
				$type = 'boolean';
			} else {
				$type = empty($column['native_type']) ? 'string' : $column['native_type'];
			}
			if (!empty($column['table']) && strpos($column['name'], $this->virtualFieldSeparator) === false) {
				$this->map[$index++] = array($column['table'], $column['name'], $type);
			} else {
				$this->map[$index++] = array(0, $column['name'], $type);
			}
		}
	}

	/**
	 259:  * Fetches the next row from the current result set
	 260:  *
	 261:  * @return mixed array with results fetched and mapped to column names or false if there is no results left to fetch
	 262:  */
	public function fetchResult() {
		if ($row = $this->_result->fetch(PDO::FETCH_NUM)) {
			$resultRow = array();
			foreach ($this->map as $col => $meta) {
				list($table, $column, $type) = $meta;
				$resultRow[$table][$column] = $row[$col];
				if ($type === 'boolean' && $row[$col] !== null) {
					$resultRow[$table][$column] = $this->boolean($resultRow[$table][$column]);
				}
			}
			return $resultRow;
		}
		$this->_result->closeCursor();
		return false;
	}

	/**
	 280:  * Gets the database encoding
	 281:  *
	 282:  * @return string The database encoding
	 283:  */
	public function getEncoding() {
		return $this->_execute('SHOW VARIABLES LIKE ?', array('character_set_client'))->fetchObject()->Value;
	}
		
	/**
	 289:  * Query charset by collation
	 290:  *
	 291:  * @param string $name Collation name
	 292:  * @return string Character set name
	 293:  */
	public function getCharsetName($name) {
		if ((bool)version_compare($this->getVersion(), "5", "<")) {
			return false;
		}
		if (isset($this->_charsets[$name])) {
			return $this->_charsets[$name];
		}
		$r = $this->_execute(
				'SELECT CHARACTER_SET_NAME FROM INFORMATION_SCHEMA.COLLATIONS WHERE COLLATION_NAME = ?',
				array($name)
		);
		$cols = $r->fetch(PDO::FETCH_ASSOC);

		if (isset($cols['CHARACTER_SET_NAME'])) {
			$this->_charsets[$name] = $cols['CHARACTER_SET_NAME'];
		} else {
			$this->_charsets[$name] = false;
		}
		return $this->_charsets[$name];
	}

	/**
	 316:  * Returns an array of the fields in given table name.
	 317:  *
	 318:  * @param Model|string $model Name of database table to inspect or model instance
	 319:  * @return array Fields in table. Keys are name and type
	 320:  * @throws CakeException
	 321:  */
	public function describe($model) {
		$key = $this->fullTableName($model, false);
		$cache = parent::describe($key);
		if ($cache) {
			return $cache;
		}
		$table = $this->fullTableName($model);

		$fields = false;
		$cols = $this->_execute('SHOW FULL COLUMNS FROM ' . $table);
		if (!$cols) {
			throw new CakeException(__d('cake_dev', 'Could not describe table for %s', $table));
		}
			
		while ($column = $cols->fetch(PDO::FETCH_OBJ)) {
			$fields[$column->Field] = array(
					'type' => $this->column($column->Type),
					'null' => ($column->Null === 'YES' ? true : false),
					'default' => $column->Default,
					'length' => $this->length($column->Type),
			);
			if (!empty($column->Key) && isset($this->index[$column->Key])) {
				$fields[$column->Field]['key'] = $this->index[$column->Key];
			}
			foreach ($this->fieldParameters as $name => $value) {
				if (!empty($column->{$value['column']})) {
					$fields[$column->Field][$name] = $column->{$value['column']};
				}
			}
			if (isset($fields[$column->Field]['collate'])) {
				$charset = $this->getCharsetName($fields[$column->Field]['collate']);
				if ($charset) {
					$fields[$column->Field]['charset'] = $charset;
				}
			}
		}
		$this->_cacheDescription($key, $fields);
		$cols->closeCursor();
		return $fields;
	}
		
	/**
	 364:  * Generates and executes an SQL UPDATE statement for given model, fields, and values.
	 365:  *
	 366:  * @param Model $model
	 367:  * @param array $fields
	 368:  * @param array $values
	 369:  * @param mixed $conditions
	 370:  * @return array
	 371:  */
	public function update(Model $model, $fields = array(), $values = null, $conditions = null) {
		if (!$this->_useAlias) {
			return parent::update($model, $fields, $values, $conditions);
		}
			
		if (!$values) {
			$combined = $fields;
		} else {
			$combined = array_combine($fields, $values);
		}
			
		$alias = $joins = false;
		$fields = $this->_prepareUpdateFields($model, $combined, empty($conditions), !empty($conditions));
		$fields = implode(', ', $fields);
		$table = $this->fullTableName($model);
		if (!empty($conditions)) {
			$alias = $this->name($model->alias);
			if ($model->name == $model->alias) {
				$joins = implode(' ', $this->_getJoins($model));
			}
		}
		$conditions = $this->conditions($this->defaultConditions($model, $conditions, $alias), true, true, $model);
			
		if ($conditions === false) {
			return false;
		}

		if (!$this->execute($this->renderStatement('update', compact('table', 'alias', 'joins', 'fields', 'conditions')))) {
			$model->onError();
			return false;
		}
		return true;
	}
		
	/**
	 408:  * Generates and executes an SQL DELETE statement for given id/conditions on given model.
	 409:  *
	 410:  * @param Model $model
	 411:  * @param mixed $conditions
	 412:  * @return boolean Success
	 413:  */
	public function delete(Model $model, $conditions = null) {
		if (!$this->_useAlias) {
			return parent::delete($model, $conditions);
		}
		$alias = $this->name($model->alias);
		$table = $this->fullTableName($model);
		$joins = implode(' ', $this->_getJoins($model));
			
		if (empty($conditions)) {
			$alias = $joins = false;
		}
		$complexConditions = false;
		foreach ((array)$conditions as $key => $value) {
			if (strpos($key, $model->alias) === false) {
				$complexConditions = true;
				break;
			}
		}
		if (!$complexConditions) {
			$joins = false;
		}
			
		$conditions = $this->conditions($this->defaultConditions($model, $conditions, $alias), true, true, $model);
		if ($conditions === false) {
			return false;
		}
		if ($this->execute($this->renderStatement('delete', compact('alias', 'table', 'joins', 'conditions'))) === false) {
			$model->onError();
			return false;
		}
		return true;
	}
		
	/**
	 448:  * Sets the database encoding
	 449:  *
	 450:  * @param string $enc Database encoding
	 451:  * @return boolean
	 452:  */
	public function setEncoding($enc) {
		return $this->_execute('SET NAMES ' . $enc) !== false;
	}

	/**
	 458:  * Returns an array of the indexes in given datasource name.
	 459:  *
	 460:  * @param string $model Name of model to inspect
	 461:  * @return array Fields in table. Keys are column and unique
	 462:  */
	public function index($model) {
		$index = array();
		$table = $this->fullTableName($model);
		$old = version_compare($this->getVersion(), '4.1', '<=');
		if ($table) {
			$indexes = $this->_execute('SHOW INDEX FROM ' . $table);
			// @codingStandardsIgnoreStart
			// MySQL columns don't match the cakephp conventions.
			while ($idx = $indexes->fetch(PDO::FETCH_OBJ)) {
				if ($old) {
					$idx = (object)current((array)$idx);
				}
				if (!isset($index[$idx->Key_name]['column'])) {
					$col = array();
					$index[$idx->Key_name]['column'] = $idx->Column_name;
						
					if ($idx->Index_type === 'FULLTEXT') {
						$index[$idx->Key_name]['type'] = strtolower($idx->Index_type);
					} else {
						$index[$idx->Key_name]['unique'] = intval($idx->Non_unique == 0);
					}
				} else {
					if (!empty($index[$idx->Key_name]['column']) && !is_array($index[$idx->Key_name]['column'])) {
						$col[] = $index[$idx->Key_name]['column'];
					}
					$col[] = $idx->Column_name;
					$index[$idx->Key_name]['column'] = $col;
				}
				if (!empty($idx->Sub_part)) {
					if (!isset($index[$idx->Key_name]['length'])) {
						$index[$idx->Key_name]['length'] = array();
					}
					$index[$idx->Key_name]['length'][$idx->Column_name] = $idx->Sub_part;
				}
			}
			// @codingStandardsIgnoreEnd
			$indexes->closeCursor();
		}
		return $index;
	}
		
	/**
	 505:  * Generate a MySQL Alter Table syntax for the given Schema comparison
	 506:  *
	 507:  * @param array $compare Result of a CakeSchema::compare()
	 508:  * @param string $table
	 509:  * @return array Array of alter statements to make.
	 510:  */
	public function alterSchema($compare, $table = null) {
		if (!is_array($compare)) {
			return false;
		}
		$out = '';
		$colList = array();
		foreach ($compare as $curTable => $types) {
			$indexes = $tableParameters = $colList = array();
			if (!$table || $table == $curTable) {
				$out .= 'ALTER TABLE ' . $this->fullTableName($curTable) . " \n";
				foreach ($types as $type => $column) {
					if (isset($column['indexes'])) {
						$indexes[$type] = $column['indexes'];
						unset($column['indexes']);
					}
					if (isset($column['tableParameters'])) {
						$tableParameters[$type] = $column['tableParameters'];
						unset($column['tableParameters']);
					}
					switch ($type) {
						case 'add':
							foreach ($column as $field => $col) {
								$col['name'] = $field;
								$alter = 'ADD ' . $this->buildColumn($col);
								if (isset($col['after'])) {
									$alter .= ' AFTER ' . $this->name($col['after']);
								}
								$colList[] = $alter;
							}
							break;
						case 'drop':
							foreach ($column as $field => $col) {
								$col['name'] = $field;
								$colList[] = 'DROP ' . $this->name($field);
							}
							break;
						case 'change':
							foreach ($column as $field => $col) {
								if (!isset($col['name'])) {
									$col['name'] = $field;
								}
								$colList[] = 'CHANGE ' . $this->name($field) . ' ' . $this->buildColumn($col);
							}
							break;
					}
				}
				$colList = array_merge($colList, $this->_alterIndexes($curTable, $indexes));
				$colList = array_merge($colList, $this->_alterTableParameters($curTable, $tableParameters));
				$out .= "\t" . implode(",\n\t", $colList) . ";\n\n";
			}
		}
		return $out;
	}

	/**
	 566:  * Generate a "drop table" statement for the given table
	 567:  *
	 568:  * @param type $table Name of the table to drop
	 569:  * @return string Drop table SQL statement
	 570:  */
	protected function _dropTable($table) {
		return 'DROP TABLE IF EXISTS ' . $this->fullTableName($table) . ";";
	}
		
	/**
	 576:  * Generate MySQL table parameter alteration statements for a table.
	 577:  *
	 578:  * @param string $table Table to alter parameters for.
	 579:  * @param array $parameters Parameters to add & drop.
	 580:  * @return array Array of table property alteration statements.
	 581:  */
	protected function _alterTableParameters($table, $parameters) {
		if (isset($parameters['change'])) {
			return $this->buildTableParameters($parameters['change']);
		}
		return array();
	}
		
	/**
	 590:  * Format indexes for create table
	 591:  *
	 592:  * @param array $indexes An array of indexes to generate SQL from
	 593:  * @param string $table Optional table name, not used
	 594:  * @return array An array of SQL statements for indexes
	 595:  * @see DboSource::buildIndex()
	 596:  */
	public function buildIndex($indexes, $table = null) {
		$join = array();
		foreach ($indexes as $name => $value) {
			$out = '';
			if ($name === 'PRIMARY') {
				$out .= 'PRIMARY ';
				$name = null;
			} else {
				if (!empty($value['unique'])) {
					$out .= 'UNIQUE ';
				}
				$name = $this->startQuote . $name . $this->endQuote;
			}
			if (isset($value['type']) && strtolower($value['type']) === 'fulltext') {
				$out .= 'FULLTEXT ';
			}
			$out .= 'KEY ' . $name . ' (';
				
			if (is_array($value['column'])) {
				if (isset($value['length'])) {
					$vals = array();
					foreach ($value['column'] as $column) {
						$name = $this->name($column);
						if (isset($value['length'])) {
							$name .= $this->_buildIndexSubPart($value['length'], $column);
						}
						$vals[] = $name;
					}
					$out .= implode(', ', $vals);
				} else {
					$out .= implode(', ', array_map(array(&$this, 'name'), $value['column']));
				}
			} else {
				$out .= $this->name($value['column']);
				if (isset($value['length'])) {
					$out .= $this->_buildIndexSubPart($value['length'], $value['column']);
				}
			}
			$out .= ')';
			$join[] = $out;
		}
		return $join;
	}

	/**
	 642:  * Generate MySQL index alteration statements for a table.
	 643:  *
	 644:  * @param string $table Table to alter indexes for
	 645:  * @param array $indexes Indexes to add and drop
	 646:  * @return array Index alteration statements
	 647:  */
	protected function _alterIndexes($table, $indexes) {
		$alter = array();
		if (isset($indexes['drop'])) {
			foreach ($indexes['drop'] as $name => $value) {
				$out = 'DROP ';
				if ($name === 'PRIMARY') {
					$out .= 'PRIMARY KEY';
				} else {
					$out .= 'KEY ' . $this->startQuote . $name . $this->endQuote;
				}
				$alter[] = $out;
			}
		}
		if (isset($indexes['add'])) {
			$add = $this->buildIndex($indexes['add']);
			foreach ($add as $index) {
				$alter[] = 'ADD ' . $index;
			}
		}
		return $alter;
	}
		
	/**
	 671:  * Format length for text indexes
	 672:  *
	 673:  * @param array $lengths An array of lengths for a single index
	 674:  * @param string $column The column for which to generate the index length
	 675:  * @return string Formatted length part of an index field
	 676:  */
	protected function _buildIndexSubPart($lengths, $column) {
		if ($lengths === null) {
			return '';
		}
		if (!isset($lengths[$column])) {
			return '';
		}
		return '(' . $lengths[$column] . ')';
	}

	/**
	 688:  * Returns an detailed array of sources (tables) in the database.
	 689:  *
	 690:  * @param string $name Table name to get parameters
	 691:  * @return array Array of table names in the database
	 692:  */
	public function listDetailedSources($name = null) {
		$condition = '';
		if (is_string($name)) {
			$condition = ' WHERE name = ' . $this->value($name);
		}
		$result = $this->_connection->query('SHOW TABLE STATUS ' . $condition, PDO::FETCH_ASSOC);

		if (!$result) {
			$result->closeCursor();
			return array();
		}
		$tables = array();
		foreach ($result as $row) {
			$tables[$row['Name']] = (array)$row;
			unset($tables[$row['Name']]['queryString']);
			if (!empty($row['Collation'])) {
				$charset = $this->getCharsetName($row['Collation']);
				if ($charset) {
					$tables[$row['Name']]['charset'] = $charset;
				}
			}
		}
		$result->closeCursor();
		if (is_string($name) && isset($tables[$name])) {
			return $tables[$name];
		}
		return $tables;
	}
		
	/**
	 723:  * Converts database-layer column types to basic types
	 724:  *
	 725:  * @param string $real Real database-layer column type (i.e. "varchar(255)")
	 726:  * @return string Abstract column type (i.e. "string")
	 727:  */
	public function column($real) {
		if (is_array($real)) {
			$col = $real['name'];
			if (isset($real['limit'])) {
				$col .= '(' . $real['limit'] . ')';
			}
			return $col;
		}

		$col = str_replace(')', '', $real);
		$limit = $this->length($real);
		if (strpos($col, '(') !== false) {
			list($col, $vals) = explode('(', $col);
		}
			
		if (in_array($col, array('date', 'time', 'datetime', 'timestamp'))) {
			return $col;
		}
		if (($col === 'tinyint' && $limit === 1) || $col === 'boolean') {
			return 'boolean';
		}
		if (strpos($col, 'bigint') !== false || $col === 'bigint') {
			return 'biginteger';
		}
		if (strpos($col, 'int') !== false) {
			return 'integer';
		}
		if (strpos($col, 'char') !== false || $col === 'tinytext') {
			return 'string';
		}
		if (strpos($col, 'text') !== false) {
			return 'text';
		}
		if (strpos($col, 'blob') !== false || $col === 'binary') {
			return 'binary';
		}
		if (strpos($col, 'float') !== false || strpos($col, 'double') !== false || strpos($col, 'decimal') !== false) {
			return 'float';
		}
		if (strpos($col, 'enum') !== false) {
			return "enum($vals)";
		}
		return 'text';
	}

	/**
	 774:  * Gets the schema name
	 775:  *
	 776:  * @return string The schema name
	 777:  */
	public function getSchemaName() {
		return $this->config['database'];
	}
		
	/**
	 783:  * Check if the server support nested transactions
	 784:  *
	 785:  * @return boolean
	 786:  */
	public function nestedTransactionSupported() {
		return $this->useNestedTransactions && version_compare($this->getVersion(), '4.1', '>=');
	}

}
?>