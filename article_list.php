<?php 
  require_once "header.php"; 
  $_SESSION['check'] = time();//app鉴权专用
  
  $comd = $conn->query("SELECT * FROM `content` ORDER BY TIME DESC"); 
  $list = ''; //初始化列表
  while($row = $comd->fetch_object())
  {
    $cid = $row->cid;
    $title = $row->title;
    $time = date('Y-m-d H:i:s',$row->time);
    $list .= 
       "<li id='$cid' onclick=\"edit('$cid')\" class='mdui-list-item'>
          <i class='mdui-list-item-icon mdui-icon material-icons'>dehaze</i>
          <div class='mdui-list-item-content'>
            <div class='mdui-list-item-title'>$title</div>
            <div class='mdui-list-item-text'>$time</div>
          </div>
        </li>";
  }
  if(empty($list))
  {
    //如果list为空
    $list = "<li id='none' class='mdui-list-item'>
          <div class='mdui-list-item-content'>
            <div class='mdui-list-item-title'>未找到您的笔记</div>
          </div>
        </li>";
  }
  ?>
  <div class="mdui-container">
    <h2 style="font-weight:400">操作</h2>
      <ul class="mdui-list">
        <li onclick="add()" class="mdui-list-item">
          <i class="mdui-list-item-icon mdui-icon material-icons">add</i>
          <div class="mdui-list-item-content">添加新笔记</div>
        </li>
        <!-- 新应用输入框 -->
        <div id='add_form' class="mdui-container" style="max-width: 95%;display: none;">
            <div id='passwdcheck' class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">笔记标题</label>
                <input id="title" type="text" class="mdui-textfield-input" />
            </div>
            <center>
                <button id="submit" onclick="submit()" class="mdui-btn mdui-btn-dense">确认</button>
            </center>
        </div>
    </ul>
  </div>
  <!-- 应用展示框 -->
  <div class="mdui-container">
    <h2 style="font-weight:400">我的笔记</h2>
      <ul class="mdui-list">
      <span id='titlelist'></span>
        <?php echo $list ?>
      </ul>
  </div>
  <script>
  var $ = mdui.JQ
  
  function add()
  {
    //增加输入框是否展示
    $('#add_form').toggle()
  }
  
  function edit(cid)
  {
    window.location.href="article.php?cid="+cid
  }
  
  function submit(){
    //新增应用
    title = $('#title').val();
    $("#submit").attr("disabled", "true");
    $("#submit").text('处理中...');
    $.ajax({
        url: './api.php',
        method: 'post',
        timeout: 10000,
        data: {
            method: 'article_add',
            title: title,
            check: '<?php echo $_SESSION['check'] ?>'
        },
        success: function(data) {
            //原密码验证正确
            // 含标题
            data = eval('(' + data + ')');
            //console.log(data)
            if (data['code'] == 200) {
              mdui.snackbar({
                message: '添加成功!',
                position: 'right-top',
              });
                $('#title').val(''); //清除title
                $('#none').hide(); //隐藏
                $('#titlelist').after("<li id='"+data['cid']+"' onclick=\"edit('"+ data['cid'] +"')\" class='mdui-list-item'>\
                                        <i class='mdui-list-item-icon mdui-icon material-icons'>dehaze</i>\
                                        <div class='mdui-list-item-content'>\
                                          <div class='mdui-list-item-title'>" + title + "</div>\
                                          <div class='mdui-list-item-text'>" + data['time'] + "</div>\
                                        </div>\
                                      </li>");
                //无刷新修改列表
            } else {
              mdui.snackbar({
                    message: '新增失败<br/>原因: '+data['msg'],
                    position: 'right-top',
                });
            }
        },
        complete: function(xhr, textStatus) {
          $("#submit").removeAttr("disabled");
          $("#submit").text('确认');
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
<?php require_once "footer.php"; ?>
