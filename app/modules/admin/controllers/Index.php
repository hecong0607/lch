<?php
namespace app\modules\admin\controllers;
use app\models\Test;
use lchphp\code\controller;


class Index extends controller{
	public $layouts = 'main';
	private $_data;

	function index(){

		$this->display('index/index');
	}

	function getdata($value){
		$this->$_data = $value;
	}
	function setdata(){
		return $this->$_data;
	}

}