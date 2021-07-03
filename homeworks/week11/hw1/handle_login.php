<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = escape($_POST['username']);
  $password = escape($_POST['password']);

  /*處理錯誤1-有欄位未填*/
  if (empty($_POST['username'])||
    empty($_POST['password'])) {
    header('Location: login.php?errCode=1');
    die();
  }
  /*執行SQL語法*/
  $sql = "SELECT * FROM cmtilo_users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s',$username);
  $result = $stmt->execute();
  /*執行不成功*/
  if(!$result) {
    echo $conn->errno;
    die($conn->error);//各種不明錯誤回報
  }
  /*執行成功*/
  $result = $stmt->get_result();
  /*處理錯誤2-帳號或密碼輸入錯誤*/
  if ($result !== false && $result->num_rows == 0) {
    header ('Location: login.php?errCode=2');
    die($conn->error);
  }
  if(!password_verify($password, $row['password'])) {
    header ('Location: login.php?errCode=2');
    die($conn->error);
  }   
  if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if(password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      header ('Location: index.php');//正確登入成功回主頁
    } 
  } 
  
?>