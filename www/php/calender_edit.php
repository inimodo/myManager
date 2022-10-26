<?php
include "access.php";
include "cors.php";
$name = preg_replace('/[^a-zA-Z0-9äöüÖÄÜ:.\s]+/u','',$_POST['name']) ;
$prio = preg_replace('/[^a-zA-Z\s]+/u','',$_POST['prio']);
$date =preg_replace('/[^0-9.\s]+/u','',$_GET['date']) ;
$id = preg_replace('/[^0-9.\s]+/u','',$_GET['id']) ;
if(isset($_POST['save']))
{
  if(isset($_GET['id']))
  {
    EditEntry($id,$name,$prio);
  }else{
    CreateEntry($name,$prio,$date);
  }
}else
if(isset($_POST['delete']) && isset($_GET['id']))
{
  DelteEntry($id);
}
header("refresh:0; url=../calender.php ");

function CreateEntry($n_name, $n_prio,$n_date)
{
  include "php.php";
  $connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
  if(!$connection){
    die("Connection Error");
  }else {
    $id = rand(10000000,99999999);
    $sqlquerry = "INSERT INTO `CALENDER`(`ID`, `TEXT`, `DATE`, `CAT`) VALUES ('".$id."','".$n_name."','".$n_date."','".$n_prio."')";
    $result = mysqli_query($connection,$sqlquerry);
  }
}
function DelteEntry($id)
{
  include "php.php";
  $connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
  if(!$connection){
    die("Connection Error");
  }else {
    $sqlquerry = "DELETE FROM `CALENDER` WHERE `ID`='".$id."'";
    $result = mysqli_query($connection,$sqlquerry);
  }
}
function EditEntry($id,$n_name, $n_prio)
{
  include "php.php";
  $connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
  if(!$connection){
    die("Connection Error");
  }else {
    $sqlquerry = "UPDATE `CALENDER` SET `TEXT`='".$n_name."',`CAT`='".$n_prio."' WHERE `ID`='".$id."'";
    $result = mysqli_query($connection,$sqlquerry);
  }
}

 ?>
