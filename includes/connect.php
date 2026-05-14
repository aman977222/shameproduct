<?php

$con=mysqli_connect('localhost','root','','mystore');
if(!$con){
    die("Connection error: ".
    mysqli_connect_error($con));
}//else{
    //echo"Connection successful";}

?>