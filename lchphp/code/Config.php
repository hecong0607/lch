<?php
namespace lchphp\code;
class Config
{

	static private $class;
	/**
	 * config原始配置
	 * @var array
	 */
	private $config = array(
		'db' => array(
			'host' 			=> '127.0.0.1',//'127.0.0.1',//数据库连接ip,默认本机
			'port' 			=> 3306,       //端口号,默认3306
			'username'	 	=> 'root',     //用户名,默认root
			'password' 		=> 'root',     //密码,默认空
			'dbname' 		=> 'test',     //数据库名字
			'charset' 		=> 'utf8',     //字符集,默认utf8
			'prefix'		=>'',
			'fields_cache' 	=>false,
		),
		'error_view' 		=> true,		//错误是否显示
		'url_model' 		=> 2,			//url模式
		'url_html_suffix' 	=> '.html',		//url后缀
		'tmpl_template_suffix' => 'php',	//视图层文件后缀
		'modules' 			=> array(),		//存在的模块模块名
		'active_module' 	=> '',			//当前活动的模块名，不可定义
	);

	/**
	 * 初始化config对象
	 */
	private function __construct()
	{
		$this->setConfig();
	}

	/**
	 * 单例获取config对象
	 * @return Config
	 */
	static function getInstance()
	{
		if (empty(self::$class)) {
			self::$class = new self;
			return self::$class;
		} else {
			return self::$class;
		}
	}

	/**
	 * 获取config
	 * @param null $name
	 * @return null
	 */
	function c($name = null)
	{
		$data = empty($this->config[$name]) ? null : $this->config[$name];
		return $data;
	}

	/**
	 * 初始化config
	 */
	private function setConfig()
	{
		$fileConf1 = BASEDIR . '/app/conf/config.php';
		if (file_exists($fileConf1)) {
			$conf1 = require($fileConf1);
			$this->config = array_merge($this->config, $conf1);
		}
	}

	/**
	 * 获取config数组
	 * @return array
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * 临时批量设置config数据
	 */
	public function setConfigsTemp($array)
	{
		if (is_array($array)) {
			$this->config = array_merge($this->config, $array);
		}
	}

	/**
	 * 判断模块的config是否存在，存在就取返回的config的db覆盖本配置
	 */
	public function setModulesConfig($modules)
	{
		if (is_string($modules)) {
			$fileConf1 = BASEDIR . '/app/modules/' . $modules . '/conf/config.php';
			if (file_exists($fileConf1)) {
				$conf1 = require($fileConf1);
				$arr = array(
					'db' => $conf1['db'],
					'active_module' => $modules,
				);
				$arr['db'] = $conf1['db'];
				$this->config = array_merge($this->config, $arr);
			}
		}
	}
}
