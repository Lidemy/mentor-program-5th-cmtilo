<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $id = $_GET['id'];
  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];    
    $user = getUserFromUsername($username);
  }

  $sql = 'SELECT * FROM cmtilo_blog_posts WHERE id = '. $id;
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
    <div class="posts">
      <article class="post">
        <div class="post__header">
          <div><?php echo escape($row['title']); ?></div>
          <div class="post__actions">
            <?php if (!empty($_SESSION['username'])) { ?>
              <a class="post__action" href="edit_post.php?id=<?php echo escape($row['id']); ?>">編輯</a>
            <?php } ?>
          </div>
        </div>
        <div class="post__info"><?php echo escape($row['created_at']); ?>
        </div>
        <div class="post__content"><?php echo escape($row['post']); ?>
        </div>
        <br/>

        <div class="post__categories">
          分類：<?php echo escape($row['categories']); ?>
        </div>
        
      </article>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>
