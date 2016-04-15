<?php /* Smarty version 3.1.27, created on 2016-01-19 10:37:28
         compiled from "/Users/chenchen/web/php/project/chachalou/application/views/index/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:273960749569da168756db7_97593865%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f120c19b96248471edad94f9a794a0668acdf3d4' => 
    array (
      0 => '/Users/chenchen/web/php/project/chachalou/application/views/index/index.tpl',
      1 => 1453167585,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '273960749569da168756db7_97593865',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_569da16876a2f2_47874942',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_569da16876a2f2_47874942')) {
function content_569da16876a2f2_47874942 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '273960749569da168756db7_97593865';
?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
	<title>查查喽</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<style type="text/css">
		.list-unstyled li{
			float: left;
			padding: 10px;
			
		}
	</style>
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<?php echo '<script'; ?>
 src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"><?php echo '</script'; ?>
>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<?php echo '<script'; ?>
 src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</head>
<body>
	<div id="header">
		<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container">		    
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar">/span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand hidden-sm" href="#">查查喽</a>
		    </div>

		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="active"><a href="#">首页<span class="sr-only">(current)</span></a></li>
		        <li><a href="#">生活服务</a></li>
		        <li><a href="#">关于我们</a></li>
		        <li><a href="#">关于我们</a></li>
		        <li><a href="#">其他</a></li>
		      </ul>
		      <form class="navbar-form navbar-left" role="search">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">搜索</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#">关于我们</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Something else here</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="#">Separated link</a></li>
		          </ul>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav> 		
	</div>
	<div id="main" class="container-fluid" style="margin-top: 80px;">
		<div class="row">
		  <div class="col-md-8 col-md-offset-2">
		  	<div class="panel panel-default">
		  	  <div class="panel-heading">
		  	    <h3 class="panel-title">生活服务</h3>
		  	  </div>
		  	  <div class="panel-body">
		  	    <ul class="list-unstyled" style="overflow: hidden;">
			  	    <li><a href="kuaidi">快递查询</a></li>
			  	    <li><a href="2">产品介绍</a></li>
			  	    <li><a href="3">服务介绍</a></li>
			  	    <li><a href="4">技术支持</a></li>
			  	    <li><a href="5">立刻购买</a></li>
			  	    <li><a href="6">联系我们</a></li>
			  	    <li><a href="1">首页</a></li>
			  	    <li><a href="2">产品介绍</a></li>
			  	    <li><a href="3">服务介绍</a></li>
			  	    <li><a href="4">技术支持</a></li>
			  	    <li><a href="5">立刻购买</a></li>
			  	    <li><a href="6">联系我们</a></li>
			  	    <li><a href="1">首页</a></li>
			  	    <li><a href="2">产品介绍</a></li>
			  	    <li><a href="3">服务介绍</a></li>
			  	    <li><a href="4">技术支持</a></li>
			  	    <li><a href="5">立刻购买</a></li>
			  	    <li><a href="6">联系我们</a></li>
		  	    </ul> 
		  	  </div>
		  	</div>
		  </div>
		</div>
	</div>
</body>
</html><?php }
}
?>