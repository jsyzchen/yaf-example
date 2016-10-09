<?php
/**
 * @name Bootstrap
 * @author root
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
use Yaf\Loader;
use Yaf\Registry;
use Yaf\Dispatcher;
use Yaf\Application;
use Yaf\Bootstrap_Abstract;

class Bootstrap extends Bootstrap_Abstract{

	private $_config;

    /**
     * 加载
     */
    public function _initLoader(){
        if(file_exists(APP_PATH . '/vendor/autoload.php')){
            Loader::import(APP_PATH . '/vendor/autoload.php');
        }
    }

    /**
     * 配置
     */
    public function _initConfig() {
		//把配置保存起来
		$this->_config = Application::app()->getConfig();
		Registry::set('config', $this->_config);
	}

    /**
     * 日志
     * @param Dispatcher $dispatcher
     */
	public function _initLogger(Dispatcher $dispatcher){
        //SocketLog
        if($this->_config->socketlog->enable){
            //载入
            Loader::import('Common/Logger/slog.function.php');
            //配置SocketLog
            slog($this->_config->socketlog->toArray(),'config');
        }
    }

    /**
     * 插件
     * @param Dispatcher $dispatcher
     */
	public function _initPlugin(Dispatcher $dispatcher) {
		//注册一个插件
		//$objSamplePlugin = new SamplePlugin();
		//$dispatcher->registerPlugin($objSamplePlugin);
	}

    /**
     * 路由
     * @param Dispatcher $dispatcher
     */
	public function _initRoute(Dispatcher $dispatcher) {
		//在这里注册自己的路由协议,默认使用简单路由
	}

    /**
     * LocalName
     */
	public function _initLocalName() {
		Loader::getInstance()->registerLocalNamespace(array(
			'Common','Smarty'
		));
	}

    /**
     * 视图
     * @param Dispatcher $dispatcher
     */
	public function _initView(Dispatcher $dispatcher) {
		//在这里注册自己的view控制器，例如smarty,firekylin
		/* init smarty view engine */
		if('Smarty' == $this->_config->application->view->name){
			Loader::import("Smarty/Adapter.php");		
			$smarty = new Adapter(null, Registry::get("config")->get("smarty"));
			$dispatcher->setView($smarty);
		}		
	}

    /**
     * Db,若使用Facedes,则无需使用该方法
     */
	/*public function _initDefaultDbAdapter()
	{  
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($this->_config->database->toArray());
        $capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new \Illuminate\Container\Container));
        $capsule->setAsGlobal();

        //开启Eloquent ORM
        $capsule->bootEloquent();
  
	}*/

	/**
     * 初始化facades
     * @author jsyzchenchen@gmail.com
     * @date 2016/10/06
     */
    public function _initFacedes(){
        //container
        $container = new \Illuminate\Container\Container();
        $container->instance('config', $config = new \Illuminate\Config\Repository());
        $database_config = [
            'fetch' => \PDO::FETCH_CLASS,
            'default' => 'mysql',
            'connections' => [
                'mysql' => $this->_config->database->toArray()
            ],
        ];
        $config->set('database', $database_config);

        //RegisterFacades
        \Illuminate\Support\Facades\Facade::clearResolvedInstances();
        \Illuminate\Support\Facades\Facade::setFacadeApplication($container);
        $aliases = array();
        Loader::import(APPLICATION_PATH . '/conf/aliases.php');
        \Common\AliasLoader::getInstance($aliases)->register();

        //RegisterProviders
        $providers = array();
        Loader::import(APPLICATION_PATH . '/conf/providers.php');
        foreach ($providers as $provider) {
            $provider = new $provider($container);
            $provider->register();
            if (method_exists($provider, 'boot')) {
                call_user_func([$provider,'boot']);
            }
        }
    }
    
    /**
     * 公用函数
     */
    public function _initFunction(){
        Loader::import('Common/functions.php');
    }
}
