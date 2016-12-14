<?php
namespace lchphp;
require_once('code/Common.php');
class Lch
{
	public $class 		= 'Index';
	public $controller 	= '\\app\\controllers\\Index';
	public $function 	= 'Index';
	public $modules		= '';
	/**
	 * 加载自动加载
	 */
	protected function autoLoad(){
		define('BASEDIR',__DIR__.'/..');
		include BASEDIR.'/lchphp/code/Loader.php';
		spl_autoload_register('\\lchphp\\code\\Loader::autoload');
	}

	/**
	 * 加载错误处理
	 */
	protected function error(){
		register_shutdown_function('\lchphp\code\Error\Error::fatalError');
		set_error_handler('\lchphp\code\Error\Error::ErrorHandler');
		set_exception_handler('\lchphp\code\Error\Error::appException');
	}
	/**
	 * 加载过滤
	 */
	protected function filtered(){
		//全局变量过滤
		if (!get_magic_quotes_gpc()) {
			!empty($_POST)     	&& $this->Add_S($_POST);
			!empty($_GET)     	&& $this->Add_S($_GET);
			!empty($_COOKIE) 	&& $this->Add_S($_COOKIE);
			!empty($_SESSION) 	&& $this->Add_S($_SESSION);
		}
		!empty($_FILES) && $this->Add_S($_FILES);
	}
	/**
	 * 递归过滤
	 * @param $array
	 */
	private function Add_S(&$array){
		if (is_array($array)) {
			foreach ($array as $key => $value) {
				if (!is_array($value)) {
					$array[$key] = addslashes($value);
				} else {
					$this->Add_S($array[$key]);
				}
			}
		}
	}
	protected function setUrl($config){
		$r = null;
		if($config['url_model']==2) {
			$SUFFIX = $config['url_html_suffix'];
			$temp = explode($SUFFIX,$_SERVER["REQUEST_URI"]);
		}else{
			$temp[0] = !empty($_GET['r'])?'/'.$_GET['r']:'';
		}
		$r = explode('/',$temp[0]);
		if(!empty($r[3])&&in_array($r[1],$config['modules'])){					//模块
			$this->modules  	= $r[1];
			$configTemp = array('activeModules'=>$r[1]);
			setConfigsTemp($configTemp);
			$this->class		= $r[2];
			$this->function		= $r[3];
			$this->controller 	= '\\app\\modules\\' . $this->modules .'\\controllers\\' . $this->class;
			$config = \lchphp\code\Config::getInstance();
			$config->setModulesConfig( $this->modules);
			$offset = 4 ;
		}else{								//主模块
			$this->class		= empty($r[1]) ? 'Index' : $r[1];
			$this->function 	= empty($r[2]) ? 'index' : $r[2];
			$this->controller 	= '\\app\\controllers\\' . $this->class;
			$offset = 3 ;
		}
		$this->setGet($r,$offset);
	}

	/**
	 * pathInfo模式，将路径中的元素写入$_GET中
	 * @param array $array
	 * @param $offset
	 */
	private function setGet($array=array(),$offset){
		$length = count($array);
		if($length>$offset){
			for( $i= $offset;$i<$length; $i+=2){
				$key 	= empty($array[$i])?$i-$offset:$array[$i];
				$value 	= empty($array[$i+1])?'':$array[$i+1];
				$_GET[$key] = $value;
			}
		}
	}

	public function run(){
		$this->autoLoad();
		$this->error();
		$this->filtered();
		$config = getConfig();
		$this->setUrl($config);
		$controller = new $this->controller();
		if(!method_exists($controller,$this->function)&&!method_exists($controller,'__call')){
			trigger_error('The function not found: ' . $this->class . '->' . $this->function . '();<br/>',E_USER_ERROR);
		}else{
			$function = $this->function;
			$controller->$function();
		}
	}

}












