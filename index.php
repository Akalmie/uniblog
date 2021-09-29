<?php
  require('config/config.php');
  $posts = get_content("posts");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('includes/head.php') ?>
  <title>Blog | Uniblog</title>
</head>
<body>
  <?php include('includes/header.php') ?>
  <div class="card-body mx-4">
    <h2 class="mb-4">Overwiew of all articles</h2>
    <?php foreach ($posts as $key => $post) { ?>
      <article class="row mb-3 rounded shadow">
        <div class="col-3 p-0 w-100"><a href="post.php?id=<?= $key ?>"><img src="<?= $post['img'] ?>" class="img-fluid rounded"></a>
        </div>
        <div class="col-sm-9 p-4">
          <h3 class="title"><a href="post.php?id=<?= $key ?>"><?= $post['title'] ?></a></h3>
          <p class="text-muted">By <a href="#"><?= $post['author'] ?></a> | <?= date('d M Y H:i', $post['created_at']) ?></p>
          <p><?= substr($post['content'],0,300) . '...' ?></p>
          <a class="btn btn-outline-primary" href="post.php?id=<?= $key ?>">Read article</a>
        </div>
      </article>
    <?php } ?>
  </div>
  <style>
    .card-body {
      margin-top: 100px;
      min-height: 100vh;
    }
  </style>
  <?php include('includes/footer.php') ?>
</body>
</html>
