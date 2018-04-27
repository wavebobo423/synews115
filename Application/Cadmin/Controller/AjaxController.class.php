<?php
/*
*前后台公用Ajax控制器
*/
namespace Cadmin\Controller;
class AjaxController extends \Think\Controller{

    //通过岗位id获取类别
    public function getPname(){
        if(IS_AJAX){
            $id=(int)I('post.id');
            $data=M('pcate');
            $pcate=$data->where("pid=$id")->getField('pname',true);
            $this->ajaxReturn($pcate);
        }
    }
}