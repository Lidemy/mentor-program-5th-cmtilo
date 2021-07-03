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
      <h1>Main</h1>
      <div class='little_cube'>▼</div>
      <div class='little_cube'>▲</div>
    </div>

    <div class='icons'>
      <a class='icon_box' href='register.php'>
        <div><img src='img/register.png'/></div>
        <div class='icon_word'>Register</div>
      </a>
      <a class='icon_box' href='login.php'>
        <div><img src='img/login.png'/></div>
        <div class='icon_word'>Login</div>
      </a>
    </div>

    <div class='warning_window'>
      <div class='window_bar'>
        <div class='tiny_cube'>－</div>
        <div class='warning_window_name'>Warning</div>
      </div>
      <div class='warning_content'>This website is for practice purposes, please DO NOT use actual account numbers and passwords.</div>
    </div>

    <form class='text_area_window' method='POST' action='handle_register.php'>
      <div class='text_area_window_name'>Register</div>
      <div class='err_msg'>
        <?php
          if(!empty($_GET['errCode'])) {
            $code = $_GET['errCode'];
            $msg = 'Error:';
            if($code === '1') {
              $msg = $msg.'Required field cannot be blank.';
            } else if ($code === '2') {
              $msg = $msg.'Account has been registered.';
            } else if ($code === '3') {
              $msg = $msg.'Unknown error.';
            }
            echo $msg;
          }
        ?>
      </div>
      <div class='register_info'>Nickname<input type='text' name='nickname'/></div>
      <div class='register_info'>Username<input type='text' name='username'/></div>
      <div class='register_info'>Password<input type='password' name='password'/></div>
      <div class='submit_btn'><input type='submit' value='Submit'/></div>
    </form>

  </main>
  <footer>Copyright © 2021 cmtilo. All rights reserved.</footer>
</body>
</html>