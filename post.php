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
  if (!empty ($_POST)){
    $ContErr = ''; 
    if (isset($_POST['submit']) && empty($_POST['content']) ){
      $ContErr = "Write Something";
    }
    $date = date_create();
    $created_at = date_timestamp_get($date);
    $updated_at = date_timestamp_get($date);
  
    $comments = new Comments();
    $comments->setContent($_POST['content']);
    $comments->setAuthor($_SESSION["user"]);
    $comments->setPostId($_GET["id"]);
    $comments->setCreatedAt($created_at);
    $comments->setUpdatedAt($updated_at);  
    add_content($comments, "comments");
    header('Location: post.php?id=' .$_GET['id']);
  }  
  $comments = get_content('comments');
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
    .card-body {
      margin-top: 100px;
      min-height: 100vh;
    }
  </style>
</head>
<body>
  <?php include('includes/header.php') ?>
  <div class="card-body">
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
  </div>
  <article class="px-4 py-3 mx-4 shadow rounded-bottom">
    <p class="text-muted">By <a href="#"><?= $post['author'] ?></a> | <?= date('d M Y H:i', $post['created_at']) ?></p>
    <p><?= $post['content'] ?></p>
    <form class="row g-3 needs-validation" novalidate method="POST"> 
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Enter commentary</label>
        <input type="text" class="form-control" name="content" id="content" required><?php echo $ContErr;?>
        <div class="valid-feedback"></div>
        <br/>
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="submit" id="submit" value="submit" name="submit">Submit</button>
      </div>
    </form>
    <?php foreach (array_reverse($comments) as $key => $comment){ ?>
    <div class="alert alert-secondary" role="alert">
      <p class="content"><?= $comment["content"] ?></p>
      <small><?= $comment["author"]?></small>
    </div>
    <?php } ?>
  </article>
  <?php include('includes/footer.php') ?>
</body>
</html>
