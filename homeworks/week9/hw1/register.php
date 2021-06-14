<!DOCTYPE html>
<html lang="en">
<head>
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="warning">
    <strong>本網站為練習之用！請勿使用真實世界帳號密碼</strong>
  </header>

  <main class="board">
    <div class="board_top">
      <a class="board_btn" href="index.php">回留言板</a>
      <a class="board_btn" href="login.php">登入</a>
    </div>

    <h1>註冊</h1>
    <div class="err_code">
    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $msg = 'Error';
        if ($code === '1') {
          $msg = '資料不齊全';
        } else if ($code ==='2') {
          $msg = '帳號已註冊';
        }
        echo '錯誤：'. $msg ;
      }
    ?>
    </div>

    <form class="board_comment_form" method="POST" action="handle_register.php">
      <div class="board_nickname">
        <span>暱稱</span>
        <input type="text" name="nickname"/>  
      </div>
      <div class="board_nickname">
        <span>帳號</span>
        <input type="text" name="username"/>  
      </div>
      <div class="board_nickname">
        <span>密碼</span>
        <input type="password" name="password"/>  
      </div>
      <div class="submit_btn"><input type="submit" /></div>
     
    </form>    
  </main>

</body>
</html>