<?php
/**
 * @name Bootstrap
 * @author jsyzchenchen@gmail.com
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends \Yaf\Bootstrap_Abstract
{
    /** @var object config */
	private $config;

    /**
     * 初始化错误,要放在最前面
     */
    public function _initErrors()
    {
        //如果为开发环境,打开所有错误提示
        if (Yaf\ENVIRON === 'develop') {
            error_reporting(E_ALL);//使用error_reporting来定义哪些级别错误可以触发
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
        }
    }

    /**
     * 加载vendor下的文件
     */
    public function _initLoader()
    {
        \Yaf\Loader::import(APP_PATH . '/vendor/autoload.php');
    }

    /**
     * 配置
     */
    public function _initConfig()
    {
		//把配置保存起来
		$this->config = \Yaf\Application::app()->getConfig();
        \Yaf\Registry::set('config', $this->config);
	}

    /**
     * 日志
     * @param \Yaf\Dispatcher $dispatcher
     */
	public function _initLogger(\Yaf\Dispatcher $dispatcher)
    {
        //SocketLog
        if (Yaf\ENVIRON === 'develop') {
            if ($this->config->socketlog->enable) {
                //载入
                \Yaf\Loader::import('Common/Logger/slog.function.php');
                //配置SocketLog
                slog($this->config->socketlog->toArray(),'config');
            }
        }
    }

    /**
     * 插件
     * @param \Yaf\Dispatcher $dispatcher
     */
	public function _initPlugin(\Yaf\Dispatcher $dispatcher)
    {
		//注册一个插件
		//$objSamplePlugin = new SamplePlugin();
		//$dispatcher->registerPlugin($objSamplePlugin);
	}

    /**
     * 路由
     * @param \Yaf\Dispatcher $dispatcher
     */
	public function _initRoute(\Yaf\Dispatcher $dispatcher)
    {
		//在这里注册自己的路由协议,默认使用简单路由
	}

    /**
     * LocalName
     */
	public function _initLocalName()
    {

	}


    /**
     * Twig View
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initTwig(\Yaf\Dispatcher $dispatcher)
    {
        $twig = new \Twig\Adapter(APP_PATH . "/application/views/", $this->config->get("twig")->toArray());
        $dispatcher->setView($twig);
    }

    /**
     * 初始化数据库分发器
     * @function _initDefaultDbAdapter
     * @author   jsyzchenchen@gmail.com
     */
    public function _initDefaultDbAdapter()
    {
        //初始化 illuminate/database
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($this->config->database->toArray());
        $capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new \Illuminate\Container\Container));
        $capsule->setAsGlobal();
        //开启Eloquent ORM
        $capsule->bootEloquent();

        class_alias('\Illuminate\Database\Capsule\Manager', 'DB');
    }


    /**
     * 公用函数载入
     */
    public function _initFunction()
    {
        \Yaf\Loader::import('Common/functions.php');
    }
}
