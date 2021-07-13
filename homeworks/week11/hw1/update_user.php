<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('permission.php');//檢查權限，如session為空則導回首頁

  $username = $_SESSION['username'];
  $nickname = $_POST['nickname'];

  // 未填則維持原暱稱，導回首頁
  if (empty($nickname)) {
    header ('Location: index.php');
    die();
  }
  //更新使用者自己的暱稱
  $sql = "UPDATE cmtilo_users SET nickname=? WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $nickname, $username);
  $result = $stmt->execute();

  //如執行未果，導回首頁顯示錯誤訊息2
  if (!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=2');
    die($conn->error);
  }

  header ('Location: index.php');
?>