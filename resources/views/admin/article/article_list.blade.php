@extends('admin.layout.index')


@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<table id="mytable" class="layui-table" lay-even="" lay-skin="row" style="margin-top: 5px">
		<colgroup>
			<col width="80">
		    <col width="90">
		    <col width="100">
		    <col width="150">
		    <col width="150">
		    <col width="170">
		    <col width="70">
		    <col width="70">
		    <col width="70">
		    <col width="200">
		</colgroup>
		<thead>
		    <tr>
		    	<th>
		    		<input id="allcheck" type="checkbox" name="allcheck"> 全选
		    	</th>
			    <th>文章编号</th>
			    <th>文章类型</th>
			    <th>文章名称</th>
			    <th>文章概要</th>
			    <th>添加时间</th>
			    <th>pv</th>
			    <th>阅览</th>
			    <th>喜欢</th>
			    <th>操作</th>
		    </tr> 
		</thead>
		<tbody>
			@foreach ($articlelists as $articlelist)
				<tr data-id="{{ $articlelist->id }}" data-name="{{ $articlelist->name }}">
					<td>
						<input class="check" type="checkbox" name="check">
					</td>
					<td>{{ $articlelist->id }}</td>
					<td title="{{ $articlelist->type_name }}">{{ $articlelist->type_name }}</td>
					<td title="{{ $articlelist->name }}">{{ $articlelist->name }}</td>
					<td title="{{ $articlelist->title }}">{{ $articlelist->title }}</td>
					<td>{{ $articlelist->insert_time }}</td>
					<td>{{ $articlelist->pv }}</td>
					<td>{{ $articlelist->read_num }}</td>
					<td>{{ $articlelist->like_num }}</td>
					<td>
						<button class="layui-btn layui-btn-xs layui-btn-normal preview">打开</button>
						<button class="layui-btn layui-btn-xs layui-btn-normal updataarticle">修改</button>
						<button class="layui-btn layui-btn-xs layui-btn-normal layui-bg-red removearticle">删除</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="main-paging">
		{{ $articlelists->links() }}
	</div>
	
	<script>
		$(function() {
			$(".preview").on("click", function() {
				var article_id = $(this).parent().parent().attr("data-id")
				window.open("/home/article/detail?article_id="+article_id)
			})
			$(".removearticle").on("click", function() {
				var article_id = $(this).parent().parent().attr("data-id")
				var article_name = $(this).parent().parent().attr("data-name")
				if (confirm("确认删除文章 id:"+article_id+" 名称:"+article_name+" 吗？")) {
					$.ajax({
						type: "post",
						url: "/admin/article/to_delete",
						headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						data: {
							article_id: article_id
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
			$(".updataarticle").on("click", function() {
				var article_id = $(this).parent().parent().attr("data-id")
				var article_name = $(this).parent().parent().attr("data-name")
				location.href = "/admin/article/update?id="+article_id
			})
		})
	</script>
@endsection