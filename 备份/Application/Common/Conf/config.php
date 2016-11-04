<?php
/*
 * 数据库配置项
 */
return array(
    //'配置项'=>'配置值'

    //常量设置
    'TMPL_PARSE_STRING' => array(
        '__ADMINCSS__' => '/Public/Admin/css',
        '__ADMINJS__' => '/Public/Admin/js',
        '__ADMINIMG__' => '/Public/Admin/images',
        '__COMMON__' => '/Public/Common/',
    ),
    //设置URL模式为pathinfo模式
    'URL_MODEL' => 1,//4种访问模式均可访问
    //默认访问
    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    //设置允许访问的模板列表
    'MODULE_ALLOW_LIST' => array('Admin','Home'),
    /* 数据库设置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'api', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

);