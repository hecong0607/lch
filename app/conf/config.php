<?php

$config = array(
    'db'=>array(
        'host' 			=>  '127.0.0.1',//'127.0.0.1',//数据库连接ip,默认本机
        'port' 			=> 3306,//端口号,默认3306
        'username' 		=> 'root',//用户名,默认root
        'password' 		=> '123456',//密码,默认空
        'dbname' 		=> 'lch',//数据库名字
        'charset' 		=> 'utf8',//字符集,默认utf8
		'prefix'		=>'',
		'fields_cache' 	=>false,
    ),
	'error_view'		=> true,
    'url_model'=>'2',//隐藏入口文件模式
    'url_html_suffix'       =>  '.html',
    'tmpl_template_suffix'  =>  'php',
	'modules' =>array(
		'admin'
	),
	'db1'=>array(
		'host' 			=>  '127.0.0.1',//'127.0.0.1',//数据库连接ip,默认本机
		'port' 			=> 3306,//端口号,默认3306
		'username' 		=> 'root',//用户名,默认root
		'password' 		=> 'root',//密码,默认空
		'dbname' 		=> 'test',//数据库名字
		'charset' 		=> 'utf8',//字符集,默认utf8
		'prefix'		=>'',
		'fields_cache' 	=>false,
	),

);
return $config;