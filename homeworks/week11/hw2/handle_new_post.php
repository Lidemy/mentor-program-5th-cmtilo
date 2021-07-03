<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = $_SESSION['username'];

  $title = escape($_POST['title']);
  $post = escape($_POST['post']);
  $categories = escape($_POST['categories']);

  /* 標題必填，內文可不填 */
  if (empty($_POST['title'])) {
    header('Location: new_post.php?errCode=1');
    die();
  }
  
  if ($username = $_SESSION['username']) {
    $sql = "INSERT INTO cmtilo_blog_posts(title, post, categories) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $title, $post, $categories);
    $result = $stmt->execute();

    if(!$result) {
      echo $conn->error;
      die($conn->error);
    }
  }
  header ('Location: index.php');
?>
