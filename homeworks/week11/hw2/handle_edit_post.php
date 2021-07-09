<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_role.php'); // 檢查權限

  $username = $_SESSION['username'];  
  $id = $_POST['id'];
  $title = $_POST['title'];
  $post = $_POST['post'];
  $categories = $_POST['categories'];

  // 檢查如 id 為空，導回首頁並顯示錯誤訊息3
  if (empty($id)) {
    header('Location: index.php?errCode=3');
    exit();
  }
  // 標題必填，如標題未填導回編輯頁並顯示錯誤訊息1
  if (empty($title)) {
    header('Location: edit_post.php?errCode=1');
    die();
  }
   
  $sql = "UPDATE cmtilo_blog_posts SET title = ? , post = ? , categories = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sssi', $title, $post, $categories, $id);
  $result = $stmt->execute();
  //如執行未果，導回並顯示錯誤訊息2
  if(!$result) {
    echo $conn->error;
    header('Location: edit_post.php?errCode=2');
    die($conn->error);
  }

  header ('Location: index.php');
?>
