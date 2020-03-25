<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/layui/css/layui.css">
	<style>
		* { margin: 0; padding: 0; }
		html { width: 100%; height: 100%; }
		body { width: 100%; height: 100%; overflow-y: hidden; }
	</style>
</head>
<body>
	
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<table id="mytable" class="layui-table" lay-even="" lay-skin="row" style="margin-top: 5px">
		<colgroup>
			<col width="100">
		    <col width="150">
		    <col width="150">
		    <col width="200">
		    <col width="150">
		</colgroup>
		<thead>
		    <tr>
		    	<th>
		    		<input id="allcheck" type="checkbox" name="allcheck"> 全选
		    	</th>
			    <th>类型编号</th>
			    <th>类型名称</th>
			    <th>添加时间</th>
			    <th>操作</th>
		    </tr> 
		</thead>
		<tbody>
			@foreach ($articletypelists as $articletypelist)
				<tr data-id="{{ $articletypelist->id }}" data-name="{{ $articletypelist->type_name }}">
					<td>
						<input class="check" type="checkbox" name="check">
					</td>
					<td>{{ $articletypelist->id }}</td>
					<td>{{ $articletypelist->type_name }}</td>
					<td>{{ $articletypelist->insert_time }}</td>
					<td>
						<button class="layui-btn layui-btn-xs layui-btn-normal updatatype">修改</button>
						<button class="layui-btn layui-btn-xs layui-btn-normal layui-bg-red removetype">删除</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>
<script src="/js/jquery.min.js"></script>
<script>
	$(function() {
		$(".removetype").on("click", function() {
			var articletype_id = $(this).parent().parent().attr("data-id")
			var articletype_name = $(this).parent().parent().attr("data-name")

			if (confirm("确认删除文章类型 id:"+articletype_id+" 名称:"+articletype_name+" 吗？")) {
				$.ajax({
					type: "post",
					url: "/admin/index/delete_articletype",
					headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					data: {
						articletype_id: articletype_id
					},
					dataType: "json",
					success: function(data) {
						if (1 == data) {
							location.reload()
						} else {
							alert("删除失败")
						}
					}
				})
			}
		})
	})
</script>