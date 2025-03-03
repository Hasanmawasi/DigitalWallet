 <?php 
session_start();
echo json_encode( ["sessoin-chek"=>var_dump($_SESSION)]);
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
    // if(isset($_SESSION['user_id'])){ 
    // $userID =  $_SESSION['user_id'];
    $userID =31;
    $balance = $data["balance"];
    $currency= $data["currency"];
    $walletname= $data["walletname"];
    $daily_limit = 50;
    $wallet = new wallet($walletname,$userID,$balance,$currency,$daily_limit);
    $walletFunc = new walletFunc($mysqli);
    $walletFunc->createWallet($wallet);
    if( $walletFunc->createWallet($wallet)){
        echo json_encode(["success"=>true,"message"=>"wallet created"]);
    }
//  }else{
//     echo json_encode(["success"=>false,"message"=>"no session found","session"=>$_SESSION['user_id']]);
    
// }
 } catch (\Throwable $th) {
    echo json_encode(["success"=>false,"message"=>"wallet failed to create!"]);
    echo $th;
 }


?>