<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>会员详情</title>
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
      <a class="section" href="/admin.php?c=member">会员管理</a>

      <i class="right chevron icon divider"></i>
      <div class="active section">详细信息</div>
    </div>
  </div>

  <div class ="ui attached segment center aligned">
<table class="ui celled striped table">
  <thead>
    <tr class="center aligned"><th colspan="6"><?php echo ($member["name"]); ?>的详细信息</th>
  </tr></thead>
  <tbody>
    <tr>
      <td class="collapsing"><i class="user icon"></i> 姓名 </td>
      <td> <?php echo ($member["name"]); ?></td>
      <td class="collapsing"><i class="info circle icon"></i>会员ID</td>
      <td><?php echo ($member["memberid"]); ?></td>
      <td class="collapsing"><i class="male icon"></i> 性别 </td>
      <td> <?php echo (getSex($member["sex"])); ?></td>
    </tr>

    <tr>
      <td class="collapsing"><i class="wait icon"></i> 加入时间 </td>
      <td> <?php echo ($member["jointime"]); ?></td>
      <td class="collapsing"><i class="qq icon"></i> QQ </td>
      <td> <?php echo ($member["qq"]); ?></td>
      <td class="collapsing"><i class="wechat icon"></i> 微信</td>
      <td> <?php echo ($member["wechat"]); ?></td>

    </tr>
    <tr>
    <td class="collapsing"><i class="yen icon"></i> 支付宝 </td>
      <td> <?php echo ($member["paynumber"]); ?></td>
      <td class="collapsing"><i class="call icon"></i> 联系方式 </td>
      <td> <?php echo ($member["phone"]); ?></td>
      <td class="collapsing" ><i class="user icon"></i> 状态</td>
      <td style="<?php if($member["status"] == 0): ?>color:red;<?php endif; ?>"> <?php echo (getStatus($member["status"])); ?></td>

    </tr>
        <tr>
    <td class="collapsing"><i class="user icon"></i> 推荐人 </td>
      <td> <?php echo ($parent["name"]); ?></td>
      <td class="collapsing"><i class="info circle icon"></i> 推荐人ID </td>
      <td> <?php echo ($parent["memberid"]); ?></td>
      <td class="collapsing" ><i class="user icon"></i> 推荐人状态</td>
      <td style="<?php if($parent["status"] == 0): ?>color:red;<?php endif; ?>"> <?php echo (getStatus($parent["status"])); ?></td>

    </tr>
    <td class="collapsing"><i class="write icon"></i> 备注 </td>
      <td colspan="5"> <?php echo ($member["info"]); ?></td>
    </tr>
  </tbody>
</table>
  
  <h4 class="ui horizontal divider header"><i class="bar chart icon"></i> 推荐会员</h4>

  <div class="ui styled accordion" style="width: 100%">
    <div class="title"><i class="dropdown icon"></i> 下1级会员（<?php echo ($member["child1number"]); ?>人） </div>
    <div class="content">
<!--     <p>共计<?php echo ($member["child1number"]); ?>人</p> -->
      <table class="ui celled table">
    <thead>
          <tr><th>会员ID</th>
            <th>姓名</th>
            <th>性别</th>
            <th>加入时间</th>
            <th>下1级人数</th>
            <th>下2级人数</th>
            <th>下3级人数</th>
            <th>状态</th>
          </tr></thead>
          <tbody>
           <?php if(is_array($child1)): $i = 0; $__LIST__ = $child1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo ($child["memberid"]); ?></td>
              <td><?php echo ($child["name"]); ?></td>
              <td><?php echo (getSex($child["sex"])); ?></td>
              <td><?php echo ($child["jointime"]); ?></td>
              <td><?php echo ($child["child1number"]); ?></td>
              <td><?php echo ($child["child2number"]); ?></td>
              <td><?php echo ($child["child3number"]); ?></td>
      <td style="<?php if($child["status"] == 0): ?>color:red;<?php endif; ?>"> <?php echo (getStatus($child["status"])); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>

        </table>
    </div>

    <div class="title"><i class="dropdown icon"></i> 下2级会员（<?php echo ($member["child2number"]); ?>人） </div>
    <div class="content">
<!--           <p>共计<?php echo ($member["child2number"]); ?>人</p> -->
            <table class="ui celled table">
        <thead>
          <tr><th>会员ID</th>
            <th>姓名</th>
            <th>性别</th>
            <th>加入时间</th>
            <th>下1级人数</th>
            <th>下2级人数</th>
            <th>下3级人数</th>
            <th>状态</th>


          </tr></thead>
          <tbody>
           <?php if(is_array($child2)): $i = 0; $__LIST__ = $child2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo ($child["memberid"]); ?></td>
              <td><?php echo ($child["name"]); ?></td>
              <td><?php echo (getSex($child["sex"])); ?></td>
              <td><?php echo ($child["jointime"]); ?></td>
              <td><?php echo ($child["child1number"]); ?></td>
              <td><?php echo ($child["child2number"]); ?></td>
              <td><?php echo ($child["child3number"]); ?></td>
      <td style="<?php if($child["status"] == 0): ?>color:red;<?php endif; ?>"> <?php echo (getStatus($child["status"])); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>

        </table>

    </div>
    <div class="title"><i class="dropdown icon"></i> 下3级会员（<?php echo ($member["child3number"]); ?>人） </div>
    <div class="content">      
<!--                 <p>共计<?php echo ($member["child3number"]); ?>人</p> -->
    <table class="ui celled table">
        <thead>
          <tr><th>姓名</th>
            <th>会员ID</th>
            <th>性别</th>
            <th>加入时间</th>
            <th>下1级人数</th>
            <th>下2级人数</th>
            <th>下3级人数</th>
            <th>状态</th>

          </tr></thead>
          <tbody>
           <?php if(is_array($child3)): $i = 0; $__LIST__ = $child3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo ($child["memberid"]); ?></td>
              <td><?php echo ($child["name"]); ?></td>
              <td><?php echo (getSex($child["sex"])); ?></td>
              <td><?php echo ($child["jointime"]); ?></td>
              <td><?php echo ($child["child1number"]); ?></td>
              <td><?php echo ($child["child2number"]); ?></td>
              <td><?php echo ($child["child3number"]); ?></td>
       <td style="<?php if($child["status"] == 0): ?>color:red;<?php endif; ?>"> <?php echo (getStatus($child["status"])); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>

        </table> 
    </div>
  </div>

  </div>










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
  $('.ui.accordion').accordion('refresh');
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
        'jump_url' : '/admin.php?c=member',
        'save_url' : '/admin.php?c=member&a=add',

  }

</script>
  <script src="/Public/js/admin/common.js"></script>
</body>
</html>