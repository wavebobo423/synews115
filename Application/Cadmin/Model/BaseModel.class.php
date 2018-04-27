<?php
namespace Cadmin\Model;
use Think\Model;

class BaseModel extends Model{

	/**
	* update
	*/
	public function update($condition,$fields)
	{
		return $this->where($condition)->save($fields);
	}

	public function updateById($fields)
	{
		return $this->save($fields);
	}

	public function getById($id,$fields="*")
	{
		$condition=array(
			'id'  => $id
		);
		return $this->field($fields)->where($condition)->find();
	}

	public function getByCondition($condition,$fields="*")
	{
		return $this->field($fields)->where($condition)->find();
	}

	/**
	*获取分页数据
	*
	*/
	public function pages($listRows, $pageNum, $fields,$order='id desc', $condition=array())
	{
		if(is_array($condition)){
			$lists = $this->field($fields)->where($condition)->order($order)->page($pageNum,$listRows)->select();
			$total = $this->where($condition)->count();
		}else{
			$lists = $this->field($fields)->order($order)->page($pageNum,$listRows)->select();
			$total = $this->count();
		}
		$pages = new \Think\Page($total,$listRows);

		//设置分页的config
        $pages->setConfig("prev","上一页");
        $pages->setConfig("next","下一页");
        $pages->setConfig('theme',"<ul class='pagination'><li><a>共%TOTAL_ROW% %FIRST%条数据%NOW_PAGE%/%TOTAL_PAGE% 页</a></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li></ul>");
		$pagination = $pages->show();
		$page = array(
			'items'      => $lists,
			'pagination' => $pagination
		);
		return $page;
	}

	public function getOne($condition,$field = true)
	{
		return $this->field($field)->where($condition)->find();
	}

	public function addData($data){
		return $this->data($data)->add();
	}

	public function delById($id){
		return $this->delete($id);
	}
	
	public function delByCondition($condition)
	{
		return $this->where($condition)->delete();
	}








}