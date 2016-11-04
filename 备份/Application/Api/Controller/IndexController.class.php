<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        echo 'hello wrold';
    }
    //创建Json
    public function createJson(){
        //创建一个数组
        $personArray = array(
            'name' => 'gao',
            'age' => 27,
            'job' => 'php',
            );
        //将数组转化为json
        $a = json_encode($personArray);
        //输出查看json
        dump($a);
        echo '<hr>';
        //json转为数组
        $personArray = json_decode($a,true);
        dump($personArray);
    }
    //生成xml
    public function createXML(){
        //xml字符串的拼接
        $str = '<?xml version="1.0" encoding="utf-8"?>';
        //根标签
        $str .= '<person>';
        $str .= '<name>tom</name>';
        $str .= '<age>18</age>';
        $str .= '<job>php</job>';
        $str .= '</person>';
        //保存为xml文档
        $rs = file_put_contents('./data.xml', $str);
        echo $rs;
        //$rs返回值为数字，就是写入文件的长度，不成功返回false
    }
    //解析xml
    public function readXML(){
        //获取xml数据，读取文件
        $xmlData = file_get_contents('./data.xml');
        // dump($xmlData);
        //将xml数据转化为对象
        $objData = simplexml_load_string($xmlData);
        // dump($objData);
        //使用对象调用属性
        echo 'name:'.$objData->name.'<br />';
        echo 'age:'.$objData->age.'<br />';
        echo 'job:'.$objData->job;
    }
    public function testRequset(){
        $url = 'https://www.baidu.com';
        //发送请求
        $content = request($url);
        echo 'aaaaa'.'<br />';
        dump($content);
    }
    public function weather(){
        $city = I('get.city');
        //1.确定接口URL地址
        $url = 'http://api.map.baidu.com/telematics/v2/weather?location='.$city.'&ak=B8aced94da0b345579f481a1294c9094';
        //2.判断请求方式
        //3.发送请求
        $content = request($url,false);
        //4.对返回值进行处理
        $xmlobj = simplexml_load_string($content);
        //dump($xmlobj);die;
        //获取当天天气数据信息
        $todatInfo = $xmlobj -> results -> result[0];
        //dump($todatInfo);die;
        //输出相关信息
        echo '实时温度：'.$todatInfo->date.'<br />';
        echo '天气情况：'.$todatInfo->weather.'<br />';
        echo '风向风力：'.$todatInfo->wind.'<br />';
        echo '温度区间：'.$todatInfo->temperature.'<br />';
    }
    public function getAreaByPhone(){
        //接收get方式传过来的phone
        $phone = I('get.phone');
        //1.URL地址
        $url = 'http://cx.shouji.360.cn/phonearea.php?number='.$phone;
        //2.判断请求方式
        //3.发送请求
        $content = request($url,false);
        //4.处理数据返回值
        $content = json_decode($content);
        echo '当前号码：'.$phone.'<br />';
        echo '省份：'.$content->data->province.'<br />';
        echo '城市：'.$content->data->city.'<br />';
        echo '运营商：'.$content->data->sp.'<br />';
    }
    public function express(){
        //发送邮件测试方法
        $rs = sendMail('我是高树森发送的邮件','你好，我是高树森','gaoshusen520@163.com');
        //接收返回值并进行判断
        if($rs === true){
            echo '发送邮件成功';
        }else{
            echo '发送失败，错误原因为：'.$rs;
        }
    }
}