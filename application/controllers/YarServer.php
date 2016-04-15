<?php
/**
 * @name YarServerController
 * @author chenchenjsyz@163.com
 * @date 2016-01-19
 * @desc 默认控制器
 */
use Yaf\Controller_Abstract;
use Yaf\Loader;
use Yaf\Dispatcher;
use App\Models\Express;

class YarServerController extends Controller_Abstract
{
	private function init(){
		// We don't need view in server mode
		Dispatcher::getInstance()->disableView();
	}

    public function getExpressListAction() {
    	$express_model = new Express();        
        $service = new \Yar_Server($express_model);
        $service->handle();
    }

}
