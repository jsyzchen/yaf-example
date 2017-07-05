<?php
use App\Models\Product;

class ProductController extends \Yaf\Controller_Abstract
{
    public function indexAction()
    {
    	//Eloquent ORM 调用方式
    	$products = Product::all();

        $this->getView()->assign("products", $products);
    }
}