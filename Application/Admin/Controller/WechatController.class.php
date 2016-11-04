<?php
//引入配置文件
require './wechat.inc.php';
//编写一个wechat类
//用来存放相关调用微信公众平台的接口方法
class Wechat{
    //封装属性
    //私有化，只能类内使用
    private $appid;
    private $appsecret;
    //使用构造方法赋值
    //在对象实例的时候，会自动调用构造方法
    public function __construct(){
        $this -> appid = APPID;
        $this -> appsecret = APPSECRET;
    }
    //http https get post 等请求种类
    public function request($url,$https=true,$method='get',$data=null){
        //1.初始化curl
        $ch = curl_init($url);
        //2.设置相关请求参数
        //curl设置是一个开关操作
        //默认返回数据不输出，而是保存起来
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //判断是否为https
        if($https === true){
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        }
        //判断是否为post请求
        if($method === 'post'){
            curl_setopt($ch,CURLOPT_POST,true);
            //post需要传输的数据
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }
        //3.发送请求
        $str = curl_exec($ch);
        //4.关闭连接
        curl_close($ch);
        //返回请求到的数据
        return $str;
    }
    //测试request方法
    public function testRequset(){
        $url = 'https://www.baidu.com';
        $content = $this -> request($url);
        var_dump($content);
    }
    //php获取access_token
    public function getAccessToken(){
        //1.url
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
        //2.发送请求
        $content = $this -> request($url);
        //4.处理返回值
        //返回值为json
        $content = json_decode($content);
        $access_token = $content -> access_token;

        echo $access_token;
    }
    //获取ticket
    public function getTicket($scene_id=666,$tmp=true,$expire_seconds=604800){
        //1.url
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->getAccessToken();
        //2.判断请求方式
        //判断是生成临时的还是永久的
        if($tmp === true){
            $data = '{"expire_seconds": '.$expire_seconds.', "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
        }else{
            $data = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
        }
        //3.发送请求
        $content = $this->request($url,true,'post',$data);
        //4.处理返回数据
        //返回格式为json
        $content = json_decode($content);   //对象格式
        $ticket  = $content->ticket;
        return $ticket;
    }
    //通过ticket获取二维码
    public function getQRCode(){
        //1.url
        $url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$this->getTicket();
        //2.判断请求方式
        //3.发送请求
        $content = $this->request($url);
        //4.处理返回值数据
        //保存图片
        $rs = file_put_contents('qrcode.jpg', $content);
        var_dump($rs);
    }
    public function getUserList(){
        //获取url
        $url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->getAccessToken();
        //请求方式
        $content = $this -> request($url);
        //处理返回数据
        $content = json_decode($content);
        //输出相关信息
        echo '关注数量为：'.$content->total. '<br />';
        echo '本次拉取数为：'.$content->count.'<br />';
        echo '用户列表为'.'<br />';
        //遍历输出数组内容
        //初始化计数器$i，从1开始
        $i = 1;
        foreach($content->data->openid as $key => $value){
            echo $i.'---------'.$value.'<br />';
            //每执行一次，计数器加一操作
            $i++;
        }
    }
    public function testStr(){
        $phone = '13596983422';
        $areaNum = substr($phone,0,7);
        echo($areaNum);
    }

}