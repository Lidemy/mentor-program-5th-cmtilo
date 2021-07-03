<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = $_SESSION['username'];
  $content = escape($_POST['content']);

  if (empty($_POST['content'])) {
    header('Location: index.php?errCode=1');
    die();
  }
  
  if($username === $_SESSION['username']) {
    $sql = "INSERT INTO cmtilo_comments(username, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss',$username, $content);
    $result = $stmt->execute();

    if(!$result) {
      die($conn->error);
    }
  }
  header ('Location: index.php');
?>
