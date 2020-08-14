<!DOCTYPE html>
<!--
    Data:20200814
-->
<?php 
    require_once "config.php";
    session_start();
    if($_SESSION['login'])
    {
      header("Refresh:0;URL='./index.php'");
      exit();
    }
    $_SESSION['check'] = time();
    //验证SESSION
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/soxft/cdn@master/mdui/css/mdui.min.css">
    <script src="https://cdn.jsdelivr.net/gh/soxft/cdn@master/mdui/js/mdui.min.js"></script>
    <title>
        后台登录 - <?php echo TITLE ?>
    </title>
</head>
<body background="https://cdn.jsdelivr.net/gh/soxft/cdn@1.9/urlshorting/background.png">
    <div style="Height:100px"></div>
    <div class="mdui-container" style="max-width: 600px;">
        <div class="mdui-card mdui-card-media-covered-transparent">
            <div class="mdui-card-menu">
                <button onclick="window.location.href='./'" class="mdui-btn mdui-btn-icon mdui-text-color-grey"><i class="mdui-icon material-icons">home</i>
                </button>
            </div>
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">后台登陆</div>
                <div class="mdui-card-primary-subtitle">Admin_Login</div>
            </div>
            <div id='content' class="mdui-card-content">
                <div id='emailcheck' class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">密码</label>
                    <input id="passwd" type="password" class="mdui-textfield-input" />
                </div>
                <br />
                <div class="mdui-card-actions">
                    <center>
                        <button id="submit" onclick="submit()" class="mdui-btn mdui-ripple mdui-btn-dense">登录</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <script>
    var $ = mdui.JQ;
    function submit() {
      $("#submit").text('处理中...')
      $("#submit").attr("disabled", "true");
        //构建ajax请求
        $.ajax({
          method: 'POST',
          url: './api.php',
          timeout: 20000,
          data: {
            method: 'Admin_Login',
            passwd: $('#passwd').val()
          },
          success: function(data) {
            data = eval('(' + data + ')');
            console.log(data)
            if(data['code'] == '200'){
              mdui.snackbar({
                message: '登陆成功<br/>跳转中',
                position: 'right-top',
              });
              setTimeout(function(){window.location.href='index.php'},2000)
            } else {
              mdui.snackbar({
                message: '登陆失败<br/>原因:' + data['msg'],
                position: 'right-top',
              });
            }
          },
          complete: function(xhr, textStatus) {
            if (textStatus == 'timeout') {
              mdui.snackbar({
                message: '请求超时!',
                position: 'right-top',
              });
            } else if (textStatus !== 'success') {
              mdui.snackbar({
                message: '出现未知错误,错误代码:' + textStatus,
                position: 'right-top',
              });
            }
            $("#submit").text('登录')
            $("#submit").removeAttr("disabled");
          }
        });
    }
  </script>
</body>