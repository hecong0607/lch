<?php
/**
 * 注册树模式
 */
namespace lchphp\code;

class Register{
	protected static $objects;

	//将对象按照名字给注册树
	static function set($alias,$object){
		self::$objects[$alias] = $object;
	}
	//获取对应名字的存在注册树上的对象
	static function get($alias){
		return self::$objects[$alias];
	}

	//按照名字将注册树上的对象删除
	function _unset($alias){
		unset(self::$objects[$alias]);
	}

}