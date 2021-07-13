<?php
  session_start();
  require_once('conn.php');

  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // 有欄位未填寫
  if (empty($username)|| empty($_POST['password'])) {
    header('Location: register.php?errCode=1');
    die();
  }

  $sql = "SELECT * FROM cmtilo_blog_users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);  
  $result = $stmt->execute();
  $stmt->store_result();
  // 執行未果，導回首頁
  if (!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=3');
    die($conn->error);
  }
  // 帳號重複註冊
  if ($stmt->num_rows > 0) {
    header('Location: register.php?errCode=2');
    die();
  } 
  
  $sql = "INSERT INTO cmtilo_blog_users(username, password) VALUES (?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $password);    
  $result = $stmt->execute();
  // 執行未果，導回首頁
  if (!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=3');
    die($conn->error);
  }

  $_SESSION['username'] = $username;
  header('Location: index.php');
?>
