<?php
include "access.php";
include "cors.php";

$day = preg_replace('/[^0-9.\s]+/u','',$_GET['d']);
$month = preg_replace('/[^0-9.\s]+/u','',$_GET['m']);
$year = preg_replace('/[^0-9.\s]+/u','',$_GET['y']);

if(isset($_GET['d']))
{
    include "php.php";
    $connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
    if(!$connection){
      die("Connection Error");
    }else {
      $date = $year.".".$month.".".$day;
      $sqlquerry = "SELECT `ID`, `TEXT`, `DATE`, `CAT` FROM `CALENDER` WHERE `DATE`='".$date."'";
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
}else
{
  include "php.php";
  $connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
  if(!$connection){
    die("Connection Error");
  }else {
    $sqlquerry = "SELECT `ID`, `TEXT`, `DATE`, `CAT` FROM `CALENDER` WHERE MONTH(DATE) = '".$month."' AND YEAR(DATE) = '".$year."'";
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
}






 ?>
