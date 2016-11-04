<?php
namespace Admin\Model;
use Think\Model;
class KnowledgeModel extends Model{
    // 定义主键
    protected $pk = 'id';
    // 定义字段
    protected $fields = array(
        'id', 'foodname','fangshi','kouwei','jiage','image','jieshao',
        'email',
    );
    protected $_map = array(
        'title' => 'k_title',
        'description' => 'k_desc',
        'content' => 'k_content',
        'nickname' => 'k_nickname'
    );
    protected $_validate = array(
        array('k_title', 'require', '标题不能为空', 1, 'regex', 3),
        array('k_desc', 'require', '描述不能为空', 1, 'regex', 3),
        array('k_content', 'require', '内容不能为空', 1, 'regex', 3)
    );
    protected $_auto = array(
        array('k_ctime', 'setNowDate', 3, 'function')
    );
}