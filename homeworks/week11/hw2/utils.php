<?php
  require_once('conn.php');

  function getUserFromUsername($username) {
    global $conn;
    $sql = "SELECT * FROM cmtilo_blog_users WHERE username = '". $username . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }  
?>