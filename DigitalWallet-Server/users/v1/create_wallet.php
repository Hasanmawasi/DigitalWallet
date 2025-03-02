<?php 
include("../../Utils/header.php");
require("../../connection/connection.php");
require("../../Models/wallets.php");
require("../../Models/walletFunc.php");

$data = json_decode(file_get_contents("php://input"),true);
if(empty($data['walletname']) || empty($data["balance"]) || empty($data["currency"])){
    echo json_encode(["success"=>false , "message"=>"Fill all the blank"]);
    return;
 }
 try {
    $userID = $_SESSION['user_id'];
    $balance = $data["balance"];
    $currency= $data["currency"];
    $daily_limit = 50;
    $wallet = new wallet($userID,$balance,$currency,$daily_limit);
    $walletFunc = new walletFunc($mysqli);
    $walletFunc->createWallet($wallet);
    if( $walletFunc->createWallet($wallet)){
        echo json_encode(["success"=>true,"message"=>"wallet created"]);
    }
 } catch (\Throwable $th) {
    echo json_encode(["success"=>false,"message"=>"wallet failed to create!"]);
    echo $th;
 }


?>