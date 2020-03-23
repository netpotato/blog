<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Potato Blog 后台管理</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
    <a href="/admin/index/index"><div class="layui-logo">Potato Blog 后台管理</div></a>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item"><a href="">控制台</a></li>
        <li class="layui-nav-item"><a href="">商品管理</a></li>
        <li class="layui-nav-item"><a href="">用户</a></li>
        <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
            <dd><a href="">邮件管理</a></dd>
            <dd><a href="">消息管理</a></dd>
            <dd><a href="">授权管理</a></dd>
        </dl>
        </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">
                <img src="" class="layui-nav-img">
              potato
            </a>
            <dl class="layui-nav-child">
                <dd><a href="">基本资料</a></dd>
                <dd><a href="">安全设置</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item"><a href="">退了</a></li>
    </ul>
    </div>
  
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="javascript:;">文章类型</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-route="/admin/index/articletype_list">类型列表</a></dd>
                        <dd><a href="javascript:;" data-route="/admin/index/articletype_add">添加类型</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">文章管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-route="/admin/index/article_all_list">所有文章列表</a></dd>
                        <dd><a href="javascript:;" data-route="/admin/index/article_add">添加文章</a></dd>
                    </dl>
                </li>
                <!-- <li class="layui-nav-item"><a href="">云市场</a></li>
                <li class="layui-nav-item"><a href="">发布商品</a></li> -->
            </ul>
        </div>
    </div>
  
    <div class="layui-body">
        <!-- 内容主体区域 -->
        <!-- <div style="padding: 15px;">@yield('content')</div> -->
        <div style="padding: 15px;height: 93%;">
            <iframe id="myiframe" src="" frameborder="0" width="100%" height="100%"></iframe>
        </div>
    </div>
  
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © layui.com - 底部固定区域
    </div>
</div>
<script src="/layui/layui.js"></script>
<script src="/js/jquery.min.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
    var element = layui.element;
});
</script>
<script>
    $(function(){
        $(".layui-nav-child a").on("click", function() {
            var src = $(this).attr("data-route")
            $("#myiframe").attr("src", src)
        })
    })
</script>
</body>
</html>