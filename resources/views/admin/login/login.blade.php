<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Potato.blog登陆</title>
		<link rel="stylesheet" href="/layui/css/layui.css" media="all"/>
		<link rel="stylesheet" href="/css/own/login.css" media="all"/>
		<style>
			/* 覆盖原框架样式 */
			.layui-elem-quote{background-color: inherit!important;}
			.layui-input, .layui-select, .layui-textarea{background-color: inherit; padding-left: 30px;}
		</style>
	</head>
	<body>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Head -->
		<div class="layui-fluid">
			<div class="layui-row layui-col-space15">
				<div class="layui-col-sm12 layui-col-md12 zyl_mar_01">
					<blockquote class="layui-elem-quote">Potato.blog 后台登陆界面</blockquote>
				</div>
			</div>
		</div>
		<!-- Head End -->
		
		<!-- Carousel -->
		<div class="layui-row">
			<div class="layui-col-sm12 layui-col-md12">
				<div class="layui-carousel zyl_login_height" id="zyllogin" lay-filter="zyllogin">
					<div carousel-item="">
						<div>
							<div class="zyl_login_cont"></div>
						</div>
						<div>
							<img src="/images/admin/login/01.jpg" />
						</div>
						<div>
							<div class="background">
								<span></span><span></span><span></span>
								<span></span><span></span><span></span>
								<span></span><span></span><span></span>
								<span></span><span></span><span></span>
							</div>
						</div>
						<div>
							<img src="/images/admin/login/02.jpg" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Carousel End -->
		
		<!-- Footer -->
		<div class="layui-row">
			<div class="layui-col-sm12 layui-col-md12 zyl_center zyl_mar_01">
				<!-- © 2019 - 简约后台登陆界面 || 简约后台登陆界面版权所有 -->
			</div>
		</div>
		<!-- Footer End -->
		
		
		
		<!-- LoginForm -->
		<div class="zyl_lofo_main">
			<fieldset class="layui-elem-field layui-field-title zyl_mar_02">
				<legend>欢迎登陆 - Potato.blog 管理平台</legend>
			</fieldset>
			<div class="layui-row layui-col-space15">
				<div class="layui-form zyl_pad_01">
					<div class="layui-col-sm12 layui-col-md12">
						<div class="layui-form-item">
							<input type="text" name="username" lay-verify="required|username" autocomplete="off" placeholder="账号" class="layui-input">
							<i class="layui-icon layui-icon-username zyl_lofo_icon"></i>
						</div>
					</div>
					<div class="layui-col-sm12 layui-col-md12">
						<div class="layui-form-item">
							<input type="password" name="password" lay-verify="required|password" autocomplete="off" placeholder="密码" class="layui-input">
							<i class="layui-icon layui-icon-password zyl_lofo_icon"></i>
						</div>
					</div>
					<div class="layui-col-sm12 layui-col-md12">
						<div class="layui-row">
							<div class="layui-col-xs4 layui-col-sm4 layui-col-md4">
								<div class="layui-form-item">
									<input type="text" name="vercode" id="vercode" lay-verify="required|vercodes" autocomplete="off" placeholder="验证码" class="layui-input" maxlength="4">
									<i class="layui-icon layui-icon-vercode zyl_lofo_icon"></i>
								</div>
							</div>
							<div class="layui-col-xs4 layui-col-sm4 layui-col-md4">
								<div class="zyl_lofo_vercode zylVerCode" onclick="zylVerCode()"></div>
							</div>
						</div>
					</div>
					<div class="layui-col-sm12 layui-col-md12">
						<button class="layui-btn layui-btn-fluid" lay-submit="" lay-filter="submit">立即登录</button>
					</div>
				</div>
			</div>
		</div>
		<!-- LoginForm End -->
		
		
		<!-- Jquery Js -->
		<script type="text/javascript" src="/js/jquery.min.js"></script>
		<!-- Layui Js -->
		<script type="text/javascript" src="/layui/layui.js"></script>
		<!-- Jqarticle Js -->
		<script type="text/javascript" src="/js/assembly/jqarticle/jparticle.min.js"></script>
		<!-- ZylVerificationCode Js-->
		<script type="text/javascript" src="/js/assembly/zylVerificationCode/zylVerificationCode.js"></script>
		<script>
			layui.use(['carousel', 'form'], function(){
				var carousel = layui.carousel
				,form = layui.form;
				
				//设置轮播主体高度
				var zyl_login_height = $(window).height()/1.3;
				var zyl_car_height = $(".zyl_login_height").css("cssText","height:" + zyl_login_height + "px!important");

				var can_submit = false;
				
				//自定义验证规则
				form.verify({
					username: function(value){
						if(value.length < 5){
							return '账号至少得5个字符';
						}
					}
					,password: [/^[\S]{6,12}$/,'密码必须6到12位，且不能出现空格']
					,vercodes: function(value){
						//获取验证码
						var zylVerCode = $(".zylVerCode").html();
						if(value!=zylVerCode){
							return '验证码错误（区分大小写）';
						}
					}
					,content: function(value){
						layedit.sync(editIndex);
					}
				});
				//监听提交
				form.on('submit(submit)', function(data){
					$.ajax({
						type: "post",
						url: "/admin/login/to_login",
						data: {
							username: data.field.username,
							password: data.field.password
						},
						headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						success: function(data) {
							if (1 == data) {
								location.href = "/admin/index/index"
							} else {
								layer.msg('用户名或密码错误')
							}
						}
					})
				});



				// $("#submit").on("click", function() {
				// 	var username = $("#username").val()
				// 	var password = $("#password").val()
				// 	if (can_submit) {
				// 		if (""==username || ""==password) {
				// 			layer.msg('用户名或密码不能为空')
				// 		} else if (password.length < 6) {
				// 			layer.msg('密码最少为6位')
				// 		} else {
				// 			$.ajax({
				// 				type: "post",
				// 				url: "/admin/index/to_login",
				// 				data: {
				// 					username: username,
				// 					password: password
				// 				},
				// 				headers: {
				// 			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				// 			    },
				// 				success: function(data) {
				// 					if (1 == data) {
				// 						location.href("/admin/index/index")
				// 					} else {
				// 						layer.msg('用户名或密码错误')
				// 					}
				// 				}
				// 			})
				// 		}
				// 	}
				// })
				
				//Login轮播主体
			 	carousel.render({
					elem: '#zyllogin'//指向容器选择器
					,width: '100%' //设置容器宽度
					,height:'zyl_car_height'
					,arrow: 'always' //始终显示箭头
					,anim: 'fade' //切换动画方式
					,autoplay: true //是否自动切换false true
					,arrow: 'hover' //切换箭头默认显示状态||不显示：none||悬停显示：hover||始终显示：always
					,indicator: 'none' //指示器位置||外部：outside||内部：inside||不显示：none
					,interval: '5000' //自动切换时间:单位：ms（毫秒）
				});
				
				//监听轮播--案例暂未使用
				carousel.on('change(zyllogin)', function(obj){
					var loginCarousel = obj.index;
				});
				
				//粒子线条
				$(".zyl_login_cont").jParticle({
					background: "rgba(0,0,0,0)",//背景颜色
					color: "#fff",//粒子和连线的颜色
					particlesNumber:100,//粒子数量
					//disableLinks:true,//禁止粒子间连线
					//disableMouse:true,//禁止粒子间连线(鼠标)
					particle: {
					    minSize: 1,//最小粒子
					    maxSize: 3,//最大粒子
					    speed: 30,//粒子的动画速度
					 }
				});
			});
		</script>
	</body>
</html>
