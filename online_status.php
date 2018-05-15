<?php

if ($_SESSION["userid"])
{
 
mysql_query("UPDATE users SET lastActiveTime = NOW() WHERE userid =
$_SESSION['userid']") or die(mysql_error());
}

?> ?>
