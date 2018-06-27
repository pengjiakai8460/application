<?php
/**
 * 框架基础类
 */

class base
{
	public function run()
	{
		$this -> loadConfig();
		$this -> registerAutoLoad(); //注册自动加载
        $this -> getRequestParams(); //获取请求参数
        $this -> dispatch();  //请求分发
	}

	/**
     * 加载配置文件
	 */
	public function loadConfig()
	{
		$GLOBALS['config'] = require_once './common/config.php';
	}

	/**
     * 用户自定义自动加载方法
     * @param $className
     */
    public function userAutoload($className)
    {
        //定义基本类列表
        $baseClass = [
            'Model' => './vendor/framework/model.php',
            'Db' => './vendor/framework/db.php',
        ];

        //依次判断基础类,模型类,控制器类
        if (isset($baseClass[$className])) 
        {
            require $baseClass[$className];  //加载模型基类
        } 
        elseif (substr($className,-5) == 'Model') 
        {
            require './application/home/models/' . $className . '.php';
        } 
        elseif (substr($className,-10) == 'Controller') 
        {
            require './application/home/controllers/' . $className . '.php';
        }
    }

    /**
     * 注册自动加载方法
     */
    private function registerAutoLoad()
    {
        spl_autoload_register([$this, 'userAutoload']);
    }

    /**
     * 获取请求参数
     */
    private function getRequestParams()
    {
        //当前模块
        $defPlate = $GLOBALS['config']['app']['default_platform'];
        $p = isset($_GET['p']) ? $_GET['p'] : $defPlate;
        define('PLATFORM', $p);

        //当前控制器
        $defController = $GLOBALS['config'][PLATFORM]['default_controller'];
        $c = isset($_GET['c']) ? $_GET['c'] : $defController;
        define('CONTROLLER', $c);

        //当前方法
        $defAction = $GLOBALS['config'][PLATFORM]['default_action'];
        $a = isset($_GET['a']) ? $_GET['a'] : $defAction;
        define('ACTION', $a);
    }

    private function dispatch()
    {
        //实例化控制器
        $controllerName = CONTROLLER . 'Controller';
        $controller = new $controllerName();

        //调用当前方法
        $actionName = ACTION . 'Action';
        $controller -> $actionName();
    }
}