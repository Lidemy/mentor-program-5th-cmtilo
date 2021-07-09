<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('permission.php');//檢查權限，如session為空則導回首頁

  $id = $_GET['id'];
  $username = $_SESSION['username'];    
  $role = getUserRole($username);

  //如id為空，導回首頁顯示錯誤訊息1
  if (empty($_GET['id'])) {
    header('Location: index.php?errCode=1');
    die();
  }
  //如為管理員，可以刪除對應 id 的文章
  if($role === 1) {
    $sql = 'UPDATE cmtilo_comments SET is_deleted=1 WHERE id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
  } else {
    //如為使用者，可以刪除自己的文章（對應 id 及 username）
    $sql = 'UPDATE cmtilo_comments SET is_deleted=1 WHERE id= ? AND username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $id, $username);
  }

  $result = $stmt->execute();
  //如執行未果，導回首頁顯示錯誤訊息2
  if (!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=2');
    die($conn->error);
  }

  header('Location: index.php');
?>
