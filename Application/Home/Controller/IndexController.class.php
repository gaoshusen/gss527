<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this -> display();
    }
    public function content(){
        //菜品详情页面
        $this -> display();
    }
    public function feedback(){
        //点餐页面
        $this -> display();
    }
    public function xiang(){
        //菜品大全页面
        $this -> display();
    }
    public function testStr(){
        $phone = '13596983422';
        $areaNum = substr($phone,0,7);
        echo($areaNum);
    }
    //获取电话号码归属地信息通过Mysql
    public function getAreaByPhoneToMysql(){
        //1.接收参数
        $phone = '13596983422';
        //2.参数校验
        if(empty($phone)){
            $data = array(
                'errorcode' => 1,
                'time' => time(),
            );
        }else{
            $areaNum = substr($phone,0,7);
            //3.通过参数进行查询
            //通过mysql数据库进行查询
            $content = M('mobile')->where("mobile = $areaNum")->find();
            // dump($content);
            //4.根据约定格式进行返回
            $data = array(
                'errorcode' => 0,
                'time' => time(),
                'province' => $content['province'],
                'city' => $content['city'],
                'sp' => $content['sp']
            );
        }
        //输出json数据
        echo json_encode($data);
    }

}