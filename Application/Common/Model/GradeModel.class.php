<?php
namespace Common\Model;
use Think\Model;

/**
* 
*/
class GradeModel extends Model
{
	private $_db = '';

	public function __construct(){
		$this->_db = M('grade');
	}

	public function show(){
		return $this->_db->where('id=0')->find();
	}

	public function updateGrade($data){
		if(!is_numeric($data['grade1']) || !$data['grade1']){
			throw_exception('1级奖金比例数据不合法');
		}
		if(!is_numeric($data['grade2']) || !$data['grade2']){
			throw_exception('2级奖金比例数据不合法');
		}
		if(!is_numeric($data['grade3']) || !$data['grade3']){
			throw_exception('3级奖金比例数据不合法');
		}

		return $this->_db->where('id=0')->save($data);
	}

	public function getGrade(){
		return $this->_db->where('id=0')->find();
	}
}