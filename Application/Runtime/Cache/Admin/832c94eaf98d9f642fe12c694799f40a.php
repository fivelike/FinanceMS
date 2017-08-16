<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改账目</title>
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
      <div class="active section">修改账目</div>
    </div>
  </div>
  <form id="cms-form">
    <div class ="ui attached segment">
      <div class ="ui two column grid">
        <div class="column">
          <div class="ui labeled input" style="width: 100%;">
            <div class="ui label">
              账目名称
            </div>
            <input value="<?php echo ($finance["finance_name"]); ?>" type="text" name="finance_name" placeholder="">
              <input type="hidden" name="finance_id" value="<?php echo ($finance["finance_id"]); ?>">
          </div>
        </div>

      </div>





      <div class ="ui two column grid">

        <div class="column">
          <div class="ui labeled input" style="width: 100%;">
            <div class="ui label">
              录入员
            </div>
            <input value="<?php echo ($finance["entry_people"]); ?>" type="text" name="entry_people" placeholder="">
          </div>
        </div>
      </div>


      <div class ="ui grid">
        <div class="four wide column">
          <div class="ui labeled input" style="width: 100%;">
            <div class="ui label">
              起始日期
            </div>
            <input value="<?php echo ($finance["begin_time"]); ?>" type="text" name="begin_time" placeholder="">

          </div>
        </div>

        <div class="four wide column">
          <div class="ui labeled input" style="width: 100%;">
            <div class="ui label">
              结束日期
            </div>
            <input value="<?php echo ($finance["over_time"]); ?>" type="text" name="over_time" placeholder="">

          </div>

        </div>
      </div>


      <table class="ui celled table cms-table">
        <thead>
          <tr><th>序列</th>
          <th>会员名称</th>
          <th>会员ID</th>
            <th>本期工资</th>
<!--             <th>1级奖金</th>
            <th>2级奖金</th>
            <th>3级奖金</th>
            <th>奖金总计</th>
            <th>收入总计</th> -->
          </tr></thead>
          <tbody>
            <?php if(is_array($members)): $k = 0; $__LIST__ = $members;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$member): $mod = ($k % 2 );++$k;?><tr>
                <td><?php echo ($k); ?></td>
                <td><?php echo ($member["name"]); ?></td>
                <td><?php echo ($member["memberid"]); ?></td>
                <td><input value="<?php echo ($member["salary"]); ?>" type="text" name="<?php echo ($member["memberid"]); ?>" placeholder=""></td>
<!--                 <td><?php echo ($member["salary"]); ?></td> -->
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>

          <tfoot>
            <tr><th colspan="8">
              <div class="ui menu">
                <ul>
                  <?php echo ($pageRes); ?>
                </ul>

              </div>
            </th>
          </tr></tfoot>
        </table>
      </div>



      <div class="ui attached segment">
        <button id="finance-button-submit" type="button" class="ui huge primary button">
          更新
        </button>
<!--     <div class="ui huge primary button">
      取消
    </div> -->
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
    'jump_url' : '/admin.php?c=finance',
    'save_url' : '/admin.php?c=finance&a=save',
    // 'detail_url': '/admin.php?c=member&a=detail',

  }

</script>
<script src="/Public/js/admin/common.js"></script>
</body>
</html>