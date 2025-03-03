<?php 
include("../../connection/connection.php");
include("../../Utils/header.php");
require("../../Models/wallets.php");
require("../../Models/walletFunc.php");

$data = json_decode(file_get_contents("php://input"),true);
if(empty($data['amount']) || empty($data['wallet_id']) || empty($data["type"])){
    echo json_encode(["success"=>false , "message"=>"Fill all the blank"]);
    return;
 }
try {
    $walletFunc = new walletFunc($mysqli);
    $wallet = $walletFunc->getWallet($data['wallet_id']);

    if($data['type']== "withdraw"){
        $withdraw= $walletFunc->withDraw($wallet,$data['amount']);
        if($withdraw){
            echo json_encode(["success"=>true,"message"=>"with draw success"]);
        }
        
    }else if($data['type']=="deposit"){
        $deposit = $walletFunc->Deposit($wallet,$data["amount"]);
        if($deposit){
            echo json_encode(["success"=>true,"message"=>"deposit  success"]);
        }
    }
} catch (Exception $e) {
    json_encode( ["error" => $e->getMessage()]);
    
}

?>