// 前端登陆业务类
var login = {
	check : function(){

	// 获取用户名和密码

	var username = $('input[name="username"]').val();
	var password = $('input[name="password"]').val();

		if(!username){
			dialog.error('用户名不能为空');
		}
		if(!password){
			dialog.error('用户名不能为空');
		}

		//执行异步请求
		var url = "/admin.php?c=login&a=check";
		var data = {'username':username,'password':password};
		$.post(url,data,function(result){
			if(result.status == 0){
				return dialog.error(result.message);
			}
			if(result.status == 1){
				return dialog.success(result.message,'/admin.php?m=admin&c=index');
			}
		},'JSON');
	}

}