<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = $_SESSION['username'];
  
  $id = escape($_POST['id']);
  $title = escape($_POST['title']);
  $post = escape($_POST['post']);
  $categories = escape($_POST['categories']);

  /* 標題必填，內文可不填 */
  if (empty($_POST['title'])) {
    header('Location: Edit_post.php?errCode=1');
    die();
  }
  
  if ($username = $_SESSION['username']) {
    $sql = "UPDATE cmtilo_blog_posts SET title = ? , post = ? , categories = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $title, $post, $categories, $id);
    $result = $stmt->execute();

    if(!$result) {
      echo $conn->error;
      die($conn->error);
    }
  }
  header ('Location: index.php');
?>
