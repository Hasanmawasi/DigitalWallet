<?php 
include("../../connection/connection.php");
include("../../Utils/header.php");
require("../../Models/wallets.php");
require("../../Models/walletFunc.php");


$data = json_decode(file_get_contents("php://input"),true);
if(empty($data['amount']) || empty($data['email']) || empty($data["currency"]) || empty($data["walletInUse"])){
    echo json_encode(["success"=>false , "message"=>"Fill all the blank"]);
    return;
 }

 try {
    $walletfunc = new walletFunc($mysqli);
    include("../../Utils/emailvalidate.php");
    $sql = "SELECT wallets.* FROM users 
            JOIN wallets ON users.user_id = wallets.user_id
            where users.user_email=? and currency=?";
            $sql1 = "SELECT balance FROM wallets WHERE wallet_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt -> bind_param("ss",$data["email"],$data["currency"]);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows >0){
         $stmt1 = $mysqli->prepare($sql1);
         echo json_encode(["wallet_id"=>$data["walletInUse"]]);
         $Wid= (int)$data["walletInUse"];
         $stmt1-> bind_param("i"
                            ,$Wid);
         if($stmt1->execute()){ 
            $result1 = $stmt1->get_result();
            if($result->num_rows > 0){
                $walletsenderdbalance = $result->fetch_assoc();
                if($walletsenderdbalance['balance'] >= $data['amount'] ){
                    $walletinfo = $result-> fetch_assoc();
                    $RecieverWallet = new wallet($walletinfo['wallet_name'],$walletinfo['user_id'],$walletinfo['balance'],$walletinfo['currency'],$walletinfo['daily_limit']);
                    $RecieverWallet->setWalletId($walletinfo["wallet_id"]);
                    // echo json_encode(["waller"=>$RecieverWallet->getWalletInfo()]);
                    $walletfunc = new walletFunc($mysqli);
                    $walletfunc->Deposit($RecieverWallet,$data['amount']);
                    echo json_encode(["success"=>true,"message"=> "Amount is transfered"]);
                 }else{
                    echo json_encode(["success"=>false,"message"=> "insuffecient Amount in balance"]);
                }
           }
         }          
        }
    }else{
    echo json_encode(["error"=> $stmt->error]);

    }
 } catch (Exception $th) {
    //throw $th;
    echo json_encode(["error"=> $th]);

 }

?>