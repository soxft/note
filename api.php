<?php 
    session_start();
    require_once "config.php";
    header('Content-type:text/json');
    header('Access-Control-Allow-Origin:*');
    $time = time();
    //发信验证措施
    $method = $_POST['method'];
    switch($method){
        case 'Admin_Login':   
            $passwd = $_POST['passwd'];
            $comd = $conn->query("SELECT * FROM config WHERE type = 'admin_passwd'");
            $repasswd = $comd->fetch_array()['content'];
            if($repasswd == $passwd){
             $data = array('code'=> 200,'msg'=> 'SUCCESS');  
            } else {
              $data = array('code'=> 201,'msg'=> '密码错误');  
            }
            $_SESSION['login'] = true;
        break;
        case 'article_add':
            //笔记增加
            $title = $_POST['title'];
            if (preg_match("/[\\pP]/u",$title)) {
                $data = array('code'=> 1001,'msg'=> '标题不能包含特殊符号');  
            }else if(mb_strlen($title) > 20 || mb_strlen($title) < 2){
                $data = array('code'=> 1002,'msg'=> '标题应在2-20位之间');  
            }else{
            
              while(true){
                //随机生成client-id并且确保client唯一性
                $cid = randStr(20);
                $arr = $conn->query("SELECT * FROM `content` WHERE `cid` = '$cid'")->fetch_assoc();
                if(empty($arr))
                {
                  break;
                }
              }
              $conn->query("INSERT INTO `content` VALUES ('$cid','','$title','$time')");
              $data = array('code'=> 200,'msg'=> 'SUCCESS','cid' => $cid,'time'=>date('Y-m-d H:i:s'));  //创建成功
            }
        break;
        case 'article_del':
            //笔记删除
            $cid = $_POST['cid'];
            $conn->query("DELETE FROM `content` WHERE cid='$cid'");
            $data = array('code'=> 200,'msg'=> 'SUCCESS','cid' => $cid,'time'=>date('Y-m-d'));  //成功
        break;
        case 'article_save':
            //笔记删除
            $cid = $_POST['cid'];
            $content = $_POST['content'];
            $conn->query("UPDATE `content` SET content='$content' WHERE cid='$cid'");
            $data = array('code'=> 200,'msg'=> 'SUCCESS');  //成功
        break;
    }
    exit(json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
