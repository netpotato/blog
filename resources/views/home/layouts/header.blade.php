<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset=utf-8>
<title>Potato个人博客</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="个人博客,Potato个人博客,个人博客模板,Potato" />
<meta name="description" content="Potato个人博客" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="Shortcut Icon" type="image/x-icon" href="/favicon.ico" />
<link href="/css/base.css" rel="stylesheet">
<link href="/css/index.css" rel="stylesheet">
<link href="/css/m.css" rel="stylesheet">
<link href="/css/info.css" rel="stylesheet">
<link href="/css/own/main.css" rel="stylesheet">
<script src="/js/jquery.min.js"></script>
<script src="/js/comm.js"></script>
</head>
<body>

<header class="header-navigation" id="header">
    <div class="logo"><a href="/home/index/index">Potato个人博客</a></div>
    <nav id="nav">
        <ul>
            <li><a href="/home/index/index">网站首页</a></li>
            <!-- <li><a href="share.html">我的相册</a></li> -->
            <!-- <li><a href="list.html">我的日记</a></li> -->
            <li><a href="gbook.html">留言</a></li>
            <li><a href="about.html">关于</a></li>
            <!-- <li><a href="info.html">内容页</a></li> -->
            <!-- <li><a href="infopic.html">内容页</a></li> -->
        </ul>
    </nav>
</header>

<script>
// window.onload = function () {
//     var obj=null;
//     console.log(document.getElementById('nav'))
//     // var As=document.getElementById('nav').getElementsByTagName('a');
//     var As=$("nav a");

//     obj = As[0];
//     for(i=1;i<As.length;i++){if(window.location.href.indexOf(As[i].href)>=0)
//     obj=As[i];}
//     obj.id='selected'
// }
</script>
