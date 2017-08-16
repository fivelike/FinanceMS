<?php
namespace Common\Model;
use Think\Model;

/**
* 
*/
class MemberModel extends Model
{
	private $_db='';
	public function __construct(){
		$this-> _db=M('member');
	}

	public function getParent($memberid){
		$data['memberid'] = array('eq',$memberid);
		$ret = $this-> _db->where($data)->find();
		return $ret;
	}

	public function incChildNumber($memberid,$field = string){
		$data['memberid'] = array('eq',$memberid);
		$ret = $this-> _db->where($data)->setInc($field,1);
		return $ret;
	}

	public function decChildNumber($memberid,$field = string){
		$data['memberid'] = array('eq',$memberid);
		$ret = $this-> _db->where($data)->setDec($field,1);
		return $ret;
	}

	public function insert($data = array()){
		if(!$data || !is_array($data)){
			return 0;
		}
		return $this -> _db->add($data);
	}

	public function getMembers($data,$page,$pageSize){
		// $data['status']=array('neq',-1);
		$conditions = $data;
		if(isset($data['name']) && $data['name']){
			$conditions['name'] = array('like','%'.$data['name'].'%');
		}
		if(isset($data['memberid']) && $data['memberid']){
			$conditions['memberid'] = array('like','%'.$data['memberid'].'%');
		}
		$offset = ($page-1)*$pageSize;
		$list = $this->_db->where($conditions)->order('id')->limit($offset,$pageSize)->select();
		return $list;
	}

	public function getXls(){
		return $this->_db->order('id')->select();
	}

	public function getMemberCount($data= array()){
		// $data['status']=array('neq',-1);
		$conditions = $data;
		if(isset($data['name']) && $data['name']){
			$conditions['name'] = array('like','%'.$data['name'].'%');
		}
		if(isset($data['memberid']) && $data['memberid']){
			$conditions['memberid'] = array('like','%'.$data['memberid'].'%');
		}
		return $this->_db->where($conditions)->count();
	}

	public function find($id){
		if(!$id || !is_numeric($id)){
			return array();
		}
		return $this->_db->where('id='.$id)->find();
	}


	public function updateMemberById($id , $data){
		if(!$id || !is_numeric($id)){
			throw_exception('ID不合法');
		}

		if(!$data || !is_array($data)){
			throw_exception('更新的数据不合法');
		}

		return $this->_db->where('id='.$id)->save($data);
	}

 	public function updateStatusById($id){
 		if(!is_numeric($id) || !$id){
 			throw_exception('ID不合法');
 		}
 		// $data['status'] = $status;
 		// $data['memberid'] = 0;
 		return $this->_db->where('id='.$id)->delete();
 	}

 		public function getChild($field,$memberid){
		// $data[$status]=array('neq',-1);
		$data[$field]=array('eq',$memberid);
		$list = $this->_db->where($data)->order('id')->select();
		return $list;
	}
}