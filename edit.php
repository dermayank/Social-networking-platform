<html>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">

<!-- User details update -->
<?php
    session_start();
    require_once("connect_db.php");
    require_once("user_details.php");

    if(isloggedin()==False){
        header("Location:login");
    }
    $error_message = "";
    $current_username = $_SESSION['username'];
    userdetails($current_username);
        $not_empty = 0;
        $error_status = 0;

    if(isset($_POST['submit'])){
        $query = "UPDATE $user_table";
        unset($sql);
        if(!empty($_POST['aboutme'])){
            $sql[] = " `about` = '".$_POST['aboutme']."' ";
            $not_empty = 1;
        }
        if(!empty($_POST['passwd']) & !empty($_POST['repasswd'])){
            if($_POST['passwd'] == $_POST['repasswd']){
                $sql[] = " `password` = '".$_POST['passwd']."' ";
                $not_empty = 1;
            }
            else {
                $error_status = 1;
                $error_message = "Password doesn't match";
            }
        }
        if(!empty($_POST['profession'])){
            $sql[] = " `profession` = '".$_POST['profession']."' ";
            $not_empty = 1;
        }
        if($error_status == 0 && $not_empty == 1){
            $query .= " SET " . implode(', ', $sql). " WHERE  `username` = '$current_username' ";
            mysqli_query($conn, $query);
            $_SESSION['edit'] = "Profile updated successfully";
            header("Location:".$current_directory.'user/'.$current_username);

        }
    }
 ?>
 <!-- Profile photo upload -->
 <?php
     if(isset($_POST['submit']) && !empty($_FILES['fileToUpload']['name'])){
             $target_file = basename($_FILES["fileToUpload"]["name"]);
             $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
             if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ){
                $target_path = "images/$current_username.$imageFileType";

                $imageFileType = strtolower(pathinfo($target_path,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image

                if($_FILES["fileToUpload"]["size"] <= 1048576) {
                     move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path);
                     $query = "UPDATE $user_table SET `profilepic` = '$target_path' WHERE  `username` = '$current_username' ";
                     mysqli_query($conn, $query);
                     header("Location:".$current_directory.'user/'.$current_username);

                 } else {
                     $error_status = 1;
                     $error_message = "File size should not be exceed 100KB";
                 }
             }
             else{
                 $error_status = 1;
                 $error_message = "Only jpg, png, jpeg and gif is supported";
             }
     }
  ?>
  <!--html body -->
    <body>
        <div class="container">
            <h1>Edit Profile</h1>
          	<hr>
        	<div class="row">

<!-- photo upload left column -->
              <div class="col-md-3">
                <div class="text-center">
                  <img src="<?php echo $current_userphoto;?>" alt="Avatar" class="w3-circle" style="height:106px;width:106px" alt="Avatar">
                  <h6>Upload a different photo...</h6>
                  <div class="panel panel-default">
                      <div class="panel-body">
                          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                              <input type="file" name="fileToUpload" id="fileToUpload"></br>
                              <button type="submit" class="btn btn-primary btn-md" name="submit" >upload</button>
                          </form>
                      </div>
                  </div>
                </div>
              </div>

              <!-- edit form column -->
              <div class="col-md-9 personal-info">
                  <?php if($error_status == 1){  ?>
                  <div class="alert alert-danger">
                      <strong>Error!</strong> <?php echo $error_message; ?>
                  </div>
              <?php
              $error_status = 0;
                }?>
                  <div class="panel panel-default">
                      <div class="panel-body">
                         <h3 class="col-md-9 col-md-offset-5">Personal info:</h3></br></br>

                        <form class="form-horizontal" role="form" method="POST" action="edit.php">

                         <div class="form-group">
                           <label class="col-md-3 control-label">Username:</label>
                           <div class="col-md-8">
                             <input class="form-control" type="text" name="username" value="<?php echo $current_username; ?>" disabled>
                           </div>
                         </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label">Full name:</label>
                            <div class="col-lg-8">
                              <input class="form-control" type="text" name="fullname" value="<?php echo $current_userfullname; ?>">
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-lg-3 control-label">Email:</label>
                               <div class="col-lg-8">
                                   <input class="form-control" type="text" name="useremail" value="<?php echo $current_useremail; ?>" disabled>
                               </div>
                           </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label">Gender:</label>
                             <div class="col-lg-8">
                                  <input class="form-control" type="text" name="gender" value="<?php echo $current_usergender; ?>" disabled>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-lg-3 control-label">Profession:</label>
                             <div class="col-lg-8">
                                 <select class="form-control" id="sel1" name="profession">
                                    <option value="Student">Student</option>
                                    <option value="Professional">Professional</option>
                                  </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-3 control-label">New password:</label>
                            <div class="col-md-8">
                              <input class="form-control" type="password" name="passwd" value="">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-3 control-label">Confirm password:</label>
                            <div class="col-md-8">
                              <input class="form-control" type="password" name="repasswd" value="">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-3 control-label">About Me:</label>
                            <div class="col-md-8">
                              <textarea class="form-control rounded-0" name="aboutme" rows="4"></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary btn-md" name="submit" >Save Changes</button>
                                <button type="button" class="btn btn-default btn-md" onclick="location.href ='<?php echo $current_directory.'user/'.$current_username;?>'">Cancel</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
              </div>
          </div>
        </div>
        <hr>
    </body>
</html>
