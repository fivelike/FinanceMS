<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑会员</title>
 <link rel="stylesheet" href="/Public/css/semantic.min.css">
 <link rel="stylesheet" href="/Public/css/icon.min.css">
 <script src="/Public/js/jquery.min.js"></script>
 <script src="/Public/js/semantic.min.js"></script>
   <script src="/Public/js/dialog/layer.js"></script>
  <script src="/Public/js/dialog.js"></script>
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
      <a class="section" href="/admin.php?c=member&a=index&p=<?php echo ($p); ?>">会员管理</a>

      <i class="right chevron icon divider"></i>
      <div class="active section">编辑会员</div>
    </div>
  </div>
<form id="cms-form">
  <div class ="ui attached segment">
    <div class ="ui two column grid">
      <div class="column">
        <div class="ui labeled input" style="width: 100%;">
          <div class="ui label">
            姓名
          </div>
          <input type="text" name="name" placeholder="" value="<?php echo ($member["name"]); ?>">
        </div>
      </div>
      <div class="column">
        <div class="ui labeled input" style="width: 100%;">
          <div class="ui label">
            支付宝号
          </div>
          <input type="text" name="paynumber" placeholder="" value="<?php echo ($member["paynumber"]); ?>">
        </div>
      </div>
    </div>



    <div class ="ui two column grid">
      <div class="column">
        <div class="ui labeled input" style="width: 100%;">
          <div class="ui label">
            QQ
          </div>
          <input type="text" name="qq" value="<?php echo ($member["qq"]); ?>">
        </div>
      </div>
      <div class="column">
       
        <div class="ui labeled input" style="width: 100%;">
          <div class="ui label">
            微信
          </div>
          <input type="text" name="wechat" value="<?php echo ($member["wechat"]); ?>">
        </div>
      </div>
    </div>

    <div class ="ui two column grid">
      <div class="column">
        <div class="ui labeled input" style="width: 100%;">
          <div class="ui label">
            联系电话
          </div>
          <input type="text" name="phone" value="<?php echo ($member["phone"]); ?>">
        </div>
      </div>
      <div class="column">
        <div class="ui labeled input" style="width: 100%;">
          <div class="ui label">
            加入时间
          </div>
          <input type="text" name="jointime" placeholder="" value="<?php echo ($member["jointime"]); ?>">
        </div>
      </div>
    </div>

    <div class ="ui four column grid">
      <div class="column">
       <div class="inline fields">
        <label class="ui label">性别:</label>
        <div class="field">
          <div class="ui radio checkbox">
            <input type="radio" name="sex" value="1" <?php if($member["sex"] == 1): ?>checked<?php endif; ?>>
            <label>男</label>
          </div>
        </div>
        <div class="field">
          <div class="ui radio checkbox">
            <input type="radio" name="sex" value="0" <?php if($member["sex"] == 0): ?>checked<?php endif; ?>>
            <label>女</label>
          </div>
        </div>
      </div>
    </div>
    <div class="column">
     <div class="inline fields">
      <label class="ui label">状态:</label>
      <div class="field">
        <div class="ui radio checkbox">
          <input type="radio" name="status" <?php if($member["status"] == 1): ?>checked<?php endif; ?> value="1">
          <label>正常</label>
        </div>
      </div>
      <div class="field">
        <div class="ui radio checkbox">
          <input type="radio" name="status" <?php if($member["status"] == 0): ?>checked<?php endif; ?> value="0">
          <label>冻结</label>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="ui one column grid">
      <div class="column">
        <div class="ui label">
          备注
        </div>
        <textarea name="info" cols=40 rows=4><?php echo ($member["info"]); ?></textarea>
      </div>
</div>

  <input type="hidden" name="id" value="<?php echo ($member["id"]); ?>">
  <div class="ui attached segment">
    <button id="cms-button-submit" attr-p="<?php echo ($p); ?>" type="button" class="ui huge primary button">
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
        'jump_url' : '/admin.php?c=member&a=index',
        'save_url' : '/admin.php?c=member&a=add',

  }

</script>
  <script src="/Public/js/admin/common.js"></script>
</body>
</html>