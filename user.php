<?php
    session_start();
    require_once("user_details.php");

    $current_username = $url_user;
    $user_exit = userdetails($current_username);
    if($user_exit==False)
        header("Location:".$current_directory."error");

?>

        <!-- The search bar-->
      <?php
        if(isset($_POST['search']) && !empty($_POST['search'])){
            header("Location:".$current_directory."user/".$_POST['search']);
        }
      ?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $current_directory?>css/user.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Home</a>

  <?php
    if(isloggedin()==True){?>
      <a href="<?php echo $current_directory.'logout';?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Logout">
          <span class="glyphicon glyphicon-log-out w3-margin-right"></span>
      </a>
      <a href="<?php echo $current_directory.'edit';?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Edit profile">
        <span class="glyphicon glyphicon-user"></span>
      </a>
      <a href="<?php echo $current_directory.'add_post';?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Add post">
        <span class="glyphicon glyphicon-edit"></span>
      </a>
  <?php }
  else{ ?>
      <a href="<?php echo $current_directory.'login';?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Login">
          login
      </a>
  <?php }?>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <?php if(isloggedin()==True){?>
      <a href="<?php echo $current_directory.'logout';?>" class="w3-bar-item w3-button w3-padding-large"><span class="glyphicon glyphicon-edit"> Post</span></a>
      <a href="<?php echo $current_directory.'edit';?>" class="w3-bar-item w3-button w3-padding-large"><span class="glyphicon glyphicon-user"> Edit</span></a>
      <a href="<?php echo $current_directory.'logout';?>" class="w3-bar-item w3-button w3-padding-large"><span class="glyphicon glyphicon-log-out"> Logout</span></a>
  <?php }?>
</div>


<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container"><br>
         <p class="w3-center"><img src="<?php echo $current_directory.$current_userphoto;?>" alt="Avatar" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <h5 class="w3-center"><i><?php echo "@$current_username";?></i><span class="<?php echo user_online("hello");?>"></span></h5>
         <h4 class="w3-center"><?php echo "$current_userfullname";?></h4>
         <hr>
         <p><span class="glyphicon glyphicon-user w3-margin-right "></span><?php echo "$current_usergender";?></p>
         <p><span class="glyphicon glyphicon-pencil w3-margin-right"></span><?php echo "$current_userprofession";?></p>
         <p><span class="glyphicon glyphicon-envelope w3-margin-right"></span><?php echo "$current_useremail";?></p>
        </div>
      </div>
      <br>

      <!-- Interests -->
      <div class="w3-card w3-round w3-white ">
        <div class="w3-container">
          <h4>About Me:</h4>
            <i><p>
                <?php echo $current_userabout; ?>
            </i></p>
        </div>
      </div>
      <br>

      <!-- Alert Box -->
      <?php
            if(isset($_SESSION['edit']) && !empty($_SESSION['edit'])){
      ?>
                  <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
                    <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
                      <i class="fa fa-remove"></i>
                    </span>
                    <p><strong>Hey!</strong></p>
                    <p>hello</p>
                  </div>
      <?php

            }
      ?>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-col m9">

      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity" style="display:inline;"><b>Recent Posts by: <i><?php echo "@$current_username";?></i></b></h6>
            <div class="w3-right"><form action="" method="post"><input type="text" name="search" placeholder="Search user..." /></form></div>
            </div>
          </div>
        </div>
    </div>

    <?php
        $sql = "SELECT * FROM $user_posts WHERE USERNAME = '$current_username' ORDER BY POST_DATE DESC";
        $result = mysqli_query($conn, $sql);
        if($result){
            if( mysqli_num_rows($result) >0){
                while($row =  mysqli_fetch_assoc($result)) {
                ?>
                  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                    <span class="w3-right w3-opacity"><?php echo $row['post_date']; ?></span>
                    <h4><?php echo $row['title']; ?></h4>
                    <hr class="w3-clear">
                    <p><?php echo $row['body']; ?></p>
                    <hr><button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>
                    <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button>
                  </div>
              <?php
                }
            }
        }
       ?>
    </div>

    <!-- Right Column -->


  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-l3 w3-padding-16">
</footer>


<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function showResult(str) {
  if (str.length==0) {
    document.getElementById("live_search_results").innerHTML="";
    document.getElementById("live_search_results").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>

</body>
</html>
