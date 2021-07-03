<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $id = escape($_GET['id']);
  $username = NULL;    
  $role = NULL;

  if (empty($_GET['id'])) {
    echo 'Error';
    die();
  }

  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];    
    $role = getUserRole($username);
  }

  if($username === $_SESSION['username'] || $role === '1') {
    $sql = 'UPDATE cmtilo_comments SET is_deleted=1 WHERE id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    if (!$result) {
      echo $conn->error;
      die($conn->error);
    }
  }

  header('Location: index.php');
?>