{{extends file='public/layout.tpl'}}
{{block name=main}}
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
{{/block}}
{{block name=scripts}}
<script type="text/javascript">
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
</script>
{{/block}}