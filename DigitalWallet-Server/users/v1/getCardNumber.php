<?php 
include("../../Utils/header.php");
include("../../connection/connection.php");
include("../../Utils/validInt.php");
$data=json_decode(file_get_contents("php://input"),true);

if(empty($data["user_id"])){
    echo json_encode(["success"=>false , "message"=>"user id is not set!"]);
    return;
 }
try{
    $sql="SELECT * FROM cards_info WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    if(validInt($data["user_id"])){
        $stmt->bind_param('i',$data["user_id"]);
        if($stmt->execute()){
            $result= $stmt->get_result();
            $data = $result->fetch_assoc();
            echo json_encode(["card"=>$data]);
        }
    }
}catch(Exception $e){
    echo json_encode(["error"=>$e]);
}


?>