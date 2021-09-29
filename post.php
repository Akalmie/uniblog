<?php
  require('config/config.php');
  
  // Check if id is pass in URL
  if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
  }

  $posts = get_content("posts");
  $post = $posts[$_GET['id']];

  if (empty($post)) {
    header('Location: index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('includes/head.php') ?>
  <title>Article | Uniblog</title>
  <style>
    figure {
      position: relative;
      height: 250px;
      width: 100%;
      overflow: hidden;
    }
    img {
      position: absolute;
      top: 50%;
      width: 100%;
      transform: translateY(-50%);
    }
    figure:after {
      position: absolute;
      content: '';
      z-index: 1;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, .3);
    }
    .img {
      position: relative;
    }
    .back {
      position: absolute;
      z-index: 3;
      top: 20px;
      left: 45px;   
    }
    .post-title {
      position: absolute;
      z-index: 3;
      bottom: 10px;
      left: 45px
    }
  </style>
</head>
<body>
  <?php include('includes/header.php') ?>
  <div class="img">
    <div class="back">
      <a class="btn btn-primary" href="index.php">Back to home</a>
      <a class="btn btn-warning" href="postUpdate.php?id=<?= $_GET['id'] ?>">Update post</a>
      <a class="btn btn-danger" href="core/deletePost.php?id=<?= $_GET['id'] ?>">Delete post</a>
    </div>
    <figure class="mb-0">
      <img src="<?= $post['img'] ?>" alt="<?= $post['title'] ?>">
    </figure>
    <h1 class="post-title text-white"><?= $post['title'] ?></h1>
  </div>
  <article class="px-4 py-3 mx-4 shadow rounded-bottom">
    <p class="text-muted">By <a href="#"><?= $post['author'] ?></a> | <?= date('d M Y H:i', $post['created_at']) ?></p>
    <p><?= $post['content'] ?></p>
  </article>
  <?php include('includes/footer.php') ?>
</body>
</html>
