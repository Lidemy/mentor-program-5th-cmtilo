<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php'); 

  $username = $_SESSION['username'];
  $nickname = escape($_POST['nickname']);

  /*未填則維持原暱稱*/
  if (empty($_POST['nickname'])) {
    header ('Location: index.php');
    die();
  }

  if($username === $_SESSION['username'] ) {
    $sql = "UPDATE cmtilo_users SET nickname=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nickname, $username);
    $result = $stmt->execute();
    if (!$result) {
      echo $conn->error;
      die($conn->error);// 錯誤回報
    }
  }
  header ('Location: index.php');
?>