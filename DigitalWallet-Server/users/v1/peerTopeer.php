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
   $fee = 2;
    $walletfunc = new walletFunc($mysqli);
    include("../../Utils/emailvalidate.php");
    $sql = "SELECT wallets.* FROM users 
            JOIN wallets ON users.user_id = wallets.user_id
            where users.user_email=? and currency=?";
            $sql1 = "SELECT balance,user_id FROM wallets WHERE wallet_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt -> bind_param("ss",$data["email"],$data["currency"]);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows >0){
         $stmt1 = $mysqli->prepare($sql1);
         $Wid= (int)$data["walletInUse"];
         $stmt1-> bind_param("i"
                            ,$Wid);
         if($stmt1->execute()){ 
            $result1 = $stmt1->get_result();
            if($result->num_rows > 0){
                $walletsenderdbalance = $result->fetch_assoc();
                if(($walletsenderdbalance['balance']+$fee)>= $data['amount'] ){
                    $walletinfo = $result-> fetch_assoc();
                    $RecieverWallet = new wallet($walletinfo['wallet_name'],$walletinfo['user_id'],$walletinfo['balance'],$walletinfo['currency'],$walletinfo['daily_limit']);
                    $RecieverWallet->setWalletId($walletinfo["wallet_id"]);
                  //   echo json_encode(["waller"=>$RecieverWallet->getWalletInfo()]);
                    $walletfunc = new walletFunc($mysqli);
                    $walletfunc->Deposit($RecieverWallet,$data['amount']);

                  //   insert data into peer2peer table
                    $sql2 = "INSERT INTO peer2peer(sender_id,reciever_id,amount, fee,currency) VALUES(?,?,?,?,?)";
                    $stmt2 = $mysqli->prepare($sql2);
                    $stmt2->bind_param("iiiis",$walletsenderdbalance["user_id"],
                                                 $walletinfo['user_id'],
                                                 $data['amount'],
                                                 $fee,
                                                 $walletinfo['currency']);
                    if($stmt2->execute()){ 
                    echo json_encode(["success"=>true,"message"=> "Amount is transfered"]);
                    }
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
    
    echo json_encode(["error"=> $th]);

 }

?>