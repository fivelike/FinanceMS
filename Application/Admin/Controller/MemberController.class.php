<?php
/**
 * 会员相关
 */
namespace Admin\Controller;
use Think\Controller;


class MemberController extends CommonController {
	public function index() {
		$data=array();
		$cond = $_GET['cond'];
		if($cond && is_numeric($cond)) {
			$data['memberid'] = intval($cond);
		}

		if($cond && !is_numeric($cond)){
			$data['name'] = $cond;
		}

		// 分页操作逻辑
		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1 ;
		$pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 12 ;
		$members = D('Member')->getMembers($data,$page,$pageSize);
		$membersCount = D('Member')->getMemberCount($data);


		$res = new \Think\Page($membersCount,$pageSize);
		$pageRes = $res->show();
		$this->assign('page',$page);
		$this->assign('pageRes',$pageRes);
		$this->assign('members',$members);
		$this->display();

	}


	public function add(){
		// print_r($_POST);
		if($_POST){
			if (!isset($_POST['name']) || !$_POST['name']) {
				return show(0,'姓名不能为空');
			}


			//edit 跳入

			if($_POST['id']){
				return $this->save($_POST);
			}


			if (!isset($_POST['memberid']) || !$_POST['memberid']) {
				return show(0,'会员ID不能为空');
			}else{
				$ret = D('Member')->getParent($_POST['memberid']);
				if($ret){
					return show(0,'会员ID已存在');
				}
			}

			if (!is_numeric($_POST['memberid'])) {
				return show(0,'会员ID需为数字组合');
			}
			if (isset($_POST['parentid']) &&$_POST['parentid']&&!is_numeric($_POST['parentid'])) {
				return show(0,'推荐人ID需为数字组合');
			}


			if($_POST['parentid']){           //输入推荐人不为空
				// 在表中查询推荐人是否存在
				$ret1 = D('Member')->getParent($_POST['parentid']);

				if(!$ret1){
					return show(0,'推荐人ID不存在');
				}else{
				//推荐人存在，上2级会员parent2id=$ret1['parentid']    
					$ret2 = D('Member')->getParent($ret1['parentid']);
				// print_r($ret2);
				// 上三级parent3id=$ret2['parentid']

					$_POST['parent2id'] = $ret1['parentid'];
					$_POST['parent3id'] = $ret2['parentid'];

				}
			}else{
				$_POST['parentid'] = null;
				$_POST['parent2id'] = null;
				$_POST['parent3id'] = null;

			}
			//判断向上的三级会员是否存在，存在的在相应的下级会员数量中加1
			$c1=1;$c2=1;$c3=1;

			if($_POST['parentid']){
				$c1 = D('Member')->incChildNumber($_POST['parentid'],'child1number');
			}

			if($_POST['parent2id']){
				$c2 = D('Member')->incChildNumber($_POST['parent2id'],'child2number');
			}

			if($_POST['parent3id']){
				$c3 = D('Member')->incChildNumber($_POST['parent3id'],'child3number');
			}

			$id = D('Member')->insert($_POST);

			if($id&&$c1&&$c2&&$c3){
				return show(1,'新增会员成功',$id);

			}else{
				return show(0,'新增失败',$id);
			}

		}else{
			$this->display();
		}
	}


	public function edit(){
		$id = $_GET['id'];
		$p = $_GET['p'];
		// print_r($p);
		$member = D('Member')->find($id);
		$this->assign('p',$p);
		$this->assign('member',$member);
		$this->display();
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		try{
			$retId = D('Member')->updateMemberById($id,$data);
			if($retId === false){
				return show(0,'更新失败');
			}
			return show(1,'更新成功');
		}catch(Exception $e){
			return show(0,$e->getMessage());
		}
	}

	public function setStatus(){
		try{
			if($_POST){
				$id = $_POST['id'];
				// $status = $_POST['status'];
				//对要删除的数据进行校验，有下级会员的不能删除，删除会员的同时将其上级会员对应的下级会员数量减1
				$member = D('Member')->find($id);
				// print_r($member);
				if($member['child1number'] != 0){
					return show(0,'该会员已有下级会员，不能删除');
				}else{
					//没有下级会员，即最下层会员，可以删除,上级的下级会员数减1
					$ret1 = D('Member')->getParent($member['parentid']); // 上1级
					$ret2 = D('Member')->getParent($ret1['parentid']);//上2级

					$ret3 = D('Member')->getParent($ret2['parentid']);//上3级

// print_r($ret1);
					$c1=1;$c2=1;$c3=1;

					if($ret1){
						$c1 = D('Member')->decChildNumber($ret1['memberid'],'child1number');
					}
					if($ret2){
						$c2 = D('Member')->decChildNumber($ret2['memberid'],'child2number');
					}
					if($ret3){
						$c3 = D('Member')->decChildNumber($ret3['memberid'],'child3number');
					}


					//执行数据更新操作
					$res = D('Member')->updateStatusById($id);

					if($res&&$c1&&$c2&&$c3){
						return show(1,'删除成功');
					}else{
						return show(0,'删除失败');
					}
				}
				
			}
		}catch(Exception $e){
			return show(0,$e->getMessage());
		}
		return show(0,'没有提交的数据');	
	}

	public function detail(){
		$id = $_GET['id'];
		$member = D('Member')->find($id);

		$child1 = D('Member')->getChild('parentid',$member['memberid']);
		$child2 = D('Member')->getChild('parent2id',$member['memberid']);
		$child3 = D('Member')->getChild('parent3id',$member['memberid']);

		$parent = D('Member')->getParent($member['parentid']);
		// print_r($parent);
		// print_r($child1);
		// print_r($child2);
		// print_r($child3);
		$this->assign('parent',$parent);
		$this->assign('member',$member);
		$this->assign('child1',$child1);
		$this->assign('child2',$child2);
		$this->assign('child3',$child3);

		$this->display();
	}




	public function output(){

		$members = D('Member')->getXls();
		$data = array(array('ID','姓名','会员ID','推荐人','上2级','上3级','下1级人数','下2级人数','下3级人数','状态','支付宝','联系方式','QQ','性别','微信','备注','加入时间'));
		foreach ($members as $member) {
					$data[] = $member;
		}

				// print_r($data);exit;
		function create_xls($data,$filename='会员列表.xls'){
			// print_r($data);
			ini_set('max_execution_time', '0');
			Vendor('PHPExcel');
			$filename=str_replace('.xls', '', $filename).'.xls';
			$phpexcel = new \PHPExcel();
			$phpexcel->getProperties()
			->setCreator("admin")
			->setLastModifiedBy("admin")
			->setTitle("Member Sheet")
			->setSubject("MemberSheet")
			->setDescription("membersheet created by admin")
			->setKeywords("office Member")
			->setCategory("Member");
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
		create_xls($data);
	}
}