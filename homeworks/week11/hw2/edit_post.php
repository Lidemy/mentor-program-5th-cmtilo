<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_role.php'); // 檢查權限

  $id = $_GET['id'];
  $username = $_SESSION['username'];

  // 檢查如 id 為空導回首頁並顯示錯誤訊息3
  if (empty($id)) {
    header('Location: index.php?errCode=3');
    exit();
  }

  $sql = 'SELECT * FROM cmtilo_blog_posts WHERE is_deleted = 0 AND id = ' . $id;
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute();
  if (!$result) {
    die('Error:'.$conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php include("navbar.php"); ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_edit_post.php" method="POST">
          <div class="edit-post__title">
            發表文章：
          </div>
          <div class="edit-post__input-wrapper">
            <input class="edit-post__input" value="<?php echo escape($row['title']); ?>" name="title" required/>
            
          </div>
          <div class="edit-post__input-wrapper">
            <textarea rows="20" class="edit-post__content" name="post" ><?php echo escape($row['post']); ?>
            </textarea>
          </div>
          <div class="edit-post__input-wrapper">
            <input class="edit-post__input" value="<?php echo escape($row['categories']); ?>" name="categories" />
          </div>
          <div class="edit-post__btn-wrapper">
            <?php
              if (!empty($_GET['errCode'])) {
                $code = $_GET['errCode'];
                $msg = 'Error';
                if ($code === '1') {
                  $msg = '標題不可為空白';
                } else if ($code === '2') {
                  $msg = '錯誤！請稍後再試';
                }
                echo '<br/><div class="err_msg">'.$msg.'</div>';
              }
            ?>
            <input hidden value=<?php echo escape($row['id']); ?> name="id" />
            <input class="edit-post__btn" type='submit' value='送出'/>
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>
