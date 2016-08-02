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
use Yaf\Session;
use Yaf\Dispatcher;
use Yaf\Application;
use Yaf\Bootstrap_Abstract;
use Illuminate\Events\Dispatcher as LDispatcher;
use Illuminate\Container\Container as LContainer;
use Illuminate\Database\Capsule\Manager as Capsule;

class Bootstrap extends Bootstrap_Abstract{
	private $_config;

    public function _initSession (Dispatcher $dispatcher)
    {
    	header('content-type:text/html;charset=utf-8');
        Session::getInstance()->start();       
    }

    public function _initConfig() {
		//把配置保存起来
		$this->_config = Application::app()->getConfig();
		Registry::set('config', $this->_config);
		$GLOBALS['config'] = $this->_config->toArray();
	}

	public function _initLogger(Dispatcher $dispatcher){
        //SocketLog
        if($this->_config->socketlog->enable){
            //载入
            Loader::import('Common/Logger/slog.function.php');
            //配置SocketLog
            slog($this->_config->socketlog->toArray(),'config');
        }
    }

	public function _initPlugin(Dispatcher $dispatcher) {
		//注册一个插件
		//$objSamplePlugin = new SamplePlugin();
		//$dispatcher->registerPlugin($objSamplePlugin);
	}

	public function _initRoute(Dispatcher $dispatcher) {
		//在这里注册自己的路由协议,默认使用简单路由
	}

	public function _initLocalName() {
		Loader::getInstance()->registerLocalNamespace(array(
			'Common','Db','Smarty','Yar'
		));
	}

	//View
	public function _initView(Dispatcher $dispatcher) {
		//在这里注册自己的view控制器，例如smarty,firekylin
		/* init smarty view engine */
		if('Smarty' == $this->_config->application->view->name){
			Loader::import("Smarty/Adapter.php");		
			$smarty = new Adapter(null, Registry::get("config")->get("smarty"));
			$dispatcher->setView($smarty);
		}		
	}

	//Db
	public function _initDefaultDbAdapter(Dispatcher $dispatcher)
	{
		if('Eloquent' == $this->_config->database->orm){//初始化 Eloquent ORM
			$capsule = new Capsule;
			$capsule->addConnection($this->_config->database->toArray());
			$capsule->setEventDispatcher(new LDispatcher(new LContainer));
			$capsule->setAsGlobal();
            //开启Eloquent
            $capsule->bootEloquent();

            //可以直接使用DB,类似Laravel的DB Facade
            class_alias('Illuminate\Database\Capsule\Manager', 'DB');
		}

        //\Db\Factory::create();

	}

    //公用函数
    public function _initFunction(){
        Loader::import('Common/functions.php');
    }
}
