<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>等级管理</title>
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
    <div class="ui one column grid">
      <div class="column">
        <div class="ui big breadcrumb">
        <a class="section" href="/admin.php?c=grade">等级管理</a>

          <i class="right chevron icon divider"></i>
<!--           <div class="active section">编辑会员</div> -->
        </div>
      </div>
    </div>


<div class="ui grid">
  <div class="four wide column">
    <button class="ui basic button" id="button-add"><i class="icon user"></i> 编辑 </button>
  </div>
</div>

<!-- 表格 -->

<table class="ui celled table">
  <thead>
    <tr><th>等级名称</th>
    <th>奖金比例</th>
    <th>备注</th>
  </tr></thead>
  <tbody>
    <tr>
      <td>1级</td>
      <td><?php echo ($grade["grade1"]); ?></td>
      <td>修改奖金比例只能影响下一次的账目统计，原先的统计将不会被更改。</td>

    </tr>
    <tr>
      <td>2级</td>
      <td><?php echo ($grade["grade2"]); ?></td>
      <td>修改奖金比例只能影响下一次的账目统计，原先的统计将不会被更改。</td>
    </tr>
        <tr>
      <td>3级</td>
      <td><?php echo ($grade["grade3"]); ?></td>
      <td>修改奖金比例只能影响下一次的账目统计，原先的统计将不会被更改。</td>
    </tr>

  </tbody>

</table>


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
        'add_url' : '/admin.php?c=grade&a=edit',
    }

</script>
  <script src="/Public/js/dialog.js"></script>
  <script src="/Public/js/dialog/layer.js"></script>
  <script src="/Public/js/admin/common.js"></script>
</body>
</html>