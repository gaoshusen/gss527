<?php
namespace Admin\Controller;
use Think\Controller;
class MainController extends Controller{

    function design(){
        $data = D('xiang')->select();
        //var_dump($data);die;
        $this->assign('dlist', $data);
        $this->display();
    }
    function system(){
        $this->display();
    }
    function insert(){
        $this->display();
    }
    function addOk(){

        $data['foodname'] = I('post.qm');
        $data['fangshi'] = I('post.zf');
        $data['kouwei'] = I('post.kw');
        $data['jiage'] = I('post.jg');
        $data['jieshao'] = I('post.content');
        //实例化xiang表模型，调用add方法插入数据
        //dump($data);die;
        if(D('xiang')->add($data)){
            //参数1: 提示信息
            //参数2: 跳转地址
            //参数3: 几秒后进行跳转
            $this->success('添加菜品成功', U('design'), 3);
        } else {
            $this->error('添加菜品失败', U('add'), 3);
        }
    }
    function del(){
        $id = I('get.id');
        //dump(D('xiang'));die;
        //实例化xiang模型，调用delete方法进行删除
        //$s = D('xiang')->delete($id);
        //dump($s);die;
//        echo $id;
        //dump(D('xiang')->delete($id)); die;
        if(D('Xiang')->delete($id)){
            $this->success('删除菜品成功', U('design'), 3);
        } else {
            $this->error('删除菜品失败', U('design'), 3);
            echo D('Xiang')->getLastSql();die;
        }
    }
    function edit(){
        // 接收id值，并查询对应的菜品信息
        $id = I('get.id');
        $info = D('xiang')->find($id);
        $this->assign('info', $info);
        //var_dump($info);die;

        $this->display();
    }
    function modify(){
        // 接收表单数据
        $data['foodname'] = I('post.qm');
        $data['fangshi'] = I('post.zf');
        $data['kouwei'] = I('post.kw');
        $data['jiage'] = I('post.jg');
        $data['jieshao'] = I('post.content');
        //dump($data);die;
        if(D('Xiang')->save($data)) {
            $this->success('修改菜品成功', U('design'), 3);
        } else {
            $this->error('修改菜品失败', U('insert', 'id=' . $data['id']), 3);
        }
    }
}