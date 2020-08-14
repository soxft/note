<?php 
  require_once "header.php"; 
  $article_num = $conn->query("select count(*) from content")->fetch_array()[0];
?>
<div class="mdui-container">
  <h2 style="font-weight:400">基础信息</h2>
  <ul class="mdui-list">
        <li class="mdui-list-item mdui-ripple">
      <i class="mdui-list-item-icon mdui-icon material-icons">grain</i>
      <div class="mdui-list-item-content">
        笔记篇数: <?php echo $article_num ?>篇
      </div>
    </li>
    <li class="mdui-list-item mdui-ripple">
      <i class="mdui-list-item-icon mdui-icon material-icons">panorama_vertical</i>
      <div class="mdui-list-item-content">
        PHP: <?PHP echo PHP_VERSION; ?>
      </div>
    </li>
    <li class="mdui-list-item mdui-ripple">
      <i class="mdui-list-item-icon mdui-icon material-icons">airplay</i>
      <div class="mdui-list-item-content">
        系统: <?PHP echo php_uname('s'); ?>
      </div>
    </li>
    <li class="mdui-list-item mdui-ripple">
      <i class="mdui-list-item-icon mdui-icon material-icons">web</i>
      <div class="mdui-list-item-content">
        服务端: <?PHP echo $_SERVER['SERVER_SOFTWARE']; ?>
      </div>
    </li>
    <li class="mdui-list-item mdui-ripple">
      <i class="mdui-list-item-icon mdui-icon material-icons">dns</i>
      <div class="mdui-list-item-content">
        主机名: <?PHP echo php_uname('n');  ?>
      </div>
    </li>
  </ul>
</div>
<?php require_once "footer.php"; ?>
