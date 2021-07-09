<?php
  session_start();
  require_once('conn.php');

  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  /* Ⅰ--檢查欄位如未填寫，導回註冊頁顯示錯誤訊息1
        $nickname 跟 $username 直接檢查是否 empty
        但 $password 經過 hash 所以檢查 $_POST['password']) */
  if (empty($nickname)||
      empty($username)||
      empty($_POST['password'])) {
    header('Location: register.php?errCode=1');
    die();
  }

  // Ⅱ--處理帳號重複註冊問題
  $sql = "SELECT * FROM cmtilo_users WHERE username ='" . $username ."'";
  $result = $conn->query($sql);
  // SQL執行未果，導回註冊頁顯示錯誤訊息3
  if(!$result) {
    echo $conn->errno;
    header('Location: register.php?errCode=3');
    die('Unknown error');
  }
  // SQL執行成功，發現帳號重複，導回註冊頁顯示錯誤訊息2
  if ($result->num_rows > 0) {
    header('Location: register.php?errCode=2');
    die();
  } 
  
  // Ⅲ--執行新增使用者
  $sql = "INSERT INTO cmtilo_users(nickname, username, password) VALUES (?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $nickname, $username, $password);    
  $result = $stmt->execute();
  // 執行未果，導回顯示錯誤訊息3
  if(!$result) {
    echo $conn->errno;
    header('Location: register.php?errCode=3');
    die($conn->error);
  }

  $_SESSION['username'] = $username;
  header('Location: index.php'); // 如註冊成功直接登入
?>
