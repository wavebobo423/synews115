<?php
namespace Wap\Controller;
use Think\Controller;
/**
 * Ç°Ì¨
 */
class EmptyController extends Controller {

    public function index(){
       // header("HTTP/1.0 404 Not Found");//404×´Ì¬Âë
       $cityName = CONTROLLER_NAME;
       $this->display("Public:404"); 
	}

	function _empty(){  
		header("HTTP/1.0 404 Not Found");//404×´Ì¬Âë  
       $this->display("Public:404"); 
	}  


}

