<?php 
$servername = "localhost";
$username="root";
$password="";
$db_name="digital_wallet";

$mysqli = new mysqli($servername,$username,$password,$db_name);

if($mysqli->connect_error){
    echo"connection fail";
}

// echo"connected successfully";


?>