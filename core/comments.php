<?php
 require('config/config.php');
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <?php include('includes/head.php') ?>
    <title>Uniblog</title>
  </head> 
  <body>
    <?php include('includes/header.php') ?>
    <div class="news">
      <form action = "#" class="row g-3 needs-validation" novalidate method="POST"> 
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Enter commentary</label>
          <input type="text" class="form-control" name="content" id="content" required><?php echo $ContErr;?>
          <div class="valid-feedback"></div>
          <br/>
          <div class="col-12">
            <button class="btn btn-primary" type="submit" id="submit" value="submit" name="submit">Submit</button>
          </div>
          </div>
        </form>
    </div>
    <?php
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
        $comments->setCreatedAt($created_at);
        $comments->setUpdatedAt($updated_at);
        
        add_content($comments, "comments");
        get_content ('comments');          
  
        include('includes/footer.php'); 
    ?>
  </body>
</html>