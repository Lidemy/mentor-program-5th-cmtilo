<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $nickname = escape($_POST['nickname']);
  $username = escape($_POST['username']);
  $password = escape(password_hash($_POST['password'], PASSWORD_DEFAULT));

  /*處理錯誤1-有欄位未填*/
  if (empty($_POST['nickname'])||
      empty($_POST['username'])||
      empty($_POST['password'])) {
    header('Location: register.php?errCode=1');
    die();
  }

  /*處理錯誤2-帳號重複註冊*/
  $sql = "SELECT * FROM cmtilo_users WHERE username ='" . $username ."'";
  $result = $conn->query($sql);

  if(!$result) {
    echo $conn->errno;
    die();//其他各種不明錯誤回報
  }
  if ($result !== false && $result->num_rows > 0) {
    header('Location: register.php?errCode=2');
    die('');//帳號重複註冊
  } else {
    /* 執行新增使用者 */
    $sql = "INSERT INTO cmtilo_users(nickname, username, password) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nickname, $username, $password);    
    $result = $stmt->execute();
    
    if(!$result) {
      echo $conn->errno;
      die($conn->error);//其他各種不明錯誤回報
    }

    $_SESSION['username'] = $username;
    header('Location: index.php');//如註冊成功直接登入
  }

?>