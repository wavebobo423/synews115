<?php
namespace Home\Controller;
use Think\Controller;
class ServerController extends Controller {
    public function Index(){
    	$this->display();
    }

    public function More()
    {
    	$this->display();
    }
}