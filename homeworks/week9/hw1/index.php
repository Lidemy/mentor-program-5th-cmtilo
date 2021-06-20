<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  $result = $conn->query("select * from cmtilo_comments order by id desc");
  if(!$result) {
    die("Error:".$conn->error);
  }

  /*$username = NULL;
  if(!empty($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
  }
  */
?>


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
      <?php if(!$username) { ?>
        <a class="board_btn" href="register.php">註冊</a>
        <a class="board_btn" href="login.php">登入</a>
      <?php } else { ?>
        <a class="board_btn" href="logout.php">登出</a>
      <?php } ?>      
    </div>
    <h1 class="sign">⧉</h1>
    <h1>comments</h1>
    <div class="hi">Hi！<?php echo $username; ?>... post your comments here…</div>
    <div class="err_code">
    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $msg = 'Error';
        if ($code === '1') {
          $msg = '資料不齊全';
        }
        echo '錯誤：'. $msg ;
      }
    ?>
    </div>

    <form class="board_comment_form" method="POST" action="handle_add_post.php">

      <textarea name="content" rows="5"></textarea>
      <br/>

      <?php if ($username) { ?>
        <div class="submit_btn"><input type="submit" /></div>
      <?php } else { ?>
        <h3>請登入以發布留言</h3>
      <?php } ?>
     
    </form>

    <div class="board_hr"></div>
    <section id="comments_card">
      <?php
        while ($row = $result->fetch_assoc()){ ?>
    
      <div class="card">
        <div class="card_avatar"></div>
        <div class="card_body">
          <div class="card_info">
            <span class="card_author">
              <?php echo $row['nickname']; ?>
            </span><br/>
            <span class="card_time">
              <?php echo $row['created_at']; ?>
            </span>
          </div class="card_content">
          <p>
            <?php echo $row['content']; ?>
          </p>
        </div>        
      </div>


      <?php } ?>

    </section>  
    <h1>⧉</h1>
    
  </main>

</body>
</html>