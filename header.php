<!DOCTYPE html>
<!--
ouath v1.0beta_2019/08/04
      v1.2beta_2020/07/25
版权归属：xcsoft版权所有
联系方式：email#xcsoft.top
-->
<?php
session_start();
require_once "config.php";
if(!$_SESSION['login'])
{
  header("Refresh:0;URL=\"./login.php\"");
  exit();
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
  <!-- 标题 -->
  <title><?php echo TITLE ?> - Powered By Xcsoft</title>
  <link rel="icon" type="image/x-icon" href="https://cdn.jsdelivr.net/gh/soxft/cdn@3.0/oauth.png" />
  <!-- css/js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/soxft/cdn@master/mdui/css/mdui.min.css">
  <script src="https://cdn.jsdelivr.net/gh/soxft/cdn@master/mdui/js/mdui.min.js"></script>
</head>
<body oncontextmenu="return false" onselectstart="return false" oncopy="return false" background="https://cdn.jsdelivr.net/gh/soxft/cdn@latest/time/img/background.png" class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-loaded">
  <header class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-theme-accent">
      <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer'}">
        <i class="mdui-icon material-icons">menu</i>
        </span>
        <a href="" class="mdui-typo-title">
          <?php echo TITLE ?>
        </a>
        <div class="mdui-toolbar-spacer"></div>
  </header>
  <!-- sider -->
  <br />
  <div class="mdui-drawer" id="main-drawer">
    <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 68px;">
      <div class="mdui-list">
        <a href="./index.php" class="mdui-list-item">
          <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
          <div class="mdui-list-item-content">
            首页
          </div>
        </a>
        <a href="./article_list.php" class="mdui-list-item">
          <i class="mdui-list-item-icon mdui-icon material-icons">lists</i>
          <div class="mdui-list-item-content">
            笔记列表
          </div>
        </a>
        <a href="./logout.php" class="mdui-list-item">
          <i class="mdui-list-item-icon mdui-icon material-icons">directions_walk</i>
          <div class="mdui-list-item-content">
            登出
          </div>
        </a>
      </div>
    </div>
  </div>