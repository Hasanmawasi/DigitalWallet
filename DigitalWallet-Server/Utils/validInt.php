<?php 

function validInt($int){
    if(!filter_var($int,FILTER_VALIDATE_INT)){
        echo json_encode(["success"=>false , "message"=>"not a number !"]);
        return false;
    }
    return true;
}

?>