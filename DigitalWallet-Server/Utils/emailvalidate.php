<?php 
if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
    echo json_encode(["success"=>false , "message"=>"not a vailed email !"]);
    return;
}

?>