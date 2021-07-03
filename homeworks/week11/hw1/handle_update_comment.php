<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $id = escape($_POST['id']);
  $content = escape($_POST['content']);
  $username = NULL;    
  $role = NULL;

  if(empty($_POST['content'])) {
    header('Location: update_comment.php?errCode=1&id='.$_post);
    die();
  }

  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];    
    $role = getUserRole($username);
  }

  if($username === $_SESSION['username'] || $role === '1') {
    $sql = 'UPDATE cmtilo_comments SET content=? WHERE id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $content, $id);
    $result = $stmt->execute();
    if(!$result) {
      echo $conn->error;
      die($conn->error);
    }
  }

  header('Location: index.php');

?>