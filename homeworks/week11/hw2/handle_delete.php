<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_role.php'); // 檢查權限

  $id = $_GET['id'];
  $username = $_SESSION['username'];

  // 檢查如 id 為空導回首頁並顯示錯誤訊息3
  if (empty($id)) {
    header('Location: index.php?errCode=3');
    exit();
  }
  
  $sql = 'UPDATE cmtilo_blog_posts SET is_deleted=1 WHERE id=?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  // 如執行未果，導回首頁顯示錯誤訊息3
  if (!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=3');
    die($conn->error);
  }

  header('Location: index.php');
?>
