<?php 
include("../../Utils/header.php");
require("../../connection/connection.php");
require("../../Models/userClass.php");
require("../../Models/usersFunc.php");

$data = json_decode(file_get_contents("php://input"),true);

if(empty($data["password"]) || empty($data["email"])){
    echo json_encode(["success"=>false , "message"=>"Fill all the blank!"]);
    return;
 }
try {
    include("../../Utils/emailvalidate.php");
    $user = new User("",$data["email"],$data["password"]);
    $userFunc = new usersFunc($mysql);

    if(!$userFunc->searchUserByEmail($user)){
        echo json_encode(["success"=>false , "message"=>"User not found"]);
    }else{
        echo json_encode(["success"=>true , "message"=>"User  found"]);
    }

} catch (Exception $e) {
    
}


?>