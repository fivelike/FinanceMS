<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>等级编辑</title>
 <link rel="stylesheet" href="/Public/css/semantic.min.css">
  <link rel="stylesheet" href="/Public/css/icon.min.css">
  <script src="/Public/js/jquery.min.js"></script>
  <script src="/Public/js/semantic.min.js"></script>
</head>
<body>
<!-- sidebar -->
<div class="ui sidebar left inverted vertical menu">
<!--   <div class="header item">
    <img src="image/logo.jpg">
  </div> -->
  <a class="item" href="/admin.php?c=index"><i class="home icon"></i> 首页 </a>
  <a class="item" href="/admin.php?c=member&a=index"><i class="user icon"></i> 会员管理 </a>
  <a class="item" href="/admin.php?c=grade&a=index"><i class="block layout icon"></i> 等级管理 </a>
  <a class="item" href="/admin.php?c=finance"><i class="smile icon"></i> 财务管理 </a>
</div>

<!-- 主体 -->
<div class="ui container">
	<div class="ui menu">
		<div class="ui item huge header"><p>欢迎使用财务会员管理系统</p></div>
		<div class="right menu">
			<div class="item">
				<div class="ui primary button">个人中心</div>
			</div>
			<div class="item"><a href="/admin.php?c=login&a=logout"><div class="ui primary button">退出</div></a></div>
		</div>
	</div>

	<div class="ui top attached segment">

		<div class="ui big breadcrumb">
			<a class="section" href="/admin.php?c=grade">等级管理</a>

			<i class="right chevron icon divider"></i>
			<div class="active section">编辑</div>
		</div>
	</div>
	<form id="cms-form">
		<div class ="ui attached segment">
			<div class ="ui one column grid">
				<div class="column">
					<h4>&nbsp;&nbsp;请以小数形式编辑奖金比例</h4>
				</div>
				<div class="column">
					<div class="ui labeled input" style="width: 50%;">
						<div class="ui label">
							1级
						</div>
						<input type="text" name="grade1" placeholder="" value="<?php echo ($grade["grade1"]); ?>">
					</div>
				</div>
				<div class="column">
					<div class="ui labeled input" style="width: 50%;">
						<div class="ui label">
							2级
						</div>
						<input type="text" name="grade2" placeholder="" value="<?php echo ($grade["grade2"]); ?>">
					</div>
				</div>

				<div class="column">
					<div class="ui labeled input" style="width: 50%;">
						<div class="ui label">
							3级
						</div>
						<input type="text" name="grade3" placeholder="" value="<?php echo ($grade["grade3"]); ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="ui attached segment">
			<button id="cms-button-submit" type="button" class="ui huge primary button">
				更新
			</button>
		</div>
	</form>

</div>



<!-- sidebar button -->
    <button class="ui black button animated" tabindex="0" onclick="toggle()" style="  position: fixed; top: 60px; left: 0px;">
      <div class="visible content">

        <i class="list layout icon"></i>
      </div>
        <div class="hidden content">
        菜单
      </div>
    </button>
</div>



<script>
function toggle() {
    $('.ui.sidebar').sidebar({
        // context: 'body',
        dimPage : true,
        // onVisible: function() {
        //     $('body').click(function(e){
        //         this.unbind(e);
        //     });
        // },
        // onShow: function() {
        //     $('.ui.sidebar').css("z-index",999);
        // },
        // onHide: function() {
        //     $('.ui.sidebar').css("z-index",1);
        // }
    }).sidebar('toggle');
}


</script>
<script>

  var SCOPE = {
        'jump_url' : '/admin.php?c=grade',
        'save_url' : '/admin.php?c=grade&a=save',

  }
</script>
  <script src="/Public/js/dialog.js"></script>
  <script src="/Public/js/dialog/layer.js"></script>
  <script src="/Public/js/admin/common.js"></script>
</body>
</html>