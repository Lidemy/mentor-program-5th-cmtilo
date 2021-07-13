<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $id = $_POST['id'];
  $change_role = $_POST['change_role'];
  $username = $_SESSION['username'];  
  $role = getUserRole($username);
  echo  $change_role;

  // 檢查身分，如非管理員則導回首頁
  if (empty($username) || $role !== 1) { 
    header('Location: index.php');
    die();
  }
  //如 id 或 $change_role 為空，導回後台頁面並顯示錯誤訊息1
  if (empty($id) || empty($change_role)) {
    header('Location: back.php?errCode=1');
    die();
  }
  
  $sql = 'UPDATE cmtilo_users SET role=? WHERE id=?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $change_role, $id);
  $result = $stmt->execute();
  if(!$result) {
    echo $conn->error;
    die($conn->error);
  }

  header('Location: back.php');
?>
