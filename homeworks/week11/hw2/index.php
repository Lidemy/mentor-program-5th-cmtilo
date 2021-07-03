<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  $sql = 'SELECT * FROM cmtilo_blog_posts WHERE is_deleted = 0 ORDER BY id DESC';
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute();
  if (!$result) {
    die('Error:'.$conn->error);
  }
  $stmt->store_result();
  // 分頁功能
  $per = 5; //每頁顯示5篇  
  $total_posts = $stmt->num_rows(); //總篇數  
  $pages = ceil($total_posts/$per); //總頁數
  $page = 1; 
  if (!empty($_GET["page"])){
    $page = intval($_GET["page"]);
  }
  $start = ($page-1) * $per;
  $end = $start + $per ;

  $sql = $sql.' LIMIT '.$start.', '.$end;
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute();
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
  
  <?php include_once("navbar.php"); ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>

  <div class="container-wrapper">
    <div class="posts">
      <?php while ($row = $result->fetch_assoc()) { ?>
      <article class="post">
        <div class="post__header">
          <div><?php echo escape($row['title']); ?></div>
          <div class="post__actions">
            <?php if (!empty($_SESSION['username'])) { ?>
            <a class="post__action" href="edit_post.php?id=<?php echo escape($row['id']); ?>">編輯</a>
            <?php } ?>
          </div>
        </div>
        <div class="post__info">
          <?php echo escape($row['created_at']); ?>
        </div>
        <div class="post__content"><?php echo mb_substr(escape($row['post']), 0, 150); ?>
        
        </div>
        <a class="btn-read-more" href="post.php?id=<?php echo escape($row['id']); ?>">READ MORE</a>
      </article>
      <?php } ?>
      
      <?php
        //分頁
        $pre = $page - 1;
        $next = $page + 1;        
      ?>
      <div class="page">
      <?php        
        if ($pre < $page && $pre >= 1) {
          echo "<a class='btn-page' href=index.php?page=".$pre.">上一頁</a>";
        }
        if ($next > $page && $next <= $pages) {
          echo "<a class='btn-page' href=index.php?page=".$next.">下一頁</a>";
        }
      ?>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>
