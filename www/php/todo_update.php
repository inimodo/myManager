<?php
include "access.php";
include "cors.php";
include "php.php";

$id = preg_replace('/[^0-9.\s]+/u','',$_GET['id']) ;
$connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
if(!$connection){
  die("Connection Error");
}else {
  $sqlquerry = "UPDATE `TODO` SET `STATE`='DONE' WHERE `ID`='".$id."'";
  $result = mysqli_query($connection,$sqlquerry);
}


 ?>
