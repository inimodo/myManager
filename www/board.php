<?php
session_start();
include "php/checkaccess.php";
if(!isValidToken($_SESSION["VAR_PTOKEN"])){
  $token = preg_replace('/[^a-zA-Z0-9\s]+/u','',$_GET['token']);
  if(isValidToken($token)){
    $_SESSION["VAR_PTOKEN"] = $token;
  }else die("Auth Error!");
}
?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="icon.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Fuck Off!</title>
  </head>
  <body>
    <div id="b_box">
    <div id="b_navi">
      <a href="calender.php" class="b_icon"><i class="fa fa-calendar" ></i></a>
      <a href="todo.php" class="b_icon"><i class="fa fa-book" ></i></a>
      <a href="ideas.php" class="b_icon"><i class="	fa fa-bolt" ></i></a>
    </div>
    </div>
  </body>
</html>
