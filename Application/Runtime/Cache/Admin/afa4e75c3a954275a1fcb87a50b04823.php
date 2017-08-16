<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查看明细</title>
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
      <a class="section" href="/admin.php?c=finance">财务管理</a>

      <i class="right chevron icon divider"></i>
      <div class="active section">查看明细</div>
    </div>
  </div>

    <div class="four wide column">
  <form action="/admin.php">
    <input type="hidden" name="c" value="finance"/>
    <input type="hidden" name="a" value="output"/>
    <input type="hidden" name="id" value="<?php echo ($financeid); ?>">
    <button style="margin-top: 10px" class="ui basic button" type="submit" id="button-output" ><i class="bar chart icon"></i> 导出Excel表格 </button>
</form>
  </div>



      <table class="ui celled table cms-table">
        <thead>
          <tr><th>序列</th>
          <th>会员名称</th>
          <th>会员ID</th>
            <th>本期工资</th>
            <th>1级奖金</th>
            <th>2级奖金</th>
            <th>3级奖金</th>
            <th>奖金总计</th>
            <th>收入总计</th>
          </tr></thead>
          <tbody>
            <?php if(is_array($members)): $k = 0; $__LIST__ = $members;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$member): $mod = ($k % 2 );++$k;?><tr>
                <td><?php echo ($k); ?></td>
                <td><?php echo ($member["name"]); ?></td>
                <td><?php echo ($member["memberid"]); ?></td>
                <td><?php echo ($member["salary"]); ?></td>
                <td><?php echo ($member["bonus1"]); ?></td>
                <td><?php echo ($member["bonus2"]); ?></td>
                <td><?php echo ($member["bonus3"]); ?></td>
                <td><?php echo ($member["bonus"]); ?></td>
                <td><?php echo ($member["pay"]); ?></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>

          <tfoot>
            <tr><th colspan="9">
              <div class="ui menu">
                <ul>
                  <?php echo ($pageRes); ?>
                </ul>

              </div>
            </th>
          </tr></tfoot>
        </table>
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
    // 'jump_url' : '/admin.php?c=finance',
    // 'save_url' : '/admin.php?c=finance&a=add',
    'detail_url': '/admin.php?c=member&a=detail',

  }

</script>
<script src="/Public/js/admin/common.js"></script>
</body>
</html>