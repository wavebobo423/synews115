<?php
namespace Cadmin\Controller;
class CommodityController extends BaseController{
    protected $modelName ="Product_brand";
    public function index()
    {
        // print_r($list);
        $curpage = isset($_GET['p'])?I("get.p"):1;
        $listRows =5;
        $ProductBrand = D("Product_brand");
        $list = $ProductBrand->page($curpage.' , '.$listRows)->select();
        $count = $ProductBrand->count();
        $page = new \Think\Page($count,$listRows);
        $pagination = $page->show();
        $this->assign('items',$list);// 赋值数据集
        $this->assign('pagination',$pagination);// 赋值分页输出
        $this->assign("channelName","品牌");
        $this->display(); // 输出模板

    }

    public function addBrand()
    {
        $this->assign('channelName',"添加品牌");
        $this->display('Commodity/edit');
    }

    public function editBrand()
    {
        $id = (int)I("get.id");
        $item = $this->model->where("brand_id = $id")->find();
        $this->assign('channelName',"编辑品牌");
        $this->assign("item",$item);
        $this->display('Commodity/edit');
    }

    public function setBrand(){
        $data = I("post.");
        $url = U("Commodity/index");
        $brand = D("product_brand");
        if(!$data['id']){
            //add
            $data['ctime'] = date("Y-m-d H:i:s",time());
            $result = $brand->data($data)->add();
            if($result){
                display_javascript("添加成功",$url);
            }else{
                display_javascript("添加异常",$url);
            }
        }else{
            //update
            $result = $brand->where('brand_id = '.$data['id'])->save($data);
            if($result){
                display_javascript("修改成功",$url);
            }else{
                display_javascript("没有修改内容",$url);
            }
        }
    }

    public function del(){
        $id   = (int)I("post.id");
        $type = (int)I("post.type");
        if($type==1){
            $brand = M("product_brand");
            $result = $brand->where('brand_id = '.$id)->delete();
        }else{
            $editor = M("product_editor");
            $result = $editor->where('editor_id = '.$id)->delete();
        }
        if($result){
            $return_data = array(
                'status'=>1,
                'msg'   => "删除成功"
            );
        }else{
            $return_data = array(
                'status'=>0,
                'msg'   => "删除异常"
            );
        }
        echo json_encode($return_data);
    }

    public function uploadImg()
    {
        $type = isset($_POST['type'])?I('post.type'):'';
        $rootPath = "/ROOT/www/xianeryijian/Public/Upload/Product/";
        $config = array(
            'maxSize' 	=> 2014*2014*5,
            'exts'    	=> array('jpg','jpeg','gif','png'),
            'rootPath'	=> $rootPath
        );
        $upload          = new \Think\Upload($config);

//		$upload->rootPath	="./Public/Upload/";
        if(!file_exists($rootPath)){
            mkdir($rootPath,0777,true);
        }
        //执行上传
        $info=$upload->upload();
        if(!$info){
            $this->error($upload->getError());
        }else{
            foreach($info as $file){
                $image=new \Think\Image();
                $old_img = $upload->rootPath.$file['savepath'].$file['savename'];
                $image->open($old_img);
                $cover=$file['savepath']."m_".$file['savename'];
                //图片的缩放
                if($type==2){
                    $image->thumb(150,150)->save($upload->rootPath.$cover);
                }else{
                    $image->thumb(250,250)->save($upload->rootPath.$cover);
                }
            }
            //删除老图片
            @unlink($old_img);
            $src = array(
                'db_path' => "/Public/Upload/Product/".$cover,
                'img_path' => "/Public/Upload/Product/".$cover
            );
            echo json_encode($src);
            exit;
        }
    }

    public function editor_index()
    {
        // print_r($list);
        $curpage = isset($_GET['p'])?I("get.p"):1;
        $listRows = 5;
        $ProductBrand = D("Product_editor");

        $list = $ProductBrand->page($curpage.' , '.$listRows)->select();
        $count = $ProductBrand->count();
        $page = new \Think\Page($count,$listRows);
        $pagination = $page->show();
        $this->assign('items',$list);// 赋值数据集
        $this->assign('pagination',$pagination);// 赋值分页输出
        $this->assign("channelName","添加小编");
        $this->display(); // 输出模板
    }

    public function addEditor()
    {
        $this->assign('channelName',"添加小编");
        $this->display('Commodity/editor_edit');
    }

    public function editEditor()
    {
        $id = (int)I("get.id");
        $editor = D("product_editor");
        $item = $editor->where("editor_id = ".$id)->find();
        $this->assign('channelName',"编辑小编信息");
        $this->assign("item",$item);
        $this->display('Commodity/editor_edit');
    }

    public function setEditor(){
        $data = I("post.");
        $url = U("Commodity/editor_index");
        $brand = D("product_editor");
        if(!$data['editor_id']){
            //add
            $data['ctime'] = date("Y-m-d H:i:s",time());
            $result = $brand->data($data)->add();
            if($result){
                display_javascript("添加成功",$url);
            }else{
                display_javascript("添加异常",$url);
            }
        }else{
            //update
            $result = $brand->where('editor_id = '.$data['editor_id'])->save($data);
            if($result){
                display_javascript("修改成功",$url);
            }else{
                display_javascript("没有修改内容",$url);
            }
        }
    }


    public function uploadIcon()
    {
        $rootPath = "/ROOT/www/xianeryijian/Public/Upload/Product/";
        $config = array(
            'maxSize' 	=> 2014*2014*5,
            'exts'    	=> array('jpg','jpeg','gif','png'),
            'rootPath'	=> $rootPath
        );
        $upload          = new \Think\Upload($config);

//		$upload->rootPath	="./Public/Upload/";
        if(!file_exists($rootPath)){
            mkdir($rootPath,0777,true);
        }
        //执行上传
        $info=$upload->upload();
        if(!$info){
            $this->error($upload->getError());
        }else{
//			print_r($info);
//			exit("OK");
            foreach($info as $file){
                $image=new\Think\Image();
                $old_img = $upload->rootPath.$file['savepath'].$file['savename'];
                $image->open($old_img);
                $cover=$file['savepath']."m_".$file['savename'];
                //图片的缩放
                $image->thumb(750,500)->save($upload->rootPath.$cover);
            }
            //删除老图片
            @unlink($old_img);
            $src = array(
                'db_path' => "/Public/Upload/Product/".$cover,
                'img_path' => "/Public/Upload/Product/".$cover
            );
            echo json_encode($src);
            exit;
        }
    }



}


?>