<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('permission.php');//檢查權限，如session為空則導回首頁

  $id = $_GET['id'];
  $username = $_SESSION['username'];
  
  //如 id 為空，導回首頁並顯示錯誤訊息2
  if(empty($id)) {
    header('Location: index.php?errCode=2');
    die();
  }

  $sql = 'SELECT * FROM cmtilo_comments WHERE id = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();

  //如執行未果，導回首頁顯示錯誤訊息2
  if(!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=2');
    die($conn->error);
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
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
      <h1>Program Manager</h1>
      <div class='little_cube'>▼</div>
      <div class='little_cube'>▲</div>
  </div>
  <div class='outer_window_functionlist'>
      <div class='outer_functionlist'><span>F</span>ile</div>
      <div class='outer_functionlist'><span>O</span>ptions</div>
      <div class='outer_functionlist'><span>W</span>indow</div>
      <div class='outer_functionlist'><span>H</span>elp</div>
  </div>
  <main class='windows'>
    <div class='outer_window'>
      <div class='little_cube'>－</div>
      <h1>Main</h1>
      <div class='little_cube'>▼</div>
      <div class='little_cube'>▲</div>
    </div>

    <form class='text_area_window' method='POST' action='handle_update_comment.php'>
      <div class='text_area_window_name'>Edit your message</div>
      <div class='text_area'>
        <textarea name='content' rows='8'><?php echo escape($row['content']) ?></textarea>
      </div>
      <input type='hidden' name='id' value="<?php echo escape($row['id']) ?>" />
      <?php
      if (!empty($_GET['errCode'])) {
        $code = $GET['errCode'];
        $msg = 'Error';
        if ($code === '1') {
          $msg = $msg.'Required field cannot be blank.';
        }
        echo '<div class="err_msg">'.$msg.'</div>';
      }
      ?>
      <div class='submit_btn'><input type='submit' value='Submit'/></div>   
    </form>
  </main>
  <footer>Copyright © 2021 cmtilo. All rights reserved.</footer>
</body>
</html>