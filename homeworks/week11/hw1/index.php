<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  $user = NULL;
  $role = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];    
    $user = getUserFromUsername($username);
    $role = getUserRole($username);
  }

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  $per_page = 5;
  $start = ($page - 1) * $per_page;
  $end = $start + $per_page ;
  $sql = 'SELECT '.
          'C.id AS id, C.content AS content, C.created_at AS created_at, '.
          'U.nickname AS nickname, U.username AS username '.
          'FROM cmtilo_comments AS C '.
          'LEFT JOIN cmtilo_users AS U on C.username = U.username '.
          'WHERE C.is_deleted IS NULL '.
          'ORDER BY C.id DESC '.
          'LIMIT ? , ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $start, $end);
  $result = $stmt->execute();
  if (!$result) {
    die('Error:'.$conn->error);
  }
  $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Message Board</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class='outer_window'>
      <div class='little_cube'>－</div>
      <h1>Message Board</h1>
      <div class='little_cube'>▼</div>
      <div class='little_cube'>▲</div>
  </div>
  <div class='outer_window_functionlist'>
      <div class='outer_functionlist'><span>F</span>ile</div>
      <div class='outer_functionlist'><span>O</span>ptions</div>
      <div class='outer_functionlist'><span>W</span>indow</div>
      <div class='outer_functionlist'><span>H</span>elp</div>
  </div>
  <div class='games_window'>
    <div class='games_window_bar'>
      <div class='tiny_cube'>－</div>
      <div class='games_window_name'>Games</div>
      <div class='tiny_cube'>▼</div>
      <div class='tiny_cube'>▲</div>
    </div>
    <div class='games_window_content'></div>
  </div>

  <main class='windows'>
    <div class='outer_window'>
      <div class='little_cube'>－</div>
      <h1>Main</h1>
      <div class='little_cube'>▼</div>
      <div class='little_cube'>▲</div>
    </div>
    <!--功能按鈕-->
    <div class='icons'>
      <?php if (!$username) { ?>
        <a class='icon_box' href='register.php'>
          <div><img src='img/register.png'/></div>
          <div class='icon_word'>Register</div>
        </a>
        <a class='icon_box' href='login.php'>
          <div><img src='img/login.png'/></div>
          <div class='icon_word'>Login</div>
        </a>
      <?php } else { ?>
        <a class='icon_box update_nickname'>
          <div><img src='img/nickname.png'/></div>
          <div class='icon_word'>Change Nickname</div>
        </a>
        <a class='icon_box' href='logout.php'>
          <div><img src='img/logout.png'/></div>
          <div class='icon_word'>Logout</div>
        </a>
        <?php if ($role === 1) { ?>
          <br/>
          <a class='icon_box' href='back.php'>
            <div><img src='img/back.png'/></div>
            <div class='icon_word'>User Roles</div>
          </a>
        <?php } ?>
      <?php } ?>
    </div>
    <!--改暱稱視窗-->
    <div class='hide changing_window'>
      <div class='window_bar'>
        <div class='tiny_cube'>－</div>
        <div class='warning_window_name'>Change Nickname</div>
      </div>
      <form class='change_nickname' method='POST' action='update_user.php'>
          <input type='text' name='nickname'/>
          <div class='update_nickname'><br/><input type='submit' value='Submit'/></div>
      </form>
    </div>
    <!--左方警告視窗-->
    <div class='warning_window'>
      <div class='window_bar'>
        <div class='tiny_cube'>－</div>
        <div class='warning_window_name'>Warning</div>
      </div>
      <div class='warning_content'>This website is for practice purposes, please DO NOT use actual account numbers and passwords.</div>
    </div>
    <!--新增留言輸入區-->
    <form class='text_area_window' method='POST' action='handle_add_post.php'>
      <div class='text_area_window_name'> Type your message here ...</div>
      <div class='text_area'><textarea name='content' rows='8'  placeholder='Typing...'></textarea></div>
      <?php
        if (!empty($_GET['errCode'])) {
          $code = $_GET['errCode'];
          $msg = 'Error';
          if ($code === '1') {
            $msg = $msg.'Required field cannot be blank.';
          } else if ($code === '2') {
            $msg = $msg.'Something went wrong, please try again.';
          }
          echo '<div class="err_msg">'.$msg.'</div>';
        }
      ?>      
      <?php if (!$username) { ?>
        <div class='submit_btn'>
          Please Login
        </div>
      <?php } else if ($role === 3) { ?>
        <div class='submit_btn'>
          You have been suspended
        </div>
      <?php } else { ?>
        <div class='submit_btn'><input type='submit' value='Submit'/></div>
      <?php } ?>
    </form>
    <!--下方顯示留言-->
    <?php while ($row = $result->fetch_assoc()) { ?>
    <div class='message_window'>
      <div class='window_bar'>
        <div class='tiny_cube'>－</div>
        <div class='window_name'><?php echo escape($row['nickname']).' (@'.escape($row['username']).')'; ?></div>
        <div class='tiny_cube'>▼</div>
        <div class='tiny_cube'>▲</div>
      </div>
      <?php if($row['username'] === $username || $role === 1) { ?>
      <div class='window_functionlist'>
        <a class='functionlist' href="update_comment.php?id=<?php echo $row['id'] ?>"><span>E</span>dit</a>
        <a class='functionlist' href="delete_comment.php?id=<?php echo $row['id'] ?>"><span>D</span>elete</a>
      </div>
      <?php } ?>
      <div class='massage_content'><?php echo escape($row['content']); ?></div>
      <div class='window_ststus_bar'>
        <div class='ststus'><?php echo escape($row['created_at']); ?></div>
        <div class='ststus'><?php echo 'Length:' . mb_strlen( $row['content'], "utf-8"); ?></div>
      </div>    
    </div>
    <?php } ?>
    <!--分頁按鈕-->
    <div class='pages'>
      <?php
        $stmt = $conn->prepare('SELECT COUNT(id) AS count FROM cmtilo_comments WHERE is_deleted IS NULL' );
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];        
        $total_page = ceil($count / $per_page);
      ?>
      
      <?php if ($page != 1) { ?>
        <a href='index.php?page=1'>&nbsp;First&nbsp;</a>
        <a href='index.php?page=<?php echo $page - 1 ?>'>&nbsp;Previous&nbsp;</a>
      <?php } ?>
      <?php echo $page ?> / <?php echo $total_page ?>  
      <?php if ($page != $total_page) { ?>
        <a href='index.php?page=<?php echo $page + 1 ?>'>&nbsp;Next&nbsp;</a>
        <a href='index.php?page=<?php echo $total_page ?>'>&nbsp;Last&nbsp;</a>
      <?php } ?>
    </div>
  </main>

  <footer>Copyright © 2021 cmtilo. All rights reserved.</footer>
  <script>
    const btn = document.querySelector('.update_nickname')
    btn.addEventListener('click', function() {
      const form = document.querySelector('.changing_window')
      form.classList.toggle('hide')
    })
  </script>
</body>
</html>