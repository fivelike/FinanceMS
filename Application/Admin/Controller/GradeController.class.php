<?php
/**
 * 等级相关
 */
namespace Admin\Controller;
use Think\Controller;

class GradeController extends CommonController {
	public function index(){

		$grade = D('Grade')->show();
		$this->assign('grade',$grade);
		$this->display();
	}

	public function edit(){
		$grade = D('Grade')->show();
		$this->assign('grade',$grade);
		$this->display();
	}

	public function save(){
		// print_r($_POST);
		if($_POST){
			if(!$_POST['grade1'] ||!$_POST['grade2'] ||!$_POST['grade3'] || !isset($_POST['grade1'])||!isset($_POST['grade2'])||!isset($_POST['grade3'])){
				return show(0,'奖金比例不能为空，若无请填0');
			}elseif (!is_numeric($_POST['grade1']) || !is_numeric($_POST['grade2'])||!is_numeric($_POST['grade3'])) {
				return show(0,'奖金比例必须为小数');
			}


			try{
				$res = D('Grade')->updateGrade($_POST);
				if($res){
					return show(1,'更新成功');
				}
				return show(1,'更新成功');
			}catch(Exception $e){
				return show(0,$e->getMessage());
			}


		}else{
			return show(0,'没有提交的数据');
		}
	}
}