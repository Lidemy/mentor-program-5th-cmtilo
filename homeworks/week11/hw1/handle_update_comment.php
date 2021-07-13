<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('permission.php');//檢查權限，如session為空則導回首頁

  $id = $_POST['id'];
  $content = $_POST['content'];
  $username = $_SESSION['username'];    
  $role = getUserRole($username);

  //如id 或 content 為空，導回編輯留言頁並顯示錯誤訊息1
  if(empty($id) || empty($content)) {
    header('Location: update_comment.php?errCode=1&id='.$id);
    die();
  }

  //如為管理員，可以編輯對應 id 的文章
  if($role === 1) {
    $sql = 'UPDATE cmtilo_comments SET content=? WHERE id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $content, $id);
  } else {
    //如為使用者，可以編輯自己的文章（對應 id 及 username）
    $sql = 'UPDATE cmtilo_comments SET content=? WHERE id= ? AND username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sis', $content, $id, $username);
  }
  $result = $stmt->execute();

  //如執行未果，導回首頁顯示錯誤訊息2
  if(!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=2');
    die($conn->error);
  }

  header('Location: index.php');
?>
