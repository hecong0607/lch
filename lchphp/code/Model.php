<?php
namespace lchphp\code;
class Model
{
	//配置
	public $dbName 		= '';		//表名
	static public $db		;		//数据库连接资源
	private $dbConfig	= array();
	const DB = 'db';

	//初始化配置
	public function __construct()
	{
		$db = Register::get(self::DB);
		if(empty($db)){
			$dbConfig = C('db');
			$config = array(
				'host'      => $dbConfig['host'],       //'127.0.0.1',//数据库连接ip,默认本机
				'port'      => $dbConfig['port'],       //端口号,默认3306
				'username'  => $dbConfig['username'],   //用户名,默认root
				'password'  => $dbConfig['password'],   //密码,默认空
				'dbname'    => $dbConfig['dbname'],     //数据库名字
				'charset'   => $dbConfig['charset']     //字符集,默认utf8
			);
			self::$db = $this->init($config);
			Register::set(self::DB,self::$db);
			return self::$db;
		}
		return $db;
	}

	/**
	 * 重新设置db变量
	 */
	public function reSetDb()
	{
		$dbConfig = C('db');
		$config = array(
			'host'      => $dbConfig['host'],       //'127.0.0.1',//数据库连接ip,默认本机
			'port'      => $dbConfig['port'],       //端口号,默认3306
			'username'  => $dbConfig['username'],   //用户名,默认root
			'password'  => $dbConfig['password'],   //密码,默认空
			'dbname'    => $dbConfig['dbname'],     //数据库名字
			'charset'   => $dbConfig['charset']     //字符集,默认utf8
		);
		self::$db = $this->init($config);
		Register::set(self::DB,self::$db);
		return self::$db;
	}

	/**
	 * 使用pdo连接
	 * @param $config
	 * @return \PDO
	 */
	private function init($config)
	{
		$this->dbConfig = array(
			'host' => '127.0.0.1',
			'port' => 3306,
			'username' => 'root',
			'password' => '',
			'dbname' => 'test',
			'charset' => 'utf8'
		);
		$this->dbConfig = array_merge($this->dbConfig, $config);
		$dsn = 'mysql:host='.$this->dbConfig['host'].';port='.$this->dbConfig['port'].';dbname='.$this->dbConfig['dbname'];
		$pdo = new \PDO($dsn, $this->dbConfig['username'], $this->dbConfig['password'], array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$this->dbConfig['charset']));
		$pdo->exec('set names '.$this->dbConfig['charset']);
		return $pdo;
	}

	static public function setDbByConfig($db = ''){
		$dbConfig = C($db);
		if(!empty($dbConfig)) {
			$config = array(
				'host' => $dbConfig['host'],       //'127.0.0.1',//数据库连接ip,默认本机
				'port' => $dbConfig['port'],       //端口号,默认3306
				'username' => $dbConfig['username'],   //用户名,默认root
				'password' => $dbConfig['password'],   //密码,默认空
				'dbname' => $dbConfig['dbname'],     //数据库名字
				'charset' => $dbConfig['charset']     //字符集,默认utf8
			);
			$model = new Model();
			self::$db = $model->init($config);
			Register::set(self::DB, self::$db);
		}
	}




}