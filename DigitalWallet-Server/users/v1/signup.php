<?php 

header("Access-Control-Allow-Origin: http://127.0.0.1:5500");// allow the front end to access to the back end
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


require("../../connection/connection.php");
require("../../Models/userClass.php");
require("../../Models/usersFunc.php");



$data = json_decode(file_get_contents("php://input"),true);

if(empty($data['username']) || empty($data["password"]) || empty($data["email"])){
   echo json_encode(["success"=>false , "message"=>"Fill all the blank"]);
   return;
}
try{
   if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
        echo json_encode(["success"=>false , "message"=>"not a vailed email !"]);
        return;
   }
   $sql = "SELECT * FROM users WHERE email = ?";

    $user = new User($data['username'],$data["email"],$data["password"],false,false);
    $userFunc = new usersFunc($mysqli);

    if(!$userFunc-> searchUserByEmail(($user))){ 
    $createUser = $userFunc -> createUser($user);
     }else{
        echo json_encode(["success"=>false , "message"=>"Email is already exsit"]);
     }
}catch (Exception $e) {
    echo json_encode( ["error" => $e->getMessage()]);
}
 
?>