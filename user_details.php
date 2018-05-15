<?php
    require_once("connect_db.php");
    $current_directory =  'http://'.$_SERVER['SERVER_NAME'].'/login/';

    function userdetails($current_username){
        Global $current_userfullname,$current_useremail,$current_usergender,$current_userprofession;
        Global $current_userabout, $current_userphoto,$conn,$user_table;

        $sql = "SELECT * FROM $user_table WHERE `username` = '$current_username'";
        $result = mysqli_query($conn, $sql);
        if( mysqli_num_rows($result) >0){
            $row = mysqli_fetch_array($result);
            $current_userfullname = $row['fullname'];
            $current_useremail = $row['email'];
            $current_usergender = $row['gender'];
            $current_userprofession = $row['profession'];
            $current_userabout = $row['about'];
            $current_userphoto = $row['profilepic'];

            return true;
        }
        else{
            return false;
        }
    }

    function isloggedin(){
        if(isset($_SESSION['username']) && isset($_SESSION['state'])){
            if(!empty($_SESSION['username']) && !empty($_SESSION['state'])){
                if($_SESSION['state'] == 1){
                    return true;
                }
            }
        }
        return false;
    }

    function user_online($user_name){
        return "offline_dot";
        //return "<span class="offline_dot"></span>";
    }

?>
<script>
    update();
    function update()
    {
        //alert("hello");
        $.post("online_status.php");// Sends request to update.php each and every 5 seconds
    }
    setInterval("update()", 5000);
</script>
