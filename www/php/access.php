<?php
session_start();
$token = preg_replace('/[^a-zA-Z0-9\s]+/u','',$_GET['token']);
include "checkaccess.php";
if(isset($_GET['token']))
{
  if(!isValidToken($token)){
    die("Auth Error!");
  }
}else
{
  if(!isValidToken($_SESSION["VAR_PTOKEN"])){
    die("Auth Error!");
  }else echo '<script>function token(){return "'.$_SESSION["VAR_PTOKEN"].'";}</script>';
}
 ?>
