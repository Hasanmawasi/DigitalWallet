<?php 
include("../../Utils/header.php");
include("../../connection/connection.php");

$data=json_decode(file_get_contents("php://input"),true);

if(isset($data['user_id'])){

    $sql = "SELECT profile_url, user_name,user_email 
            FROM users  
            WHERE users.user_id = ?;";
    $stmt =$mysqli->prepare($sql);
    $stmt->bind_param('i',$data["user_id"]);
    if($stmt->execute()){
        $result  = $stmt->get_result();
        if( $result -> num_rows> 0){
            $profileUrl = $result-> fetch_assoc();
            echo json_encode(["user"=>$profileUrl]);
            return;
        }
    }
}


?>