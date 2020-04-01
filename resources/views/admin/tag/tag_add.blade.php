@extends('admin.layout.index')


@section('content')

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<form class="layui-form" action="">
		<div class="layui-form-item">
			<label class="layui-form-label">标签名称</label>
			<div class="layui-input-block">
				<input type="text" name="tag_name" id="tag_name" lay-verify="tag_name" autocomplete="off" placeholder="请输入标题" class="layui-input">
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
				var tag_name = $("#tag_name").val()
				if ("" == tag_name) { alert("标签名称不能为空") }
				else {
					$.ajax({
						type: "post",
						url: "/admin/tag/to_add",
						headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						data: {
							tag_name: tag_name
						},
						dataType: "json",
						success: function(data) {
							if (1 == data) {
								location.href = "/admin/tag/list"
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