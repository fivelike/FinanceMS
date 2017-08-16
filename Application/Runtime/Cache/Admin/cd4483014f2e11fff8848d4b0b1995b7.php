<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>会员管理</title>
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
        <a class="section" href="/admin.php?c=member">会员管理</a>

          <i class="right chevron icon divider"></i>
<!--           <div class="active section">编辑会员</div> -->
        </div>
      </div>
    </div>

<div class="ui grid">
  <div class="four wide column">
    <button class="ui basic button" type="button" id="button-add"><i class="add circle icon"></i> 添加会员 </button>
  </div>
  <div class="four wide column">
    <form action="/admin.php">
      <div class="ui action input">
          <input type="hidden" name="c" value="member"/>
          <input type="hidden" name="a" value="index"/>
        <input type="text" placeholder="搜索会员，ID" name="cond" value="">
        <button class="ui icon button" type="submit"><i class="search icon"></i></button>
      </div>
    </form>

  </div>

  <div class="four wide column">
  <form action="/admin.php">
    <input type="hidden" name="c" value="member"/>
    <input type="hidden" name="a" value="output"/>
    <button class="ui basic button" type="submit" id="button-output" ><i class="bar chart icon"></i> 导出Excel表格 </button>
</form>
  </div>
  <div class="four wide column"></div>
</div>

<!-- 表格 -->

<table class="ui celled table cms-table">
  <thead>
    <tr><th>序列</th>
    <th>会员名称</th>
    <th>性别</th>
    <th>会员ID</th>
    <th>加入时间</th>
    <th>上3级会员</th>
    <th>上2级会员</th>
    <th>上1级会员</th>
    <th>下1级人数</th>
    <th>下2级人数</th>
    <th>下3级人数</th>
    <th>当前状态</th>
    <th>操作</th>
  </tr></thead>
  <tbody>
  <?php if(is_array($members)): $k = 0; $__LIST__ = $members;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$member): $mod = ($k % 2 );++$k;?><tr>
      <td><?php echo ($k); ?></td>
      <td><a href="javascript:void(0)" id="cms-detail"  attr-id="<?php echo ($member["id"]); ?>"><?php echo ($member["name"]); ?></a></td>
      <td><?php echo (getSex($member["sex"])); ?></td>
      <td><?php echo ($member["memberid"]); ?></td>
      <td><?php echo ($member["jointime"]); ?></td>
      <td><?php echo ($member["parent3id"]); ?></td>
      <td><?php echo ($member["parent2id"]); ?></td>
      <td><?php echo ($member["parentid"]); ?></td>
      <td><?php echo ($member["child1number"]); ?></td>
      <td><?php echo ($member["child2number"]); ?></td>
      <td><?php echo ($member["child3number"]); ?></td>
      <td style="<?php if($member["status"] == 0): ?>color:red;<?php endif; ?>"><?php echo (getStatus($member["status"])); ?></td>
      <td>
      <button class="ui mini secondary button" id="cms-button-edit" type="button" attr-id="<?php echo ($member["id"]); ?>" attr-p="<?php echo ($page); ?>"><i class="checkmark box icon"></i></button>
        <button class="ui mini button" id="cms-button-delete" type="button" attr-id="<?php echo ($member["id"]); ?>" attr-a="member" attr-message="删除"><i class="remove icon"></i></button>
      </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </tbody>
 <!--  <tfoot>
    <tr><th colspan="13">
      <div class="ui right floated pagination menu">
        <a class="icon item">
          <i class="left chevron icon"></i>
        </a>
        <a class="item">1</a>
        <a class="item">2</a>
        <a class="item">3</a>
        <a class="item">4</a>
        <a class="icon item">
          <i class="right chevron icon"></i>
        </a>
      </div>
    </th>
  </tr></tfoot> -->
    <tfoot>
    <tr><th colspan="13">
      <div class="ui menu">
      <ul>
          <?php echo ($pageRes); ?>
        </ul>
  
      </div>
    </th>
  </tr></tfoot>
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
        'add_url' : '/admin.php?c=member&a=add',
        'edit_url' : '/admin.php?c=member&a=edit',
        'set_status_url' : '/admin.php?c=member&a=setStatus',
        // 'listorder_url' : '/admin.php?c=menu&a=listorder',
        'detail_url' : '/admin.php?c=member&a=detail',
    }

</script>
  <script src="/Public/js/dialog.js"></script>
  <script src="/Public/js/dialog/layer.js"></script>
  <script src="/Public/js/admin/common.js"></script>
</body>
</html>