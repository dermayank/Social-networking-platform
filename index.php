<?php

    $request  = str_replace("/login/", "", $_SERVER['REQUEST_URI']);
    $params  = explode("/", $request);
    $safe_pages = array("user", "login", "register", "edit", "logout","add_post","test");

      if(in_array($params[0], $safe_pages)) {
          if($params[0]==$safe_pages[0]){
            $url_user = $params[1];
            include_once($params[0].".php");
          }
          else {
              include_once($params[0].".php");
          }
      } else {
          include_once("error.php");
      }

?>
