<?php
include "access.php";
include "cors.php";
include "php.php";

$connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
if(!$connection){
  die("Connection Error");
}else {
  $sqlquerry = "SELECT * FROM `TODO` WHERE 1";
  $result = mysqli_query($connection,$sqlquerry);
  $size = mysqli_num_rows($result);
  echo "[";
  if($size > 0){
    for ($index=0; $index < $size; $index++) {
        $conntent = mysqli_fetch_assoc($result);
        if($index == $size-1)
        {
          echo json_encode($conntent);
        }else
        {
          echo json_encode($conntent).",";
        }
    }
  }
  echo "]";
}

 ?>
