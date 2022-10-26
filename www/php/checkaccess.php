<?php
function isValidToken($token)
{
  include "php.php";
  $connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
  if(!$connection){
    die("Connection Error");
  }else {
    $today = date("Y-m-d H:i:s",time()-(60*60*24));
    $newtoken = preg_replace('/[^a-zA-Z0-9\s]+/u','',$token);
    $sqlquerry = "SELECT `ID`, `TOKEN`, `STAMP` FROM `LOGIN` WHERE `TOKEN`= '".$newtoken."' AND `STAMP` > '".$today."'";
    $result = mysqli_query($connection,$sqlquerry);
    if($result == false)return false;
    $size = mysqli_num_rows($result);
    if($size ==1){
      return true;
    }
  }
  return false;
}
 ?>
