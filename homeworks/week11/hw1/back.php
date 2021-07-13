<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = $_SESSION['username'];    
  $role = getUserRole($username);

  //檢查身分，如非管理員則導回首頁
  if (empty($username) || $role !== 1) { 
    header('Location: index.php');
    die();
  }

  $sql = 'SELECT * FROM cmtilo_users';
  $stmt = $conn->prepare($sql);
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

  <main class='windows'>
    <div class='outer_window'>
      <div class='little_cube'>－</div>
      <h1>User Roles</h1>
      <div class='little_cube'>▼</div>
      <div class='little_cube'>▲</div>
    </div>
  
    <div class='icons'>
      <a class='icon_box' href='index.php'>
        <div><img src='img/Board.png'/></div>
        <div class='icon_word'>Message Board</div>
      </a>
    </div>
    <?php
        if (!empty($_GET['errCode'])) {
          $code = $_GET['errCode'];
          $msg = 'Error';
          if ($code === '1') {
            $msg = $msg.'Something went wrong, please try again.';
          }
          echo '<div class="err_msg">'.$msg.'</div>';
        }
      ?>
    <table>
      <tr>
        <th>Nickname</th>
        <th>Username</th>
        <th>Role</th>
        <th>Modify</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>    
        <td><?php echo escape($row['nickname']); ?></td>
        <td><?php echo escape($row['username']); ?></td>
        <td><?php 
          if (escape($row['role']) === '1') {
            echo 'Admin 🌼';
          } else if (escape($row['role']) === '2') {
            echo 'Normal 🌝';
          } else if (escape($row['role']) === '3') {
            echo 'Suspend ⛔';
          } ?></td>
        <td class='modify'>        
          <form class='change_role' method='POST' action="handle_back.php">
            <label><input type='radio' name='change_role' value='1'>Admin</label>
            <label><input type='radio' name='change_role' value='2'>Normal</label>
            <label><input type='radio' name='change_role' value='3'>Suspend</label>
            <input hidden name='id' value="<?php echo $row['id'] ?>">
            <input type='submit' value='OK'/>
          </form>
        </td>
      </tr>
      <?php } ?>    
    </table>
  </main>
  <footer>Copyright © 2021 cmtilo. All rights reserved.</footer>
</body>
</html>
