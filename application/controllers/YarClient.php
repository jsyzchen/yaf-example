<?php
/**
 * @name YarClientController
 * @author chenchenjsyz@163.com
 * @date 2016-01-19
 * @desc 默认控制器
 */
use Yaf\Controller_Abstract;
use Yaf\Dispatcher;
use App\Models\Express;

class YarClientController extends Controller_Abstract
{
    private function init(){
        // We don't need view in server mode
        Dispatcher::getInstance()->disableView();
    }

    /**
     * 获取物流公司和快递公司编号列表
     * @return [type] [description]
     */
    public function expressListAction() {      
        $uri = "http://www.chachalou.com/yarserver/getExpressList";
        $client = new \Yar_Client($uri);
        $result = $client->lst();
        echo json_encode($result);
    }

}
