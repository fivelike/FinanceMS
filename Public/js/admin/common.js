/*
添加按钮操作
 */
$("#button-add").click(function(){
	var url = SCOPE.add_url;
	window.location.href=url;
});

// /*
// 导出表格操作
// */
// $("#button-output").click(function(){
	
// });
/*
提交form表单操作
 */
$("#cms-button-submit").click(function(){
	var data = $("#cms-form").serializeArray();
	postData = {};
	var p = $(this).attr('attr-p');
	$(data).each(function(i){
		postData[this.name] = this.value;
	});

	// layer.open({
	// 	// type : 0,
	// 	title : 'Loading...',
	// 	// icon : 3,
	// 	content : "正在处理数据,请等待",

	// });


	// 将获取到的数据post给服务器
	
	url = SCOPE.save_url;
	if(p){
			jump_url = SCOPE.jump_url + '&p=' + p;
		}else{
				jump_url = SCOPE.jump_url;
		}
	$.post(url,postData,function(result){
		if (result.status == 1){
			//成功
			return dialog.success(result.message,jump_url);
		}else if (result.status == 0) {
			//失败
			return dialog.error(result.message);
		}

	},"JSON");
});

//编辑模型
$(".cms-table #cms-button-edit").on('click',function(){
	var id = $(this).attr('attr-id');
	var p = $(this).attr('attr-p');
	if(p){
		var url = SCOPE.edit_url + '&id=' + id + '&p=' + p;
	}else{
		var url = SCOPE.edit_url + '&id=' + id;
	}
	// alert(url);
	window.location.href=url;
});

//删除操作JS
$(".cms-table #cms-button-delete").on('click',function(){
	var id = $(this).attr('attr-id');
	var a = $(this).attr('attr-a');
	var message = $(this).attr('attr-message');
	var url = SCOPE.set_status_url;

	data = {};
	data['id'] = id;
	// data['status'] = -1;

	layer.open({
		type : 0,
		title : '是否提交？',
		btn : ['yes','no'],
		icon : 3,
		closeBtn : 2,
		content : "是否确定" + message,
		scrollbar : true,
		yes : function(){
			//执行相关跳转
			todelete(url, data);
		},
	});
});

function todelete(url, data){
	$.post(
		url,
		data,
		function(s){
			if(s.status == 1){
				return dialog.success(s.message,'');
				//跳转到相关页面
			}else{
				return dialog.error(s.message);
			}
		}
	,"JSON");
}

//打开详细页面
$(".cms-table #cms-detail").on('click',function(){
	var id = $(this).attr('attr-id');
	var url = SCOPE.detail_url + '&id=' + id;
	// window.location.href=url;
	window.open(url, "_blank");
});
/*
提交finance表单操作
 */
$("#finance-button-submit").click(function(){
	var data = $("#cms-form").serializeArray();
	postData = {};
	$(data).each(function(i){
		postData[this.name] = this.value;
	});


	// 将获取到的数据post给服务器
	
	url = SCOPE.save_url;
	jump_url = SCOPE.jump_url;

	layer.open({
		// type : 0,
		title : 'Loading...',
		// icon : 3,
		content : "正在处理数据,请等待",

	});

	$.post(url,postData,function(result){
		if (result.status == 1){
			//成功
			return dialog.success(result.message,jump_url);
		}else if (result.status == 0) {
			//失败
			return dialog.error(result.message);
		}

	},"JSON");
});
