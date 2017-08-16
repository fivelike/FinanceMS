<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    
    public function index(){

    	$membersCount = D('Member')->getMemberCount();
    	$month = D('Finance')->getThisMonth();
    	$payAgo = D('Finance')->getSum('total_pay');
    	$bonus1Ago = D('Finance')->getSum('total_bonus1');
    	$bonus2Ago = D('Finance')->getSum('total_bonus2');
    	$bonus3Ago = D('Finance')->getSum('total_bonus3');
    	$bonusAgo = D('Finance')->getSum('total_bonus');
    	$salaryAgo = D('Finance')->getSum('total_salary');

    	$this->assign('payAgo',$payAgo);
    	$this->assign('bonus1Ago',$bonus1Ago);
    	$this->assign('bonus2Ago',$bonus2Ago);
    	$this->assign('bonus3Ago',$bonus3Ago);
    	$this->assign('bonusAgo',$bonusAgo);
    	$this->assign('salaryAgo',$salaryAgo);

    	$this->assign('month',$month);
    	$this->assign('membersCount',$membersCount);
    	$this->display();
    }

}