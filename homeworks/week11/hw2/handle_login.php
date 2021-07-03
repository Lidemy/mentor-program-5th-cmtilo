<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = escape($_POST['username']);
  $password = escape($_POST['password']);

  if (empty($_POST['username'])||
    empty($_POST['password'])) {
    header('Location: login.php?errCode=1');
    die();
  }

  $sql = "SELECT * FROM cmtilo_blog_users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s',$username);
  $result = $stmt->execute();

  if(!$result) {
    echo $conn->errno;
    die($conn->error);
  }

  $result = $stmt->get_result();

  if ($result !== false && $result->num_rows == 0) {
    header ('Location: login.php?errCode=2');
    die();
  }
  if(!password_verify($password, $row['password'])) {
    header ('Location: login.php?errCode=2');
    die()
  }
  if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if(password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      header ('Location: index.php');
    }
  }
?>