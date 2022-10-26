<?php
include "access.php";
include "cors.php";

$name = preg_replace('/[^a-zA-Z0-9äöüÖÄÜ:.\s]+/u','',$_POST['name']) ;
$till =preg_replace('/[^0-9.\s]+/u','',$_GET['lower']) ;
$date = preg_replace('/[^0-9.\s]+/u','',$_GET['upper']) ;

if(isset($_POST['save']))
{
  if(isset($id))
  {
    EditEntry($name,$till,$date,$id);
  }else{
    CreateEntry($name,$till,$date);
  }
}else
if(isset($_POST['delete']) && isset($id))
{
  DelteEntry($id);
}
header("refresh:0; url=../todo.php ");

function CreateEntry($name,$till,$date)
{
  include "php.php";
  $connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
  if(!$connection){
    die("Connection Error");
  }else {
    $id = rand(10000000,99999999);
    $sqlquerry = "INSERT INTO `TODO`(`ID`, `TEXT`, `TILL`, `DEADLINE`, `STATE`) VALUES ('".$id."','".$name."','".$till."','".$date."','OPEN')";
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
    $sqlquerry = "DELETE FROM `TODO` WHERE `ID`='".$id."'";
    $result = mysqli_query($connection,$sqlquerry);
  }
}
function EditEntry($name,$till,$date,$id)
{
  include "php.php";
  $connection = new mysqli($ucp_server_name,$ucp_server_username,$ucp_server_password,$ucp_databank);
  if(!$connection){
    die("Connection Error");
  }else {
    $sqlquerry = "UPDATE `TODO` SET `TEXT`='".$name."',`TILL`='".$till."', `DEADLINE`='".$date."' WHERE `ID`='".$id."'";
    $result = mysqli_query($connection,$sqlquerry);
  }
}

 ?>
