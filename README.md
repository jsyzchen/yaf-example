# chen-yaf
>[yaf](https://github.com/laruence/yaf)是鸟哥用C语言编写的一个PHP框架，yaf文档地址：[http://yaf.laruence.com/manual/](http://yaf.laruence.com/manual/)

其实很早之前就接触yaf了,但只是学习学习，没有深入的去了解和使用，但由于最近在重构一个项目，而重构所用到的框架就是yaf框架，正好趁此机会好好地使用了下yaf框架。本篇文章其实主要给一个yaf的例子,就是扩展了下yaf，因为yaf的东西本身就简单，所以快。鸟哥也给了两个例子，[laruence/yaf-examples](https://github.com/laruence/yaf-examples),一个是在yaf里使用Smarty的例子，还有一个是在yaf里加了DB和Log操作的包的例子。我给的yaf例子地址是：[https://github.com/jsyzchen/chen-yaf](https://github.com/jsyzchen/chen-yaf)

# 配置
首先，你得安装yaf,文档里有，[http://php.net/manual/zh/yaf.installation.php](http://php.net/manual/zh/yaf.installation.php) 。
安装完之后，编辑php.ini文件，配置yaf:
```sh
extension=yaf.so
yaf.use_namespace=1 ;开启命名空间
yaf.use_spl_autoload=1 ;开启自动加载
```
[chen-yaf](https://github.com/jsyzchen/chen-yaf)主要添加了:   
* [Eloquent ORM](https://github.com/illuminate/database)  
* [Twig](http://twig.sensiolabs.org)  
* 罗飞的[SocketLog](https://github.com/luofei614/SocketLog)   
* 一些常用函数  

先编辑conf/application.ini文件
```sh
[common]
application.directory = APP_PATH  "/application"
application.view.ext = "html"
application.view.engine = "twig"

;user
user.default_filter = 'trim,addslashes,htmlspecialchars'

[product : common]
;twig
twig.cache = APP_PATH "/storage/twig/cache"

;database
database.driver = 'mysql'
database.read.host = '127.0.0.1'
database.write.host = '127.0.0.1'
database.port = '3306'
database.database = 'test'
database.username = 'root'
database.password = '123456'
database.charset = 'utf8'
database.collation = 'utf8_unicode_ci'
database.prefix = ''
database.strict = false

[develop : common]
application.dispatcher.catchException = TRUE

;twig
twig.debug = true

;socketlog
socketlog.enable = true
socketlog.host = 'localhost'
socketlog.optimize = true
socketlog.show_included_files = true
socketlog.error_handler = true
socketlog.force_client_ids = ''
socketlog.allow_client_ids = 'slog_78de03'

;database
database.driver = 'mysql'
database.host = '127.0.0.1'
database.port = '3306'
database.database = 'test'
database.username = 'root'
database.password = '123456'
database.charset = 'utf8'
database.collation = 'utf8_unicode_ci'
database.prefix = ''
database.strict = false
```
database为MySql数据库的配置,socketlog为socketlog的配置，twig为twig模板引擎的配置

因为chen-yaf使用的是composer包，首先你得[安装composer](http://docs.phpcomposer.com/00-intro.html),然后在项目目录下建一个composer.json文件，内容如下：
```javascript
{
    "require": {
        "php": ">=5.5.9",
        "illuminate/database": "5.1.*",
        "illuminate/events": "5.1.*",
        "symfony/debug": "2.6.*",
        "symfony/var-dumper": "2.6.*",
        "twig/twig": "^1.26"
    },
  
    "autoload": {
      "psr-4": {
        "App\\Models\\": "application/models"
      }
    }
}
```
然后记得 
```sh
composer install  
```
编辑Bootstrap.php文件
```php
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
    $this->config = \Yaf\Application::app()->getConfig();//把配置保存起来
    \Yaf\Registry::set('config', $this->config);
}
```

# Eloquent ORM
> [Eloquent ORM](https://github.com/illuminate/database)是Laravel框架里的ORM。  

yaf里是没有数据库操作类的，可以自己写一个DAO层，或者直接使用第三方包，推荐[Medoo](https://github.com/catfan/Medoo)和[Eloquent ORM](https://github.com/illuminate/database),chen-yaf里面是使用的[Eloquent ORM](https://github.com/illuminate/database)。
编辑Bootstrap.php文件，添加_initDefaultDbAdapter方法
```php
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
```
然后在application/model下建一个Model基类，EloquentModel.php
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentModel extends Model
{

}
```
然后所有的Model类都继承EloquentModel，这样就可以像在Laravel里操作数据库了，另外DB也是能使用的，和Laravel里的DB facade使用方法一样。文档：[https://laravel-china.org/docs/5.1/eloquent](https://laravel-china.org/docs/5.1/eloquent) , [https://laravel-china.org/docs/5.1/database](https://laravel-china.org/docs/5.1/database)

# twig
>[twig](http://twig.sensiolabs.org/)是Symfony框架里的模板引擎，当然它也可以单独使用。模板引擎也可以使用Smarty,如果你想拥有页面缓存的功能，请用Smarty。

编辑Bootstrap.php文件，添加_initTwig方法
```php
/**
 * Twig View
 * @param \Yaf\Dispatcher $dispatcher
 */
public function _initTwig(\Yaf\Dispatcher $dispatcher)
{
    $twig = new \Twig\Adapter(APP_PATH . "/application/views/", $this->config->get("twig")->toArray());
    $dispatcher->setView($twig);
}
```
这样就可以在html文件里使用twig模板引擎了

# SocketLog
>SocketLog是ThinkPHP框架核心开发者“罗飞”开发的一个调试的工具，使用过ThinkPHP5框架的应该很熟悉。更多的介绍可以阅读我的另一篇文章：[日志服务](http://jsyzchen.com/2016/07/28/log-service/)。

我把SocketLog相关的文件放在library/Common/Logger目录下了，当你安装完SocketLog并配置好，在Bootstrap.php添加_initLogger方法。
```php
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
```
然后就可以在Chrome里调试你的代码了。

# 其他
[chen-yaf](https://github.com/jsyzchen/chen-yaf)引入了一些函数，放在library/Common/functions.php里了，都是一些常用的函数，如果你的项目中有其他的函数往里面加就行了。编辑Bootstrap.php,添加_initFunction方法。
```php
/**
 * 公用函数载入
 */
public function _initFunction()
{
    \Yaf\Loader::import('Common/functions.php');
}
```
# 总结
[chen-yaf](https://github.com/jsyzchen/chen-yaf)只是一个很简单的yaf例子，加了Eloquent ORM和twig。实际项目中，还需要不断地往里面添加东西。既然我们使用了composer包，那么我们在做自己的项目时就可以很方便的使用第三方包，避免我们重复造轮子。
推荐一些第三方包吧，也是我们在重构项目里所用到的。
1.[carbon](https://github.com/briannesbitt/Carbon):对于时间日期的操作。  
2.[php-resque](https://github.com/chrisboulton/php-resque):队列的操作。  
3.[sokil/php-mongo](https://github.com/sokil/php-mongo):mongodb的操作。  
4.[monolog](https://github.com/Seldaek/monolog):日志的操作。
