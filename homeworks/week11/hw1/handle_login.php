<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  // 如有欄位未填，導回登入頁顯示錯誤訊息1
  if (empty($username) || empty($password)) {
    header('Location: login.php?errCode=1');
    die();
  }
  // 執行SQL語法
  $sql = "SELECT * FROM cmtilo_users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s',$username);
  $result = $stmt->execute();

  // SQL執行未果，導回登入頁顯示錯誤訊息2
  if(!$result) {
    echo $conn->errno;
    header('Location: login.php?errCode=2');
    die($conn->error);
  }

  // SQL執行成功拿取結果
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  // 影響0列或密碼錯誤，導回登入頁顯示錯誤訊息2
  if ($result->num_rows == 0 ||
      !password_verify($password, $row['password'])) {
    header ('Location: login.php?errCode=2');
    die($conn->error);
  }

  // 登入成功回主頁
  if ($result->num_rows > 0 &&
      password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    header ('Location: index.php');
  }
?>
