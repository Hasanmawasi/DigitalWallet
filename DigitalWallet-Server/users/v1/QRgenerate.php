<?php 
require("../../Utils/header.php");
include("../../connection/connection.php");
require("../../Models/wallets.php");
require("../../Models/walletFunc.php");

if(isset($_GET['userid']) || isset($_GET["walletid"]) || isset($_GET["amount"])){
    $user_id = $_GET['userid'];
    $wallet_id = $_GET["walletid"];
    $amount = $_GET["amount"];
    $fee=2;
    $walletFunc = new walletFunc($mysqli);
    $wallet= $walletFunc->getWallet($wallet_id);
    $walletFunc->withDraw($wallet,$amount+$fee);
    
    echo json_encode(["success"=>true,"message"=>"transfer success!!"]);
}else{
    echo json_encode(["success"=>false,"message"=>"fill the blank!!"]);

}
?>