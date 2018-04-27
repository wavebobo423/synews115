<?php
/**
 * Created by PhpStorm.
 * User: jaafar
 * Date: 30/11/15
 * Time: 13:00
 */

namespace Cadmin\Controller;
use Think\Controller;

class BaseController extends Controller {
    // const pageSize = 5; //分页显示条数
    protected $modelName=null;
    protected $model=null;
    protected $listRows = 20;

    protected function _initialize(){
        //判断是否登录
        if(!session('name')){


            $this->redirect('Index/index');
        }
        $modelName = $this->modelName?$this->modelName:"";
        if($modelName){
            $this->model=D($modelName);
        }
    }
    //todo wrong
    // protected function page($total,$where=''){
    //     $page=new Think\Page($total,pageSize);


    // }
    //空操作 用于跳转404
    public function _empty(){
        $this->display('Public/404');
    }
}