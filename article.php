<?php 
  require_once "header.php"; 
  $cid = $_GET['cid'];  
  $_SESSION['check'] = time();//app鉴权专用
  @$arr = $conn->query("SELECT * FROM `content` WHERE cid='$cid'")->fetch_object();
  if(empty($cid) || empty($arr))
  {
    header("Refresh:0;URL=\"index.php\"");
    exit();
  }else{
    $title = $arr->title;
    $time = date("Y-m-d H:i:s",$arr->time);
    $content = $arr->content;
  }
?>
<style>
#del{
  width: 45%;
}
#save{
  width: 45%;
}
</style>
<div class="mdui-container" style='max-width:95%'>
  <div class="mdui-card mdui-card-media-covered-transparent">
      <div class="mdui-card-primary">
        <div class="mdui-card-primary-title"><?php echo $title ?></div>
        <div class="mdui-card-primary-subtitle"><?php echo $time ?></div>
          <div class="mdui-textfield">
            <textarea rows="15" class='mdui-textfield-input' id="input"><?php echo $content ?></textarea>
          </div>
      </div>
    </div>
    <div style='height:20px'></div>
    <div class="mdui-card mdui-card-media-covered-transparent">
      <div style='height:12px'></div>
        <center>
          <button id='del' onclick='del()' class="mdui-btn mdui-btn-raised mdui-ripple">删除笔记</button>&emsp;<button id='save' onclick='save();' class="mdui-btn mdui-btn-raised mdui-ripple">保存并返回</button>
        </center>
      <div style='height:12px'></div>
    </div>
</div>

  <!-- 加载 -->
  <div id='loading' style="position: absolute;margin: auto;top: 0;left: 0;right: 0;bottom: 0;display: none;width: 50px;height: 50px" class="mdui-spinner mdui-spinner-colorful"></div>
  
<script>
var $ = mdui.JQ;

function del() {
    //编辑应用
    mdui.confirm('你确定要删除该笔记吗,此操作不可逆!', function() {
        $.showOverlay(); //遮罩
        $('#loading').show();

        $.ajax({
            url: './api.php',
            method: 'post',
            timeout: 10000,
            data: {
                method: 'article_del',
                cid: '<?php echo $cid ?>',
                check: '<?php echo $_SESSION['check'] ?>'
            },
            success: function(data) {
                //console.log(data)
                data = eval('(' + data + ')');
                if (data['code'] == '200') {
                    mdui.snackbar({
                        message: '笔记删除成功',
                        position: 'right-top',
                    });
                    setTimeout(function() {
                        window.location.href = './article_list.php'
                    }, 1000); //跳转
                } else {
                    mdui.snackbar({
                        message: '出现错误<br/>错误信息:' + data['msg'],
                        position: 'right-top',
                    });
                }
            },
            complete: function(xhr, textStatus) {
                setTimeout(function() {
                    $.hideOverlay();
                }, 100); //隐藏遮罩
                $('#loading').hide();
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
            }
        });
    });
}

function save() {
    //编辑应用
        $.showOverlay(); //遮罩
        $('#loading').show();
      
        $.ajax({
            url: './api.php',
            method: 'post',
            timeout: 10000,
            data: {
                method: 'article_save',
                cid: '<?php echo $cid ?>',
                content: $('#input').val(),
                check: '<?php echo $_SESSION['check'] ?>'
            },
            success: function(data) {
                //console.log(data)
                data = eval('(' + data + ')');
                if (data['code'] == '200') {
                    mdui.snackbar({
                        message: '笔记保存成功',
                        position: 'right-top',
                    });
                    setTimeout(function() {
                        window.location.href = './article_list.php'
                    }, 1000); //跳转
                } else {
                    mdui.snackbar({
                        message: '出现错误<br/>错误信息:' + data['msg'],
                        position: 'right-top',
                    });
                }
            },
            complete: function(xhr, textStatus) {
                setTimeout(function() {
                    $.hideOverlay();
                }, 100); //隐藏遮罩
                $('#loading').hide();
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
            }
        });
}
</script>
<div style='height:10px'></div>
<?php require_once "footer.php"; ?>
