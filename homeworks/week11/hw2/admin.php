<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_role.php'); // 檢查權限

  $username = $_SESSION['username'];
  $sql = 'SELECT * FROM cmtilo_blog_posts WHERE is_deleted = 0 ORDER BY id DESC';
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute();
  // 如執行未果，導回首頁顯示錯誤訊息3
  if (!$result) {
    echo $conn->error;
    header('Location: index.php?errCode=3');
    die($conn->error);
  }
  $result = $stmt->get_result();
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
      <div class="admin-posts">
        <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="admin-post">
          <div class="admin-post__title">
          <a href="post.php?id=<?php echo escape($row['id']); ?>">
            <?php echo escape($row['title']); ?>
          </a>
          </div>
          <div class="admin-post__info">
            <div class="admin-post__created-at">
              <?php echo escape($row['created_at']); ?>
            </div>
            <?php if ($user === 'admin') { ?>            
            <a class="admin-post__btn" href="edit_post.php?id=<?php echo escape($row['id']); ?>">
              編輯
            </a>
            <a class="admin-post__btn" href="handle_delete.php?id=<?php echo escape($row['id']); ?>">
              刪除
            </a>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>