<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('permission.php');//檢查權限，如session為空則導回首頁

  $username = $_SESSION['username'];
  $content = $_POST['content'];

  //如未填寫內容，導回首頁顯示錯誤訊息1
  if (empty($_POST['content'])) {
    header('Location: index.php?errCode=1');
    die();
  }
  
  $sql = "INSERT INTO cmtilo_comments(username, content) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss',$username, $content);
  $result = $stmt->execute();

  //如執行未果，導回首頁顯示錯誤訊息2
  if (!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=2');
    die($conn->error);
  }
  
  header ('Location: index.php');
?>
