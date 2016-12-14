<?php
namespace app\controllers;

use app\models\Test;
use lchphp\code\Controller;

class Index extends Controller
{
	public $layouts = 'main';

	function index()
	{
//        echo 1;die;
//		$client = new \Yar_Client("http://lch/index/yar");
//		$result = $client->api("parameter");
//		var_dump($result);
//		\Yar_Concurrent_Client::call("http://lch/index/yar", "app\\models\\Test", array("one"),"app\\controllers\\Index::callback");
		\Yar_Concurrent_Client::call("http://lch/index/yar", "api", array("parameters"), "app\\controllers\\Index::callback");
//		\Yar_Concurrent_Client::call("http://lch/index/yar", "Test", array("parameters"), "callback");
//		\Yar_Concurrent_Client::call("http://lch/index/yar", "Test", array("parameters"), "callback");
		\Yar_Concurrent_Client::loop();
//		$service = new \Yar_Server(new Test());
//		$service->handle();
//		phpinfo();
//		$this->display('index/index');
	}
	static function callback($retval, $callinfo) {
		var_dump($retval);
	}
	public function api($parameter, $option = "foo") {

		return $parameter;//var_dump($parameter);
	}
	public function yar(){
		$service = new \Yar_Server(new Test());
		$service->handle();
	}

}