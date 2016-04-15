<?php /* Smarty version 3.1.27, created on 2016-01-19 14:17:13
         compiled from "/Users/chenchen/web/php/project/chachalou/application/views/life/express.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1519636000569dd4e9388325_51547351%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f63f69b237a6e473317bf548161d9d4f0d5de36d' => 
    array (
      0 => '/Users/chenchen/web/php/project/chachalou/application/views/life/express.tpl',
      1 => 1453184039,
      2 => 'file',
    ),
    '4de000b9f68421ac522f46bd19b128d31ceb1817' => 
    array (
      0 => '/Users/chenchen/web/php/project/chachalou/application/views/public/layout.tpl',
      1 => 1453183001,
      2 => 'file',
    ),
    '6843befedf78dd76de851d77e757d4d260c2b275' => 
    array (
      0 => '6843befedf78dd76de851d77e757d4d260c2b275',
      1 => 0,
      2 => 'string',
    ),
    '5e784d8b76b72fdb1e4977b1d6b84a45e6ce6e8f' => 
    array (
      0 => '5e784d8b76b72fdb1e4977b1d6b84a45e6ce6e8f',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1519636000569dd4e9388325_51547351',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_569dd4e93b79b6_25805472',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_569dd4e93b79b6_25805472')) {
function content_569dd4e93b79b6_25805472 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1519636000569dd4e9388325_51547351';
?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
	<title>查查喽</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css"> 
    
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
	<?php
$_smarty_tpl->properties['nocache_hash'] = '1519636000569dd4e9388325_51547351';
?>

	<div class="main center-block container-fluid" style="margin-top: 50px;padding: 50px;">
	<form class="form-inline">
		<div class="result">
		<div class="seatchForm">
			<div class="txtURL">
	          <label>快递公司：</label>
	          <select class="form-control" name="expressid" id="expressid">
	          	
	          </select>		          
			  <label>快递单号：</label><input name="expressno" type="text" id="expressno" value="" class="form-control" placeholder="请输入你的快递单号"/>
			  </p>
		</div>
				<div class="txtButton"><button type="button" class="btn btn-primary" id="btnSnap">查询</button>(若想多次查询，请刷新网页后再次查询)</div>
			</div>
			<div class="txtAboutSnap">
				<table class="table table-hover" id="DataTable" style="display: none;">
					<thead>
					    <tr>
					        <th>时间</th>  
					        <th>描述</th>
					        <th>区域</th>
					    </tr>
					</thead>
					<tbody id="express_data">
						
					</tbody>					
				</table>
				<div id="powered" style="">查询数据由：<a href="http://kuaidi100.com" target="_blank">KuaiDi100.Com （快递100）</a> 网站提供 </div>
			</div>
		</div>
	</form>
	</div>

</body>
<?php echo '<script'; ?>
 src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php
$_smarty_tpl->properties['nocache_hash'] = '1519636000569dd4e9388325_51547351';
?>

<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function()
	{
		$("#btnSnap").click(function()
		{
			$("#retData").html('loading...');
 			//$("#express_data").html('');
			//$(".txtAboutSnap").html('');
			
			var expressid = $("#expressid").val();
            var expressno = $("#expressno").val();
            //console.log(expressid);
            //console.log(expressno);
			$.get("{:U('express')}",{com:expressid,nu:expressno},
				function(data)
				{	
					data = JSON.parse(data);
					//console.log(data.resultcode);
					//$('#powered').attr('style','display: block;');
					if(data.resultcode == '200'){						
						$('#DataTable').attr('style','display: block;');
						//console.log(data);	
						$.each(data.result.list,function(k, v) {

							var html = '<tr><td>'+v.datetime+'</td><td>'+v.remark+'</td><td>'+v.zone+'</td></tr>';
							$("#express_data").append(html);	
						});
						//$("#retData").html(data);
						//console.log(data);
					}else{						
						var html = "<div style='color:red;'>"+data.reason+"</div>";
						$(".txtAboutSnap").append(html);
					}
					$('#powered').attr('style','display: block;');
				},'json');
			return false;
		});
	});
<?php echo '</script'; ?>
>

</html><?php }
}
?>