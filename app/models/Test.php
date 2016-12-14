<?php
namespace app\models;
use lchphp\code\Model;
class Test extends Model
{
	public function one()
	{
		$sql = 'select * from `test` where `name` like ?';
		$name = '%小%';
		$obj	= self::$db->prepare($sql);
		$obj->bindParam(1,$name);
		$name = 'name';
		$obj->execute();
		$result = $obj->fetchALL(\PDO::FETCH_ASSOC);
		var_dump($result);
	}
	public function two()
	{
		$this->one();
		Model::setDbByConfig('db1');
		$this->one1();

	}
	public function one1()
	{
		$sql = 'select * from `test` where `name` like ?';
		$name = '%我%';
		$obj	= self::$db->prepare($sql);
		$obj->bindParam(1,$name);
		$obj->execute();
		$result = $obj->fetchALL(\PDO::FETCH_ASSOC);
		var_dump($result);
	}

	public function api(){
		return 1;
	}
	function callback($retval, $callinfo) {
		var_dump($retval);
	}

}