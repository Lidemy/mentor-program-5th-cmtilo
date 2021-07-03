<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = $_SESSION['username'];
  $id = escape($_GET['id']);
  $role = escape($_POST['role']);

  if($username === $_SESSION['username'] || $role === '1') {
    $sql = 'UPDATE cmtilo_users SET role=? WHERE id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $role, $id);
    $result = $stmt->execute();
    if(!$result) {
      echo $conn->error;
      die($conn->error);
    }
  }
  header('Location: back.php');

?>