<?php
namespace Common\Model;
use Think\Model;

/**
* 
*/
class FinanceModel extends Model
{
	private $_db='';
	public function __construct(){
		$this-> _db=M('finance');
	}

	public function insert($data = array()){
		if(!$data || !is_array($data)){
			return 0;
		}
		return $this -> _db->add($data);
	}

	public function saveTotal($finance_id,$data){
		return $this->_db->where('finance_id="'.$finance_id.'"')->save($data);
	}

	public function getFinances($page,$pageSize){
		$offset = ($page-1)*$pageSize;
		$list = $this->_db->order('finance_id DESC')->limit($offset,$pageSize)->select();
		return $list;
	}

	public function getFinanceCount(){

		return $this->_db->count();
	}

	public function getFinanceById($finance_id){
		if(!$finance_id || !is_numeric($finance_id)){
			return array();
		}
		return $this->_db->where('finance_id='.$finance_id)->find();
	}

	public function updateFinanceById($finance_id,$data){
		if(!$finance_id || !is_numeric($finance_id)){
			return show(0,'ID不合法');
		}

		if(!$data || !is_array($data)){
			return show(0,'更新的数据不合法');
		}
		return $this->_db->where('finance_id='.$finance_id)->save($data);

	}

	public function getThisMonth(){
		return $this->_db->order('finance_id DESC')->limit(1)->find();
	}

	public function getSum($field=string){
		return $this->_db->SUM($field);
	}

	public function deleteByFinanceid($finance_id){
		if(!is_numeric($finance_id) || !$finance_id){
			throw_exception('ID不合法');
		}
 
		return $this->_db->where('finance_id='.$finance_id)->delete();
	}
}