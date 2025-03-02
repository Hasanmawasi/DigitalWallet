<?php 
session_start();
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
    $userFunc = new usersFunc($mysqli);
    $loginUser = $userFunc->searchUserByEmail($user);
    if(!$loginUser){
        echo json_encode(["success"=>false , "message"=>"User not found"]);
    }else{
        $entered_password = $data["password"];
        $stored_password = $loginUser['password'];

        if(password_verify($entered_password, $stored_password)){
            $_SESSION['user_id']=$loginUser["user_id"];
            $_SESSION['user_email']=$loginUser["user_email"];
            echo json_encode(["success"=>true , "message"=>"User  found"]);
        }else{
            echo json_encode(["success"=>false , "message"=>"Incorrect Password"]);
        }

    }

} catch (Exception $e) {
    json_encode( ["error" => $e->getMessage()]);
    
}


?>