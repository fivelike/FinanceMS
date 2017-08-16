<?php
/**
 * 公用的方法
 */
function show($status, $message, $data=array()){
	$result = array(
		'status' => $status,
		'message' => $message,
		'data' => $data,
	);
	exit(json_encode($result));
}

function getMd5Password($password){
	return md5($password . C('MD5_PRE'));
}

function getStatus($status){
	if($status == -1){
		$str = '删除';
	}elseif ($status == 0) {
		$str = '冻结';
	}elseif ($status) {
		$str = '正常';
	}
	return $str;
}

function getSex($sex)
{
	if($sex == 1){
		$str = '男';
	}elseif ($sex == 0) {
		$str = '女';
	}
	return $str;
}

function transform($number){
	if(is_numeric($number)){
		return round($number,2);
	}
}