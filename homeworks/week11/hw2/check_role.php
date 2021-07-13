<?php
  require_once('utils.php');
  if (empty($_SESSION['username']) || getUserRole($_SESSION['username']) !== 'admin') {
    session_destroy(); // 如果使用者從留言板來，先幫他摧毀session
    header('Location: index.php');
    exit();
  }
?>
