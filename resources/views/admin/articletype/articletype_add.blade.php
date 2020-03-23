<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="/layui/css/layui.css">
	<style>
		* { margin: 0; padding: 0; }
		html { width: 100%; height: 100%; }
		body { width: 100%; height: 100%; overflow-y: hidden; }
	</style>
</head>
<body>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<form class="layui-form" action="">
		<div class="layui-form-item">
			<label class="layui-form-label">类型名称</label>
			<div class="layui-input-block">
				<input type="text" name="articletype_name" id="articletype_name" lay-verify="articletype_name" autocomplete="off" placeholder="请输入标题" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button type="submit" id="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</form>

</body>
</html>

<script src="/js/jquery.min.js"></script>
<script>
	$(function() {
		$("#submit").on("click", function() {
			var articletype_name = $("#articletype_name").val()
			if ("" == articletype_name) { alert("类型名称不能为空") }
			$.ajax({
				type: "post",
				url: "/admin/index/add_articletype",
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				data: {
					articletype_name: articletype_name
				},
				dataType: "json",
				success: function(data) {
					if (1 == data) {
						alert("添加成功")
					} else {
						alert("添加失败")
					}
				}
			})
		})
	})
</script>