<?php
/** 
 * 数据库操作类
 */

class db
{
	//读取数据库配置
	private $config = $GLOBALS['config'];

	private static $instance = null;

	private $dsh;

	private $db;

	/**
     * 构造方法
     * 私有化以防止外部实例化.
     * @param $params
     */
	private function __construct()
	{
		$params = $this->$config;
		try {
			$this->dsn = 'mysql:host=' . $params['host'] . ';dbname=' . $params['dbname'];
            $this->db = new PDO($this->dsn, $params['useranme'], $params['password']);
            $this->db->exec('SET character_set_connection=' . $params['charset'] . ', character_set_results=' . $params['charset'] . ', character_set_client=binary');
		} catch (Exception $e) {
			$this->error($e->getMessage());
		}
	}

	/**
     * 禁止克隆
	 */

	private function __clone()
	{

	}

	/**
     * @return Db|null
     * 获取当前类的单一实例
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof self) 
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

	/**
     * 输出错误信息
     * 
     * @param $str string
     * @return string
     */
    public function error($str)
    {
        echo 'MySQL Error: ' . $str;
        exit();
    }

    public function test()
    {
    	echo 'aaaa';exit();
    }
}