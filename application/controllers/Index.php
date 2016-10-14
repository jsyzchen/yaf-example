<?php
/**
 * @name IndexController
 * @author root
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class IndexController extends \Yaf\Controller_Abstract
{
    public function indexAction() {//默认Action
        $this->getView()->assign("content", "Hello World");
    }
}
