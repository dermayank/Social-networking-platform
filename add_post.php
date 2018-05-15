<!DOCTYPE html>
<html lang="en">
  <head>
      <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
      <style>
      ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
          opacity: 1000; /* Firefox */
        }
      </style>
  </head>
  <?php
      session_start();
      require_once("connect_db.php");
      require_once("user_details.php");

      if(isloggedin()==False){
          header("Location:login.php");
      }
      $current_username = $_SESSION['username'];

      if(isset($_POST['submit'])){
          if(!empty($_POST['post_title']) && !empty($_POST['post_body'])){
              $title = $_POST['post_title'];
              $body = $_POST['post_body'];
              $date = date("Y-m-d");
             $sql = "INSERT INTO $user_posts(`username`, `title`, `body`, `post_date`) VALUES('$current_username', '$title', '$body', '$date')";
            echo $sql;
             if(mysqli_query($conn, $sql)){
                header("Location:".$current_directory.'user/'.$current_username);
             }
          }
      }
   ?>
  <body>
      <div class="container">
          <h1>Add Post</h1><hr>

            <div class="col-sm-8 col-sm-offset-2">
                  <div class="panel panel-default">
                      <div class="panel-body">

                          <form class="form-horizontal" role="form" method="POST" action="">

                              <div class="form-group">
                                <div class="col-md-12">
                                  <input type="text" class="form-control rounded-0" name="post_title"  placeholder="Post title here" required></textarea>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-12">
                                  <textarea class="form-control rounded-0" name="post_body" rows="10" placeholder="Post Body here" required></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary btn-md" name="submit" >Save Changes</button>
                                    <button type="button" class="btn btn-default btn-md" onclick="location.href ='<?php echo $current_directory.'user/'.$current_username;?>'">Cancel</button>
                                </div>
                             </div>
                        </form>
                    </div>
                </div>
                 <!--Panel end -->
    </div>
</body>
