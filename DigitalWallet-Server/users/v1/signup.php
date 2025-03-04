<?php 

include("../../Utils/header.php");


require("../../connection/connection.php");
require("../../Models/userClass.php");
require("../../Models/usersFunc.php");

session_start();

$data = json_decode(file_get_contents("php://input"),true);

if(empty($data['username']) || empty($data["password"]) || empty($data["email"])){
   echo json_encode(["success"=>false , "message"=>"Fill all the blank"]);
   return;
}
try{
    // to make sure the entered email in correct format
   include("../../Utils/emailvalidate.php");

   // $sql = "SELECT * FROM users WHERE email = ?";
    // create user object from user class
    $user = new User($data['username'],$data["email"],$data["password"],false,false);
    $userFunc = new usersFunc($mysqli);

    if(!$userFunc-> searchUserByEmail(($user))){ 
      
       $createUser = $userFunc -> createUser($user);
      //   getting the id fron the data base
      $data= $userFunc-> searchUserByEmail($user);
      $userFunc->createCard($data['user_id']);
      echo json_encode(["user_id"=>$data['user_id']]);
     }else{
        echo json_encode(["success"=>false , "message"=>"Email is already exsit"]);
     }
}catch (Exception $e) {
   echo  json_encode( ["error" => $e->getMessage()]);
}
 
?>