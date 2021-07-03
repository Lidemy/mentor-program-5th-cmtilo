<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $id = escape($_GET['id']);
  $username = $_SESSION['username'];

  if (empty($_GET['id'])) {
    echo 'Error';
    die();
  }
  
  if ($username = $_SESSION['username']) {
    $sql = 'UPDATE cmtilo_blog_posts SET is_deleted=1 WHERE id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    if (!$result) {
      echo $conn->error;
      die($conn->error);
    }
  }

  header('Location: admin.php');
?>