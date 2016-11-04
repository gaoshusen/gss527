<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function login(){
        $this -> display();
    }
    public function checkLogin(){
        $name = I('post.name');
        //var_dump($name);die;
        $passwd = I('post.pwd');


        if(D('User')->checkLogin($name, $passwd)) {
            $this->success('登录成功', "U('Main/index')", 3);
        } else {
            $this->success('登录成功', U('Main/index'), 3);
        }
    }

}