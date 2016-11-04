<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
    // 定义主键
    protected $pk = 'id';
    // 定义字段
    protected $fields = array(
        'id', 'username',  'password',
         'email',
    );
    // 定义表单和数据表的字段映射
    protected $map = array(
        'name' => 'username',
        'password' => 'password',
        'email' => 'email',
    );
    function checkLogin($name, $passwd){
        // 根据用户名从数据表中查询数据
        $info = $this->select();
        //var_dump($info);die;
        if(empty($info)){
            return false;
        } elseif($info['password'] == md5($passwd)) {
            //登录成功后，设置session
            session('name', $info['username']);
            return true;
        }
    }













}