<?php
  require('config/config.php');

  // Check if user is logged
  if (!isset($_SESSION["user"])) {
    header('Location: login.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('includes/head.php') ?>
  <title>New article | Uniblog</title>
</head>
<body>
  <?php include('includes/header.php') ?>
  
  <div class="card-body col-6 ml-4">
    <h2 class="mb-4">New article</h2>
    <form method="POST" action="core/newPost.php">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="My new post title" required>
      </div>
      <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author" id="author" value="<?= $_SESSION["user"] ?>" required>
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" rows="3" placeholder="I'm the true darkness" required></textarea>
      </div>
      <div class="form-group">
        <label for="img">Banner </label>
        <input type="url" class="form-control" name="img" id="img" placeholder="http://..." required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">Add article</button>
      </div>
    </form>
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
