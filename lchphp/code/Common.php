<?php
/**
 * 获取配置
 * @param $name
 * @return null
 */
function C($name){
	if(!empty($name)) {
		$config = \lchphp\code\Config::getInstance();
		$data = $config->c($name);
	}else{
		$data = null;
	}
	return $data;
}

/**
 * 获取全部配置
 * @return array
 */
function getConfig(){
	$config = \lchphp\code\Config::getInstance();
	$data = $config->getConfig();
	return $data;
}

/**
 * 设置临时配置
 * @param $array
 */
function setConfigsTemp($array){
	$config = \lchphp\code\Config::getInstance();
	$config->setConfigsTemp($array);
}

/**
 * 创建路径
 */
function createUrl($path,$pram = array()){
	//模块
	$module = C('active_module');
	if (!empty($module)) {
		$module .= '/';
	}
	if(C('url_model')==2) {
		$url = '/' . $module . $path ;
		if (is_array($pram) && !empty($pram)) {
			$arr = array();
			foreach ($pram as $k => $v) {
				$arr[] = $k . '/' . $v;
			}
			$url .= '/'.implode('/', $arr);
		}
		$url .= C('url_html_suffix');
	}else{
		$url = $_SERVER['PHP_SELF'] . '?r='.$module.$path;
		if (is_array($pram) && !empty($pram)) {
			$arr = array();
			foreach ($pram as $k => $v) {
				$arr[] = $k . '=' . $v;
			}
			$url .= '&'.implode('&', $arr);
		}
	}
	return $url;
}


