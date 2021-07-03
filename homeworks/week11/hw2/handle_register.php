<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = escape($_POST['username']);
  $password = password_hash(escape($_POST['password']), PASSWORD_DEFAULT);

  if (empty($_POST['username'])||
      empty($_POST['password'])) {
    header('Location: register.php?errCode=1');
    die();
  }


  $sql = "SELECT * FROM cmtilo_blog_users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);  
  $result = $stmt->execute();
  $stmt->store_result();
  var_dump ($stmt);


  if ($result !== false && $stmt->num_rows > 0) {
    header('Location: register.php?errCode=2');
    die();
  } else {
    $sql = "INSERT INTO cmtilo_blog_users(username, password) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);    
    $result = $stmt->execute();
    
    if(!$result) {
      echo $conn->errno;
      die($conn->error);
    }

    $_SESSION['username'] = $username;
    header('Location: index.php');
  }
?>