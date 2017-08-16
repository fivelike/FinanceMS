<?php
namespace Admin\Controller;
use Think\Controller;

//财务相关
class FinanceController extends CommonController{
	public function index(){
				// 分页操作逻辑
		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1 ;
		$pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 12;
		$finances = D('Finance')->getFinances($page,$pageSize);
		$financeCount = D('Finance')->getFinanceCount();


		$res = new \Think\Page($financeCount,$pageSize);
		$pageRes = $res->show();
		$this->assign('pageRes',$pageRes);
		$this->assign('finances',$finances);
		$this->display();

	}

	public function add(){
		// print_r($_POST);exit;
		if($_POST){
			//校验数据。。。

			if (!isset($_POST['finance_name']) || !$_POST['finance_name']) {
				return show(0,'账目名称不能为空');
			}

			if (!isset($_POST['entry_people']) || !$_POST['entry_people']) {
				return show(0,'录入员不能为空');
			}

			if (!isset($_POST['begin_time']) || !$_POST['begin_time']) {
				return show(0,'起始时间不能为空');
			}
			if (!isset($_POST['over_time']) || !$_POST['over_time']) {
				return show(0,'结束时间不能为空');
			}



			$data1['finance_name']=$_POST['finance_name'];
			$data1['entry_people']=$_POST['entry_people'];
			$data1['begin_time']=$_POST['begin_time'];
			$data1['over_time']=$_POST['over_time'];

			$finance_id = D('Finance')->insert($data1);
			if(!$finance_id){
				return show(0,'添加失败，请重试1！');
			}

			unset($_POST['finance_name']);
			unset($_POST['entry_people']);
			unset($_POST['begin_time']);
			unset($_POST['over_time']);
			// print_r($_POST);


			//获取等级奖金比例
			$grade = D('Grade')->getGrade();
			if(!$grade){
				return show(0,'添加失败，请重试2！');
			}
			// print_r($grade);

			$grade1 = $grade['grade1'];
			$grade2 = $grade['grade2'];
			$grade3 = $grade['grade3'];


			//循环增加数据
			foreach ($_POST as $memberid=>$salary) {
				// print_r($memberid."=>".$salary."\n");
				$member = D('Member')->getParent($memberid);
				$baseContent['finance_id'] = $finance_id;
				$baseContent['memberid'] = $member['memberid'];
				$baseContent['name'] = $member['name'];
				$baseContent['salary'] = $salary;
				$c_id = D('FinanceContent')->insert($baseContent) ;
				if(!$c_id || !$member){
					return show(0,'添加失败，请重试3！');
				}

			}

			foreach ($_POST as $memberid=>$salary) {
				// $member = D('Member')->getParent($memberid);
				$parentid = $member['parentid'];
				$parent2id = $member['parent2id'];
				$parent3id = $member['parent3id'];
				$bonus1 = D('FinanceContent')->incNumber($financeid,$parentid,'bonus1',$salary*$grade1);
				$bonus2 = D('FinanceContent')->incNumber($financeid,$parent2id,'bonus2',$salary*$grade2);
				$bonus3 = D('FinanceContent')->incNumber($financeid,$parent3id,'bonus3',$salary*$grade3);
			}


			$c = D('FinanceContent')->getc($finance_id);
			if(!$c){
				return show(0,'添加失败，请重试！4');
			}
			// print_r($c);
			foreach ($c as $key) {
				// print_r($key[id] .';');
				$bonus = $key['bonus1']+$key['bonus2']+$key['bonus3'];
				$pay = $bonus + $key['salary'];

				$total_sp['total_salary']+=$key['salary'];
				$total_sp['total_bonus']+=$bonus;
				$total_sp['total_bonus1']+=$key['bonus1'];
				$total_sp['total_bonus2']+=$key['bonus2'];
				$total_sp['total_bonus3']+=$key['bonus3'];
				$total_sp['total_pay']+=$pay;

				$sp['bonus'] = $bonus;
				$sp['pay'] = $pay;
				// print_r($sp);
				$insertSP = D('FinanceContent')->saveSum($key['id'],$sp);
								// print_r($insertSP);
				// if(!$insertSP){
				// 	return show(0,'添加失败，请重试5！');
				// }
			}
			// print_r($total_sp);
			$total = D('Finance')->saveTotal($finance_id,$total_sp);
			// if(!$total){
			// 	return show(0,'添加失败，请重试6！');
			// }
			return show(1,'添加成功');



		}


		// 分页操作逻辑
		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1 ;
		$pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10000;
		$members = D('Member')->getMembers($data,$page,$pageSize);
		$membersCount = D('Member')->getMemberCount($data);


		$res = new \Think\Page($membersCount,$pageSize);
		$pageRes = $res->show();
		$this->assign('pageRes',$pageRes);
		$this->assign('members',$members);
		$this->display();

	}

	public function setStatus(){
		try{
			if($_POST){
				$id = $_POST['id'];

				// print_r($id);exit;
				$df = D('Finance')->deleteByFinanceid($id);
				$dfc = D('FinanceContent')->deleteByFinanceid($id);
				if(!$df || !$dfc ){
					return show(0,'删除失败');
				}else{
					return show(1,'删除成功');
				}
			}
		}catch(Exception $e){
			return show(0,$e->getMessage());
		}
		return show(0,'没有提交的数据');	
	}

	public function detail(){
				// 分页操作逻辑

		$finance_id = $_GET['id'];

		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1 ;
		$pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 12;
		$members = D('FinanceContent')->getPeople($finance_id,$page,$pageSize);
		$membersCount = D('FinanceContent')->getPeopleCount($finance_id);

		$res = new \Think\Page($membersCount,$pageSize);
		$pageRes = $res->show();
		$this->assign('pageRes',$pageRes);
		$this->assign('members',$members);
		$this->assign('financeid',$finance_id);
		$this->display();
	}

	public function edit(){
		$finance_id = $_GET['id'];
		$finance = D('Finance')->getFinanceById($finance_id);
		// print_r($finance);

		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1 ;
		$pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 10000;
		$members = D('FinanceContent')->getPeople($finance_id,$page,$pageSize);
		$membersCount = D('FinanceContent')->getPeopleCount($finance_id);

		$res = new \Think\Page($membersCount,$pageSize);
		$pageRes = $res->show();
		$this->assign('pageRes',$pageRes);
		$this->assign('members',$members);

		$this->assign('finance',$finance);

		$this->display();
	}

	public function save(){
					//校验数据。。。

		if (!isset($_POST['finance_name']) || !$_POST['finance_name']) {
			return show(0,'账目名称不能为空');
		}

		if (!isset($_POST['entry_people']) || !$_POST['entry_people']) {
			return show(0,'录入员不能为空');
		}

		if (!isset($_POST['begin_time']) || !$_POST['begin_time']) {
			return show(0,'起始时间不能为空');
		}
		if (!isset($_POST['over_time']) || !$_POST['over_time']) {
			return show(0,'结束时间不能为空');
		}

		$finance_id = $_POST['finance_id'];
		$data1['finance_name']=$_POST['finance_name'];
		$data1['entry_people']=$_POST['entry_people'];
		$data1['begin_time']=$_POST['begin_time'];
		$data1['over_time']=$_POST['over_time'];
		$data1['total_salary']=0;
		$data1['total_bonus']=0;
		$data1['total_bonus1']=0;
		$data1['total_bonus2']=0;
		$data1['total_bonus3']=0;
		$data1['total_pay']=0;

		unset($_POST['finance_name']);
		unset($_POST['entry_people']);
		unset($_POST['begin_time']);
		unset($_POST['over_time']);
		unset($_POST['finance_id']);


		//更新FInance表
		$updateFinance = D('Finance')->updateFinanceById($finance_id,$data1);

		//获取奖金比例
		$grade = D('Grade')->getGrade();
		if(!$grade){
			return show(0,'更新失败，请重试！1');
		}
		$grade1 = $grade['grade1'];
		$grade2 = $grade['grade2'];
		$grade3 = $grade['grade3'];


					//循环更新数据
		foreach ($_POST as $memberid=>$salary) {
				// print_r($memberid."=>".$salary."\n");
			// $member = D('Member')->getParent($memberid);
			$baseContent['bonus'] = 0;
			$baseContent['bonus1'] = 0;
			$baseContent['bonus2'] = 0;
			$baseContent['bonus3'] = 0;
			$baseContent['pay'] = 0;
			$baseContent['salary'] = $salary;

			$updateSalary = D('FinanceContent')->updateSalary($memberid,$finance_id,$baseContent);
		}


		//计算
		foreach ($_POST as $memberid=>$salary) {
			$member = D('Member')->getParent($memberid);
			$parentid = $member['parentid'];
			$parent2id = $member['parent2id'];
			$parent3id = $member['parent3id'];
			$bonus1 = D('FinanceContent')->incNumber($financeid,$parentid,'bonus1',$salary*$grade1);
			$bonus2 = D('FinanceContent')->incNumber($financeid,$parent2id,'bonus2',$salary*$grade2);
			$bonus3 = D('FinanceContent')->incNumber($financeid,$parent3id,'bonus3',$salary*$grade3);
		}

			$c = D('FinanceContent')->getc($finance_id);
			if(!$c){
				return show(0,'更新失败，请重试！2');
			}
			// print_r($c);
			foreach ($c as $key) {
				// print_r($key[id]);
				$bonus = $key['bonus1']+$key['bonus2']+$key['bonus3'];
				$pay = $bonus + $key['salary'];

				$total_sp['total_salary']+=$key['salary'];
				$total_sp['total_bonus']+=$bonus;
				$total_sp['total_bonus1']+=$key['bonus1'];
				$total_sp['total_bonus2']+=$key['bonus2'];
				$total_sp['total_bonus3']+=$key['bonus3'];
				$total_sp['total_pay']+=$pay;

				$sp['bonus'] = $bonus;
				$sp['pay'] = $pay;
				$insertSP = D('FinanceContent')->saveSum($key['id'],$sp);
				// if(!$insertSP){
				// 	return show(0,'更新失败，请重试！3');
				// }
			}
			// print_r($total_sp);
			$total = D('Finance')->saveTotal($finance_id,$total_sp);
			// if(!$total){
			// 	return show(0,'更新失败，请重试！4');
			// }
			return show(1,'更新成功');
	}


		public function output(){
		$finance_id = $_GET['id'];
		$finance = D('Finance')->getFinanceById($finance_id);
		$c = D('FinanceContent')->getc($finance_id);
		$data = array(array('账目名称','录入人','结算周期','工资总额','奖金总额','1级奖金总额','2级奖金总额','3级奖金总额','支出总额'),

			array($finance['finance_name'],$finance['entry_people'],$finance['begin_time'].'至'.$finance['over_time'],$finance['total_salary'],$finance['total_bonus'],$finance['total_bonus1'],$finance['total_bonus2'],$finance['total_bonus3'],$finance['total_pay']),

			array('ID','账目ID','会员ID','姓名','本期工资','奖金总计','1级奖金','2级奖金','3级奖金','收入总计'));
		foreach ($c as $member) {
					$data[] = $member;
		}

				// print_r($data);exit;
		function create_xls($data,$filename){
			// print_r($data);
			ini_set('max_execution_time', '0');
			Vendor('PHPExcel');
			$filename=str_replace('.xls', '', $filename).'.xls';
			$phpexcel = new \PHPExcel();
			$phpexcel->getProperties()
			->setCreator("admin")
			->setLastModifiedBy("admin")
			->setTitle("Finance Sheet")
			->setSubject("MemberSheet")
			->setDescription("financesheet created by admin")
			->setKeywords("office Finance")
			->setCategory("Finance");
			$phpexcel->getActiveSheet()->fromArray($data);
			$phpexcel->getActiveSheet()->setTitle('Sheet1');
			$phpexcel->setActiveSheetIndex(0);
			header('Content-Type: application/vnd.ms-excel');
			header("Content-Disposition: attachment;filename=$filename");
			header('Cache-Control: max-age=0');
			header('Cache-Control: max-age=1');
    		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
   			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    		header ('Pragma: public'); // HTTP/1.0
    		$objwriter = \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    		$objwriter->save('php://output');
    		exit;

		}
		create_xls($data,$finance["finance_name"].'财务明细.xls');
	}
}