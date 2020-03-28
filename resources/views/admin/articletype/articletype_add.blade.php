@extends('admin.layout.index')


@section('content')

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

	<script>
		$(function() {
			$("#submit").on("click", function() {
				var articletype_name = $("#articletype_name").val()
				if ("" == articletype_name) { alert("类型名称不能为空") }
				else {
					$.ajax({
						type: "post",
						url: "/admin/articletype/to_add",
						headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						data: {
							articletype_name: articletype_name
						},
						dataType: "json",
						success: function(data) {
							if (1 == data) {
								location.href = "/admin/articletype/list"
							} else {
								alert("添加失败")
							}
						}
					})
				}
			})
		})
	</script>
@endsection