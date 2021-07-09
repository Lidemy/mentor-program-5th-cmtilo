<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_role.php'); // 檢查權限

  $username = $_SESSION['username'];
  $title = $_POST['title'];
  $post = $_POST['post'];
  $categories = $_POST['categories'];

  // 標題必填，如標題未填導回顯示錯誤訊息1
  if (empty($title)) {
    header('Location: new_post.php?errCode=1');
    die();
  }

  $sql = "INSERT INTO cmtilo_blog_posts(title, post, categories) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $title, $post, $categories);
  $result = $stmt->execute();
  // 如執行未果，導回首頁顯示錯誤訊息3
  if (!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=3');
    die($conn->error);
  }

  header ('Location: index.php');
?>
