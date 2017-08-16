<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

    public function index(){

    	if(session('adminUser')!=null){
    		$this->redirect('/admin.php?c=index');
    	}
    	$this->display();
    }

    public function check(){
    	// print_r($_POST);

    	//对数据进行强校验
    	$username = $_POST['username'];
    	$password = $_POST['password'];

    	if(!trim($username)){
    		return show(0,"用户名不能为空");
    	}
    	if(!trim($password)){
    		return show(0,"密码不能为空");
    	}

    	$ret = D('Admin')->getAdminByUsername($username);
    	// print_r(getMd5Password($ret['password']));
    	if(!$ret){
    		return show(0,'该用户不存在');
    	}

    	if ($ret['password'] != getMd5Password($password)) {
    		return show(0,'密码错误');
    	}


    	session('adminUser', $ret);
    	// print_r(isset($_SESSION['adminUser']));
    	return show(1,'登陆成功');

    }

    public function logout(){
    	session('adminUser',null);
    	$this->redirect('/admin.php?c=login');
    }

}