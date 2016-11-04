<?php
//引入类文件
require './wechat.class.php';
//实列化类
$wechat = new Wechat();
//调用属性方法
$wechat->getUserList();