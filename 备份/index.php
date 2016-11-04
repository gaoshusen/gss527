<?php

//1. 设置响应类型
header("Content-Type:text/html;charset=utf-8");

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');

// 引入ThinkPHP入口文件
require '../WWW/ThinkPHP/ThinkPHP.php';