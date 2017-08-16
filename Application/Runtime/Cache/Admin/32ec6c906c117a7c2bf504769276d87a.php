<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>登陆界面</title>
  <link rel="stylesheet" href="/Public/css/semantic.min.css">
  <link rel="stylesheet" href="/Public/css/icon.min.css">
  <script src="/Public/js/jquery.min.js"></script>
  <script src="/Public/js/semantic.min.js"></script>
  <script src="/Public/js/dialog/layer.js"></script>
  <script src="/Public/js/dialog.js"></script>
  <script src="/Public/js/admin/login.js"></script>
</head>
<body>
<div class="ui container">
  <h2 class="ui center aligned icon header">
    <i class="circular users icon"></i> 
    财务会员管理系统 
  </h2>
  <div class="ui column middle aligned relaxed fitted stackable grid">
  <div class="column">
    <div class="ui form segment">
      <div class="field">
        <label>用户名</label>
        <div class="ui left icon input">
          <input type="text" placeholder="用户名" name="username"> 
          <i class="user icon"></i>
        </div>
      </div>
      <div class="field">
        <label>密码</label>
        <div class="ui left icon input">
          <input type="password" placeholder="密码" name="password">
          <i class="lock icon"></i>
        </div>
      </div>
      <button class="ui blue submit button" type="button" onclick="login.check()">登陆</button>
    </div>
  </div>

</div>
</div>

</body>
</html>