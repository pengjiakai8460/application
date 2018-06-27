<?php
/*
 * 基础公共配置参数
 */
return [
	//数据库参数
	'db' => [
		'db' => 'mysql',
		'host' => '127.0.0.1',
		'port' => '3306',
		'dbname' => 'apps',
		'username' => 'root',
		'password' => 'root',
		'charset' => 'utf8'
	],

	//默认模块配置
    'app' => [
        'default_platform'=> 'home', //默认平台
    ],

    //前台默认访问配置
    'home' => [
        'default_controller' => 'Index', //默认控制器
        'default_action' => 'index', //默认操作方法
    ],

    //后台配置
    'admin' => [
        'default_controller' => '', //默认控制器
        'defautl_action' => '', //默认操作方法
    ],
];