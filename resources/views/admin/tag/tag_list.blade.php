@extends('admin.layout.index')


@section('content')
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
			    <th>标签编号</th>
			    <th>标签名称</th>
			    <th>添加时间</th>
			    <th>操作</th>
		    </tr> 
		</thead>
		<tbody>
			@foreach ($taglists as $taglist)
				<tr data-id="{{ $taglist->id }}" data-name="{{ $taglist->tag_name }}">
					<td>
						<input class="check" type="checkbox" name="check">
					</td>
					<td>{{ $taglist->id }}</td>
					<td>{{ $taglist->tag_name }}</td>
					<td>{{ $taglist->insert_time }}</td>
					<td>
						<button class="layui-btn layui-btn-xs layui-btn-normal updatatype">修改</button>
						<button class="layui-btn layui-btn-xs layui-btn-normal layui-bg-red removetype">删除</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="main-paging">
		{{ $taglists->links() }}
	</div>
	<script>
		$(function() {
			$(".removetype").on("click", function() {
				var tag_id = $(this).parent().parent().attr("data-id")
				var tag_name = $(this).parent().parent().attr("data-name")

				if (confirm("确认删除标签 id:"+tag_id+" 名称:"+tag_name+" 吗？")) {
					$.ajax({
						type: "post",
						url: "/admin/tag/to_delete",
						headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						data: {
							tag_id: tag_id
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
			$(".updatatype").on("click", function() {
				var tag_id = $(this).parent().parent().attr("data-id")
				location.href = "/admin/tag/update?id="+tag_id
			})
		})
	</script>
@endsection
