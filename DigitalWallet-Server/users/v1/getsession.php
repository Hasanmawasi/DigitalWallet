<?php 
session_start();

if(isset($_SESSION["ID"])){
    echo "user id". $_SESSION['ID'];
}
?>