<?php 
include("../../connection/connection.php");
include("../../Utils/header.php");
require("../../Models/wallets.php");
require("../../Models/walletFunc.php");
include("../../Utils/validInt.php");

$data=json_decode(file_get_contents("php://input"),true);

if(empty($data["wallet_id"])){
    echo json_encode(["success"=>false , "message"=>"user id is not set!"]);
    return;
 }
 try {

    $walletFunc = new walletFunc($mysqli);
    if(validInt($data["wallet_id"])){
        
        $wallet= $walletFunc->getWallet($data["wallet_id"]);
        // echo json_encode(["success"=>true , "wallet"=> $wallet]);
      
        }
} catch (Exception $e) {
    json_encode(["error"=>$e]);
}
?>