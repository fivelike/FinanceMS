<?php
namespace Common\Model;
use Think\Model;

/**
* 
*/
class FinanceContentModel extends Model
{
	private $_db='';
	public function __construct(){
		$this-> _db=M('finance_content');
	}

	public function insert($data){
		if(!$data || !is_array($data)){
			return 0;
		}
		return $this -> _db->add($data);
	}

	public function incNumber($financeid,$memberid,$field = string,$setp){
		$conditions['financeid'] = array('eq',$financeid);
		$conditions['memberid'] = array('eq',$memberid);
		$ret = $this-> _db->where($conditions)->setInc($field,$setp);
		return $ret;
	}

	public function getc($finance_id){
		$ret = $this-> _db->where('finance_id="'.$finance_id.'"')->select();
		return $ret;
	}

	public function saveSum($id,$data){
		return $this->_db->where('id="'.$id.'"')->save($data);
	}


		public function getPeople($finance_id,$page,$pageSize){
		$data['finance_id']=array('eq',$finance_id);
		// $conditions = $data;
		// if(isset($data['name']) && $data['name']){
		// 	$conditions['name'] = array('like','%'.$data['name'].'%');
		// }
		// if(isset($data['memberid']) && $data['memberid']){
		// 	$conditions['memberid'] = array('like','%'.$data['memberid'].'%');
		// }
		$offset = ($page-1)*$pageSize;
		$list = $this->_db->where($data)->order('id')->limit($offset,$pageSize)->select();
		return $list;
	}

	public function getPeopleCount($finance_id){
		$data['finance_id']=array('eq',$finance_id);
		// $conditions = $data;
		// if(isset($data['name']) && $data['name']){
		// 	$conditions['name'] = array('like','%'.$data['name'].'%');
		// }
		// if(isset($data['memberid']) && $data['memberid']){
		// 	$conditions['memberid'] = array('like','%'.$data['memberid'].'%');
		// }
		return $this->_db->where($data)->count();
	}

	public function updateSalary($memberid,$finance_id,$data){
		$conditions['finance_id']=array('eq',$finance_id);
		$conditions['memberid']=array('eq',$memberid);
		if(!$finance_id || !is_numeric($finance_id)){
			return show(0,'ID不合法');
		}
		if(!$memberid || !is_numeric($memberid)){
			return show(0,'ID不合法');
		}

		if(!$data || !is_array($data)){
			return show(0,'更新的数据不合法');
		}
		return $this->_db->where($conditions)->save($data);
	}

	public function deleteByFinanceid($finance_id){
 		if(!is_numeric($finance_id) || !$finance_id){
 			throw_exception('ID不合法');
 		}

 		return $this->_db->where('finance_id='.$finance_id)->delete();
 	}
}