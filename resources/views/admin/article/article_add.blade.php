@extends('admin.layout.index')


@section('content')

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<div class="layui-form" action="">
		<div class="layui-form-item">
			<label class="layui-form-label">文章类型</label>
			<div class="layui-input-block">
				<select name="articletype" id="articletype" lay-filter="articletype">
					<option value="0">请选择文章类型</option>
					@foreach ($articletypelists as $articletypelist)
						<option value="{{ $articletypelist->id }}">{{ $articletypelist->type_name }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">文章名称</label>
			<div class="layui-input-block">
				<input type="text" name="name" id="name" lay-verify="name" autocomplete="off" placeholder="请输入文章名称" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">作者名称</label>
			<div class="layui-input-block">
				<input type="text" name="auth" id="auth" lay-verify="auth" autocomplete="off" placeholder="请输入作者名称" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">文章摘要</label>
			<div class="layui-input-block">
				<input type="text" name="title" id="title" lay-verify="title" autocomplete="off" placeholder="请输入概要" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">标签</label>
			<div class="layui-input-block">
				<input type="text" name="tag" id="tag" lay-verify="tag" autocomplete="off" placeholder="请输入标签，英文 ',' 隔开，最多五个，超过五个取前五个" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">文章图片</label>
			<div class="layui-upload">
				<button type="button" class="layui-btn" id="uploadimg">上传图片</button>
				<div class="layui-upload-list" style="margin-left: 110px;">
					<img class="layui-upload-img" id="cur_uploadimg" style="width: 100px;height: 100px;margin-bottom: 3px;">
					<p id="uploadimg_tip"></p>
				</div>
				<input type="hidden" id="uploadimg_id" value="">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">文章内容</label>
			<div class="layui-input-block">
				<textarea id="content" style="display: none;"></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button type="submit" id="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</div>

	<script>
	layui.use('layedit', function(){
		var layedit = layui.layedit;
		var editIndex = layedit.build('content', {
			uploadImage: {
				type:'post',
				url: '/admin/article/upload_edit_img',
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    done: function(res){
					//上传完毕回调
					if (res.code == 1){
						return layer.msg('上传成功');
					} else {
						return layer.msg('上传失败');
					}
				},
			}
		}); //建立编辑器

		$("#submit").on("click", function() {
			var articletype_id = $("#articletype").val()
			var name = $("#name").val()
			var auth = $("#auth").val()
			var title = $("#title").val()
			var tag = $("#tag").val()
			var image_id = $("#uploadimg_id").val()
			var content = layedit.getContent(editIndex)
			var otags = tag.split(',')
			var tags = []
			for (var i=0; i<otags.length; i++) {
				if ("" != otags[i]) {
					tags.push(otags[i])
				}
			}
			tags = tags.slice(0, 5)
			if (articletype_id == 0) { layer.msg('请选择文章类型'); }
			else if (name == "") { layer.msg('请输入文章名称'); }
			else if (auth == "") { layer.msg('请输入作者名称'); }
			else if (title == "") { layer.msg('请输入文章摘要'); }
			else if (tag == "") { layer.msg('请输入文章标签'); }
			else if (image_id == "") { layer.msg('请上传文章图片'); }
			else if (content == "") { layer.msg('请输入文章内容'); }
			else {
				$.ajax({
					type: "post",
					url: "/admin/article/to_add",
					headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					data: {
						articletype_id: articletype_id,
						name: name,
						auth: auth,
						title: title,
						tag: tag,
						image_id: image_id,
						content: content
					},
					dataType: "json",
					success: function(data) {
						if (1 == data) {
							location.href = "/admin/article/list"
						} else {
							layer.msg('文章发布失败');
						}
					}
				})
			}
		})
	});
	// 文章图片上传
	layui.use('upload', function(){
		var upload = layui.upload;
		
		//执行实例
		var uploadInst = upload.render({
			elem: '#uploadimg', //绑定元素
			url: '/admin/article/upload_img', //上传接口
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			before: function(obj){
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					$('#cur_uploadimg').attr('src', result); //图片链接（base64）
				});
			},
			done: function(res){
				//上传完毕回调
				if (res.code == 1){
					$("#uploadimg_id").val(res.image_id);
					return layer.msg('上传成功');
				} else {
					return layer.msg('上传失败');
				}
			},
			error: function(){
				//请求异常回调
				var demoText = $('#uploadimg_tip');
				demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
				demoText.find('.demo-reload').on('click', function(){
					uploadInst.upload();
				});
			}
		});
	});
	</script>
@endsection